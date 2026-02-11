<?php include("../sistem_funcoes/include_formata_datahoras.php"); ?>

<?php require_once('../Connections/connection.php'); 

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
?>
&nbsp;
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="../sistem_funcoes/openWindow.js" type="text/javascript"></script>
<script src="../sistem_funcoes/goURL.js" type="text/javascript"></script>
<style>
.link_on{
	cursor:pointer;
	}
.link_on:hover{
	cursor:pointer;
	color:#039;
	text-decoration:underline;
	}
   </style>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="texto">
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF" class="txt-Indece"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  align="center"><img src="<?php echo "$icons_sistema_nome"; ?>" width="30" height="30" /></td>
        <td >&nbsp;&nbsp;<?php echo "$sistema_nome"; ?> &nbsp;<?php echo "$versao"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <form id="qtdd" name="qtdd" method="get" action="?">
          </form>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="3" align="center"   class="txt">
      <form action="../sma_relatorios_leite/relatorios_manejo_animal.php?" method="get" name="pesquisa" target="_blank" id="pesquisa">
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" class="txt-Indece">Relatório por animal</td>
            </tr>
          <tr>
            <td align="center" class="txt"><span id="sprytextfield2">
              <input name="conteudo" type="hidden" id="conteudo" value="<?php echo $_GET['conteudo']; ?>" />
              <input name="list_qtdd" type="hidden" id="list_qtdd" value="<?php echo $_GET['list_qtdd']; ?>" />
              <input name="cod_animal" type="text" class="txt-form" id="cod_animal" value="<?php echo $_GET['cod_animal']; ?>" size="40" />
              </span>                <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar por animal" class="txt-Botao-ADD"  onclick="acao()"/>
              <br /><br />
</td>
            </tr>
        </table>
        </form>    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"  class="txt-Indece">RELATÓRIOS</td>
  </tr>

  <tr>
    <td width="36%" align="center" bgcolor="#FFFFFF"  class="txt"><button class="link_on" 
       onclick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_animal.php','','status=yes,scrollbars=yes,resizable=yes')" >RELATÓRIO MANEJO</button></td>
    <td width="34%" align="center" bgcolor="#FFFFFF"  class="txt">
    
<br />
    
     <button class="link_on" 
       onclick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_animal_diario.php','','status=yes,scrollbars=yes,resizable=yes')" >RELATÓRIO DIARIO</button><br /><br />


    </td>
    <td width="30%" align="center" bgcolor="#FFFFFF"  class="txt">
    
    <br />
    
     <button class="link_on" 
       onclick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_lista_animais_restritos_medicamentos.php','','status=yes,scrollbars=yes,resizable=yes')" >ANIMAIS C/RESTRIÇÃO</button><br /><br />
    </td>
  </tr>
  <tr>
    <td colspan="3" align="left" bgcolor="#FFFFFF"  class="txt-Indece">Relatório otimizado</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#FFFFFF"  class="txt">
     <button class="link_on" onclick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_lista_animais_mensal.php','','status=yes,scrollbars=yes,resizable=yes,width=1160')">RELATÓRIO MENSAL</button>
     
    </td>
    <td align="left" bgcolor="#FFFFFF"  class="txt"><button class="link_on" onclick="MM_openBrWindow('../sma_relatorios_leite/relatorios_manejo_mes_ano.php','','status=yes,scrollbars=yes,resizable=yes,width=1160')">RELATÓRIO MÊS/ANO</button></td>
    <td align="left" bgcolor="#FFFFFF"  class="txt"><table width="300" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td><a href="#"       onclick="MM_openBrWindow('../sma_relatorios_leite/otimizar.php','','status=yes,scrollbars=yes,resizable=yes,width=1024')" ><img src="../sma_relatorios_leite/icons/otimizar_relatorios.png" width="40" height="40" border="0" align="middle" />OTIMIZAR RELATÓRIO</a></td>
      </tr>
      <tr>
        <td><a href="#"  onclick="MM_openBrWindow('../sma_relatorios_leite/index_otimizar.php','','status=yes,scrollbars=yes,resizable=yes,width=1024')" ><img src="../sma_relatorios_leite/icons/otimizar_relatorios_edit.png" width="40" height="40" border="0"  align="middle"  /> LISTA RELATÓRIOS OTIMIZADOS </a></td>
      </tr>
    </table></td>
  </tr>
  <tr class="txt-Indece">
    <td colspan="3">&nbsp;</td>
  </tr>

</table>
