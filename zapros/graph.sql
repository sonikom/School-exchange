SELECT u.id, u.last_name AS user, b.id AS id1, b.last_name AS brok
  FROM user u JOIN user_broker ub ON u.id = ub.user_id
  JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id
  JOIN brokers b ON bt.broker_id = b.id
WHERE b.id=1;

SELECT u.id, u.last_name AS user, b.id AS id1, b.last_name AS brok
  FROM user u JOIN user_broker ub ON u.id = ub.user_id
  JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id
  JOIN brokers b ON bt.broker_id = b.id
WHERE b.id=1;


-- ГРАФИК НА НЕДЕЛЮ

CREATE FUNCTION f_graph_all(time int, product_id int)
RETURNS int
BEGIN
  DECLARE colvo int;
  DECLARE colvo_fin int;
  DECLARE time_now datetime;
  DECLARE time_new datetime; 
  DECLARE time_year int;
  DECLARE time_month int;
  DECLARE time_day int;

  SELECT CURRENT_DATE() INTO time_now;

  SELECT ADDDATE(time_now, INTERVAL time DAY) INTO time_new;

  SELECT YEAR(time_new) INTO time_year;
  SELECT MONTH(time_new) INTO time_month;
  SELECT DAYOFMONTH(time_new) INTO time_day;

  SELECT s.colvo INTO colvo
  FROM(SELECT YEAR(t.datetime) AS y, MONTH(t.datetime) AS m, DAY(t.datetime) AS d, SUM(t.quantity) AS colvo
        FROM trade t JOIN product p ON t.product_id = p.id
        WHERE (p.id = product_id) 
        GROUP BY y, m, d) AS s 
  WHERE s.y = time_year AND s.m = time_month AND s.d = time_day;


  
  RETURN colvo;
END;

SELECT f_graph_all(-6, 6) AS 'graph_all';

SELECT ADDDATE('2011-04-15 00:02:00', INTERVAL -1 DAY);

SELECT s.colvo
  FROM(SELECT YEAR(t.datetime) AS y, MONTH(t.datetime) AS m, DAY(t.datetime) AS d, SUM(t.quantity) AS colvo
        FROM trade t JOIN product p ON t.product_id = p.id
        WHERE (p.id = 6) 
        GROUP BY y, m, d) AS s 
  WHERE s.y = 2020 AND s.m = 7 AND s.d = 28;


-- ДНИ НЕДЕЛИ

CREATE FUNCTION f_date_day(time int)
RETURNS int
BEGIN
  
  DECLARE time_now datetime;
  DECLARE time_new datetime; 
    DECLARE time_day int;

  SELECT CURRENT_DATE() INTO time_now;

  SELECT ADDDATE(time_now, INTERVAL time DAY) INTO time_new;

  
  SELECT DAYOFMONTH(time_new) INTO time_day;

  RETURN time_day;
END;

SELECT f_date_day(-7) AS 'date_day';

-- ПРОВЕРКА ДНЯ 
CREATE FUNCTION f_check_date_day(time int, product_id int)
RETURNS int
BEGIN
 
  DECLARE colvo_fin int;
  DECLARE time_now datetime;
  DECLARE time_new datetime; 
  DECLARE time_year int;
  DECLARE time_month int;
  DECLARE time_day int;

  SELECT CURRENT_DATE() INTO time_now;

  SELECT ADDDATE(time_now, INTERVAL time DAY) INTO time_new;

  SELECT YEAR(time_new) INTO time_year;
  SELECT MONTH(time_new) INTO time_month;
  SELECT DAYOFMONTH(time_new) INTO time_day;

  SELECT COUNT(s.colvo) INTO colvo_fin
    FROM(SELECT YEAR(t.datetime) AS y, MONTH(t.datetime) AS m, DAY(t.datetime) AS d, t.id AS colvo
        FROM trade t JOIN product p ON t.product_id = p.id
        WHERE (p.id = product_id) 
        GROUP BY y, m, d) AS s 
    WHERE s.y = time_year AND s.m = time_month AND s.d = time_day;

RETURN colvo_fin;
END;

SELECT f_check_date_day(-7) AS 'check_date_day';

-- ЛИЧНЫЙ ГРАФИК ДЛЯ КАЖДОГО ПОЛЬЗОВАТЕЛЯ

-- CUSTOMER


  CREATE FUNCTION f_graph_user_customer(time int, product_id int, email varchar(255))
