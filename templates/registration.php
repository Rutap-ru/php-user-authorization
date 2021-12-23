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
  <form action="?registration" method="post">
    <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

    <?php
    if (!empty($info_message)) {
        printfArray('<div class="alert %1$s" role="alert">%2$s</div>', $info_message);
    }
    ?>
    <div class="form-floating mb-2">
      <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" <?php if (!empty($_POST['email'])) echo 'value="' . $_POST['email'] . '"';?>>
      <label for="email">Email</label>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="login" id="floatingLogin" placeholder="Логин" <?php if (!empty($_POST['login'])) echo 'value="' . $_POST['login'] . '"';?>>
      <label for="floatingLogin">Логин</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Пароль" <?php if (!empty($_POST['password'])) echo 'value="' . $_POST['password'] . '"';?>>
      <label for="floatingPassword">Пароль</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password_repeat" id="floatingPassword2" placeholder="Повторите пароль" <?php if (!empty($_POST['password_repeat'])) echo 'value="' . $_POST['password_repeat'] . '"';?>>
      <label for="floatingPassword2">Повторите пароль</label>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="fullname" id="floatingInput" placeholder="ФИО" <?php if (!empty($_POST['fullname'])) echo 'value="' . $_POST['fullname'] . '"';?>>
      <label for="floatingInput">ФИО</label>
    </div>


    <button class="w-100 btn btn-lg btn-primary mb-3" name="submitted" type="submit">Зарегистрироваться</button>
    <a href="/">Авторизация</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>


    
  </body>
</html>