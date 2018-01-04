<?php


 
 //'mysql:host=$host; dbname=$database;',

function pdo_consulta($query, $params)
{
		/* Variáveis PDO */
	$base_dados = 'precomai_pmp';
	$usuario_bd = 'precomai_cv2';
	$senha_bd   = 'cv2cv2cv2';
	$host_db    = 'localhost';
	$charset_db = 'utf8';
	$conexao_pdo = null;
	 
	/* Concatenação das variáveis para detalhes da classe PDO */
	$detalhes_pdo  = 'mysql:host=' . $host_db;
	$detalhes_pdo .= ';dbname='. $base_dados . ';charset='. $charset_db . ';';



	// Tenta conectar
	try {
	    // Cria a conexão PDO com a base de dados
	    $conn = new PDO($detalhes_pdo, $usuario_bd, $senha_bd);
	    //$conn = new PDO("mysql:host=localhost;dbname=pmp;charset=utf8", "root", "");

	    

	    $prepara = $conn->prepare($query);

	    $prepara->execute($params);

	    return $prepara->fetchAll(PDO::FETCH_ASSOC);

	} catch (PDOException $e) {
	    // Se der algo errado, mostra o erro PDO
	    print "Erro: " . $e->getMessage() . "<br/>";
	    
	    // Mata o script
	    die();
	}

}


?>