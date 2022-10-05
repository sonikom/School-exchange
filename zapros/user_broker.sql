-- SELECT u.pasport, u.id
--   FROM user u
--   WHERE  u.email = 's@list.ru';
-- 
-- INSERT IGNORE INTO broker_procesing(user_id, company_tarif_id, contract)
--   VALUES(1, 9, 4444444);
-- 
-- 
-- INSERT IGNORE INTO broker_procesing(user_id, company_tarif_id, contract) VALUES(1, 4, '1234567890_4.png');


-- CREATE FUNCTION f_broker_tarif(company_tarif_id int, broker_emai varchar(50))
--   RETURNS int(11)
--   SQL SECURITY INVOKER
-- BEGIN
--   DECLARE broker_tarif_id int;
--   DECLARE broker_id int;
--     SELECT b.id INTO broker_id
--       FROM brokers b
--       WHERE b.email = broker_emai ;  
--       
--     SELECT bt.id  INTO broker_tarif_id
--       FROM broker_tarif bt 
--       WHERE (bt.broker_id = broker_id) AND (bt.company_tarif_id = company_tarif_id);    
--   RETURN broker_tarif_id;
--   END

 
INSERT IGNORE INTO user_broker(broker_tarif_id, user_id, contract, data_start, data_end)
   VALUES(11, 7, 'ddddddd', 2000-11-11, 2000-11-11);

SELECT f_broker_procesing('vovadiv@kist.ru') AS 'broker_procesing';