<?php
    session_start();
?>
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
          <li ><a class="dropdown-item"  href="about_us.php">О нас</a></li>
            <li><a class="dropdown-item" href="supporting_shops.php">Поддерживаемые магазины</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="spravka.php">Справка</a></li>
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

<div id="carouselExampleInterval" style="margin-top: 40px;" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
    <div class="carousel-item active" style="height: 600px; transition: opacity .8s ease;" data-bs-interval="2000">
      <img src="img/slide1.jpg" width="1200px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" style="height: 600px; transition: opacity .8s ease;" data-bs-interval="2000">
      <img src="img/slide22.jpg" width="1200px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" style="height: 600px; transition: opacity .8s ease;" data-bs-interval="2000">
      <img src="img/slide33.jpg" width="1200px" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

 
<div class="intro">
    <div class="container">
      <div class="intro-inner">
        <div class="intro-item">
          <div class="intro-text">Не всегда бывает удобно постоянно отслеживать цену понравившегося товара. Для этого мы разработали отслеживание твоих желаемых товаров с разных онлайн-магазинов</div>
        </div>
        <div class="intro-item">
            <form class="intro-form" action="registration.php" method="post">
            <div class="form_text">Зарегистрируйся! И добавляй свой первый товар!</div>
              <input class="form-input" type="text" required placeholder="Имя пользователя" name="login"><br>
              <input class="form-input" type="text" required placeholder="E-mail" name="email"><br>
              <button class="form-btn" type="submit">Продолжить</button>
            </form> 
        </div>
      </div>
      </div>
</div>

<div class="company">
  <div class="container">
    <div class="cmp-text">Поддерживаемые магазины</div>
    <div class="cmp-items">
      <div class="cmp-itm">
          <img src="img/WLB.png" width="400px"  alt="">
        </div>
        <div class="cmp-itm">
          <img src="img/Avito.png" width="400px" alt="">
        </div>
      </div>
  </div>
</div>

<!-- <footer class="footer">
  <div class="footer-text">checkprice@mail.ru</div>
</footer> -->



<script src=""></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>