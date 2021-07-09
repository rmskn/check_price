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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <div class="lk">
        <div class="lk-nav">
            <a class="lk-link" href="#" data-filter="personal">Личные данные </a> <br>
            <a class="lk-link" href="#" data-filter="add">Добавить товар</a> <br>
            <a class="lk-link" href="#" data-filter="my">Мои товары</a> <br>
            <a class="lk-link" href="#" data-filter="ask">Задать вопрос</a> <br>
            <a class="lk-link" href="">Выход</a>
        </div>
        <div class="lk-content " >
            <div class="content-item" data-cat="personal">
                <div class="item-header">Личные данные</div>
                <div class="pd">
                    <div class="d-header">Имя</div>
                    <div class="d-text">такое то такое</div>
                </div>
                <div class="pd">
                    <div class="d-header">Логин</div>
                    <div class="d-text">попуск2003</div>
                </div>
                <div class="pd">
                    <div class="d-header">Почта</div>
                    <div class="d-text">попуск2003@eblan.ru</div>
                </div>
            </div>
            <div class="content-item hide" data-cat="add"  >
                <div class="item-header">Добавить товар</div>
                <form class="lk-form" action="">        
                    <input class="lk-find" size=50 placeholder="Вставьте ссылку на товар" required type="text">
                    <button type="submit" class="lk-btn">Найти</button>
                </form>
            </div>
            <div class="content-item hide" data-cat="my">
                <div class="item-header">Мои товары</div>
            </div>
            <div class="content-item hide" data-cat="ask">
                <div class="item-header">Задать вопрос</div>
                <form class="lk-form" action="">        
                    <input class="lk-find" size=50 placeholder="Задайте свой вопрос" required type="text">
                    <button type="submit" class="lk-btn">Задать</button>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="app.js"></script>
</body>
</html>