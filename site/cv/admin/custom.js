var form = document.getElementById("form-contato");

if (form.addEventListener) {                   
    form.addEventListener("submit", validaCadastro);
} else if (form.attachEvent) {                  
    form.attachEvent("onsubmit", validaCadastro);
}

function validaCadastro(evt){
	var nome      = document.getElementById('nome');
	var telefone  = document.getElementById('telefone');
	var data_nascimento     = document.getElementById('data_nascimento');
	var cpf       = document.getElementById('cpf');	
	var sexo      = document.getElementById('sexo');
	var vaga      = document.getElementById('vaga');
	var endereco  = document.getElementById('endereco');
	var bairro    = document.getElementById('bairro');
	var cidade    = document.getElementById('cidade');
	var estado    = document.getElementById('estado');
	var cep       = document.getElementById('cep');
	var email     = document.getElementById('email');
	var curriculo = document.getElementById('curriculo');
	var filtro    = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var contErro  = 0;


	/* Validação do campo nome */
	caixa_nome = document.querySelector('.msg-nome');
	if(nome.value == ""){
		caixa_nome.innerHTML = "Favor preencher o seu Nome Completo";
		caixa_nome.style.display = 'block';
		contErro += 1;
	}else{
		caixa_nome.style.display = 'none';
	}

	/* Validação do campo telefone */
	caixa_telefone = document.querySelector('.msg-telefone');
	if(telefone.value == ""){
		caixa_telefone.innerHTML = "Favor preencher o seu Telefone";
		caixa_telefone.style.display = 'block';
		contErro += 1;
	}else{
		caixa_telefone.style.display = 'telefone';
	}

	/* Validação do campo idade */
	caixa_idade = document.querySelector('.msg-idade');
	if(data_nascimento.value == ""){
		caixa_idade.innerHTML = "Favor preencher a sua Data de Nascimento";
		caixa_idade.style.display = 'block';
		contErro += 1;
	}else{
		caixa_idade.style.display = 'data_nascimento';
	}

	/* Validação do campo rg 
	caixa_rg = document.querySelector('.msg-rg');
	if(rg.value == ""){
		caixa_rg.innerHTML = "Favor preencher o seu RG";
		caixa_rg.style.display = 'block';
		contErro += 1;
	}else{
		caixa_rg.style.display = 'rg';
	}*/

	/* Validação do campo cpf */
	caixa_cpf = document.querySelector('.msg-cpf');
	if(cpf.value == ""){
		caixa_cpf.innerHTML = "Favor preencher o seu CPF";
		caixa_cpf.style.display = 'block';
		contErro += 1;
	}else{
		caixa_cpf.style.display = 'cpf';
	}

	/* Validação do campo endereco */
	caixa_endereco = document.querySelector('.msg-endereco');
	if(endereco.value == ""){
		caixa_endereco.innerHTML = "Favor preencher o seu Endereço";
		caixa_endereco.style.display = 'block';
		contErro += 1;
	}else{
		caixa_endereco.style.display = 'endereco';
	}

	/* Validação do campo bairro */
	caixa_bairro = document.querySelector('.msg-bairro');
	if(bairro.value == ""){
		caixa_bairro.innerHTML = "Favor preencher o seu Bairro";
		caixa_bairro.style.display = 'block';
		contErro += 1;
	}else{
		caixa_endereco.style.display = 'bairro';
	}

	/* Validação do campo cidade */
	caixa_cidade = document.querySelector('.msg-cidade');
	if(cidade.value == ""){
		caixa_cidade.innerHTML = "Favor preencher a sua Ciadade";
		caixa_cidade.style.display = 'block';
		contErro += 1;
	}else{
		caixa_cidade.style.display = 'cidade';
	}

	/* Validação do campo estado */
	caixa_estado = document.querySelector('.msg-estado');
	if(estado.value == ""){
		caixa_estado.innerHTML = "Favor preencher o seu Estado";
		caixa_estado.style.display = 'block';
		contErro += 1;
	}else{
		caixa_estado.style.display = 'estado';
	}

	/* Validação do campo cep */
	caixa_cep = document.querySelector('.msg-cep');
	if(cep.value == ""){
		caixa_cep.innerHTML = "Favor preencher o seu CEP";
		caixa_cep.style.display = 'block';
		contErro += 1;
	}else{
		caixa_cep.style.display = 'cep';
	}


	/* Validação do campo email */
	caixa_email = document.querySelector('.msg-email');
	if(email.value == ""){
		caixa_email.innerHTML = "Favor preencher o seu E-mail";
		caixa_email.style.display = 'block';
		contErro += 1;
	}else if(filtro.test(email.value)){
		caixa_email.style.display = 'none';
	}else{
		caixa_email.innerHTML = "Formato do E-mail inválido";
		caixa_email.style.display = 'block';
		contErro += 1;
	}	

	/* Validação do campo sexo */
	caixa_sexo = document.querySelector('.msg-sexo');
	if(sexo.value == ""){
		caixa_sexo.innerHTML = "Favor preencher o Sexo";
		caixa_sexo.style.display = 'block';
		contErro += 1;
	}else{
		caixa_sexo.style.display = 'none';
	}

	/* Validação do campo vaga */
	caixa_vaga = document.querySelector('.msg-vaga');
	if(vaga.value == ""){
		caixa_vaga.innerHTML = "Favor selecionar uma das Vagas disponiveis!";
		caixa_vaga.style.display = 'block';
		contErro += 1;
	}else{
		caixa_vaga.style.display = 'vaga';
	}


	if(contErro > 0){
		evt.preventDefault();
	}
}

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function formatacpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}

function soNumeros(v){
    return v.replace(/\D/g,"")
}


function cep(v){
    v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
    return v
}

function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id( el ){
	return document.getElementById( el );
}
window.onload = function(){
	id('telefone').onkeypress = function(){
		mascara( this, mtel );
	}
}



