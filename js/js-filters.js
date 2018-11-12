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


