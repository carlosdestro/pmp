<?php
//ALTER TABLE `curriculos` ADD `curriculo_nome` VARCHAR(255) NULL AFTER `FOTO`, ADD `foto_nome` VARCHAR(255) NULL AFTER `curriculo_nome`;

// Se não postar nada
if ( ! isset( $_POST ) || empty( $_POST ) ) {
	
	// Mensagem para o usuário
	echo 'Nada a publicar!';
	
	// Mata o script
	exit;
}

// Verifica campos em branco
foreach ( $_POST as $chave => $valor ) {
	// Cria as variáveis dinamicamente
	$$chave = $valor;
	
	// Verifica campos em branco
	if ( empty( $valor ) ) {
		// Mensagem para o usuário
		echo 'Existem campos em branco.';
		
		// Mata o script
		exit;
	}
}

// Verifica se todas as variáveis estão definidas
if (  
	   ! isset( $nome      )  
	//|| ! isset( $cliente_sobrenome ) 
	//|| ! isset( $cliente_idade     )
	//|| ! isset( $cliente_sexo      )
) {
	// Mensagem para o usuário
	echo 'Existem variáveis não definidas.';

	// Mata o script
	exit;
}

/*
$curriculo = isset( $_FILES['curriculo'] ) ? $_FILES['curriculo'] : null;

// Verifica se existe curriculo
if ( empty( $curriculo ) ) {
	// Mensagem para o usuário
	echo 'Favor anexe seu curriculo!';
	
	// Mata o script
	exit;
}
*/
 	
// Inclui o arquivo de conexão
include('pdo.php');


if($_FILES['curriculo']['size'] > 0)
{
$fileName = $_FILES['curriculo']['name'];
$tmpName  = $_FILES['curriculo']['tmp_name'];
$fileSize = $_FILES['curriculo']['size'];
$fileType = $_FILES['curriculo']['type'];


$content = file_get_contents($tmpName);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

//echo "<br>File $fileName uploaded<br>";
}

if($_FILES['foto']['size'] > 0)
{
$fileName_foto = $_FILES['foto']['name'];
$tmpName_foto  = $_FILES['foto']['tmp_name'];
$fileSize_foto = $_FILES['foto']['size'];
$fileType_foto = $_FILES['foto']['type'];

$content_foto = file_get_contents($tmpName_foto);//fread($fp_foto, filesize($tmpName_foto));



if(!get_magic_quotes_gpc())
{
    $fileName_foto = addslashes($fileName_foto);
}

echo "<br>File $fileName_foto uploaded<br>";
}


function GetAge($dob="01/01/1970") 
{ 
        $dob=explode("/",$dob); 
        $curMonth = date("m");
        $curDay = date("j");
        $curYear = date("Y");
        $age = $curYear - $dob[2]; 
        if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[0])) 
                $age--; 
        return $age; 
}

$idade = GetAge($data_nascimento);


$verifica = pdo_consulta("INSERT INTO curriculos (
		nome,
		telefone,
		idade,
		rg,
		cpf,
		sexo,
		vaga,
		endereco,
		bairro,
		cidade,
		estado,
		cep,
		email,
		curriculo,
		curriculo_nome,
		foto,
		foto_nome,
		situacao) 
	VALUES
	( 
		:nome,
		:telefone,
		:idade,
		:rg,
		:cpf,
		:sexo,
		:vaga,
		:endereco,
		:bairro,
		:cidade,
		:estado,
		:cep,
		:email,
		:curriculo,
		:curriculo_nome,
		:foto,
		:foto_nome,
		 'Inicial' )",

array(
	'nome' =>					$nome,
	'telefone' =>					$telefone,
	'idade' =>					$idade,
	'rg' =>					$rg,
	'cpf' =>					$cpf,
	'sexo' =>					$sexo,
	'vaga' =>					$vaga,
	'endereco' =>					$endereco,
	'bairro' =>					$bairro,
	'cidade' =>					$cidade,
	'estado' =>					$estado,
	'cep' =>					$cep,
	'email' =>					$email,
	'curriculo' =>					$content,
	'curriculo_nome' =>					$fileName,
	'foto' =>					$content_foto,
	'foto_nome' =>					$fileName_foto
	)

);	

if ( $verifica ) {
	echo 'Seu curriculo foi gravado com sucesso!';
	header("location:msg.php");
	
	// Mata o script
	exit;
} else {
	echo 'Erro ao enviar dados.';
	echo $verifica;	
	
	// Mata o script
	exit;
}
