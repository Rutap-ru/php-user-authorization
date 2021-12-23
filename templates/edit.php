<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Регистрация пользователя</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Favicons -->
<link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">
    
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.1/examples/sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">

    <h1 class="h3 mb-5 fw-normal">Редактирование данных</h1>

    <form action="?edit&fullname" method="post">
      <h2 class="h4 fw-normal">Изменение ФИО</h2>
    <?php
    if (!empty($info_message) && isset($_GET['fullname'])) {
        printfArray('<div class="alert %1$s" role="alert">%2$s</div>', $info_message);
    }
    ?>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="fullname" id="floatingInput" placeholder="ФИО" value="<?php 
        if (isset($_GET['fullname'])) {
            echo $_POST['fullname'];
        } else {
            echo $user_data['fullname'];
        }
        ?>">
      <label for="floatingInput">ФИО</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-5" name="submitted" type="submit">Сохранить</button>
  </form>

  <form action="?edit&password" method="post">
    <h2 class="h4 fw-normal">Изменение пароля</h2>
    <?php
    if (!empty($info_message) && isset($_GET['password'])) {
        printfArray('<div class="alert %1$s" role="alert">%2$s</div>', $info_message);
    }
    ?>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Пароль" value="<?php
        if (isset($_GET['password'])) {
            echo $_POST['password'];
        }
        ?>">
      <label for="floatingPassword">Текущий пароль</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="newpassword" id="floatingNewPassword" placeholder="Пароль" value="<?php
        if (isset($_GET['password'])) {
            echo $_POST['newpassword'];
        }
        ?>">
      <label for="floatingNewPassword">Новый пароль</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="newpassword_repeat" id="floatingPassword2" placeholder="Повторите пароль" value="<?php
        if (isset($_GET['password'])) {
            echo $_POST['newpassword_repeat'];
        }
        ?>">
      <label for="floatingPassword2">Повторите новый пароль</label>
    </div>


    <button class="w-100 btn btn-lg btn-primary mb-3" name="submitted" type="submit">Сохранить</button>
  </form>
  <div class="mb-3">
      <a href="?my">Назад в ЛК</a>
    </div>
    <div>
      <a href="?logout">Выход</a>
    </div>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>

</main>


    
  </body>
</html>