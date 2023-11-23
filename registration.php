<?php
include('protect.php');
include('connection.php');
require_once 'header.php';
$modulo_id = 1;
?>

<section>
    <div class="container my-4">
        <h2 class="text-center mb-4">Escolha as turmas que deseja cursar</h2>

        <?php
        $query = "SELECT t.*, d.nome AS disciplina_nome, t.nome AS turma_nome FROM turmas t
                  INNER JOIN disciplinas d ON t.disciplina_id = d.disciplina_id
                  WHERE d.modulo_id = $modulo_id
                  ORDER BY d.nome, t.turma_id";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) > 0) {
            $disciplineName = null;

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['disciplina_nome'] !== $disciplineName) {
                    if ($disciplineName !== null) {
                        echo '</div>';
                    }

                    echo '<div class="row mb-3 disciplina-container" data-disciplina-id="' . $row['disciplina_id'] . '">
                            <div class="col-12">
                                <h3 class="text-center">' . $row['disciplina_nome'] . '</h3>
                            </div>
                        </div>
                        <div class="row">';
                    $disciplineName = $row['disciplina_nome'];
                }

                echo '<div class="col-12 col-md-4 mb-4">
                        <div role="button" class="card turma-card" onclick="selecionarTurma(' . $row['turma_id'] . ', this, ' . $row['disciplina_id'] . ')">
                            <div class="card-body">
                                <h5 class="card-title text-center">' . $row['turma_nome'] . '</h5>
                                <p class="card-text">Instrutor: ' . $row['professor_nome'] . '</p>
                                <p class="card-text">Horário de Início: ' . $row['horario_inicio'] . '</p>
                                <p class="card-text">Horário de Término: ' . $row['horario_termino'] . '</p>
                            </div>
                        </div>
                    </div>';
            }

            echo '</div>';

            echo '<div class="col-12 mt-4 d-flex justify-content-between">
                    <a class="btn btn-secondary" href="index.php">Cancelar</a>
                    <div>
                        <button id="revisarInscricaoBtn" class="btn btn-primary pointer-event me-2" onclick="revisarInscricao()" disabled>Revisar Inscrição</button>
                        <button id="inscreverBtn" class="btn btn-success" onclick="inscrever(' . $modulo_id . ')" disabled>Confirmar</button>
                    </div>
                </div>';

        } else {
            echo '<div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        Nenhuma turma disponível para este módulo no momento!
                    </div>
                  </div>';
        }

        ?>
    </div>

    <div class="modal fade" id="turmaFechadaModal" tabindex="-1" role="dialog" aria-labelledby="turmaFechadaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="turmaFechadaModalLabel">Turma Fechada</h5>
                <button type="button" onclick="fecharModalTurmaFechada()" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Esta turma está fechada. Você não pode se inscrever nela.
                <div id="list-position"  class="d-none flex-column align-items-center mt-5 w-100">
                    <h4>Posição</h4>
                    <div>
                        <p id="position">10</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer w-100 flex justify-content-between ">
                <button type="button" class="btn btn-secondary" onclick="fecharModalTurmaFechada()" data-dismiss="modal">Voltar</button>
                <button type="button" class="btn btn-primary" id="listaEspera">Entrar na lista de espera</button>
            </div>
        </div>
    </div>
</div>


</section>

<?php
    require_once 'footer.php';
?>
