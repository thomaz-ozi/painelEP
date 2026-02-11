<?php require_once('../Connections/connection_user.php'); ?>
<?php //envio de resposta do formulario
$limpar_logs=$_POST['limpar_logs'];
if ($limpar_logs==limpar_logs){
	$sql = 'TRUNCATE TABLE `tbnext_usuario_logs`';
	mysql_select_db ( $database, $connection_user );
	if ( @mysql_query ( $sql ) )
	{
		include "res_exc.php";
		exit;
	}
	else {
		die ( mysql_error () );
	}
}
?>

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

<div  class="div_absolute"></div>
<div  class="div_absolute_msn">
 <div  class="div_absolute"></div>
		<div  class="div_absolute_msn">
			<br><br>
			<div class="x_panel divLoadMsnRes" style=" width: 65%;">
				<div class="x_title">
					
					<h2><img src="<?php echo "$icons_sistema_nome"; ?>" />&nbsp;&nbsp;<?php echo "$sistema_nome"; ?>&nbsp;&nbsp; &nbsp;<img src="<?php echo "$local_icons"; ?>excluir-30.png" width="30" height="30" />  Excluir </h2>
					<a class="close-link" style="float:right;" onclick="MM_goToURL('parent','?conteudo=<?php echo $_GET['conteudo']; ?>&<?php echo $id_sistema; ?>=<?php echo $_GET[$id_sistema]; ?>&');return document.MM_returnValue"><i class="fa fa-close"></i></a>
					<div class="clearfix"></div>
				</div>
                <br>
                <br>
                

  <form action="?log_exc=log_exc&usuario=<?php echo  $usuario; ?>&conteudo=ulog&menu=Usuario&submenu=subUsuario" method="POST" name="add_receita" id="add" >
  
  
         	      <div class="txt-Indece" style=" padding:20px; text-align:left" >
                <b><i class="fa fa-exclamation-triangle" style="color:#FF9A43; font-size:36px; margin-top:20px; float:left; "></i> ir&Aacute; excluir todos os log de Eventos dos usuarios</b>
                </div>
  
  
    <BR  />
    <br>
				<br>
            <div  class="txt-Indece">
              <button 
               type="submit" class="btn btn-default txt-Botao-Excluir "  accesskey="c"  ><i class="fa fa-close"></i> EXCLUIR</button>
  
      </div>
</form>


		
                
                
                
			</div>
		</div>


