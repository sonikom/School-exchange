CREATE VIEW v_moderator_archive
  AS
SELECT u.first_name, u.middle_name, u.last_name, u.pasport, u.email
  FROM user u
  ORDER BY u.last_name ASC;

SELECT u.first_name, u.middle_name, u.last_name, u.pasport, u.email
  FROM user u;

  SELECT * FROM v_moderator_archive;

  CREATE PROCEDURE pr_broker_archive(email varchar(255))
    BEGIN
    DECLARE broker_tarif int;

    SELECT u.first_name, u.middle_name, u.last_name, u.pasport, u.email, ub.contract
      FROM user_broker ub JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id JOIN brokers b ON bt.broker_id = b.id JOIN user u ON ub.user_id = u.id
    WHERE b.email = email
    ORDER BY u.last_name ASC; 

    END;
  CALL pr_broker_archive('vova@list.ru');

    SELECT u.first_name, u.middle_name, u.last_name, u.pasport, u.email, ub.contract
      FROM user_broker ub JOIN broker_tarif bt ON ub.broker_tarif_id = bt.id JOIN brokers b ON bt.broker_id = b.id JOIN user u ON ub.user_id = u.id
    WHERE b.email = 'vova@list.ru'
    ORDER BY u.last_name ASC;