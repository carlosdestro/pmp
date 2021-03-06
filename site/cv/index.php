<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Curriculo - Preço Mais Popular Farmácias</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<style type="text/css">
.msg-erro{ color: red; }
</style>

</head>

<style type="text/css">	
 body {
        margin: 0px
    }
	.container {
        width: 100vw;
        background: #6C7A89;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center
    }
    .box {
        width: 680px;
        background: #fff;
    }

    .form {
        margin-top: 200px;
    	  margin: 20px;
    	  font: verdana;
        
    }
    .form-group{
        font-style: Verdana;
        margin-top: 10px;
        
    }
    .form-control-inline{
        font-style: Verdana;
        size: 40px;
    }
    .fb-like{
      vertical-align: center;
    }
    img {
      width: 35%;
    }
    
</style>
<body >

<?php 
   /* session_start();

    //verifica se existe uma mensagem na sessão
    if( isset( $_SESSION['mensagem'] ) )
    {
        $mensagem = $_SESSION['mensagem'];
    }*/
?>

<div class="container">
    <div class="box">
	<div style="background-color:#FFFF00 "; align="center" ><img src="img/logofull.png"/> <br/>
  </div>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=442127325832564";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


        
        <h1 align="center"><b>Trabalhe Conosco</b>  </h1>
        
        <h3 align="center" style="color: red"> <?php //echo $mensagem; ?></h3>

		<div class="form">

            <form action="enviar_curriculo.php" method="post" id='form-contato' enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control form-control-inline" id="nome" name="nome" placeholder="Infome o seu Nome" size="40">
                  <span class='msg-erro msg-nome'></span>
                </div>

                <div class="form-group">
                  <label for="foto">Anexe sua Foto aqui</label>
                  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                  <input type="file" class="form-control" id="foto" name="foto" placeholder="Anexe sua Foto aqui!">
                  <span class='msg-erro msg-foto'></span>
                </div>

                 <div class="form-group">
                  <label for="telefone">Telefone Contato</label>
                  <input type="telefone" class="form-control" id="telefone" name="telefone" placeholder="Informe o seu Telefone (xx)xxxxx-xxxx" maxlength="15" >
                  <span class='msg-erro msg-telefone    '></span>
                </div>

                 <div class="form-group">
                  <label for="idade">Idade</label>
                  <input type="idade" class="form-control" id="idade" name="idade" placeholder="Informe sua Idade" maxlength="2" onkeypress="mascara(this,soNumeros)">
                  <span class='msg-erro msg-idade'></span>
                </div>

                 <div class="form-group">
                  <label for="rg">RG</label>
                  <input type="rg" class="form-control" id="rg" name="rg" placeholder="Informe o seu RG" maxlength="15">
                  <span class='msg-erro msg-rg'></span>
                </div>

                 <div class="form-group">
                  <label for="cpf">CPF</label>
                  <input type="cpf" class="form-control" id="cpf" name="cpf" placeholder="Informe o seu CPF" onkeypress="mascara(this,formatacpf)" maxlength="14">
                  <span class='msg-erro msg-cpf'></span>
                </div>

                <div class="form-group">
                  <label for="privilegio">Sexo</label>
                  <select class="form-control" name="sexo" id="sexo">
                    <option value="">Selecione o Sexo</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                  </select>
                  <span class='msg-erro msg-sexo'></span>
                </div>

                 <div class="form-group">
                  <label for="privilegio">Vaga</label>
                  <select class="form-control" name="vaga" id="vaga">
                    <option value="">Selecione uma Vaga</option>
                    <option value="Gerente de Loja">Gerente de Loja</option>
                    <option value="Balconista\Atendente">Balconista\Atendente</option>
                    <option value="Caixa Operador">Caixa Operador</option>
                    <option value="Farmacêutico">Farmacêutico</option>
                  </select>
                  <span class='msg-erro msg-vaga'></span>
                </div>

                 <div class="form-group">
                  <label for="endereco">Endereço</label>
                  <input type="endereco" class="form-control" id="endereco" name="endereco" placeholder="Informe o seu Endereço">
                  <span class='msg-erro msg-endereco'></span>
                </div>

                 <div class="form-group">
                  <label for="bairro">Bairro</label>
                  <input type="bairro" class="form-control" id="bairro" name="bairro" placeholder="Informe o seu Bairro">
                  <span class='msg-erro msg-bairro'></span>
                </div>

                 <div class="form-group">
                  <label for="cidade">Cidade</label>
                  <input type="cidade" class="form-control" id="cidade" name="cidade" placeholder="Informe a sua Cidade">
                  <span class='msg-erro msg-cidade'></span>
                </div>

                 <div class="form-group">
                  <label for="estado">Estado</label>
                  <input type="estado" class="form-control" id="estado" name="estado" placeholder="Informe o seu Estado(UF)">
                  <span class='msg-erro msg-estado'></span>
                </div>

                 <div class="form-group">
                  <label for="cep">CEP</label>
                  <input type="cep" class="form-control" id="cep" name="cep" placeholder="Informe o seu CEP"  onkeypress="mascara(this,cep)" maxlength="9" >
                  <span class='msg-erro msg-cep'></span>
                </div>

                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Informe o E-mail">
                  <span class='msg-erro msg-email'></span>
                </div>

                <div class="form-group">
                  <label for="curriculo">Anexe seu Curriculo</label>
                  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                  <input type="file" class="form-control" id="curriculo" name="curriculo" placeholder="Anexe seu crurrículo aqui!">
                  <span class='msg-erro msg-curriculo'></span>
                </div>
                
                <button type="submit" class="btn btn-primary" id='botao'> 
                  Gravar
                </button>
            </form>
		</div>
<div style="background-color:#FFFF00 "; align="center" >
<br/>
<div class="fb-like"; data-href="https://www.facebook.com/farmaciasprecomaispopular/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
<label>Copyright © 2017. MKT DROGARIA E COMERCIO DE ELETRONICOS LTDA.</label>
    </div>


</div>


    <script type="text/javascript" src="custom.js"></script>

</body>
</html>