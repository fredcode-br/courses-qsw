<?php
// include('protect.php');
include('../connection.php');

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['disciplina_id']) && isset($_POST['turma_id'])) {
    $turma_id = $_POST['turma_id'];
    $usuario_id = $_SESSION['id']; 
}
    echo "Lista de espera";
?>
