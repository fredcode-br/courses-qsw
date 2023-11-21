<?php
// include('protect.php');
include('../connection.php');

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['disciplina_id']) && isset($_POST['turma_id'])) {
    $disciplina_id = $_POST['disciplina_id'];
    $turma_id = $_POST['turma_id'];
    $usuario_id = $_SESSION['id']; 
    $data_inscricao = date('Y-m-d');

    $verificaTurmaFechadaQuery = "SELECT turma_fechada FROM turmas WHERE turma_id = '$turma_id'";
    $verificaTurmaFechadaResult = mysqli_query($mysqli, $verificaTurmaFechadaQuery);

    if ($verificaTurmaFechadaResult && $rowTurmaFechada = mysqli_fetch_assoc($verificaTurmaFechadaResult)) {
        if ($rowTurmaFechada['turma_fechada']) {
            echo "A turma está fechada.";
            exit();
        }
    } else {
        echo "Erro ao verificar o status da turma.";
        exit();
    }

    $verificaInscricaoQuery = "SELECT * FROM inscricoes WHERE usuario_id = '$usuario_id' AND turma_id = '$turma_id'";
    $verificaInscricaoResult = mysqli_query($mysqli, $verificaInscricaoQuery);

    if (mysqli_num_rows($verificaInscricaoResult) > 0) {
        echo "Você já está inscrito nesta turma.";
    } else {
        $verificaChoqueQuery = "SELECT turma_id FROM inscricoes WHERE usuario_id = '$usuario_id'";
        $verificaChoqueResult = mysqli_query($mysqli, $verificaChoqueQuery);

        while ($row = mysqli_fetch_assoc($verificaChoqueResult)) {
            $turmaInscrita = $row['turma_id'];

            $queryTurmaDesejada = "SELECT horario_inicio, horario_termino FROM turmas WHERE turma_id = '$turma_id'";
            $resultTurmaDesejada = mysqli_query($mysqli, $queryTurmaDesejada);
            if ($rowTurmaDesejada = mysqli_fetch_assoc($resultTurmaDesejada)) {
                $horarioInicioDesejado = $rowTurmaDesejada['horario_inicio'];
                $horarioTerminoDesejado = $rowTurmaDesejada['horario_termino'];

                $queryTurmaInscrita = "SELECT horario_inicio, horario_termino FROM turmas WHERE turma_id = '$turmaInscrita'";
                $resultTurmaInscrita = mysqli_query($mysqli, $queryTurmaInscrita);

                while ($rowTurmaInscrita = mysqli_fetch_assoc($resultTurmaInscrita)) {
                    $horarioInicioInscrito = $rowTurmaInscrita['horario_inicio'];
                    $horarioTerminoInscrito = $rowTurmaInscrita['horario_termino'];

                    if (
                        ($horarioInicioDesejado <= $horarioTerminoInscrito && $horarioTerminoDesejado >= $horarioInicioInscrito) ||
                        ($horarioInicioInscrito <= $horarioTerminoDesejado && $horarioTerminoInscrito >= $horarioInicioDesejado)
                    ) {
                        echo "Choque de horários com a outra turma a qual você está inscrito(a). Selecione outra turma.";
                        exit();
                    }
                }
            }
        }

        $query = "INSERT INTO inscricoes (usuario_id, turma_id, data_inscricao)
                  VALUES ('$usuario_id', '$turma_id', '$data_inscricao')";

        $result = mysqli_query($mysqli, $query);

        if ($result) {
            echo "Inscrição realizada com sucesso!";
        } else {
            echo "Erro ao realizar a inscrição.";
        }
    }
} else {
    echo "Parâmetros inválidos.";
}
?>
