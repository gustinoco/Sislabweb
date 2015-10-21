 
/*Função que abre popup recebendo o URL e ID como parametro para pagina pelo _GET */
function abrir(url,id) {
var popurl=url+"?id="+id;
winpops = window.open(popurl,"","width=1900,height=1000,");
}


/*FUNCAO ALERTA AODELETAR REGISTRO*/
function deletar(){
		decisao = confirm("Deseja deletar registro?");
		if (decisao){
			return true;
		} 
		return false;
}



function confirmacao(id, idBoletim, url) {
    
     var resposta = confirm("Deseja excluir a amostra com número: "+id+" que está no boletim: "+idBoletim+"?");
    
     if (resposta == true || resposta2 == true) {
          window.location.href = url+"?deletar="+id+"&boletim="+idBoletim;
     }
}


function confirmacao2(id, url) {
    
     var resposta = confirm("Deseja excluir o boletim: "+id+"?");
    
     if (resposta == true || resposta2 == true) {
          window.location.href = url+"?deletar="+id;
     }
}

function confirmacao_cliente(id, nome, url) {
    
     var resposta = confirm("Deseja excluir o cliente: "+ nome +"?");
    
     if (resposta == true || resposta2 == true) {
          window.location.href = url+"?deletar="+id;
     }
}

function confirmacao_pesquisador(id, nome, url) {
    
     var resposta = confirm("Deseja excluir o cliente: "+ nome +"?");
    
     if (resposta == true || resposta2 == true) {
          window.location.href = url+"?deletar="+id;
     }
}