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
    botaoComentarioPadrao.classList.add('btn-disabled');    

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
        listItem.textContent = fileName;
        listItem.href = "https://www.castrodev.com.br/anexos/" + fileName;
        grupoDescricao.appendChild(listItem);
        grupoDescricao.appendChild(document.createElement('br'));
    }
}

function openModal(){
    
    var modal = document.getElementById("modal");
    modal.style.display = "block";

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }
}

function closeModal(){
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}

function addMsgPadrao(msg){
    closeModal();
    addComment(msg);
}