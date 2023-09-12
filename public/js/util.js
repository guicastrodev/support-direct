function alertaPrototipo(){
    alert('Sistema em desenvolvimento! Essa funcionalidade estará disponível em breve.');
}  

function addComment(texto){
    var listaDescricoes = document.getElementById("lista-descricoes");
    var botaoComentario = document.getElementById("ad-comentario");
    var botaoComentarioPadrao = document.getElementById("ad-com-padrao");
    var descricao = document.createElement("textarea");
    var grupoDescricao = document.createElement("div");
    descricao.style.width = '100%'; 
    descricao.id = 'descricao';   
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

    if(botaoComentarioPadrao){
        botaoComentarioPadrao.classList.add('btn-disabled');    
    }

    var botaoAnexo = document.getElementById('ad-anexo');
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
        listItem.href = "https://www.castrodev.com.br/anexos/" + fileName;
        grupoDescricao.appendChild(listItem);
        grupoDescricao.appendChild(separador);
    }
}

function openModal(){
    
    var modal = document.getElementById("modal");
    modal.style.display = "block";    
    modal.querySelector('input:not([type="hidden"])').focus();

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }

    var perfil = document.getElementById('perfil');

    if(perfil){
        var dpgroup = document.getElementById('dp-group');

        perfil.addEventListener('change', function() {
            /* 2 - Gestor; 4 - Técnico */
            if (perfil.value === '2'||perfil.value === '4') {
                dpgroup.style.display = 'block';
            } else {
                dpgroup.style.display = 'none';
            }
          });    
    };    
}

function closeModal(){
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}

function addMsgPadrao(msg){
    closeModal();
    addComment(msg);
}