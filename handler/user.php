<?php
$user_data = $_SESSION['user'];

if (isset($_GET['edit'])) {
    if (formSubmitted() && isset($_GET['fullname'])) {
        try {

            $validFeild = New ValidateFormData();
            $form_data_feild = array('fullname'=>'ФИО');

            foreach ($form_data_feild as $feild_key=>$feild_name) {
                if (!$validFeild->emptyFeild($_POST[$feild_key], $feild_name)) {
                    throw new Exception($validFeild->msgOut());
                }
                $mthd_valid = $feild_key.'Valid';
                if (method_exists($validFeild, $mthd_valid)) {
                    if (!$validFeild->$mthd_valid($_POST[$feild_key])) {
                        throw new Exception($validFeild->msgOut());
                    }
                }
            }

            $user_update = array($_POST['fullname'], $user_data['id']);
            try {
                $sql = "UPDATE `users` SET `fullname`=? WHERE `id`=?";
                $STH = $DBH->prepare($sql);  
                $STH->execute($user_update);

                $_SESSION['user']['fullname'] = $_POST['fullname'];

                $info_message = array('alert-success', 'ФИО изменено');
            }  
            catch(PDOException $ex) { 
                throw new Exception('Не удалось сохранить изменения ФИО');
            }


        }
        catch(Exception $e) {
            $info_message = array('alert-danger', $e->getMessage());
        }
    } elseif (formSubmitted() && isset($_GET['password'])) {
        try {

            $validFeild = New ValidateFormData();
            $form_data_feild = array(
                'password'=>'текущий пароль',
                'newpassword'=>'новый пароль',
                'newpassword_repeat'=>'повтор нового пароля'
            );

            foreach ($form_data_feild as $feild_key=>$feild_name) {
                if (!$validFeild->emptyFeild($_POST[$feild_key], $feild_name)) {
                    throw new Exception($validFeild->msgOut());
                }
                $mthd_valid = $feild_key.'Valid';
                if (method_exists($validFeild, $mthd_valid)) {
                    if (!$validFeild->$mthd_valid($_POST[$feild_key], $feild_name)) {
                        throw new Exception($validFeild->msgOut());
                    }
                }
            }

            // Проверяем новые пароли
            $password_hash = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
            if (!password_verify($_POST['newpassword_repeat'], $password_hash)) {
                throw new Exception('Введеные новые пароли не совпадают.');
            }

            // Проверяем текущий пароль
            $whereData = array($user_data['id']);
            $STH = $DBH->prepare("SELECT * FROM `users` WHERE `id`=?");
            $STH->execute($whereData);
            $userData = $STH->fetch(PDO::FETCH_ASSOC);
            if ($userData && password_verify($_POST['password'], $userData['password'])) {

                if (password_verify($_POST['newpassword'], $userData['password'])) {
                    throw new Exception('Новый пароль должен отличаться от текущего');
                }

                // Меняем пароль
                $user_update = array($password_hash, $user_data['id']);
                try {
                    $sql = "UPDATE `users` SET `password`=? WHERE `id`=?";
                    $STH = $DBH->prepare($sql);  
                    $STH->execute($user_update);

                    $info_message = array('alert-success', 'Пароль изменен');
                }  
                catch(PDOException $ex) { 
                    throw new Exception('Пароль не удалось изменить');
                }

            } else {
                throw new Exception('Текущий пароль указан неверно');
            }


        }
        catch(Exception $e) {
            $info_message = array('alert-danger', $e->getMessage());
        }
    }

    // Подключаем шаблон страницы Редактирования
    include 'templates/edit.php';

} elseif (isset($_GET['logout'])) { // Выход из ЛК

    unset($_SESSION['user']);
    header("Location: /");
    exit;

} else {

    // Подключаем шаблон страницы ЛК
    include 'templates/my.php';

}
?>