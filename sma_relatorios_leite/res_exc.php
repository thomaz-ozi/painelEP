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

if ((isset($_POST['id_otimizar'])) && ($_POST['id_otimizar'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbnext_mod_sma_otimizar_leite WHERE id_otimizar=%s",
                       GetSQLValueString($_POST['id_otimizar'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());
}
 //  include"../funcoes/estilo.php"; ?>


<style type="text/css">
<!--
.style2 {color: #006600}
.style3 {font-size: 16px}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<div id="apDiv1" style="position:absolute; position:fixed; left:0px; display:block; top:0px; width:100%;  height: auto; min-height:100%; z-index:1; background-image: url(../images/fundoBlackTransp.png);  border: 1px none #000000;
"></div>
<div id="apDiv1" style="position:absolute; left:0px; display:block; top:0px; width:100%;  height: auto; min-height:100%; z-index:1; ">  <form action="receitas_acao_excluir_res.php?id=<?php echo $row_list_excluir['id']; ?>&amp;idUsuario=<?php echo $_GET[idUsuario]; ?>" method="POST" name="add_receita" id="add" >
  <table width="658" border="0" cellpadding="0" cellspacing="1" class="texto" align="center">
    <tr>
      <td width="293" align="left" background="../icons/financeiro_linhas.png">&nbsp;</td>
    </tr>
    <tr>
      <td height="31" bgcolor="#E7E6EB" class="txt-indece"><div align="center">
        <table  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  align="left">&nbsp;</td>
            <td  align="left"><?php echo "$sistema_nome"; ?></td>
            <td  align="center"><img src="../icons/circulo_red/excluir-30.png" width="30" height="30" /></td>
            <td  align="left">Excluir</td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr></tr>
    <tr>
      <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="txt">
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
        <tr>
          <td width="48%" >&nbsp;</td>
          <td width="52%" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" ><div align="center" class="style3 style4"> O conteudo foi<span class="txt-Botao-Excluir"> &quot;EXCLUIDO&quot;</span> com sucesso!</div></td>
          </tr>
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" >&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td valign="top"  class="txt-Indece"><div align="center"><a href="index_otimizar.php"><img src="../icons/circulo_red/botao_form_ok.png" width="80" height="22" border="0" /></a></div></td>
    </tr>
    <tr></tr>
  </table>
  
  
  
</form></div>
