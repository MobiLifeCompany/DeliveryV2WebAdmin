ALTER TABLE shop_rates ADD CONSTRAINT fk_shop_rates_shops1_idx FOREIGN KEY (shop_id) REFERENCES shops(id);
ALTER TABLE shop_rates ADD CONSTRAINT fk_shop_rates_orders1_idx FOREIGN KEY (order_id) REFERENCES orders(id);
ALTER TABLE shop_rates ADD CONSTRAINT fk_shop_rates_customers1_idx FOREIGN KEY (customer_id) REFERENCES customers(id);