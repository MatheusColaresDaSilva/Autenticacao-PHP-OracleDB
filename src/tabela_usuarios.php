<?php include '..\template\header.php';
      require 'database\init.php';

      $conexao = db_connect();
?>
<!-- Example DataTables Card-->
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tabela de Usuários
       </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>NOME</th>
                  <th>ACESSO</th>
                  <th>OPÇÕES</th>
                </tr>
              </thead>
              <tbody>
                <?php

                  echo listarUsuarios($conexao);

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Modal-->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Alterar Usuário</h4>
            </div>
            <div class="modal-body">
                <form id="criarusuario" name="criarusuario" action="database\manter_usuario.php" method="POST">
                  <div class="form-group">
                   <div class="form-row">
                     <div class="col-md-12">
                      <label for="exampleInputEmail1">Nome</label>
                      <input class="form-control" id="inputNomeAlt" name="inputNomeAlt" type="text" aria-describedby="nomeHelp" placeholder="Nome" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                        <label class="radio-inline"><input type="radio" id="radioAdmAlt" name="radioAlt" value="adm" required>Administrador</label>
                        <label class="radio-inline"><input type="radio" id="radioUserAlt" name="radioAlt" value="user">Usuário</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                        <input type="checkbox" id="checkInativoAlt" name="checkInativoAlt" required> Inativo?</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                   <div class="form-row">
                     <div class="col-md-12">
                        <input type="submit" value="Alterar Usuario" name="alterar" id="alterar" class="btn btn-success btn-block col-md-12" >
                    </div>
                   </div>
                  </div>  
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
          </div>
          
        </div>
      </div>
    

<?php include '..\template\footer.php';?>