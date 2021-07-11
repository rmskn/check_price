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
    <title>О нас</title>
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

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">О нас</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          
        </div>
        <h2>Что мы делаем?</h2>
        <p>Мы предоставляем услуги по отслеживанию любых товаров в различных интернет магазинах.</p>
        
      </div>
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
         
        </div>
        <h2>Как это работает?</h2>
        <p>Вы добавляете понравившийся товар в свой личный кабинет. После этого мы будем отслеживать изменение цены данного товара, если цена меняется вы сразу же получите сообщене на почту об изменении цены на товар.</p>
        
      </div>
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          
        </div>
        <h2>Почему это удобно</h2>
        <p>Данный сервис очень удобен в современную цифровую эпоху. Таким образом Вы не будете тратить время на «слежку» за нужной позицией, а возложите эту обязанность на нас.</p>
        
      </div>
    </div>
  </div>


<script src=""></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>