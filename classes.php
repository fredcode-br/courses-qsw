<?php
  // include('protect.php');
  include('connection.php');
  $pageStyle = 'home.css';
  require_once 'header.php';
?>

<section>
    <div class="container my-4">
        <h2 class="text-center mb-4">Listagem de Turmas</h2>
        <div class="row">
            <?php
                if (isset($_GET['disciplina_id'])) {
                    $disciplina_id = $_GET['disciplina_id'];
            
                    $query = "SELECT * FROM turmas WHERE disciplina_id = $disciplina_id";
                    $result = mysqli_query($mysqli, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $numeroTurma = 1; 
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="col-12 mb-4">
                                    <div role="button" class="card turma-card" onclick="selecionarTurma('.$row['turma_id'].', this)">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Turma '.$numeroTurma.'</h5>
                                            <p class="card-text">Docente: '.$row['professor_nome'].'</p>
                                            <p class="card-text">Horário Início: '.$row['horario_inicio'].'</p>
                                            <p class="card-text">Horário Término: '.$row['horario_termino'].'</p>
                                        </div>
                                    </div>
                                </div>';
                            $numeroTurma++; 
                        }
                        echo '<div class="col-12 mt-4 d-flex justify-content-center">
                                <button id="inscreverBtn" class="btn btn-primary" onclick="inscrever('.$disciplina_id.')" disabled>Inscrever-se</button>
                            </div>';
                    } else {
                        echo '<div class="col-12">
                                <div class="alert alert-warning" role="alert">
                                    Nenhuma turma disponível para esta disciplina no momento!
                                </div>
                              </div>';
                    }
                } else {
                    header('Location: index.php');
                    exit();
                }
            ?>
        </div>
    </div>
</section>

<script src="./assets/js/main.js"></script>

<?php
    require_once 'footer.php';
?>
