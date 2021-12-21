<?php

session_start();

// параметры для доступа к БД
$db_user = "bduser"; 
$db_pass = "bdpassword"; 
$db_name = "bdname";
$db_host = "localhost"; 

// подключаемся к базе данных  
try {  
    $DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);  
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {  
    echo "Бро, у нас проблемы.";  
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}


// Проверяем авторизован пользователь или нет
if (!empty($_SESSION['user'])) {

} else {
    readfile('templates/sing-in.html');
}
?>