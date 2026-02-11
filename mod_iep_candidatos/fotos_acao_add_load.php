 <?php require_once('../Connections/connection.php'); ?>
 <?php 
/*
$hostname_connection = "localhost";
$database_connection = "iep02";
$username_connection = "root";
$password_connection = "";
*/

/*carrega o último registro*/
mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT Codigo, Nome FROM tbMod_canditados ORDER BY Codigo DESC";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);

$conn = mysqli_connect($hostname_connection,$username_connection,$password_connection, $database_connection)or die("Erro na conexão com o BD"); 

$Codigo=$row_list_acao['Codigo']+1;

$tb = "tbMod_canditadosFotos";
//$local_imagem="../mod_iep_candidatos/";
//$local_imagem="c:\\temp\\latest.img"
$local_imagem="C:\\xampp\tmp\\";
?>
<?php
//VERIFICA SE O FORM FOI ENVIADO
//if($_GET) { 
  if(!empty($_FILES['foto']['tmp_name'])){
	//codigo do candidato
	//   $Codigo=$_POST['Codigo'];         
	   
	   //RECEBE DADOS DO FORMULÁRIO               
	   //$pFoto = $_FILES["foto"]["tmp_name"];   
	   $pTipo = $_FILES["foto"]["type"];       
	  
	  
	  
	   //MOVE                                     
	  // move_uploaded_file($pFoto, $local_imagem);  
	   
	   //ABRE ARQUIVO                      
	   //$pont = fopen($local_imagem, "rb");   
	   //PERCORRE O ARQUIVO                                       
	   //$dados = addslashes(fread($pont, filesize($local_imagem))); 
	  
	   
	   $dados = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
		
	   
	   	//INSERE NA BASE DE DADOS
	  	//$sql = mysqli_query($conn, "INSERT INTO ".$tb." (img_boleto ) VALUES('".$dados."', '".$pTipo."') ");
		 $slqDelete= "DELETE  FROM ".$tb." WHERE Codigo='" . $Codigo . "'";
		$sqlAcao = mysqli_query($conn,$slqDelete);
		 $slqInsert="INSERT INTO ".$tb." (Codigo,Foto,tipo)  VALUES('".$Codigo."','".$dados."', '".$pTipo."')";
		$sqlAcao = mysqli_query($conn, $slqInsert);

	  
  }
								
//}else {    echo "Provavelmente a não foi enviada!";    }//FECHA ELSE 


?>
