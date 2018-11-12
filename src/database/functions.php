<?php
/**
 * Conecta com o MySQL usando PDO
 */
function db_connect()
{
   /*Configure o XAMPP para conexão com ORACLE DB*/
   /* Crie o Banco de Dados Oracle*/
   /*Crie essa tabela

    CREATE TABLE "USERREBAIXA" 
       (  "USUR_ID" NUMBER(10,0) NOT NULL ENABLE, 
      "USUR_LOGIN" VARCHAR2(50 BYTE) NOT NULL ENABLE, 
      "USUR_SENHA" VARCHAR2(50 BYTE) NOT NULL ENABLE, 
      "USUR_ACESSO" NUMBER, 
       PRIMARY KEY ("USUR_ID")
      USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 
      STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
      PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
      BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
      TABLESPACE "USERS"  ENABLE, 
       UNIQUE ("USUR_LOGIN")
      USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
      STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
      PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
      BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
      TABLESPACE "USERS"  ENABLE
       ) SEGMENT CREATION IMMEDIATE 
      PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
     NOCOMPRESS LOGGING
      STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
      PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
      BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
      TABLESPACE "USERS" ;

      Crie essa sequencia

      CREATE SEQUENCE  "USUARIO_REBAIXA"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 61 CACHE 20 NOORDER  NOCYCLE ;
    */

	  $user = ''; // Seta o Usuário
    $pass = ''; // Seta a Senha
    $db = ''; // Instância do Banco de Dados
    //'AL32UTF8' = UTF-8
    $conexao = oci_connect($user,$pass,$db,'AL32UTF8');
    
    return $conexao;
}

/**
 * Cria o hash da senha, usando MD5 e SHA-1
 */
function make_hash($str)
{
    return sha1(md5($str));
}

/**
 * Verifica se o usuário está logado
 */
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        return false;
    }
 
    return true;
}

function userLogged()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
    {
        return false;
    }
 
    return $_SESSION['user_name'];
}

function tipoAcesso($acesso){

    if($acesso == 0){
        $acesso = 'Administrador';
    }
    elseif($acesso == 1){
        $acesso = 'Usuário';
    }
    else{
        $acesso = 'INATIVADO';
    }

    return $acesso;
}


function listarUsuarios($conexao){

    $tr = '';
    $consulta = "SELECT USUR_ID,
                        USUR_LOGIN,
                        USUR_ACESSO
                   FROM USERREBAIXA 
                   order by USUR_LOGIN ASC"; 
                   
    $stid = oci_parse($conexao, $consulta) or die ("erro");
    $exec= oci_execute($stid);

      while ($row = oci_fetch_array($stid, OCI_BOTH)) {

        $disable = $row['USUR_ACESSO'] == 2? 'disabled' : '';

        $tr .= "<tr>
                    <th>".$row['USUR_ID']."</th>
                    <th>".$row['USUR_LOGIN']."</th>
                    <th>".tipoAcesso($row['USUR_ACESSO'])."</th>
                    <th>
                      <button type='button' ".$disable." value=".$row['USUR_ID']." name='excluir' class='fa fa-trash' aria-hidden='true' </button>
                      <button type='button' ".$disable." value=".$row['USUR_ID']." name='alterar' class='fa fa-pencil-square-o' aria-hidden='true' data-toggle='modal' data-target='#myModal'></button>
                    </th>
                </tr>";
       }

       oci_free_statement($stid);

       return $tr;

 }

 function dadosUsuarios($conexao,$user){

    $consulta = "SELECT USUR_ID,
                        USUR_LOGIN,
                        USUR_ACESSO
                   FROM USERREBAIXA 
                   WHERE USUR_ID = ".$user."
                   order by USUR_LOGIN ASC"; 
                   
    $stid = oci_parse($conexao, $consulta) or die ("erro");
    $exec= oci_execute($stid);

 
    $rows_returned = oci_fetch_all($stid, $res);
    oci_free_statement($stid);

     return $res;

 }

 function session_alert() {

    if(isset($_SESSION['session_alert']['login'])) {
    ?>
 
      <script type="text/javascript"> alertify.alert(<?php echo "'".$_SESSION['session_alert']['login']."'" ?>); </script>
 
    <?php 
    }

    if(isset($_SESSION['session_alert']['manteruser'])) {
    
         if($_SESSION['session_alert']['manteruser'] == 'Usuário já existente')
         {
      ?>
 
                <script type="text/javascript"> 

                  if(!alertify.warningAlert){
                      //define a new errorAlert base on alert
                      alertify.dialog('warningAlert',function factory(){
                         return{
                                build:function(){
                                    var warningHeader = '<span class="fa fa-exclamation fa-2x" '
                                    +    'style="vertical-align:middle;color:#ed8b02;">'
                                    + '</span>  Atenção';
                                    this.setHeader(warningHeader);
                                }
                            };
                        },true,'alert');
                   }

                  alertify.warningAlert("Esse usuário já existe.");
                </script>
 
       <?php 
         }

         else{
       ?>
 
                <script type="text/javascript"> 

                  if(!alertify.successAlert){
                      //define a new errorAlert base on alert
                      alertify.dialog('successAlert',function factory(){
                         return{
                                build:function(){
                                    var successHeader = '<span class="fa fa-check fa-2x" '
                                    +    'style="vertical-align:middle;color:#0c7a15;">'
                                    + '</span>';
                                    this.setHeader(successHeader);
                                }
                            };
                        },true,'alert');
                   }

                  alertify.successAlert("Usuário criado com sucesso.");
                </script>
 
       <?php 
       
         }
     }

    unset($_SESSION['session_alert']);
}


?>