RETURNS int
BEGIN
  DECLARE colvo int;
  DECLARE colvo_fin int;
  DECLARE time_now datetime;
  DECLARE time_new datetime; 
  DECLARE time_year int;
  DECLARE time_month int;
  DECLARE time_day int;

  SELECT CURRENT_DATE() INTO time_now;

  SELECT ADDDATE(time_now, INTERVAL time DAY) INTO time_new;

  SELECT YEAR(time_new) INTO time_year;
  SELECT MONTH(time_new) INTO time_month;
  SELECT DAYOFMONTH(time_new) INTO time_day;

  SELECT s.colvo INTO colvo
  FROM(SELECT YEAR(t.datetime) AS y, MONTH(t.datetime) AS m, DAY(t.datetime) AS d, SUM(t.quantity) AS colvo
        FROM trade t JOIN product p ON t.product_id = p.id JOIN user u ON t.customer_id = u.id
        WHERE (p.id = product_id) AND (u.email = email)
        GROUP BY y, m, d) AS s 
  WHERE s.y = time_year AND s.m = time_month AND s.d = time_day;


  
  RETURN colvo;
END;



SELECT f_graph_user_customer(-6, 6, 's@list.ru') AS 'graph_user_customer';




SELECT f_check_date_day_customer(-2, 6, 's@list.ru') AS 'graph_user_customer';

SELECT f_check_date_day_customer(-6, 6, 's@list.ru') AS 'check_date_day_customer';


SELECT f_graph_user_customer(-6, 6, 's@list.ru') AS 'graph_user_customer';

 

  CREATE FUNCTION f_check_date_day_customer(time int, product_id int, email varchar(255))
    RETURNS int
    BEGIN
    

    DECLARE colvo int;
    DECLARE time_now datetime;
    DECLARE time_new datetime; 
    DECLARE time_year int;
    DECLARE time_month int;
    DECLARE time_day int;
  
    SELECT CURRENT_DATE() INTO time_now;
  
    SELECT ADDDATE(time_now, INTERVAL time DAY) INTO time_new;
  
    SELECT YEAR(time_new) INTO time_year;
    SELECT MONTH(time_new) INTO time_month;
    SELECT DAYOFMONTH(time_new) INTO time_day;

    SELECT COUNT(s.colvo) INTO colvo
    FROM(SELECT YEAR(t.datetime) AS y, MONTH(t.datetime) AS m, DAY(t.datetime) AS d, t.id AS colvo
        FROM trade t JOIN product p ON t.product_id = p.id JOIN user u ON t.customer_id = u.id
        WHERE (p.id = product_id) AND (u.email = email) 
        GROUP BY y, m, d) AS s 
    WHERE s.y = time_year AND s.m = time_month AND s.d = time_day;

    RETURN colvo;

    END;


-- SELLER 

 CREATE FUNCTION f_graph_user_seller(time int, product_id int, email varchar(255))
RETURNS int
BEGIN
  DECLARE colvo int;
  DECLARE colvo_fin int;
  DECLARE time_now datetime;
  DECLARE time_new datetime; 
  DECLARE time_year int;
  DECLARE time_month int;
  DECLARE time_day int;

  SELECT CURRENT_DATE() INTO time_now;

  SELECT ADDDATE(time_now, INTERVAL time DAY) INTO time_new;

  SELECT YEAR(time_new) INTO time_year;
  SELECT MONTH(time_new) INTO time_month;
  SELECT DAYOFMONTH(time_new) INTO time_day;

  SELECT s.colvo INTO colvo
  FROM(SELECT YEAR(t.datetime) AS y, MONTH(t.datetime) AS m, DAY(t.datetime) AS d, SUM(t.quantity) AS colvo
        FROM trade t JOIN product p ON t.product_id = p.id JOIN user u ON t.seller_id = u.id
        WHERE (p.id = product_id) AND (u.email = email)
        GROUP BY y, m, d) AS s 
  WHERE s.y = time_year AND s.m = time_month AND s.d = time_day;


  
  RETURN colvo;
END;

  CREATE FUNCTION f_check_date_day_seller(time int, product_id int, email varchar(255))
    RETURNS int
    BEGIN
    

    DECLARE colvo int;
    DECLARE time_now datetime;
    DECLARE time_new datetime; 
    DECLARE time_year int;
    DECLARE time_month int;
    DECLARE time_day int;
  
    SELECT CURRENT_DATE() INTO time_now;
  
    SELECT ADDDATE(time_now, INTERVAL time DAY) INTO time_new;
  
    SELECT YEAR(time_new) INTO time_year;
    SELECT MONTH(time_new) INTO time_month;
    SELECT DAYOFMONTH(time_new) INTO time_day;

    SELECT COUNT(s.colvo) INTO colvo
    FROM(SELECT YEAR(t.datetime) AS y, MONTH(t.datetime) AS m, DAY(t.datetime) AS d, t.id AS colvo
        FROM trade t JOIN product p ON t.product_id = p.id JOIN user u ON t.seller_id = u.id
        WHERE (p.id = product_id) AND (u.email = email) 
        GROUP BY y, m, d) AS s 
    WHERE s.y = time_year AND s.m = time_month AND s.d = time_day;

    RETURN colvo;

    END;
