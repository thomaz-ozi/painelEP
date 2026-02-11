<?php require_once('../Connections/connection_user.php'); ?>

<?php
//---------------------------------------- classificar noticia
//permissao de usuario
//13/10/2010
//19/10/2017
/*
$row_perfusuario['id_perm_status_usuario_perfil']=$row_perfusuario['id_perm_status_usuario_perfil'];
if($row_perfusuario['id_perm_status_usuario_perfil'] == '1'){
	$adm_sql='';
	}else{}
		

//------------------- lista a quantidade
$list_qtdd=$_GET['list_qtdd'];
if(empty($list_qtdd)){
$list_qtdd='10';
}
	


$opcao=$_GET['opcao'];
if($opcao==nome){
	$palavra_pesquisa=ucwords($_GET['palavra_pesquisa']);
	}else{
	$palavra_pesquisa=strtolower($_GET['palavra_pesquisa']);
	}

//"SELECT * FROM tbnext_usuario ORDER BY nome ASC";

if(empty($opcao)){
		if($row_perfusuario['id_usuario']!=0){ //ocular administrador
		$permisao_cliente_sql= " WHERE  id_usuario !='0' AND banco_dados= '".$row_perfusuario['banco_dados']."' ";
		}
	   $list_SQL="SELECT * FROM tbnext_usuario ". $adm_sql ." ".$permisao_cliente_sql." ORDER BY nome ASC";
		}else{
			
			//para sistem de clientes
		if($row_perfusuario['id_usuario']!=1){ //acultar o administrador
		$permisao_cliente_sql= " AND  id_usuario !='0' AND banco_dados= '".$row_perfusuario['banco_dados']."'";
		}
 		$list_SQL="SELECT * FROM tbnext_usuario WHERE  ". $adm_sql ."   ".$permisao_cliente_sql."  ". $opcao ." LIKE '%".$palavra_pesquisa."%' ORDER BY nome ASC";
		}


*/

switch ($row_perfusuario['id_perm_status_usuario_perfil']) {
    case 1:
       // $adm_sql='';
	   if($row_perfusuario['id_perm_status_usuario_perfil']==0){
			$adm_sql= "  "; //usuario do sistema   
		  }else{
	   			$adm_sql= " WHERE id_usuario !='0' "; //usuario adminstrador 
		  }
        break;
		
    case 2:
		$adm_sql= " WHERE  banco_dados= '".$row_perfusuario['banco_dados']."' AND id_usuario !='0' "; //usuario padrão

        break;
    case 3:
      	$adm_sql =" WHERE banco_dados= '".$row_perfusuario['banco_dados']."' AND id_usuario = ".$row_perfusuario['id_usuario']." AND ativado='1'"; // restrito

        break;
	 default;
      	$adm_sql =" WHERE banco_dados= '".$row_perfusuario['banco_dados']."' AND id_usuario = ".$row_perfusuario['id_usuario']." AND ativado='1'";// inativo

        break;	
}

	   $list_SQL="SELECT * FROM tbnext_usuario ". $adm_sql ."  ORDER BY nome ASC";


?>
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

mysql_select_db($database_connection_user, $connection_user);
  $query_list_acao =$list_SQL;
$list_acao = mysql_query($query_list_acao, $connection_user) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);
?>

<?php
echo $totalRows_list_acao .'-'. $row_perfusuario['perm_limit_usuario'];

?>

