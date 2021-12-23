<?php
require 'lib/config.php';

// Проверяем авторизован пользователь или нет
if (!empty($_SESSION['user'])) { // ЛК пользователя
    include 'handler/user.php';
} else {
    include 'handler/guest.php';
}
?>