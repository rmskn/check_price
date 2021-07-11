<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="style.css">   
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Главная страница</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-xl ">
  <a class="navbar-brand" href="index.php">
      <img src="/img/Logo.png" alt="" width="42">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
        <?php 
        if (!isset($_SESSION['authorization-login'])) echo '<li class="nav-item">
          <a class="nav-link" href="auth.php">Вход</a>
        </li>';
        ?>
        
        <?php 
        if (!isset($_SESSION['authorization-login'])) echo '<li class="nav-item">
          <a class="nav-link" href="registration.php">Регистрация</a>
        </li>';
        ?>

        <?php 
        if (isset($_SESSION['authorization-login'])) echo '<li class="nav-item">
          <a class="nav-link" href="lk.php">Личный кабинет</a>
        </li>';
        ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Информация
          </a>
          <ul class="dropdown-menu"  aria-labelledby="navbarDropdown">
            <li ><a class="dropdown-item"  href="#">О нас</a></li>
            <li><a class="dropdown-item" href="#">Поддерживаемые магазины</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Справка</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" style="margin-top:auto; margin-bottom:auto;" action="vendor/find.php" method="post">
        <input class="form-control me-3" style="width:500px;" type="text" placeholder="Вставьте ссылку на товар" name="findhref">
        <button class="btn btn-primary" type="submit">Поиск</button>
      </form>
    </div>
  </div>
</nav>
<?php
    session_start();
    require 'vendor/functions.php';
    require 'vendor/connect.php';

    $login = $_SESSION['authorization-login'];  
    $type = $_GET['it'];

    switch ($type)
    {
        case 'fullname': {$value = mysqli_query($connect, "select fullname from users where login = '$login'"); break;}
        case 'login': {$value = mysqli_query($connect, "select login from users where login = '$login'"); break;}
        case 'email': {$value = mysqli_query($connect, "select email from users where login = '$login'"); break;}
        case 'password': {$value = mysqli_query($connect, "select password from users where login = '$login'"); break;}   
    }

    $value = mysqli_fetch_row($value);
    $value = $value[0];

    if ($type === 'password') $value = '';

    if (isset($_SESSION['edit-error-type']))
    {
        $type_error = $_SESSION['edit-error-type'];
        $edit_error = $_SESSION['edit-error'];
        $value = $_SESSION['tmp-edit-data'];
    }

    unset($_SESSION['edit-error']);
    unset($_SESSION['edit-error-type']);
    unset($_SESSION['tmp-edit-data']);

    echo '
    <div class="container">
    <div class="redaction">
        <div class="redaction-title">Введите новые данные</div>
        <form action="vendor/edit_personal.php?it='.$type.'" method="post">
    <input type="text" placeholder="Новый пароль" name="new-data" value = "'.$value.'">
    <button type="submit">Изменить</button>
    </form>
    </div>
</div>
    ';
    
    //Вывод ошибок
    echo get_error_msg_data($type_error,$edit_error);
?>


<script src=""></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>


