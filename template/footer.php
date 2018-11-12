   <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Confimar Logout.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="database/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <script src="../vendor/alertifyjs/alertify.min.js"></script>
    <!--<script src="../js/sb-admin-charts.min.js"></script>
    <script src="../js/js-filters.js"></script>-->
     <?php   

       session_alert(); 
     
     ?>

<script type="text/javascript">

$(document).ready(function(){
   $('#inputDpto').change(function(){

    var dpto_codigo = $(this).val();

  $.ajax({
      url:'../src/database/ajaxData.php',
      method: 'POST',
      data:{dpto_codigo_prod :dpto_codigo},
      success: function(html){
        $('#inputProd').html(html); 

         }
      })

  });
});

$(document).ready(function(){
   $('#inputDpto').change(function(){

    var dpto_codigo = $(this).val();

  $.ajax({
      url:'../src/database/ajaxData.php',
      method: 'POST',
      data:{dpto_codigo_grupo :dpto_codigo},
      success: function(html){

        $('#inputGrupo').html(html);       

         }
      })

  });
});


$(document).ready(function(){
   $('#inputGrupo').change(function(){

    var grupo_codigo = $(this).val(); //RECEBER O VALOR COMO UM ARRAY

    var selectedOptions = []; //CRIA UM ARRAY QUE VAI RECEBER A CONCATENAÇÃO DOS VALORES

    for (var i = 0; i < grupo_codigo.length; i++) {
       
            selectedOptions.push("'" + grupo_codigo[i] + "'");  //VAI FAVENDO UMA LISTA COM OS INDEX DOS ARRAYS
    }
    

    gruposselectionados = selectedOptions.join(",");  //UNI TUDO COM VIRGULA PARA FICAR NO PADRAO DO ORACLE

    $.ajax({
      url:'../src/database/ajaxData.php',
      method: 'POST',
      data:{grupo_codigo : gruposselectionados},
      success: function(html){

        $('#inputProd').html(html);       
        //console.log(html);
         }
      })

  });
});

$(document).ready(function(){
  $('#select_all_grupo').click(function() {

     $('#inputGrupo option').prop('selected', false);

      var dpto_codigo = $('#inputDpto').val();

      $.ajax({
        url:'../src/database/ajaxData.php',
        method: 'POST',
        data:{dpto_codigo_prod :dpto_codigo},
        success: function(html){
          $('#inputProd').html(html); 

           }
        })
   });
});

$(document).ready(function(){
  $('#select_all_produtos').click(function() {

     $('#inputProd option').prop('selected', false); 

   });
});

$(document).ready(function(){
  $('#select_all_unidade').click(function() {

     $('#inputUnid option').prop('selected', false); 

   });
});


$('#verbaunitaria').submit(function(e) {

    if($('#inputGrupo').val() == ""){

     $('#inputGrupo option').prop('selected', true);

    }

    if($('#inputProd').val() == ""){

     $('#inputProd option').prop('selected', true);

    }

    if($('#inputUnid').val() == ""){

     $('#inputUnid option').prop('selected', true);

    }   

 });

$('button[name=excluir]').click(function(){

  var id = $(this).val();
  
  alertify.confirm('Deseja realmente inativar esse usuário?', 
                     function(e){ 
                      $.ajax({
                          url:'../src/database/manter_usuario.php',
                          method: 'POST',
                          data:{ excluir : id},
                          success: function(html){
                            $('button[name=excluir]').html(html); 

                             }
                           })} , 

                     function(e){ }).setHeader('<span class="fa fa-exclamation fa-2x" '
                                                + 'style="vertical-align:middle;color:#ed8b02;">'
                                                + '</span>  Confirmar Inativação?');
});

$('button[name=alterar').click(function(){


/*    $.ajax({
    type: "POST",
    url: '../src/database/functions.php',
    data: {functionname: 'dadosUsuarios', arguments: [$conexao, $('button[name=alterar').val()]},

    success: function (obj, textstatus) {
                  if( !('error' in obj) ) {
                      
                      //yourVariable = obj.result;
                      alert('e nois');
                  }
                  else {
                      alert(obj.error);
                  }
            }
    });
*/

  //var nome = dadosUsuarios($conexao);
  
  //alert($('button[name=alterar').val());

  //$('#inputNomeAlt').val('nois');

});

</script>

  </div>
</body>

</html>
