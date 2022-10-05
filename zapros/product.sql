-- Проверка банка 



  CREATE FUNCTION f_chek_customer_bank(email varchar(50))
  RETURNS int
  BEGIN
    DECLARE user_id int;
    DECLARE customer_price double;
    
    SELECT ub.id INTO user_id
    FROM user_broker ub JOIN user u ON ub.user_id = u.id
    WHERE u.email = email;

    SELECT b.money INTO customer_price
    FROM bank b
    WHERE b.user_broker_id = user_id;

    RETURN customer_price;

END;

SELECT f_chek_customer_bank('yra@gmail.com') AS 'chek_customer_bank';


-- проверка банка 
CREATE FUNCTION f_chek_customer_money(email varchar(50))
  RETURNS int
  BEGIN
    DECLARE user_id int;
    DECLARE money double;
    
    SELECT u.id INTO user_id
    FROM user u 
    WHERE u.email = email;

    SELECT b.money INTO money
      FROM bank b
      WHERE b.user_id = user_id;
  RETURN money;
  END;
  
SELECT f_chek_customer_money('s@list.ru');

SELECT u.id
    FROM user_broker ub JOIN user u ON ub.user_id = u.id
    WHERE u.email = 's@list.ru';

-- Добавление в CUSTOMER PRODUCT

CREATE FUNCTION f_add_customer_product(email varchar(50), product_id int, datetime datetime, quantity int, price double)
  RETURNS int
  BEGIN
    DECLARE user_id int;
    DECLARE user_broker_id int;
    DECLARE max_customer_price double;
    
    SELECT ub.id, u.id INTO user_broker_id, user_id
    FROM user_broker ub JOIN user u ON ub.user_id = u.id
    WHERE u.email = email;   

     UPDATE bank b SET b.money = (b.money - (price * quantity))
     WHERE b.user_id =  user_id;
      
     INSERT IGNORE INTO customer_product(user_broker_id, product_id, datetime, quantity, price, `all`)
     VALUE (user_broker_id, product_id, datetime, quantity, price, quantity);
  
     SELECT fmm.price INTO max_customer_price
        FROM function_max_min fmm
        WHERE (fmm.max_min = 'max_customer') AND (fmm.product_id = product_id);
     
     IF (price > max_customer_price) THEN 
      UPDATE function_max_min fmm SET fmm.price = price
         WHERE (fmm.max_min = 'max_customer') AND (fmm.product_id = product_id);
      END IF;

  RETURN 1; 
  END;

SELECT f_add_customer_product('yra@gmail.com', 6, '2008-10-23 10:37:22', 10, 140);
SELECT f_add_customer_product('s@list.ru', 2, '2020.08.06 00:55:37', 4 , 10) AS 'customer';




-- ПРОВЕРКА НАЛИЧИЯ ПРОДУКТА ПО КАТЕГОРИИ

  SELECT ub.id
  FROM user_broker ub JOIN user u ON ub.user_id = u.id
  WHERE u.email = 's@list.ru';

  SELECT COUNT(a.product_id)
    FROM archive a
    WHERE (a.user_broker_id = 5) AND (a.product_id = 5);

  SELECT p.id
    FROM product p
    WHERE p.name = 'Груша';

  CREATE FUNCTION f_sale_chek_category(email varchar(50), product_id int)
  RETURNS int
  BEGIN
    DECLARE user_id int;
    DECLARE chek int;
    
    SELECT u.id INTO user_id
    FROM user u 
    WHERE u.email = email;

    SELECT COUNT(a.product_id) INTO chek
    FROM archive a
    WHERE (a.user_id = user_id) AND (a.product_id = product_id);  

  RETURN chek; 
  END;

  SELECT f_sale_chek_category('s@list.ru', 6) AS "sale_chek_category";
  SELECT f_sale_chek_category('s@list.ru', 6) AS 'sale_chek_category';


  -- ПРОВЕРКА НАЛИЧИЯ ТОВАРА ПО КОЛ-ВУ

SELECT a.quantity
    FROM archive a
    WHERE (a.user_broker_id = 5) AND (a.product_id = 6); 

 CREATE FUNCTION f_seller_chek_quantity(email varchar(50), product_id int)
  RETURNS int
  BEGIN
    DECLARE user_id int;
    DECLARE chek int;
    
    SELECT u.id INTO user_id
    FROM user u 
    WHERE u.email = email;


    SELECT a.quantity INTO chek
    FROM archive a
    WHERE (a.user_id = user_id) AND (a.product_id = product_id);   

  RETURN chek; 
  END; 

SELECT f_seller_chek_quantity('s@list.ru', 6) AS "seller_chek_quantity";

  -- ДОБАВЛЕНИЕ В SELLER_PRODUCT

