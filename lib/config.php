<?php
session_start();

// Функция проверки отправления формы
function formSubmitted($form_name=false)
{
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        return false;
    }
    if (!isset($_POST['submitted'])) { // был ли вообще сабмит
        return false; //неа, завершаем
    }
    if ($form_name && $_POST['submitted']!=$form_name) { //если проверяется конкретная форма, была ли отправлена именно она?
        return false;
    }
    return true;
}

function printfArray($format, $arr)
{ 
    return call_user_func_array('printf', array_merge((array)$format, $arr)); 
} 

class ValidateFormData
{
    public $message;

    public function emptyFeild($field, $name)
    {
        if (empty($field)) {
            $this->message = 'Введите '.$name;
            return false;
        }
        return true;
    }

    public function msgOut()
    {
        return $this->message;
    }

    public function emailValid($value, $name=null)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->message = 'Введен некорректный Email';
            return false;
        }
        return true;
    } 

    public function loginValid($value)
    {
        if (!preg_match('/^[a-z0-9-_]*$/i', $value)) {
            $this->message = 'В логине присутствуют недопустимые символы';
            return false;
        }
        return true;
    } 

    public function passwordValid($value, $name=null)
    {
        if (empty($name)) {
            $name = 'Пароль';
        }

        if (preg_match('/\'|\"/i', $value)) {
            $this->message = 'В поле '.$name.' присутствуют недопустимые символы';
            return false;
        } elseif (mb_strlen($value) < 6) {
            $this->message = $name.' должн быть более 6-и символов';
            return false;
        }
        return true;
    }

    public function newpasswordValid($value, $name=null)
    {
        return $this->passwordValid($value, $name);
    }

    public function fullnameValid($value, $name=null)
    {
        if (!preg_match('/^([а-яё \-]+|[a-z \-]+)$/ui', $value)) {
            $this->message = 'В ФИО присутствуют недопустимые символы';
            return false;
        }
        return true;
    }

}

// параметры для доступа к БД
$db_user = "probus"; 
$db_pass = "18091988"; 
$db_name = "userauthorization";
$db_host = "localhost"; 

// подключаемся к базе данных  
try {  
    $DBH = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);  
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {  
    echo "Проблемы с подключением к БД.";  
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}
?>