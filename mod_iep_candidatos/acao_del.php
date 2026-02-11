<?php require_once('../Connections/connection.php'); ?>
<?php require_once ("../sistema_funcoes/converter_utf8.php");?>

<?php 
	$_POST['id_usuario']= $row_perfusuario['id_usuario'];
	
	$_POST['DataRegistro']=date(Y.'-'.m.'-'.d.' '.H.':'.m.':'.s);
	$_POST['DataRegistroFotos']=date(Y.'-'.m.'-'.d.' '.H.':'.m.':'.s);
	
	require_once ("../sistema_funcoes/converte_datas.php");
	$_POST['DataNascimento']=converte_data($_POST['DataNascimento']);

	

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_POST['Codigo'])) && ($_POST['Codigo'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbMod_canditados WHERE Codigo=%s",
                       GetSQLValueString($_POST['Codigo'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}





mysql_select_db($database_connection, $connection);
$query_list_objetivos = "SELECT * FROM tbMod_canditadosObjet ORDER BY Objetivo ASC";
$list_objetivos = mysql_query($query_list_objetivos, $connection) or die(mysql_error());
$row_list_objetivos = mysql_fetch_assoc($list_objetivos);
$totalRows_list_objetivos = mysql_num_rows($list_objetivos);

$maxRows_list_acao = 1;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

$colname_list_acao = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao = sprintf("SELECT * FROM tbMod_canditados WHERE Codigo = %s", GetSQLValueString($colname_list_acao, "int"));
$query_limit_list_acao = sprintf("%s LIMIT %d, %d", $query_list_acao, $startRow_list_acao, $maxRows_list_acao);
$list_acao = mysql_query($query_limit_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);

if (isset($_GET['totalRows_list_acao'])) {
  $totalRows_list_acao = $_GET['totalRows_list_acao'];
} else {
  $all_list_acao = mysql_query($query_list_acao);
  $totalRows_list_acao = mysql_num_rows($all_list_acao);
}
$totalPages_list_acao = ceil($totalRows_list_acao/$maxRows_list_acao)-1;

$maxRows_list_acao_observacao = 10;
$pageNum_list_acao_observacao = 0;
if (isset($_GET['pageNum_list_acao_observacao'])) {
  $pageNum_list_acao_observacao = $_GET['pageNum_list_acao_observacao'];
}
$startRow_list_acao_observacao = $pageNum_list_acao_observacao * $maxRows_list_acao_observacao;

$colname_list_acao_observacao = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_observacao = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_observacao = sprintf("SELECT * FROM tbMod_canditadosObser WHERE Codigo = %s", GetSQLValueString($colname_list_acao_observacao, "int"));
$query_limit_list_acao_observacao = sprintf("%s LIMIT %d, %d", $query_list_acao_observacao, $startRow_list_acao_observacao, $maxRows_list_acao_observacao);
$list_acao_observacao = mysql_query($query_limit_list_acao_observacao, $connection) or die(mysql_error());
$row_list_acao_observacao = mysql_fetch_assoc($list_acao_observacao);

if (isset($_GET['totalRows_list_acao_observacao'])) {
  $totalRows_list_acao_observacao = $_GET['totalRows_list_acao_observacao'];
} else {
  $all_list_acao_observacao = mysql_query($query_list_acao_observacao);
  $totalRows_list_acao_observacao = mysql_num_rows($all_list_acao_observacao);
}
$totalPages_list_acao_observacao = ceil($totalRows_list_acao_observacao/$maxRows_list_acao_observacao)-1;

$colname_list_acao_emprego = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_emprego = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
$query_list_acao_emprego = sprintf("SELECT * FROM tbMod_canditadosEmprego WHERE Codigo = %s ORDER BY EmpregoDataSaida ASC", GetSQLValueString($colname_list_acao_emprego, "int"));
$list_acao_emprego = mysql_query($query_list_acao_emprego, $connection) or die(mysql_error());
$row_list_acao_emprego = mysql_fetch_assoc($list_acao_emprego);
$totalRows_list_acao_emprego = mysql_num_rows($list_acao_emprego);
?>
<script src="../mod_iep_candidatos/script.js"></script>
<script src="../mod_iep_candidatos/script_descricao.js"></script>
<script src="../mod_iep_candidatos/script_cep.js"></script>
<script src="../mod_iep_candidatos/script_empresa.js"></script>
<script src="../sistema_funcoes/fileUploadImg.js"></script>
<link rel="stylesheet" type="text/css" href="../sistema_funcoes/fileUploadImg.css">
<style>.overflowY{height:160px; margin-top:-20px;  overflow-x: hidden; overflow-y: scroll; border:#BCBCBC solid 1px; } #editEmprego{ display:none;}</style>

 <script>
$(function(){
	$(".mask_date_ma").mask("99/99/9999");

	});

</script>
<?php 
$acao_comum="Excluir";
$acao_icons="excluir-30.png";
$msn='<div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>   </button>
           <strong><center>TEM CERTEZA EM EXCLUIR ESSAS INFORMAÇÕES?</center></strong>
      </div>';
include ("../sistema/index_content_head.php");?>


<form action="<?php echo $editFormAction; ?>" method="POST" id="acao" name="acao" >
   <div class="col-md-12 col-sm-12 col-xs-12">
        <h2>Pessoais</h2>
    </div>
<section id="acaoPrint">
<div class="col-md-10 col-sm-10 col-xs-12">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Codigo  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
          <input name="CodigoD" type="text" disabled class="form-control col-md-7 col-xs-12"   placeholder="Codigo" value="<?php echo $row_list_acao['Codigo']; ?>">
          <input name="id_usuario" type="hidden"  >
          <input name="Codigo" type="hidden"   id="Codigo"  value="<?php echo $row_list_acao['Codigo']; ?>">
          <input name="res" type="hidden" id="res" value="res" />
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nome <span class=" ">*</span>
        </label>
        <div class="col-md-5 col-sm-5 col-xs-12">
          <input name="Nome" type="text" disabled     class="form-control col-md-7 col-xs-12" id="Nome" placeholder="Candidato" value="<?php echo convert_utf8($row_list_acao['Nome']); ?>">
        </div>
        

   	</div>     
	<div class="col-md-12 col-sm-12 col-xs-12">
        <label for="heard" class="control-label col-md-1 col-sm-1 col-xs-12" >Objetivo</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="Objetivo"   class="form-control" id="Objetivo">
            <option value="" <?php if (!(strcmp("", $row_list_acao['Objetivo']))) {echo "selected=\"selected\"";} ?>>---</option>
            <?php
do {  
?>
            <option value="<?php echo convert_utf8($row_list_objetivos['Objetivo'])?>"<?php if (!(strcmp(convert_utf8($row_list_objetivos['Objetivo']), convert_utf8($row_list_objetivos['Objetivo'])))) {echo "selected=\"selected\"";} ?>><?php echo convert_utf8($row_list_objetivos['Objetivo'])?></option>
            <?php
} while ($row_list_objetivos = mysql_fetch_assoc($list_objetivos));
  $rows = mysql_num_rows($list_objetivos);
  if($rows > 0) {
      mysql_data_seek($list_objetivos, 0);
	  $row_list_objetivos = mysql_fetch_assoc($list_objetivos);
  }
?>
          </select>
     </div>
     <div class="col-md-2 col-sm-2 col-xs-12">
                   <input name="DataRegistro" type="text" disabled class="form-control col-md-2 col-xs-12 mask_date" id="DataRegistro"   placeholder="Data de Registro" value="<?php echo date(d."/".m."/".Y)?>">
                   <input name="DataRegistroAlterado" type="hidden" disabled class="form-control col-md-2 col-xs-12 mask_date" id="DataRegistroAlterado"   placeholder="Data de Registro" value="<?php echo date(d."/".m."/".Y)?>">

		</div>
     
     
     
     
     
             <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nascimento
        </label>
        <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="DataNascimento" type="text" disabled   class="form-control col-md-7 col-xs-12 mask_date" id="DataNascimento" placeholder="Nascimento" value="<?php echo converte_data($row_list_acao['DataNascimento']); ?>">
        </div>
        
        <div class="col-md-1 col-sm-1 col-xs-12">
         <input name="DataNascimentoIdade" type="text" disabled   class="form-control col-md-7 col-xs-12" id="DataNascimentoIdade" placeholder="Idade">
		</div>
     
     
     
     
     
     
     
     
     
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nº Filhos  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
         <select name="NFilhos"   class="form-control" id="NFilhos">
           <option value="" <?php if (!(strcmp("", $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>---</option>
           <option value="0" <?php if (!(strcmp(0, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>0</option>
           <option value="1" <?php if (!(strcmp(1, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>1</option>
           <option value="2" <?php if (!(strcmp(2, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>2</option>
           <option value="3" <?php if (!(strcmp(3, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>3</option>
           <option value="4" <?php if (!(strcmp(4, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>4</option>
<option value="5" <?php if (!(strcmp(5, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>5</option>
           <option value="6" <?php if (!(strcmp(6, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>6</option>
           <option value="7" <?php if (!(strcmp(7, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>7</option>
           <option value="8" <?php if (!(strcmp(8, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>8</option>
           <option value="9" <?php if (!(strcmp(9, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>9</option>
           <option value="9" <?php if (!(strcmp(9, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>10</option>
          </select>
		</div>        
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Id Filhos <span class=" ">*</span>
        </label>
        
        
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input name="IdadeFilhos" type="text" disabled     class="form-control col-md-7 col-xs-12" id="IdadeFilhos" placeholder="Filhos" value="<?php echo $row_list_acao['IdadeFilhos']; ?>">
        </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">

         
         
         <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Escolaridade  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="Escolaridade"   disabled class="form-control" id="Escolaridade">
            <option value="" <?php if (!(strcmp("", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Escolaridade</option>
            <option value="Nunca estudou" <?php if (!(strcmp("Nunca estudou", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Nunca estudou</option>
            <option value="Primario Incompleto" <?php if (!(strcmp("Primario Incompleto", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Primario Incompleto</option>
            <option value="Primario Completo" <?php if (!(strcmp("Primario Completo", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Primario Completo</option>
            <option value="Fundamento Incompleto" <?php if (!(strcmp("Fundamento Incompleto", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Fundamento Incompleto</option>
<option value="Fundamento Completo" <?php if (!(strcmp("Fundamento Completo", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Fundamento Completo</option>
            <option value="Fundamento Esdudando" <?php if (!(strcmp("Fundamento Esdudando", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Fundamento Esdudando</option>
            <option value="Medio Incompleto" <?php if (!(strcmp("Medio Incompleto", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Medio Incompleto</option>
            <option value="Medio Completo" <?php if (!(strcmp("Medio Completo", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Medio Completo</option>
            <option value="Supeior Incompleto" <?php if (!(strcmp("Supeior Incompleto", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Supeior Incompleto</option>
            <option value="Supeior completo" <?php if (!(strcmp("Supeior completo", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Supeior completo</option>
          </select>
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado Civil  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="EstadoCivil"   disabled="disabled" class="form-control" id="EstadoCivil">
            <option value="" <?php if (!(strcmp("", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>Estado Civil</option>
            <option value="casado" <?php if (!(strcmp("casado", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>casado</option>
            <option value="Solteiro" <?php if (!(strcmp("Solteiro", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>Solteiro</option>
            <option value="Amigado" <?php if (!(strcmp("Amigado", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>Amigado</option>
            <option value="Divociado" <?php if (!(strcmp("Divociado", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>Divociado</option>
            <option value="Viuvo" <?php if (!(strcmp("Viuvo", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>Viuvo</option>
<option value="Outros" <?php if (!(strcmp("Outros", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>Outros</option>
          </select>
		</div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CPF  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="CPF" type="text" disabled     class="form-control col-md-7 col-xs-12 mask_cpf" id="CPF" placeholder="CPF" value="<?php echo $row_list_acao['CPF']; ?>">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">RG </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="RG" type="text" disabled   class="mask_rg form-control col-md-7 col-xs-12" id="RG"  placeholder="RG" value="<?php echo $row_list_acao['RG']; ?>">
        </div>
         <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CNH </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="CNH" type="text" disabled   class="mask_rg form-control col-md-7 col-xs-12" id="CNH"  placeholder="Habilitação" value="<?php echo $row_list_acao['CNH']; ?>">
        </div>
        </div>
          
          
        </div> 
        <div class="col-md-2 col-sm-2 col-xs-12">
                         <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview" data-original-title="" title="">
                <input class="form-control image-preview-filename" disabled="disabled" type="text"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> 
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title"></span>
                        <input name="foto" type="file" id="foto" placeholder="Imagem" accept="image/png, image/jpeg, image/gif"> <!-- rename it -->
                        <input type="hidden" name="DataRegistroFotos" id="DataRegistroFotos">
                    </div>
                </span>
            </div><!-- /input-group image-preview [TO HERE]--> 
                        <div class="printImg" >
            <img src="../mod_iep_candidatos/acao_imagem.php?codigo=<?php echo $_GET['Codigo']; ?>" class="img-responsive img-thumbnail " alt="Imagem do Cantidato" style="width:auto;height:auto; float:right;"></div>
  			 </div>
   </div>
        
               
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h2>Endereço</h2>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CEP  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="CEP" type="text" disabled   class="form-control col-md-7 col-xs-12 mask_cep" id="CEP" placeholder="CEP" value="<?php echo $row_list_acao['CEP']; ?>">
      </div>
    </div>
    <span id="loadEndereco">
      <div class="col-md-12 col-sm-12 col-xs-12" >
  
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Endereço  </label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input name="Endereco" type="text" disabled     class="form-control col-md-7 col-xs-12" id="Endereco" placeholder="Endereço" value="<?php echo $row_list_acao['Endereco']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Numero   </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
      	<input name="end_nro" type="text" disabled   class="form-control col-md-7 col-xs-12" id="end_nro" placeholder="Nº" value="">
      </div>
      
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bairro   </label>
      <div class="col-md-3 col-sm-3 col-xs-12">
      	<input name="Bairro" type="text" disabled     class="form-control col-md-7 col-xs-12" id="Bairro" placeholder="Bairro" value="<?php echo $row_list_acao['Bairro']; ?>">
      </div>
      </div>
      
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input name="Cidade" type="text" disabled     class="form-control col-md-7 col-xs-12" id="Cidade" placeholder="Cidade" value="<?php echo $row_list_acao['Cidade']; ?>">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
        	<input name="Estado" type="text" disabled     class="form-control col-md-7 col-xs-12" id="Estado" placeholder="Estado"  value="<?php echo $row_list_acao['Estado']; ?>">
        	<input name="end_cPais" type="hidden" id="end_cPais" value="">
        	<input name="end_xPais" type="hidden" id="end_xPais" value="">
        </div>
    </div>

	</span>
       <div class="col-md-12 col-sm-12 col-xs-12">
        <h2>Contato</h2>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Telefone 1  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone1" type="text" disabled     class="form-control col-md-7 col-xs-12 mask_cel" id="Telefone1" placeholder="Telefone 1" value="<?php echo $row_list_acao['Telefone1']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Telefone 2  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone2" type="text" disabled class="form-control col-md-7 col-xs-12 mask_cel" id="Telefone2" placeholder="Telefone 2" value="<?php echo $row_list_acao['Telefone2']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Telefone 3   </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone3" type="text" disabled class="form-control col-md-7 col-xs-12 mask_cel" id="Telefone3" placeholder="Telefone 3" value="<?php echo $row_list_acao['Telefone3']; ?>">
      </div>

   </div>
   <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">e-mail  </label>
      <div class="col-md-5 col-sm-5 col-xs-12">
      	<input name="EMail" type="text" disabled     class="form-control col-md-7 col-xs-12" id="EMail" placeholder="e-mail" value="<?php echo $row_list_acao['EMail']; ?>">
      </div>
   </div>
   
   <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="col-md-12 col-sm-12 col-xs-12"><h2> Último emprego</h2></div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Empresa </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        <input name="EmpregoEmpresa[]" type="text" disabled   class="form-control col-md-7 col-xs-12" id="EmpregoEmpresa" placeholder="Empresa" value="<?php echo convert_utf8($row_list_acao_emprego['EmpregoEmpresa']); ?>">
        <input name="DataRegistroEmp" type="hidden" id="DataRegistroEmp">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cargo  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="EmpregoCargo[]" type="text" disabled   class="form-control col-md-7 col-xs-12" id="EmpregoCargo[]"   placeholder="Cargo" value="<?php echo convert_utf8($row_list_acao_emprego['EmpregoCargo']); ?>">
        </div>
        <a class="btn btn-app oculPrint" id="empregoEdit">
              <i class="fa fa-edit"></i> Outros
        </a>
        
        <div id="editEmprego" >
        <?php  include ("../mod_iep_candidatos/emprego_acao_edit.php");?>
        </div>
        </div> 
        <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="EmpregoCidade" type="text" disabled     class="form-control col-md-7 col-xs-12 " id="EmpregoCidade" placeholder="Cidade/UF" value="<?php echo $row_list_acao['EmpregoCidade']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">D.Entreda  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="EmpregoDataEntreda" type="text" disabled class="form-control col-md-7 col-xs-12 mask_date" id="EmpregoDataEntreda" placeholder="EmpregoDataEntreda" value="<?php echo $row_list_acao['EmpregoDataEntreda']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">D. Saída  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="EmpregoDataSaida" type="text" disabled class="form-control col-md-7 col-xs-12 mask_date" id="EmpregoDataSaida" placeholder="EmpregoDataSaida" value="<?php echo $row_list_acao['EmpregoDataSaida']; ?>">
      </div>

   </div>
        
        
        
        <div class="col-md-12 col-sm-12 col-xs-12">
        	<h2>Observação</h2>
    	</div>
        
          <div class="col-md-12 col-sm-12 col-xs-12" style="margin:5px;">
          <label>
            <input name="FaseProva" type="checkbox" class="flat" id="FaseProva"  /> Prova
          </label>
          <label>
            <input name="FaseEntrevista" type="checkbox" class="flat" id="FaseEntrevista"  /> Entrevista
          </label>
          <label>
            <input name="FaseTreinamento" type="checkbox" class="flat" id="FaseTreinamento"  /> Treinamento
          </label>
          <label>
            <input name="FaseExIEP" type="checkbox" class="flat" id="FaseExIEP"  /> Ex IEP
          </label>
          <div id="loadDiv"></div>  
        </div>

       <input name="Observacoes" type="hidden" id="Observacoes"><input name="DataRegistroObs" type="hidden" id="DataRegistroObs">
        <table width="100%" class="table table-hover">
          <thead>
            <tr>
              <th width="15%">Data</th>
              <th width="12%">Usuario</th>
              <th width="61%">Observação</th>
              <th width="12%" align="right">             
              <button class="options_action_add_sec oculPrint" title=" ADICIONAR " id="descricaoAdd" type="button"> </button>
              </th>
            </tr>
          </thead>
        </table>
        <div class="col-md-12 col-sm-12 col-xs-12 overflowY" >
	  <table width="100%" class="table table-hover" id="tableDesc">
                      <tbody>
                        <tr>
                          <th width="15%" ></th>
                          <td width="12%"></td>
                          <td width="64%"></td>
                          <td width="9%" ></td>
                        </tr>
						<?php do { ?>
                        <tr>
                          <th><?php echo $row_list_acao_observacao['id_usuario']; ?></th>
                          <td><?php echo $row_list_acao_observacao['DataRegistroObs']; ?></td>
                          <td><?php echo convert_utf8($row_list_acao_observacao['Observacoes']); ?></td>
                          <td></td>
                        </tr>
						<?php } while ($row_list_acao_observacao = mysql_fetch_assoc($list_acao_observacao)); ?>
                      </tbody>
          </table>

        </div>  
        
        
        
    
</section>   
<div class="btn-group">
<br><br><br>
        <button type="button" class="btn btn-default" onclick="javascript:history.back()"><i class="fa fa-chevron-left"></i> Voltar</button>

        <button type="button" class="btn btn-success" 
             onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-alt');return document.MM_returnValue"
        ><i class="fa fa-save"></i> Alterar </button>
        <button type="button" class="btn btn-primary"  onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add');return document.MM_returnValue" ><i class="fa fa-file-text-o"></i> Novo</button>
        <button type="submit" class="btn btn-danger" >&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i> Excluir &nbsp;&nbsp;&nbsp;&nbsp;</button>

</div>
<input type="hidden" name="MM_update" value="acao">
 
  
</form> 



  <?php if ($_POST['res']=='res'){include "res_exc.php";}?>
  <?php
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
	mysql_free_result($list_select);
  }
  mysql_free_result($list_objetivos);

mysql_free_result($list_acao);

mysql_free_result($list_acao_observacao);

mysql_free_result($list_acao_emprego);
?>


