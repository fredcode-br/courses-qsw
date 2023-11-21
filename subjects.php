<?php
    include('protect.php');
    include('connection.php');
    require_once 'header.php';
?>

<section>
    <div class="container my-4">
        <h2 class="text-center mb-4">Listagem de Disciplinas</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            $query = "SELECT d.disciplina_id, d.nome, GROUP_CONCAT(p.nome SEPARATOR ', ') as pre_requisitos
                      FROM disciplinas d
                      LEFT JOIN pre_requisitos pr ON d.disciplina_id = pr.disciplina_id
                      LEFT JOIN disciplinas p ON pr.pre_requisito_id = p.disciplina_id
                      GROUP BY d.disciplina_id, d.nome";

            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">'.$row['nome'].'</h5>';
                    
                    if (!empty($row['pre_requisitos'])) {
                        echo '<p class="card-text flex-grow-1">Pré-requisitos: '.$row['pre_requisitos'].'</p>';
                    } else {
                        echo '<p class="card-text flex-grow-1">Pré-requisitos: Nenhum</p>';
                    }
                    
                    echo '<a href="classes.php?disciplina_id='.$row['disciplina_id'].'" class="btn btn-primary mt-2">
                            Inscrever
                          </a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">
                        Nenhuma disciplina ofertada no momento!
                      </div>';
            }
            ?>
        </div>
    </div>
</section>

<?php
    require_once 'footer.php';
?>
