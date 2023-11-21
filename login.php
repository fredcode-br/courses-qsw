<?php
    include('connection.php');
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);

        if (empty($email)) {
            echo "Insira seu email";
        } 
        elseif (empty($password)) {
            echo "Insira sua senha";
        } 
        else {
            $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$password'";
            $sql_query = $mysqli->query($sql_code) or die("SQL code execution failed: " . $mysqli->error);

            $quantity = $sql_query->num_rows;

            if ($quantity == 1) {
                $user = $sql_query->fetch_assoc();

                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $user['usuario_id'];
                $_SESSION['name'] = $user['nome'];

                header("Location: index.php");
            } 
            else {
                echo '<div class="alert alert-danger" role="alert">
                        Falha ao fazer login! senha ou email incorretos
                    </div>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>

     <link rel="stylesheet" href="./assets/css/global.css">
     <link rel="stylesheet" href="assets/css/login.css">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<section class="d-flex justify-content-centr align-items-center gradient-form" style="background-color: #eee; height: 100vh;" >
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <form method="POST">
                                        <p class="text-center">Faça login na sua conta</p>
    
                                        <div class="form-outline mb-4">
                                            <label 
                                                class="form-label" 
                                                for="email">
                                                Email:
                                            </label>
                                            <input 
                                                type="email" 
                                                id="email" 
                                                name="email"
                                                class="form-control"
                                                placeholder="Digite seu endereço de e-mail" />
                                        </div>
    
                                        <div class="form-outline mb-4">
                                            <label 
                                                class="form-label" 
                                                for="password">
                                                Senha:</label>
                                            <input 
                                                type="password" 
                                                id="password"
                                                name="password"  
                                                class="form-control" 
                                                placeholder="Digite sua senha"/>
                                        </div>
    
                                        <div class="text-center pt-1 mb-5 pb-1 w-100">
                                            <button 
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 w-100"
                                                type="submit"
                                            >
                                                Entrar
                                            </button>
                                        </div>
    
                                        <div class="d-flex align-items-center justify-content-center pb-2">
                                            <p class="mb-0 me-2">Não tem uma conta?</p>
                                            <a class="btn btn-outline-danger" href="./register.php">Criar nova</a>
                                        </div>
    
                                    </form>
    
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>