UPDATE archive a SET a.quantity = 250
    WHERE (a.user_broker_id = 5) AND (a.product_id = 6);

CREATE FUNCTION f_add_seller_product(email varchar(50), product_id int, datetime datetime, quantity int, quantity_last int, price double)
  RETURNS int
  BEGIN
    DECLARE user_id int;   
    DECLARE user_broker_id int;   
    DECLARE min_seller_price double;
    
    SELECT u.id INTO user_id
    FROM user u 
    WHERE u.email = email;


    SELECT ub.id INTO user_broker_id
    FROM user_broker ub JOIN user u ON ub.user_id = u.id
    WHERE u.email = email;

    UPDATE archive a SET a.quantity = (quantity_last - quantity)
    WHERE (a.user_id = user_id) AND (a.product_id = product_id);

   INSERT IGNORE INTO seller_product(user_broker_id, product_id, datetime, quantity, price, `all`)
   VALUE (user_broker_id, product_id, datetime, quantity, price, quantity);
  
   SELECT fmm.price INTO min_seller_price
      FROM function_max_min fmm
      WHERE (fmm.max_min = 'min_seller') AND (fmm.product_id = product_id);   

   IF (min_seller_price > price) THEN
    UPDATE function_max_min fmm SET fmm.price = price
       WHERE (fmm.max_min = 'min_seller') AND (fmm.product_id = product_id); 
   END IF;
  RETURN 1; 
  END;

  SELECT f_add_seller_product('s@list.ru', 6, '2008-10-23 10:37:22', 20, 250, 11222.23) AS 'add_seller_product';
  SELECT f_add_seller_product('s@list.ru', 6, '2020.06.24 23:16:26', 230, 12 , 123) AS 'customer';

  -- ВЫЗОВ СТАКАНА 

CREATE VIEW v_sort_cup_customer
  AS
  SELECT cp.price, cp.quantity, cp.datetime
    FROM customer_product cp
    ORDER BY cp.price ASC, cp.datetime ASC;

SELECT * FROM  v_sort_cup_customer;

 SELECT v.price, SUM(v.quantity)
    FROM v_sort_cup_customer v
    GROUP BY v.price;

 CREATE PROCEDURE pr_sort_cup_seller(product_id int)
 BEGIN
   SELECT sp.price, sp.quantity, sp.datetime
    FROM seller_product sp
    WHERE sp.product_id = product_id
    ORDER BY sp.price ASC, sp.datetime ASC;
 END;
  

  -- ВЫЗОВ СТАКАНА  ДЛЯ SELLER
 CREATE PROCEDURE pr_sort_cup_seller(product_id int)
 BEGIN
 SELECT SUM(s.quantity) AS 'quantity', s.price
   FROM (
         SELECT sp.price, sp.quantity 
         FROM seller_product sp
         WHERE (sp.product_id = product_id)  AND (sp.quantity > 0)   
         ORDER BY sp.price ASC, sp.datetime ASC) AS s
         GROUP BY s.price
         ORDER BY s.price DESC;
 END;

CALL pr_sort_cup_seller(6);

SELECT SUM(s.quantity) AS 'quantity', s.price
   FROM (
         SELECT sp.price, sp.quantity 
         FROM seller_product sp
         WHERE (sp.product_id = product_id) AND (sp.quantity > 0)    
         ORDER BY sp.price ASC, sp.datetime ASC) AS s
         GROUP BY s.price
         ORDER BY s.price DESC;

-- ВЫЗОВ СТАКАНА  ДЛЯ CUSTOMER

CREATE PROCEDURE pr_sort_cup_customer(product_id int)
BEGIN
SELECT SUM(s.quantity) AS 'quantity', s.price
  FROM (
  SELECT cp.price, cp.quantity 
         FROM customer_product cp
         WHERE (cp.product_id = product_id) AND (cp.quantity > 0)   
         ORDER BY cp.price ASC, cp.datetime ASC) AS s 
         GROUP BY s.price
         ORDER BY s.price DESC;
  END;

CALL pr_sort_cup_customer(6);

-- свое количество 
CREATE FUNCTION f_my_customer_price(email varchar(255), product_id int, price double)
RETURNS int
BEGIN
  DECLARE record int;
  DECLARE user_id int;
  DECLARE quantity int;

   SELECT ub.id INTO user_id
    FROM user_broker ub JOIN user u ON ub.user_id = u.id
    WHERE u.email = email;

  SELECT SUM(cp.quantity), COUNT(cp.id) INTO quantity, record
    FROM customer_product cp
    WHERE (cp.user_broker_id = user_id) AND (cp.price = price) AND (cp.product_id = product_id);

  IF (record = 0) THEN
     SET quantity = 0;
  END IF;

  RETURN quantity;
end;

