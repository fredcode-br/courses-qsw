<?php
      // include('protect.php');
    include('connection.php');
    $pageStyle = 'home.css';
    require_once 'header.php';
?>

<section>
  <div class="container my-4">
    <h2 class="text-center mb-4">Listagem de Disciplinas</h2>
    <div class="row"> 
      <?php
        $query = "SELECT * FROM disciplinas";
        $result = mysqli_query($mysqli, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">'.$row['nome'].'</h5>
                          <p class="card-text">Pré-requisitos: Nenhum</p>
                          <a href="classes.php?disciplina_id='.$row['disciplina_id'].'" class="btn btn-primary btn-block">
                            Cadastrar
                          </a>
                        </div>
                      </div>
                    </div>';
          }
        }else {
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
