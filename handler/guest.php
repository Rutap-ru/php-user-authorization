<?php
if (isset($_GET['registration'])) { // Регистрация нового пользователя

    if (formSubmitted()) {

        try {
            $validFeild = New ValidateFormData();
            $form_data_feild = array(
                'email'=>'Email',
                'login'=>'логин',
                'password'=>'пароль',
                'password_repeat'=>'повтор пароля',
                'fullname'=>'ФИО'
            );

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

            // Проверяем пароли
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if (!password_verify($_POST['password_repeat'], $password_hash)) {
                throw new Exception('Введеные пароли не совпадают.');
            }

            // Проверяем, возможно пользователь с таким Email/логином уже существует в БД
            $whereData = array($_POST['email'], $_POST['login']);
            $sql = "SELECT `email`, `login` FROM `users` WHERE `email`=? or `login`=?";
            $STH = $DBH->prepare($sql);
            $STH->execute($whereData);
            $repeatUser = $STH->fetch(PDO::FETCH_ASSOC);
            if (!empty($repeatUser['login'])) {
                if ($_POST['email'] == $repeatUser['email']) {
                    throw new Exception('Пользователь с таким Email уже зарегистрирован');
                }
                throw new Exception('Пользователь с таким Логином уже зарегистрирован');
            }

            // Добавляем пользователя в БД
            $inputData = array(
                $_POST['email'],
                $_POST['login'],
                $password_hash,
                $_POST['fullname']
            );  
            try {
                $sql = "INSERT INTO users (`email`, `login`, `password`, `fullname`) values (?,?,?,?)";
                $STH = $DBH->prepare($sql);  
                $STH->execute($inputData);
            }  
            catch(PDOException $ex) {
                throw new Exception('Произошла ошибка при сохранении данных');
            }

            header("Location: /?success");
            exit;


        }
        catch(Exception $e) {
            $info_message = array('alert-danger', $e->getMessage());
        }

    }

    // Подключаем шаблон страницы Регистрации
    include 'templates/registration.php';

} else { // Авторизация

    if (isset($_GET['success'])) {
        $info_message = array(
            'alert-success',
            'Регистрация прошла успешно, можете войти в личный кабинет'
        );
    }

    if (formSubmitted()) {

        try {
            $validFeild = New ValidateFormData();
            $form_data_feild = array('login'=>'логин', 'password'=>'пароль');

            foreach ($form_data_feild as $feild_key=>$feild_name) {
                if (!$validFeild->emptyFeild($_POST[$feild_key], $feild_name)) {
                    throw new Exception($validFeild->msgOut());
                }
            }


            $whereData = array($_POST['login']);
            $STH = $DBH->prepare("SELECT * FROM `users` WHERE `login`=?");
            $STH->execute($whereData);
            $userData = $STH->fetch(PDO::FETCH_ASSOC);
            if ($userData && password_verify($_POST['password'], $userData['password'])) {
                $user_arr = $userData;
                unset($user_arr['password']);
                $_SESSION['user'] = $user_arr;

                // Редиректим в ЛК
                header("Location: /?my");
                exit;
            }

            throw new Exception('Логин или пароль неверны');
        }
        catch(Exception $e) {
            $info_message = array('alert-danger', $e->getMessage());
        }

    }

    // Подключаем шаблон страницы Авторизации
    include 'templates/sing-in.php';

}
?>