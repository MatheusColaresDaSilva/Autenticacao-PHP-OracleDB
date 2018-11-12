<?php
// inclui o arquivo de inicialização
session_start();
require 'init.php';
$conexao = db_connect();


// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
 
if (empty($email) || empty($password))
{
	$_SESSION['session_alert']['login'] = 'Informe usuário e/ou senha';
	header('Location: ../login.php');
    //echo '<script type="text/javascript"> alert("Informe email e senha"); location.href = "../login.php"; </script>' ;
    exit;
}
 
// cria o hash da senha
$passwordHash = make_hash($password);

$consulta = "SELECT USUR_ID,USUR_LOGIN, USUR_SENHA, USUR_ACESSO FROM USERREBAIXA WHERE usur_login = :email AND usur_senha = :passwordHash";

$stid = oci_parse($conexao, $consulta) or die ("erro");

oci_bind_by_name($stid, ':email', $email);
oci_bind_by_name($stid, ':passwordHash', $passwordHash);

oci_execute($stid);

$users = oci_fetch_all($stid, $res);

//verifica se a senha e o usuário estão corretos
if (!$users) {

	$_SESSION['session_alert']['login'] = 'Usuário ou senha incorretos';
	header('Location: ../login.php');
    exit;
}

//verifica se o usuário esta ativo
if($res['USUR_ACESSO'][0] == 2){

	$_SESSION['session_alert']['login'] = 'USUÁRIO INATIVO';
	header('Location: ../login.php');
    exit;
}

$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $res['USUR_ID'][0];
$_SESSION['user_name'] = $res['USUR_LOGIN'][0];
 
header('Location: ../pagina_inicial.php');

?>