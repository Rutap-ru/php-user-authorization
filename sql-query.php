<?php
require 'lib/config.php';

// 1 −	составить запрос, который выведет список email'лов встречающихся более чем у одного пользователя
$duble_email = $DBH->query("SELECT email FROM users WHERE email!='' GROUP BY email HAVING count(email)>1")->fetchAll(PDO::FETCH_ASSOC);

// 2 −	вывести список логинов пользователей, которые не сделали ни одного заказа
$user_no_price = $DBH->query("SELECT login FROM users WHERE NOT EXISTS (SELECT orders.user_id FROM orders WHERE users.id=orders.user_id)")->fetchAll(PDO::FETCH_ASSOC);

// 3 −	вывести список логинов пользователей которые сделали более двух заказов
$user_from_2_orders = $DBH->query("SELECT users.login FROM users JOIN orders ON users.id=orders.user_id GROUP BY users.login HAVING COUNT(users.login)>2")->fetchAll(PDO::FETCH_ASSOC);

?>