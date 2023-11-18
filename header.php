<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cursos</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="<?= 'assets/css/' . $pageStyle ?>">
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Cusros</title>
</head>
<body>

<header class="bg-light">
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">Seu Logo</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Disciplinas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Calendário</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contato</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sobre</a>
        </li>
      </ul>

      <?php
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['id'])) {
            echo '<div class="d-flex ml-auto">
                    <div class="mr-2">
                        <p>Welcome,</p>
                        <p>' . $_SESSION['name'] . '!</p>
                    </div>
                    <a class="btn btn-danger" href="./logout.php">Sair</a>
                </div>';
        } else {
            echo '<ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary mr-2" href="./login.php">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="./register.php">Cadastrar</a>
                    </li>
                </ul>';
        }
    ?>

    </div>
  </nav>
</div>
</header>