<?php

    //include 'conection.php';
	session_start();
	require 'init.php';
	$conexao = db_connect();

if(isset($_POST['criar'])){

	//--------------------Transformar Dados---------------------//
	$senhacrip = make_hash($_POST['inputSenha']);
	$acesso = $_POST['radio'] == 'adm'? 0 : 1;

	//--------------------Válidar se o Usuário ja existe---------------------//
	$consulta = "select usur_login from USERREBAIXA where usur_login = '".$_POST['inputNome']."'";

	$stid = oci_parse($conexao, $consulta) or die ("erro");
	$exec= oci_execute($stid);

	$rows_returned = oci_fetch_all($stid, $res);

	if($rows_returned){
		
		$_SESSION['session_alert']['manteruser'] = 'Usuário já existente';
	    header('Location: ../criar_usuario.php');
		die();
	}

	else {

	   //--------------------Buscar Transação---------------------//
	    $take_transacao = "SELECT USUARIO_REBAIXA.NEXTVAL FROM DUAL";
	    $stid_transacao =  oci_parse($conexao, $take_transacao) or die("erro");
	    oci_execute($stid_transacao);

	    while (oci_fetch($stid_transacao)) {

		    $trans = oci_result($stid_transacao, 'NEXTVAL');
		}

		$insert = "INSERT INTO USERREBAIXA (USUR_ID,
			                          USUR_LOGIN,
			                          USUR_SENHA,
			                          USUR_ACESSO) 
			                  VALUES (".$trans.",
			                          '".$_POST['inputNome']."',
			                          '".$senhacrip."',
			                          ".$acesso.")";

        $stid_insert = oci_parse($conexao, $insert) or die ("erro");
		$exec= oci_execute($stid_insert);

	    //--------------------Libera memóra Fecha conexões Volta pra página---------------------//
	    oci_free_statement($stid);
	    oci_free_statement($stid_insert);
	    oci_free_statement($stid_transacao);
	  
		$_SESSION['session_alert']['manteruser'] = 'Usuário criado com sucesso';
	    header('Location: ../criar_usuario.php');
	    
		die();

	}	 
}

elseif(isset($_POST['excluir'])){


	$delete = "UPDATE USERREBAIXA SET USUR_ACESSO = 2 WHERE USUR_ID ='".$_POST['excluir']."'";

    $stid = oci_parse($conexao, $delete) or die ("erro");
	$exec= oci_execute($stid);

    //--------------------Libera memóra Fecha conexões Volta pra página---------------------//
    oci_free_statement($stid);

	//header('Location: ../tabela_usuarios.php');  
    echo '<script type="text/javascript"> location.href = "tabela_usuarios.php"; </script>' ;
	die();

}

?>