<?php  include ("../sistema/index_content_head.php");?>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="table table-striped table-bordered dt-responsive nowrap datatable-full">
  <thead>
  <tr><?php if($row_perfusuario['id_perm_status_usuario_perfil']==1){ ?>
    <td width="2%" align="center" >ID</td>
    <td width="19%" align="center" >Usuario de acesso </td>
    <?php } ?>   
    <td width="32%" align="center" ><strong>Nome do Usuario</strong></td>
    <td width="14%" align="center" >Celular</td>
    <td width="22%" align="center" >Setor</td>
    <td width="11%"  class="txt"><?php

	if(($row_perfusuario['perm_limit_usuario']==0)or($row_perfusuario['perm_limit_usuario']>$totalRows_list_acao)){
	
	
	 if($row_perfusuario['id_perm_status_usuario_perfil']==1){ ?>
      <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button>
      <?php }elseif($totalRows_list_acao==0){ ?>
           <button type="button" 
      onClick="MM_goToURL('parent','?conteudo=<?php echo $conteudo_inf; ?>-add&<?php echo $id_sistema; ?>=<?php echo $row_list_acao[$id_sistema]; ?>');return document.MM_returnValue"
      class="options_action_add" title=" ADICIONAR ">
      </button>
    <?php }}?></td>
  </tr> 
      </thead>
        
        <tbody>
   
   <?php   if($totalRows_list_acao !=0){?>
  <?php do { ?>
  <tr >
 
 
 <?php if($row_perfusuario['id_perm_status_usuario_perfil']==1){ ?>
    <td align="center" ><?php echo $id_usuario= $row_list_acao['id_usuario']; ?></td>
    <td align="left" ><?php echo $row_list_acao['usuario']; ?></td>
    <?php } ?>
    <td align="left"><?php echo $row_list_acao['tratamento']; ?>&nbsp;<?php echo $row_list_acao['nome']; ?></td>
    <td align="center" ><?php echo $row_list_acao['celular']; ?></td>
    <td align="center" ><?php  $id_usuario_setor= $row_list_acao['id_usuario_setor']; include("../sistema_usuario/list_usuario_setor.php");  echo $nome_class= $row_list_filtro_usuario_class['xNome']; ?></td>
    <td align="center"  >
    <?php if($row_perfusuario['id_perm_status_usuario_local']=='1'){  ?>
    
    <button type="button" onclick="MM_goToURL('parent','?startmod=local_perm&amp;conteudo=local_perm&amp;id_usuario=<?php echo base64_encode($row_list_acao['id_usuario']); ?>');return document.MM_returnValue" class="options_action_local" title=" LOCAL ">
     </button>
    <?php } ?>
	<?php 
	//perfil do usuario
 	$perf_id_usuario=$row_perfusuario['id_usuario'];
	$perf_id_usuario_perm=$row_perfusuario['id_usuario_perm']; 
	$id_perm_status_usuario_perfil=$row_perfusuario['id_perm_status_usuario_perfil'];
	//lista de usuario
	$id_usuario=$row_list_acao['id_usuario']; 
	$id_usuario_perm=$row_list_acao['id_usuario_perm']; 
	
	if(($id_usuario==1 )&&($perf_id_usuario==1)){ 
		
	  		echo '<button type="button" 
     onClick="MM_goToURL(\'parent\',\'?'. $id_sistema.'='. base64_encode( $row_list_acao[$id_sistema]).'&conteudo='.$conteudo_inf.'-alt\');return document.MM_returnValue"
     class="options_action_edit" title=" EDITAR ">
     </button>';
		
	}
	  else{
	  	if($id_usuario==$perf_id_usuario){
			echo '<button type="button" 
     onClick="MM_goToURL(\'parent\',\'?'. $id_sistema.'='. base64_encode($row_list_acao[$id_sistema]).'&conteudo='.$conteudo_inf.'-alt\');return document.MM_returnValue"
     class="options_action_edit" title=" EDITAR ">
     </button>';
		}
				
		 elseif($id_usuario_perm==$perf_id_usuario){
			echo '<button type="button" 
     onClick="MM_goToURL(\'parent\',\'?'. $id_sistema.'='. base64_encode($row_list_acao[$id_sistema]).'&conteudo='.$conteudo_inf.'-alt\');return document.MM_returnValue"
     class="options_action_edit" title=" EDITAR ">
     </button>';
			echo '<button type="button" 
      onClick="MM_goToURL(\'parent\',\'?'. $id_sistema.'='. base64_encode($row_list_acao[$id_sistema]).'&conteudo='.$conteudo_inf.'-exc\');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
      </button>';
		}
		
		 elseif( $id_perm_status_usuario_perfil=='1'){
			echo '<button type="button" 
     onClick="MM_goToURL(\'parent\',\'?'. $id_sistema.'='. base64_encode($row_list_acao[$id_sistema]).'&conteudo='.$conteudo_inf.'-alt\');return document.MM_returnValue"
     class="options_action_edit" title=" EDITAR ">
     </button>';
			echo '<button type="button" 
      onClick="MM_goToURL(\'parent\',\'?'. $id_sistema.'='. base64_encode($row_list_acao[$id_sistema]).'&conteudo='.$conteudo_inf.'-exc\');return document.MM_returnValue"
      class="options_action_del" title=" EXCLUIR ">
      </button>';
		}
		
		
}
		
		
		
		?></td>
  </tr>
   <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>
  <?php  }else{ ?>
  <tr >
    <td align="center" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left"><br />
O sistema n&atilde;o encontrou nada!<br />
<br />
<br />
<br />
<br /></td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center"  >&nbsp;</td>
  </tr>
 <?php }?>
 </tbody>
 
</table>
<?php
mysql_free_result($list_acao);
?>
