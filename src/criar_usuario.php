<?php include '..\template\header.php';?>

  <div class="container">
      <div class="card-header">Preencha os campos abaixo:</div>
      <div class="card-body">
        <form id="criarusuario" name="criarusuario" action="database\manter_usuario.php" method="POST">
          <div class="form-group">
           <div class="form-row">
             <div class="col-md-6">
              <label for="exampleInputEmail1">Nome</label>
              <input class="form-control" id="inputNome"  name="inputNome" type="text" aria-describedby="nomeHelp" placeholder="Nome" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Senha</label>
                <input class="form-control" id="inputSenha" name ="inputSenha" type="senha" placeholder="Password" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label class="radio-inline"><input type="radio" id="radioAdm" name="radio" value="adm" required>Administrador</label>
                <label class="radio-inline"><input type="radio" id="radioUser" name="radio" value="user" required>Usuário</label>
              </div>
            </div>
          </div>
          <div class="form-group">
           <div class="form-row">
             <div class="col-md-6">
                <input type="submit" value="Criar Usuario" name="criar" id="criar" class="btn btn-success btn-block col-md-12" >
            </div>
           </div>
          </div>  
        </form>
      </div>
  </div>


<?php include '..\template\footer.php';?>