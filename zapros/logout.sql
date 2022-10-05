-- проверка существовования 

-- SELECT COUNT(u.email) AS 'check'
--   FROM user u
--   WHERE u.email LIKE "s@list.ru";


-- проверка существовования BROKER

--   SELECT COUNT(b.email) AS 'logout_broker'
--     FROM brokers b
--     WHERE (b.email LIKE 'vova@list.ru') & (b.password = '12345');


-- CREATE FUNCTION f_logout_broker(login varchar(255), pass varchar(50))
-- RETURNS int
-- BEGIN
--   DECLARE log int;
--   
--   SELECT COUNT(b.email) INTO log
--     FROM brokers b
--     WHERE (b.email LIKE login) & (b.password = pass);
-- 
--   RETURN log;
-- END;

SELECT f_logout_broker('vova@list.ru', '12345');



-- проверка пароля для пользователя

-- SELECT COUNT(u.email)
--   FROM user u 
--   WHERE (u.email LIKE 's@list.ru') & (u.password='1234');

-- CREATE FUNCTION f_logout_user(login varchar(255), pass varchar(50))
-- RETURNS int
-- BEGIN
--   DECLARE log int;
--   
--   SELECT COUNT(u.email) INTO log
--     FROM user u 
--     WHERE (u.email LIKE login) & (u.password = pass);
--   
--   RETURN log;
-- END;

-- SELECT f_logout_user('s@list.ru', '1234') AS 'logout_user';



-- проверка пароля для модератора

-- SELECT COUNT(m.email)
--   FROM moderators m
--   WHERE (m.email LIKE 'zina@mail.ru') & (m.password ='12345');

-- CREATE FUNCTION f_logout_moderator(login varchar(255), pass varchar(50))
-- RETURNS int
-- BEGIN
--   DECLARE log int;
--   
--   SELECT COUNT(m.email) INTO log
--   FROM moderators m
--   WHERE (m.email LIKE login) & (m.password = pass);
--   
--   RETURN log;
-- END;

-- SELECT f_logout_moderator('ekom@yandex.ru', '12345') AS 'logout_moderator';


-- добавление пользователя в таблицу обработки

-- INSERT IGNORE INTO USER(first_name, middle_name, last_name, pasport, email, password)
--   VALUES('Полина', 'Владимирович', 'Петрошенко','3019928702', 'ira@yandex.ru', 'ira1987');


-- CREATE FUNCTION f_createaccaunt(first_name varchar(50), middle_name varchar(50), last_name varchar(50), pasport varchar(50), email varchar(255), pass varchar(50), file varchar(50))
-- RETURNS int
-- BEGIN
--   
--   
--   INSERT IGNORE INTO procesing(first_name, middle_name, last_name, pasport, email, password, file)
--   VALUES(first_name, middle_name, last_name, pasport, email, pass, file);
--   
--   RETURN 1;
-- END;

-- SELECT f_createaccaunt('Даша',	'Макарова',	'Дырко',	'7999774447',	'dasha@yandex.ru',	'dassha1987', 'guvk') AS 'accaunt';




-- проверка паспорта
-- 
-- SELECT COUNT(u.pasport)
--   FROM user u 
--   WHERE u.pasport = '1234567890';
-- 
-- SELECT COUNT(p.pasport)
--   FROM procesing p
--   WHERE p.pasport = '785537878';
-- 
-- 
-- CREATE FUNCTION f_pasport_create_acc( pasport_acc varchar(50))
--   RETURNS int
--   BEGIN
--     DECLARE pasport_user int;
--     DECLARE pasport_procesing int;
--     
--     SELECT COUNT(u.pasport) INTO pasport_user
--       FROM user u 
--       WHERE u.pasport = pasport_acc;
--     
--     SELECT COUNT(p.pasport) INTO pasport_procesing
--       FROM procesing p
--       WHERE p.pasport = pasport_acc;
-- 
--     RETURN pasport_user + pasport_procesing;
--   END;
-- 
-- SELECT f_pasport_create_acc('0984321') AS 'check_pasport';

-- вывод данных о пользователе 

-- CREATE VIEW v_process
--   AS
--   SELECT p.id, p.first_name, p.middle_name, p.last_name, p.pasport, p.email, p.file, p.status
--     FROM procesing p 

-- SELECT * FROM v_process v

--   SELECT p.id, p.first_name, p.middle_name, p.last_name, p.pasport, p.email, p.password, p.file
--     FROM procesing p
--     WHERE p.id = 1

-- замена статуса 

--   UPDATE procesing p SET p.status = 'zina@mail.ru'
--     WHERE p.id = 6
    

-- добавление пользователя в таблицу USER
-- 
-- INSERT IGNORE INTO USER(first_name, middle_name, last_name, pasport, email, password)
--   VALUES('Полина', 'Владимировна', 'Дырко','3456928702', 'wira@yandex.ru', 'ira1987');


CREATE FUNCTION f_add_accaunt(first_name varchar(50), middle_name varchar(50), last_name varchar(50), pasport varchar(50), email varchar(255), pass varchar(50))
RETURNS int
BEGIN
  DECLARE user_id int;
  
  INSERT IGNORE INTO USER(first_name, middle_name, last_name, pasport, email, password)
  VALUES(first_name, middle_name, last_name, pasport, email, pass);

  SELECT u.id INTO user_id
    FROM user u
    WHERE u.email = email;

  INSERT IGNORE INTO bank(user_id, money)
    VALUES (user_id, 1000);
  
  RETURN 1;
END;

SELECT f_add_accaunt('Мирослава', 'Владимировна', 'Комарова','23456723457', 'mira@yandex.ru', 'mira2027');
SELECT f_add_accaunt('Софья', 'Не задано', 'Комарова', '4016512282', 's1a2k@list.ru', '1234') AS 'add_accaunt'; 

--   DELETE FROM procesing WHERE pasport = '5019938702';
  
-- SELECT f_add_accaunt('Оля', 'Александровна', 'Тимошенко','1771771771', 'olyatim@gmail.com', 'olya1995') AS 'add_accaunt';


-- CHEK USER BROKER

SELECT COUNT(ub.id) AS 'cou'
  FROM user_broker ub JOIN user u ON ub.user_id = u.id
  WHERE u.email = 's@list.ru';