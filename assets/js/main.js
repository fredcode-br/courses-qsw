
var turmaSelecionada = 0;

function selecionarTurma(numeroTurma, elemento) {
    if (turmaSelecionada > 0) {
        var turmaAnterior = document.querySelector('.turma-card.selecionado');
        if (turmaAnterior) {
            turmaAnterior.classList.remove('selecionado');
        }
    }
    elemento.classList.add('selecionado');
    turmaSelecionada = numeroTurma;

    var inscreverBtn = document.getElementById('inscreverBtn');
    inscreverBtn.disabled = (turmaSelecionada === 0);
}

function inscrever(disciplinaId) {
    console.log("here")
    if (turmaSelecionada > 0) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', './functions/register.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          alert(xhr.responseText); 
        }
      };
      xhr.send('disciplina_id=' + encodeURIComponent(disciplinaId) +
             '&turma_id=' + encodeURIComponent(turmaSelecionada));       
    }
}
