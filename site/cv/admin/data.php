<?php

ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 'On');

//header('Cache-Control: no-cache, no-store, must-revalidate'); header('Pragma: no-cache'); header('Expires: 0');

include("pdo.php");

$_SERVER['PHP_AUTH_USER'] = 'admin';

if(isset($_REQUEST['cpf']))
{
	if(!isset($_REQUEST['sit2']) || $_REQUEST['sit2'] == '')
	{
		$_REQUEST['sit2'] = null;
		$_REQUEST['sit1'] = null;
	}

	$resultado = pdo_consulta(
    "INSERT INTO HISTORICO  (CPF, DATA, OBSERVACAO, SITUACAO, SITUACAO_NOVA, USUARIO) VALUES (:cpf, now(), :obs, :sit1, :sit2, :usuario)", 
    array(':cpf' => $_REQUEST['cpf'],
    	  ':obs' => $_REQUEST['observacao'],
    	  ':sit1' => $_REQUEST['sit1'],
    	  ':sit2' => $_REQUEST['sit2'],
          ':usuario' => $_SERVER['PHP_AUTH_USER']));

	if(	$_REQUEST['sit2'] != null)
	$resultado = pdo_consulta(
    "UPDATE curriculos set situacao = :sit2 where cpf = :cpf", 
    array(':cpf' => $_REQUEST['cpf'],
    	':sit2' => $_REQUEST['sit2']));
}
else
{

$observacao = "GROUP_CONCAT(CONCAT(DATE_FORMAT(b.DATA, '%d/%m/%y'), ' ', b.SITUACAO, '>', SITUACAO_NOVA, ' - ', observacao, ' (' , b.usuario, ')'), '<br />')";

if(substr( $_SERVER['PHP_AUTH_USER'], 0, 5) != "admin")
    $observacao = "''";

$resultado = pdo_consulta(
    "SELECT registro, nome, idade, rg, sexo, cidade, vaga, concat(a.situacao, ifnull((select concat(' (',usuario,')') from HISTORICO d where d.cpf = a.cpf order by d.DATA desc limit 1 ), '')) situacao, $observacao OBSERVACAO, a.cpf FROM curriculos a left join HISTORICO b on a.cpf = b .cpf 
    WHERE (1=1)
     and (cidade like :cidade)
     AND (:idadei = '' or idade >= :idadei)
     AND (:idadef = '' or idade <= :idadef)
     AND (:sexo = '' or sexo = :sexo)
     AND (:vaga = '' or vaga = :vaga)
     AND (:situacao = '' or a.situacao = :situacao)
     
     GROUP BY registro, nome, idade, rg, sexo, cidade, vaga, a.situacao
     order by nome", 
    array(':cidade' => '%' . $_REQUEST['cidade'] . '%',
    	  ':idadei' => $_REQUEST['idadei'],
    	  ':idadef' => $_REQUEST['idadef'],
    	  ':sexo' => $_REQUEST['sexo'],
    	  ':vaga' => $_REQUEST['vaga'],
    	  ':situacao' => $_REQUEST['situacao']	));
//echo 2/

}

echo(json_encode($resultado));

ob_end_flush();

flush();

?>