SELECT f_my_customer_price('s@list.ru', 6, 1) AS 'my_customer_price';


CREATE FUNCTION f_my_seller_price(email varchar(255), product_id int, price double)
RETURNS int
BEGIN
  DECLARE record int;
  DECLARE user_id int;
  DECLARE quantity int;

   SELECT ub.id INTO user_id
    FROM user_broker ub JOIN user u ON ub.user_id = u.id
    WHERE u.email = email;

  SELECT sum(sp.quantity), COUNT(sp.id) INTO quantity, record
    FROM seller_product sp
    WHERE (sp.user_broker_id = user_id) AND (sp.price = price) AND (sp.product_id = product_id);

  IF (record = 0) THEN
     SET quantity = 0;
  END IF;

  RETURN quantity;
end;

SELECT f_my_seller_price('s@list.ru', 6, 120) AS 'my_seller_price';
SELECT f_my_seller_price('gira222@yandex.ru', 1, 333) AS 'my_seller_price';

-- обработка стакана

CREATE FUNCTION f_processing_cup(product_id int)
  RETURNS int
BEGIN
  DECLARE max_customer_price double;
  DECLARE min_seller_price double;
  DECLARE customer_id int;
  DECLARE customer_user_broker_id int;
  DECLARE customer_price double;
  DECLARE customer_quantity int;
  DECLARE seller_id int;
  DECLARE seller_user_broker_id int;
  DECLARE seller_price double;
  DECLARE seller_quantity int;
  DECLARE seller_bank int;
  DECLARE customer_bank int;
  DECLARE trade_time datetime;
  DECLARE cou int;

      SELECT fmm.price INTO min_seller_price
      FROM function_max_min fmm
      WHERE (fmm.max_min = 'min_seller') AND (fmm.product_id = product_id);    

      SELECT fmm.price INTO max_customer_price
      FROM function_max_min fmm
      WHERE (fmm.max_min = 'max_customer') AND (fmm.product_id = product_id);

      SELECT sp.id, sp.price, sp.quantity, sp.user_broker_id iNTO seller_id, seller_price, seller_quantity, seller_user_broker_id
      FROM seller_product sp
      WHERE (sp.quantity > 0) AND (sp.product_id = product_id)
      ORDER BY sp.price ASC, sp.datetime ASC    
      LIMIT 1;

      SELECT cp.id, cp.price, cp.quantity, cp.user_broker_id INTO customer_id, customer_price, customer_quantity, customer_user_broker_id
      FROM customer_product cp
      WHERE (cp.quantity > 0)  AND (cp.product_id = product_id)
      ORDER BY cp.price DESC, cp.datetime DESC
      LIMIT 1;      

       SELECT ub.user_id INTO seller_bank
       FROM user_broker ub
       WHERE ub.id = seller_id;

       SELECT ub.user_id INTO customer_bank
       FROM user_broker ub
       WHERE ub.id = customer_id;
      
   
    WHILE (max_customer_price >= min_seller_price) DO   
      
        IF (customer_quantity > seller_quantity) THEN 
        SELECT NOW() INTO trade_time; 
        
        INSERT IGNORE INTO trade(seller_id, customer_id, product_id, datetime, quantity, price)
          VALUES (1, 1, 1, trade_time, 5, 100);

        UPDATE seller_product sp set sp.quantity = 0
        WHERE sp.id = seller_id;

        UPDATE bank b SET b.money = b.money + (seller_quantity * seller_price)
        WHERE b.user_id = seller_bank;

        UPDATE customer_product cp set cp.quantity = (customer_quantity - seller_quantity)
        WHERE cp.id = customer_id;

        SELECT COUNT(a.id) INTO cou
        FROM archive a
        WHERE (a.user_id = customer_bank) AND (a.product_id = product_id);

        IF (cou = 1) THEN 
        UPDATE archive a SET a.quantity = a.quantity + seller_quantity
        WHERE (a.user_id = customer_bank) AND (a.product_id = product_id);
        END IF;
         
        IF (cou = 0) THEN 
        INSERT IGNORE INTO archive(user_id, product_id, quantity)
        VALUES(customer_bank, product_id, seller_quantity);
        END IF;
                
       END IF;
       IF (customer_quantity = seller_quantity) THEN 
         SELECT NOW() INTO trade_time; 
         INSERT IGNORE INTO trade(seller_id, customer_id, product_id, datetime, quantity, price)
          VALUES (seller_bank, customer_bank, product_id, trade_time, seller_quantity, seller_price);

         UPDATE seller_product sp set sp.quantity = 0
         WHERE sp.id = seller_id;
         UPDATE bank b SET b.money = b.money + (seller_quantity * seller_price)
         WHERE b.user_id = seller_bank;

         UPDATE customer_product cp set cp.quantity = 0
         WHERE cp.id = customer_id;
        
        SELECT COUNT(a.id) INTO cou
        FROM archive a
        WHERE (a.user_id = customer_bank) AND (a.product_id = product_id);

        IF (cou = 1) THEN 
        UPDATE archive a SET a.quantity = a.quantity + seller_quantity
        WHERE (a.user_id = customer_bank) AND (a.product_id = product_id);
        END IF;
         
        IF (cou = 0) THEN 
        INSERT IGNORE INTO archive(user_id, product_id, quantity)
        VALUES(customer_bank, product_id, seller_quantity);
        END IF;
        
        
       END IF;
       IF (customer_quantity < seller_quantity) THEN 
         SELECT NOW() INTO trade_time; 
         INSERT IGNORE INTO trade(seller_id, customer_id, product_id, datetime, quantity, price)
          VALUES (seller_bank, customer_bank, product_id, trade_time, customer_quantity, seller_price);

         UPDATE seller_product sp set sp.quantity = (seller_quantity - customer_quantity)
         WHERE sp.id = seller_id;
         UPDATE bank b SET b.money = b.money + (customer_quantity * seller_price)
         WHERE b.user_id = seller_bank;

         UPDATE customer_product cp set cp.quantity = 0
         WHERE cp.id = customer_id; 

        SELECT COUNT(a.id) INTO cou
        FROM archive a
        WHERE (a.user_id = customer_bank) AND (a.product_id = product_id);

        IF (cou = 1) THEN 
        UPDATE archive a SET a.quantity = a.quantity + customer_quantity
        WHERE (a.user_id = customer_bank) AND (a.product_id = product_id);
        END IF;
         
        IF (cou = 0) THEN 
        INSERT IGNORE INTO archive(user_id, product_id, quantity)
        VALUES(customer_bank, product_id, customer_quantity);
        END IF;
         
       END IF;

      

       SELECT sp.id, sp.price, sp.quantity, sp.user_broker_id iNTO seller_id, seller_price, seller_quantity, seller_user_broker_id
       FROM seller_product sp
       WHERE (sp.quantity > 0)  AND (sp.product_id = product_id)
       ORDER BY sp.price ASC, sp.datetime ASC    
       LIMIT 1;

       UPDATE function_max_min fmm SET fmm.price = seller_price
       WHERE (fmm.max_min = 'min_seller') AND (fmm.product_id = product_id);

       SELECT fmm.price INTO min_seller_price
       FROM function_max_min fmm
       WHERE (fmm.max_min = 'min_seller') AND (fmm.product_id = product_id);


       SELECT cp.id, cp.price, cp.quantity, cp.user_broker_id INTO customer_id, customer_price, customer_quantity, customer_user_broker_id
       FROM customer_product cp
       WHERE (cp.quantity > 0) AND (cp.product_id = product_id)
       ORDER BY cp.price DESC, cp.datetime DESC
       LIMIT 1;
       
       UPDATE function_max_min fmm SET fmm.price = customer_price
       WHERE (fmm.max_min = 'max_customer') AND (fmm.product_id = product_id);
       
       SELECT fmm.price INTO max_customer_price
       FROM function_max_min fmm
       WHERE (fmm.max_min = 'max_customer')  AND (fmm.product_id = product_id);
      
      SELECT ub.user_id INTO seller_bank
       FROM user_broker ub
       WHERE ub.id = seller_id;

       SELECT ub.user_id INTO customer_bank
       FROM user_broker ub
       WHERE ub.id = customer_id;
    END WHILE;
    

    
  RETURN 1;
  END;

SELECT f_processing_cup(1);

 -- добавление в TRADE

INSERT IGNORE INTO trade(seller_product_id, customer_product_id, product_id, datetime, price, quantity)
  VALUES (1, 6);


CREATE FUNCTION f_demo()
    RETURNS datetime
BEGIN
  DECLARE contrac_date datetime;
  
   SELECT NOW() INTO contrac_date; 

  RETURN contrac_date;
END;
 

CREATE FUNCTION f_count_archive(product_id int, user_id int, quantity int)
  RETURNS int
BEGIN 
  DECLARE cou int;

   SELECT COUNT(a.id) INTO cou
        FROM archive a
        WHERE (a.user_id = user_id) AND (a.product_id = product_id);

   IF (cou = 1) THEN 
   UPDATE archive a SET a.quantity = a.quantity + quantity
   WHERE (a.user_id = user_id) AND (a.product_id = product_id);
   END IF;
   
   IF (cou = 0) THEN 
   INSERT IGNORE INTO archive(user_id, product_id, quantity)
   VALUES(user_id, product_id, quantity);
   END IF;

  RETURN 1;
END; 


SELECT f_count_archive(6, 1, 3);




 SELECT NOW()
