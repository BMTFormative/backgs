-- Begin of view: TotalPayments
-- This view aggregates the total amount paid per sale. It helps in understanding how much money has been collected for each sale.
CREATE VIEW TotalPayments AS
SELECT 
    paycustomers."SaleNumber",  -- Identifier for each sale.
    SUM(paycustomers."Amount") AS totalofpayment,  -- The total sum of payments for each sale.
FROM 
    paycustomers
GROUP BY 
    paycustomers."SaleNumber";
-- End of view: TotalPayments

-- Begin of view: TotalAmounts
-- This view calculates the total sales amount per sale based on quantity and price. It is useful for sales analysis and reporting.
CREATE VIEW TotalAmounts AS
SELECT 
    "SaleNumber",  -- Sale identifier.
    "TotalAmountWith",  -- Total revenue generated from each sale.
    "DateSale",  -- Date of the sale.
    "CustomerId"
FROM 
    sales
GROUP BY 
    "SaleNumber", "DateSale","CustomerId","TotalAmountWith";
-- End of view: TotalAmounts


-- Begin of view: Globalsellbuys
-- This view provides a combined report of total payments and sales for each customer, ensuring comprehensive financial tracking per customer.
CREATE VIEW Globalsellbuys AS
SELECT 
    coalesce(gp."CustomerId", gs."CustomerId") AS "CustomerId",  -- Ensures all customers are listed, even if they only have sales or payments.
    coalesce(gp.GlobalPayments, 0) AS GlobalPayments,  -- Sum of all payments per customer, with a fallback of 0 if none exist.
    coalesce(gs.GlobalSales, 0) AS GlobalSales  -- Sum of all sales per customer, with a fallback of 0 if none exist.
FROM 
    (SELECT 
        paycustomers."CustomerId",
        SUM(paycustomers."Amount") AS GlobalPayments
     FROM 
        paycustomers
     GROUP BY 
        paycustomers."CustomerId") gp
FULL OUTER JOIN
    (SELECT 
        sales."CustomerId",
        SUM(sales."TotalAmountWith") AS GlobalSales
     FROM 
        sales
     GROUP BY 
        sales."CustomerId") gs
ON gp."CustomerId" = gs."CustomerId";
-- End of view: Globalsellbuys

-- Begin of view: product_qty_changes
-- This view calculates the net change in product quantities, considering both sales and stock replenishments, vital for inventory management.
CREATE VIEW product_qty_changes AS
WITH sales_sum AS (
    SELECT
        "ProductId",
        SUM("Qty") AS decrease  -- Total units sold.
    FROM saledetails
    GROUP BY "ProductId"
),
stocks_sum AS (
    SELECT
        "ProductId",
        SUM("Qty") AS increase  -- Total units added to stock.
    FROM stocks
    GROUP BY "ProductId"
)
SELECT
    s."ProductId",
    COALESCE(s.increase, 0) - COALESCE(st.decrease, 0) AS net_change  -- Net inventory change per product.
FROM stocks_sum s
FULL OUTER JOIN sales_sum st ON s."ProductId" = st."ProductId";
-- End of view: product_qty_changes


-- Begin of function: allocate_global_payment
-- This function is designed to allocate a global payment across various sales based on their outstanding balances. 
-- It ensures payments are distributed starting with the oldest sales to effectively manage receivables.
CREATE OR REPLACE FUNCTION allocate_global_payment(global_payment_id bigint, total_payment_amount decimal)
RETURNS void AS $$
DECLARE
    current_sale record;  -- Holds each sale's data fetched from the query in the loop, specifically sales with outstanding balances.
    remaining_payment decimal := total_payment_amount;  -- Starts with the total payment amount and decreases as payments are allocated.
    allocate_amount decimal;  -- Determines the amount to allocate to each sale during the loop.

BEGIN
    -- Loop through each sale to allocate the global payment amount. The loop prioritizes older sales with outstanding balances.
    FOR current_sale IN 
        SELECT 
            s."SaleNumber",  -- Sale number identifier.
            s."DateSale",  -- Date of sale, used to prioritize older debts.
            s."TotalAmountWith" - COALESCE(SUM(p."Amount"), 0) AS outstanding,  -- Calculated as total sale amount minus any payments already made.
            s."CustomerId"
        FROM 
            totalamounts s
        LEFT JOIN 
            paycustomers p ON s."SaleNumber" = p."SaleNumber"
        GROUP BY 
            s."SaleNumber", s."TotalAmountWith", s."DateSale", s."CustomerId"
        HAVING 
            s."TotalAmountWith" - COALESCE(SUM(p."Amount"), 0) > 0  -- Filters to only include sales with outstanding amounts.
        ORDER BY 
            s."DateSale" ASC  -- Orders by sale date to ensure oldest debts are paid first.
    LOOP
        -- Exit loop if there is no remaining payment to allocate.
        IF remaining_payment <= 0 THEN
            EXIT;
        END IF;

        -- Determine the smallest amount between the outstanding sale amount and the remaining payment.
        allocate_amount := LEAST(current_sale.outstanding, remaining_payment);

        -- Record the payment allocation in the 'paycustomers' table.
        INSERT INTO public.paycustomers("SaleNumber","CustomerId", "DatePayment", "Amount", "GlobalepaymentId", "created_at", "updated_at")
        VALUES (current_sale."SaleNumber",current_sale."CustomerId", NOW(), allocate_amount, global_payment_id, NOW(), NOW());

        -- Subtract the allocated amount from the remaining payment total.
        remaining_payment := remaining_payment - allocate_amount;
    END LOOP;
END;
$$ LANGUAGE plpgsql; -- Specifies that the function uses the PL/pgSQL procedural language.
-- End of function: allocate_global_payment




--------------------------------------------------------------------------- function split global payment 
