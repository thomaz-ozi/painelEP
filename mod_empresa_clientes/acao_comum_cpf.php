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

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM tbnext_mod_empresa_clientes WHERE id_clientes = '".$_POST['content']."'";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>
<script>

$(function($){
   $(".mask_cpf").mask("999.999.999-99");
   $(".mask_cep").mask("99999-999");
   
});

</script>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="26%" class="txt-opcoes">Nome (completo)</td>
    <td width="74%" class="txt"><input style="width:220px;" name="xNome" type="text" <?php echo $exc; ?>  required id="xNome" value="<?php echo $row_list_acao['xNome']; ?>"></td>
  </tr>
  <tr>
    <td class="txt-opcoes">RG:</td>
    <td class="txt">
    <input name="RG" type="text" <?php echo $exc; ?>  required id="RG" value="<?php echo $row_list_acao['RG']; ?>"></td>
  </tr>
  <tr>
    <td class="txt-opcoes">CPF:</td>
    <td class="txt"><input name="CPF" type="text" <?php echo $exc; ?> required id="CPF" value="<?php echo $row_list_acao['CPF']; ?>" class="mask_cpf"></td>
  </tr>
</table>
<?php
mysql_free_result($list_acao);
?>
