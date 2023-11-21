
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
  if (turmaSelecionada > 0) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', './functions/register.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            var resp = xhr.responseText;
            if(resp == "A turma está fechada."){
              abrirModalTurmaFechada()
            } else if (resp == "Inscrição realizada com sucesso!") {
              alert(resp)
            } else {
              alert(resp)
            }
          }
      };
      xhr.send('disciplina_id=' + encodeURIComponent(disciplinaId) +
          '&turma_id=' + encodeURIComponent(turmaSelecionada));
  }
}

function abrirModalTurmaFechada() {
  var modal = document.getElementById('turmaFechadaModal');
      modal.classList.add('show');
      modal.style.display = 'block';
      modal.classList.remove('fade');
      document.body.classList.add('modal-open');
  
}

function fecharModalTurmaFechada() {
  var modal = document.getElementById('turmaFechadaModal');

  if (modal) {
      modal.classList.add('fade');
      modal.classList.remove('show');
      document.body.classList.remove('modal-open');
      setTimeout(function () {
          modal.style.display = 'none';
      }, 300); 
  }
}

const btnListaEspera = document.getElementById('listaEspera');
btnListaEspera.addEventListener('click', function () {
  addListaEspera();
});


function addListaEspera() {
  const modal = document.getElementById('turmaFechadaModal');
  const listPosition = document.getElementById('list-position');
  const position = document.getElementById('position');
  var xhr = new XMLHttpRequest();
  xhr.open('POST', './functions/addWaitingList.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var resp = xhr.responseText;
        console.log(listPosition)
        listPosition.classList.remove('.d-none');
        listPosition.classList.add('d-flex');
        btnListaEspera.setAttribute("disabled", "");
      }
  };
  xhr.send('&turma_id=' + encodeURIComponent(turmaSelecionada));
}


