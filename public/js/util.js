function alertaPrototipo(){
    alert('Sistema em desenvolvimento! Essa funcionalidade estará disponível em breve.');
}  

function addComment(texto){
    const listaDescricoes = document.getElementById("lista-descricoes");
    const botaoComentario = document.getElementById("ad-comentario");
    const botaoComentarioPadrao = document.getElementById("ad-com-padrao");
    const descricao = document.createElement("textarea");
    const grupoDescricao = document.createElement("div");
    descricao.style.width = '100%'; 
    descricao.id = 'descricao';
    descricao.title = 'Descrição do Chamado (preenchimento obrigatório)';
    descricao.name = 'descricao';  
    descricao.required = true; 
    grupoDescricao.id = 'grupo-descricao';   
    grupoDescricao.name = 'grupo-descricao';   

    descricao.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + "px";
    });    

    if(texto){
        descricao.value = texto;
    }

    grupoDescricao.appendChild(descricao);
    listaDescricoes.appendChild(grupoDescricao);
    botaoComentario.classList.add('btn-disabled');
    botaoComentario.onclick = null;

    if(botaoComentarioPadrao){
        botaoComentarioPadrao.classList.add('btn-disabled');
        botaoComentarioPadrao.onclick = null;
    }

    const botaoAnexo = document.getElementById('ad-anexo');
    if(botaoAnexo){
        botaoAnexo.classList.remove('btn-disabled');
        botaoAnexo.setAttribute('for', 'files[]');
    }
}

function listFiles(){
    const fileInput = document.getElementById('files[]');
    const grupoDescricao = document.getElementById('grupo-descricao');
    const files = fileInput.files;
    const listItems = grupoDescricao.querySelectorAll('a');

    listItems.forEach(item => {
        grupoDescricao.removeChild(item);
    });    

    for (let i = 0; i < files.length; i++) {
        const fileName = files[i].name;
        const listItem = document.createElement('a');
        const separador = document.createElement('a');        
        listItem.textContent = fileName;
        separador.textContent = '; ';
        listItem.href = '#';
        grupoDescricao.appendChild(listItem);
        grupoDescricao.appendChild(separador);
    }

    if(document.getElementById("descricao")){
        document.getElementById("descricao").value = '[anexando arquivo(s)]';
    }
    
}

function openModal(){
    
    const modal = document.getElementById("modal");
    modal.style.display = "block";  
    
    if(modal.querySelector('input:not([type="hidden"])')) {
        modal.querySelector('input:not([type="hidden"])').focus();
    }    

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }
}

function closeModal(){
    const modal = document.getElementById("modal");
    modal.style.display = "none";
}

function addMsgPadrao(msg){
    closeModal();
    addComment(decodeURIComponent(msg));
}

function abreConfirmacaoExclusao(rota) {
    document.getElementById('form-exclusao').action = rota;
    document.getElementById('msg-box-exclusao').style.display = 'block';
}

function fechaConfirmacaoExclusao() {
    document.getElementById('msg-box-exclusao').style.display = 'none';
}

function confirmaExclusao() {
    fechaConfirmacaoExclusao();
    document.getElementById('form-exclusao').submit();
}

const perfil = document.getElementById('perfil');

// Exibe ou oculta o campo departamento, de acordo com o perfil
if(perfil){
    const dpgroup = document.getElementById('dp-group');

    if (perfil.value === '1'||perfil.value === '2') {
        dpgroup.style.display = 'block';
    } else {
        dpgroup.style.display = 'none';
    }

    perfil.addEventListener('change', function() {
        /* 1 - Gestor; 2 - Técnico */
        if (perfil.value === '1'||perfil.value === '2') {
            dpgroup.style.display = 'block';
        } else {
            dpgroup.style.display = 'none';
        }
      });    
}; 

// Ajusta a altura das descrições dos chamados
function ajustarAlturaTextarea(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 2 + 'px';
}

const textareas = document.querySelectorAll('.auto-height');

if (textareas){
    textareas.forEach(function(textarea) {
        ajustarAlturaTextarea(textarea);});
}

function ordena(coluna){

    function sortTable(columnIndex, ascending) {
        var rows = $("table tr:gt(0)").toArray();
        
        rows.sort(function(a, b) {
          var textA = $(a).find("td:eq(" + columnIndex + ") a").text().toUpperCase();
          var textB = $(b).find("td:eq(" + columnIndex + ") a").text().toUpperCase();
          return ascending ? (textA > textB ? 1 : -1) : (textA < textB ? 1 : -1);
        });
        
        $("table tr:gt(0)").remove();
        $("table").append(rows);
      }
    
      var ascending = coluna.classList.contains("asc");
    
    coluna.classList.remove("asc","desc");

    var columnIndex;

    var cells = document.querySelectorAll("table tr:first-child th");

    for (var i = 0; i < cells.length; i++) {
        if (cells[i].textContent.trim() === coluna.textContent.trim()) {
            columnIndex = i;
            break;
        }
    }

    sortTable(columnIndex, ascending);

    coluna.classList.add(ascending ? "desc" : "asc");

    const spans = coluna.parentNode.querySelectorAll("span");
    for (let i = 0; i < spans.length; i++) {
        spans[i].parentNode.removeChild(spans[i]);            
    }

    var span = document.createElement('span');
    coluna.insertBefore(span, coluna.firstChild);
}

const tabelas = document.querySelectorAll(".tabela-ordena");

if(tabelas){
    for (let i = 0; i < tabelas.length; i++) {
        const table_headers = tabelas[i].querySelectorAll("th");
        for (let i = 0; i < table_headers.length; i++) {
            table_headers[i].onclick= function(){ordena(this); };  
        }          
    }
}



