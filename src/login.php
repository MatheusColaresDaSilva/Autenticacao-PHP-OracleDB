<?php 
  
  session_start();
  require 'database/init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Rebaixa de Preço</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" href="../vendor/alertifyjs/css/alertify.min.css" />
  <!-- include a theme -->
  <link rel="stylesheet" href="../vendor/alertifyjs/css/themes/default.min.css" />
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Rebaixa de Preço</div>
      <div class="card-body">
        <form action="database/validar_login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Usuário</label>
            <input class="form-control" id="email" name="email" type="text" aria-describedby="emailHelp" placeholder="Enter Usuário">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
          </div>
          <input type="submit" value="Acessar" name="validarlogin" id="validarlogin" class="btn btn-primary btn-block ">
        </form>
      </div>
    </div>
  </div>
</body>

 <script src="../vendor/alertifyjs/alertify.min.js"></script>

 <?php   

   session_alert(); 
 
 ?>
</html>
