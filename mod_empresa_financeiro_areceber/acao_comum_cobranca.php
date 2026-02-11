<?php require_once('../Connections/connection.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

	
	
	mysql_select_db($database_connection, $connection);
 $query_list_ulti_cobranca = "SELECT * FROM tbnext_mod_empresa_financeiro_receita_parcelas_cobr WHERE id_receitas_parcelas='".$_POST['id_receitas_parcelas']."' ORDER BY id_parcs_cobranca DESC";
$list_ulti_cobranca = mysql_query($query_list_ulti_cobranca, $connection) or die(mysql_error());
$row_list_ulti_cobranca = mysql_fetch_assoc($list_ulti_cobranca);
$totalRows_list_ulti_cobranca = mysql_num_rows($list_ulti_cobranca);
//echo "<br>";

$_POST['cobr_n']=$row_list_ulti_cobranca['cobr_n']+1;
$_POST['cobr_data']=date(Y.'-'.m.'-'.d);
$_POST['cobr_hora']=date(h.':'.m.':'.s);
$_POST['cobr_email']=$_POST['email'];
$_POST['id_receitas_parcelas'];


   $insertSQL = sprintf("INSERT INTO tbnext_mod_empresa_financeiro_receita_parcelas_cobr (cobr_data, cobr_hora, cobr_n, cobr_email, id_receitas_parcelas) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cobr_data'], "date"),
                       GetSQLValueString($_POST['cobr_hora'], "date"),
                       GetSQLValueString($_POST['cobr_n'], "int"),
					   GetSQLValueString($_POST['cobr_email'], "text"),
                       GetSQLValueString($_POST['id_receitas_parcelas'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());



?>

<script>
$(function(){
$('#url_formapgto').click(function(){
	$(this).select()
	});	
});

</script>
 <br>
<br>
<span style="display:none;">
<div align="left"> <i class="fa fa-exclamation-triangle"></i> Mais Informações</div>
<div class="ln_solid"></div>

 <br>

<div class="col-md-12 col-sm-12 col-xs-12 "  >

      <div class="form-group col-md-4 col-sm-6 col-xs-12">
        <label>Cobrança nº:</label>
        <input name="" type="text" disabled style="text-align:right;"   class="form-control col-md-4 col-sm-4 col-xs-12" id="" placeholder="Prazo de entrega:" value="<?php echo $_POST['cobr_n']; ?>">
        </div>
      <div class="form-group col-md-4 col-sm-6 col-xs-12" >
        <label>Data:</label>
        <input name="" type="text" disabled style="text-align:right;"  class="form-control col-md-4 col-sm-4 col-xs-12" id="" placeholder="" value="<?php echo $_POST['cobr_data']; ?>">
        </div>        
      <div class="form-group col-md-4 col-sm-6 col-xs-12" >
        <label>Hora:</label>
        <input name="" type="text" disabled style="text-align:right;"  class="form-control col-md-4 col-sm-4 col-xs-12" id="" placeholder="" value="<?php echo $_POST['cobr_hora']; ?>">
        </div>
</div>
</span>
<div class="clearfix"></div>
<br>
    
<span style="display:none"><?php

//initialize the session
if (!isset($_SESSION)) {
  session_start();
 }?></span>
 
<div class="form-group col-md-12 col-sm-12 col-xs-12" >
  <label class=" col-md-6 col-sm-6 col-xs-12"><i class="fa fa-exclamation-triangle"></i> Caso precise copiar o endereço para o cliente, ex: WhatsApp e outras meios de comunicação</label>
  <input name="url_formapgto" type="text"  style="text-align:center;"  class="form-control col-md-6 col-sm-6 col-xs-12" id="url_formapgto" placeholder="" value="<?php 
 $usuario=md5($_SESSION['MM_UserGroup']);
 $local=md5($_SESSION['LOCAL']);
 $parcela=md5($_POST['id_receitas_parcelas']);
 $url_formapgto= $usuario.$local.$parcela;

echo $msg = 'http://www.gruponext.com.br/formapgto/?'.$url_formapgto;


?>">
  </div>

<?php
mysql_free_result($list_ulti_cobranca);
?>
