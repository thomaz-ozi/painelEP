<?php require_once('../Connections/connection_user.php'); ?>
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

mysql_select_db($database_connection, $connection_user);
$query_list_usuario = "SELECT * FROM tbnext_usuario WHERE ativado = 3 ORDER BY nome ASC";
$list_usuario = mysql_query($query_list_usuario, $connection_user) or die(mysql_error());
$row_list_usuario = mysql_fetch_assoc($list_usuario);
$totalRows_list_usuario = mysql_num_rows($list_usuario);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" class="txt-Indece">Usuario cadastrado</td>
    <td width="14%" class="txt-Indece">&nbsp;</td>
  </tr>  <?php if($totalRows_list_usuario!=0){ ?>
    <?php do { ?>
  <tr class="txt">

      <td><?php echo $row_list_usuario['nome']; ?> &nbsp;<?php echo $row_list_usuario['sobrenome']; ?></td>
      <td align="center"><a href="?startmod=fazendas_per&conteudo=fazendas_per&id_usuario=<?php echo $row_list_usuario['id_usuario']; ?>&MM_update=ativado&ativado=1"><img src="../icons/circulo_red/add-16.png" width="16" height="16" border="0"></a><a href="http://www.cabanhavillanova.com.br/sma/painelnext/sistema/painel.php?startmod=usuario&conteudo=uu-exc&id_usuario=<?php echo $row_list_usuario['id_usuario']; ?>"><img src="../icons/circulo_red/excluir-16.png" width="16" height="16" border="0"></a></td>
    
  </tr> 
   <?php } while ($row_list_usuario = mysql_fetch_assoc($list_usuario)); ?>
      <?php }else{ ?>
  <tr class="txt">
    <td colspan="2" align="center">Nem um cadastro foi solicitado!</td>
  </tr>
   <?php } ?>
</table>
<?php
mysql_free_result($list_usuario);
?>
