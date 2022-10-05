-- Bank

CREATE FUNCTION f_found_my_bank(email varchar(255))
  RETURNS int
BEGIN
  DECLARE user_id int;
  DECLARE money int;

  SELECT u.id INTO user_id
  FROM user u
  WHERE u.email = email;

  SELECT b.money INTO money
  FROM bank b
  WHERE b.user_id = user_id;
  
  RETURN money;   

END;

SELECT f_found_my_bank('s@list.ru') AS 'found_my_bank';
-- резерв

SELECT cp.id, p.name, cp.quantity, cp.datetime
  FROM customer_product cp JOIN product p ON cp.product_id = p.id
  WHERE (cp.user_broker_id = 5) AND (cp.quantity > 0);

SELECT ub.id
  FROM user_broker ub JOIN user u ON ub.user_id = u.id
  WHERE u.email = 's@list.ru';

CREATE PROCEDURE pr_book_money(email varchar(255))
  BEGIN
  DECLARE user_broker_id int;

  SELECT ub.id INTO user_broker_id
  FROM user_broker ub JOIN user u ON ub.user_id = u.id
  WHERE u.email = email;

  SELECT cp.id, p.name, cp.price, cp.quantity, cp.datetime
  FROM customer_product cp JOIN product p ON cp.product_id = p.id
  WHERE (cp.user_broker_id = user_broker_id) AND (cp.quantity > 0);

  END;
CALL pr_book_money('s@list.ru');

-- резерв товара

CREATE PROCEDURE pr_book_product(email varchar(255))
  BEGIN
  DECLARE user_broker_id int;

  SELECT ub.id INTO user_broker_id
  FROM user_broker ub JOIN user u ON ub.user_id = u.id
  WHERE u.email = email;

  SELECT sp.id, p.name, sp.price, sp.quantity, sp.datetime
  FROM seller_product sp JOIN product p ON sp.product_id = p.id
  WHERE (sp.user_broker_id = user_broker_id) AND (sp.quantity > 0);

  END;

CALL pr_book_product('s@list.ru');

-- удаление из SELLER_PRODUCT
CREATE FUNCTION f_del_offer_customer( id_offer_customer int, email varchar(255))
  RETURNS int
BEGIN
  DECLARE user_id int;
  DECLARE money double;
  DECLARE quantity int;

  SELECT cp.price, cp.quantity INTO money, quantity
  FROM customer_product cp
  WHERE cp.id = id_offer_customer;

  SELECT u.id INTO user_id
    FROM user u
    WHERE u.email = email;

  UPDATE bank b SET b.money = b.money + (money * quantity)
  WHERE b.user_id = user_id;

  DELETE FROM customer_product WHERE id = id_offer_customer;

  RETURN 1;
END;

SELECT f_del_offer_customer(9, 's@list.ru');


CREATE FUNCTION f_del_offer_customer( id_offer_seller int, email varchar(255))
  RETURNS int
BEGIN
  DECLARE user_id int;
  DECLARE money double;
  DECLARE quantity int;

  SELECT cp.price, cp.quantity INTO money, quantity
  FROM customer_product cp
  WHERE cp.id = id_offer_seller;

  SELECT u.id INTO user_id
    FROM user u
    WHERE u.email = email;

  UPDATE bank b SET b.money = b.money + (money * quantity)
  WHERE b.user_id = user_id;

  DELETE FROM seller_product WHERE id = id_offer_customer;

  RETURN 1;
END;


-- УДАЛЕНИЕ SELLER_PRODUCT

  SELECT COUNT(a.id)
    FROM archive a
    WHERE a.user_broker_id = 5;

  
CREATE FUNCTION f_del_offer_seller( id_offer_seller int, email varchar(255))
  RETURNS int
BEGIN
  DECLARE user_id int;
  DECLARE money double;
  DECLARE quantity int;
  DECLARE user_broker_id int;
  DECLARE product_id int;
  DECLARE count_archive int;

  SELECT sp.price, sp.quantity INTO money, quantity
  FROM seller_product sp
  WHERE sp.id = id_offer_seller;

  SELECT u.id INTO user_id
    FROM user u
    WHERE u.email = email;

  SELECT sp.user_broker_id, sp.product_id INTO user_broker_id, product_id
    FROM seller_product sp
    WHERE sp.id = id_offer_seller;


  UPDATE archive a SET a.quantity = a.quantity + quantity
    WHERE (a.user_id = user_id) AND (a.product_id = product_id);


  DELETE FROM seller_product WHERE id = id_offer_seller;

  RETURN 1;
END;

SELECT f_del_offer_seller(10, 's@list.ru');

-- Archive 
CREATE PROCEDURE pr_chek_archive(email varchar(255))
BEGIN
  DECLARE user_id int;
  
  
  SELECT u.id INTO user_id
  FROM user u
  WHERE u.email = email;

  SELECT p.name, a.quantity
  FROM archive a JOIN product p ON a.product_id = p.id
  WHERE a.user_id = user_id;

END;

CALL pr_chek_archive('s@list.ru');

