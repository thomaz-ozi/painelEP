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
 $query_list_cobranca = "SELECT * FROM tbnext_mod_empresa_financeiro_receita_parcelas_cobr WHERE id_receitas_parcelas = '".$_POST['content']."' ORDER BY id_parcs_cobranca DESC";
$list_cobranca = mysql_query($query_list_cobranca, $connection) or die(mysql_error());
$row_list_cobranca = mysql_fetch_assoc($list_cobranca);
$totalRows_list_cobranca = mysql_num_rows($list_cobranca);
?>
<style onload="divLoadMsn('.divLoadMsnlocal','options_action_file_doc','Informações de Cobranças','#loadPesquisa')"></style> 
<div class="divLoadMsnlocal">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    
    <tr>
      <td colspan="3" class="txt">
      <?php //  echo $query_list_cobranca;  ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
          <thead>
          <tr class="txt-opcoes">
            <td width="17%">Qtdd</td>
            <td width="35%">Data</td>
            <td width="22%">Horas</td>
            <td>Email</td>
            </tr>
        </thead>
      </table>
      <div class="divBarraRol" style="height:150px;">
      
      
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
          <tbody>
            <tr>
              <td width="17%"></td>
              <td width="35%"></td>
              <td width="22%"></td>
              <td></td>
            </tr>
            <?php $l=1;?>
			<?php do { ?>
            <tr class="linhas<?php echo $l; ?>">
              
                <td><?php echo $row_list_cobranca['cobr_n']; ?></td>
                <td><?php echo $row_list_cobranca['cobr_data']; ?></td>
                <td><?php echo $row_list_cobranca['cobr_hora']; ?></td>
                <td><?php echo $row_list_cobranca['cobr_email']; ?></td>
                
            </tr>
            <?php  $l++; if($l>2){$l=1;} ?>
			<?php } while ($row_list_cobranca = mysql_fetch_assoc($list_cobranca)); ?>
          </tbody>
        </table>
      </div>
      
      </td>
      </tr>
    </tbody>
</table>
<div class="clearfix"></div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-default" onclick="loadsDataClear('#loadCabr')"  ><i class="fa fa-close"></i>&nbsp; FECHAR</button>
      </div>
    </div>
</div>

<?php
mysql_free_result($list_cobranca);
?>
