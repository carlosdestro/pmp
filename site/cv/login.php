<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Login - Preço Mais Popular Farmácias</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<style type="text/css">	
 body {
        margin: 0px;
        background: #FFFF00;
    }
	.container {
        width: 100vw;
        background: #FFFF00;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center
    }
    .box {
        width: 600px;
        margin-top: 90px;
        background-image: url('img/login.png');
        background-repeat: no-repeat;  
            }

    .form {
    	  margin: 80px;
    	  font: verdana;        

    }
    .form-group{
        font-style: Verdana;
        margin-top: 20px;
        
   }
    
    
</style>
<body >

<div class="container">
    <div class="box">
   

		<div class="form">

            <form action="valida.php" method="post" id='form-contato' enctype="multipart/form-data">
                <div class="form-group">
                  <label for="usuario">Usuário</label>
                  <input type="text" class="form-control form-control-inline" id="usuario" name="usuario" placeholder="Infome o seu Usuário" size="40">
                  <span class='msg-erro msg-nome'></span>
              
                  <label for="senha">Senha</label>
                  <input type="password" maxlength="50" class="form-control" id="senha" name="senha" placeholder="Informe sua Senha">
                  <span class='msg-erro msg-endereco'></span>
                </div>

                                 
                <button type="submit" class="btn btn-primary" id='botao'> 
                  Entrar
                </button>
            </form>
		</div>


</div>


    <script type="text/javascript" src="custom.js"></script>

</body>
</html>