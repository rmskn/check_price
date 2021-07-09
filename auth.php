<?php
     session_start();

     //Insert old data
     $ph_login = "";
     
     if (isset($_SESSION['auth-error'])) 
     {
       $errors = $_SESSION['auth-error'];//Error (string) (you can edit it in vendor/auth.php)
       $ph_login = $_SESSION['tmp-auth-login'];//auth data

       unset($_SESSION['auth-error']);
       unset($_SESSION['tmp-auth-login']);

       var_dump($ph_login);

       //ТУТ ИЛИ НЕ ТУТ НАДО ВЫВОДИТЬ ОШИБКИ ИЗ ERRORS
     }
     
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="style.css">   
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Регистрация</title>
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
    
        <li class="nav-item ">
          <a class="nav-link" href="registration.php">Регистрация</a>
        </li>
        

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

    <div class="container">
    <div class="reg">
    <form class="reg-form" action="vendor/auth.php" method="post">
            <div class="form_text">Авторизация</div>
              <input class="form-input" type="text" placeholder="Имя пользователя" name="login" value="<?php echo $ph_login; ?>"><br>
              <input class="form-input" type="password" placeholder="Пароль" name="password" required ><br>
              <button class="form-btn" type="submit">Продолжить</button>
            </form> 
    </div>
    </div>

    <!-- <footer class="footer">
  <div class="footer-text">checkprice@mail.ru</div>
</footer> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>