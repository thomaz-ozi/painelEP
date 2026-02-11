<?php require_once('../Connections/connection.php'); ?>
<?php require_once ("../sistema_funcoes/converter_utf8.php");?>
<?php require_once ("../sistema_funcoes/masc_clear_cpf_rg_cnh.php");?>
<?php require_once ("../sistema_funcoes/masc_clear_cep.php");?>
<?php require_once ("../sistema_funcoes/agoraDataHoras.php");?>
<?php 
require_once ("../sistema_funcoes/calPediodoDatas.php");
include "../sistema_funcoes/converte_datas_horas.php";
require_once ("../sistema_funcoes/converte_datas.php");
?>

<?php 
    $_POST['CEP']=masc_clear_cpf($_POST['CEP']);
    $_POST['CPF']=masc_clear_cpf($_POST['CPF']);
    $_POST['RG']=masc_clear_rg($_POST['RG']);
    $_POST['CNH']=masc_clear_cnh($_POST['CNH']);
					   
if (!isset($_SESSION)) {
  session_start();
 }
	$_POST['id_usuario']= $_SESSION['MM_UserGroup'];
	
	$_POST['RegistroDataAlterado']=agoraDataHoras();
	$_POST['DataRegistroFotos']=agoraDataHoras();
	
	
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "acao")) {
	$updateSQL = sprintf("UPDATE tbMod_canditados SET Nome=%s, DataNascimento=%s, Objetivo=%s, NFilhos=%s, IdadeFilhos=%s, Escolaridade=%s, EstadoCivil=%s, Endereco=%s, Endereco_nro=%s, Complemento=%s, Bairro=%s, Cidade=%s, Estado=%s, CEP=%s, Telefone1=%s, Telefone2=%s, Telefone3=%s, EMail=%s, CPF=%s, RG=%s, CNH=%s, FaseProva=%s, FaseEntrevista=%s, FaseTreinamento=%s, FaseExIEP=%s, id_usuario=%s, RegistroDataAlterado=%s WHERE Codigo=%s",
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['DataNascimento'], "date"),
                       GetSQLValueString($_POST['Objetivo'], "text"),
                       GetSQLValueString($_POST['NFilhos'], "text"),
                       GetSQLValueString($_POST['IdadeFilhos'], "text"),
                       GetSQLValueString($_POST['Escolaridade'], "text"),
                       GetSQLValueString($_POST['EstadoCivil'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
					   GetSQLValueString($_POST['Endereco_nro'], "text"),
					   GetSQLValueString($_POST['Complemento'], "text"),
                       GetSQLValueString($_POST['Bairro'], "text"),
                       GetSQLValueString($_POST['Cidade'], "text"),
                       GetSQLValueString($_POST['Estado'], "text"),
                       GetSQLValueString($_POST['CEP'], "text"),
                       GetSQLValueString($_POST['Telefone1'], "text"),
                       GetSQLValueString($_POST['Telefone2'], "text"),
                       GetSQLValueString($_POST['Telefone3'], "text"),
                       GetSQLValueString($_POST['EMail'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['RG'], "text"),
                       GetSQLValueString($_POST['CNH'], "text"),
					   
					   GetSQLValueString($_POST['FaseProva'], "int"),
					   GetSQLValueString($_POST['FaseEntrevista'], "int"),
					   GetSQLValueString($_POST['FaseTreinamento'], "int"),
					   GetSQLValueString($_POST['FaseExIEP'], "int"),
					   
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['RegistroDataAlterado'], "date"),
                       GetSQLValueString($_POST['Codigo'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
   
	include ("../mod_iep_candidatos/acao_comum_emprego_add.php");
	include ("../mod_iep_candidatos/acao_comum_emprego_alt.php");
   	include ("../mod_iep_candidatos/acao_comum_obser_add.php");
}

   	include ("../mod_iep_candidatos/fotos_acao_add.php");




 //verificar pesquisa por codigo
 include("../mod_iep_candidatos/acao_alt_load_pesquisa_codverif.php");

/*list_acao - inicio*/
//convertando para ajax
if($_POST[PesquisaAvancadaColunas]==''){echo $_POST[PesquisaAvancadaColunas]='Codigo';  $_POST[xPesq]=$_GET[Codigo];}	
	//opcoes de campos
	
	//declarar a variavel
	$colunaSQL;
	$tbSQL;

	switch ($_POST[PesquisaAvancadaColunas]){
		case 'Codigo':
			$tbSQL='tbMod_canditados';
			$colunaSQL='direto';
		break;
		case 'Observacoes':
			$tbSQL=vwnext_candidatosCompleto;
		break;
		case 'telefones':
			$tbSQL=vwnext_candidatosCompleto;
		break;
		
		case 'cel':
			$_POST[PesquisaAvancadaColunas]='telefones';
			$tbSQL='vwnext_candidatosCompleto';
		break;	
		case 'fone':
			$_POST[PesquisaAvancadaColunas]='telefones';
			$tbSQL='vwnext_candidatosCompleto';
		break;
		case 'todos':
			$tbSQL=vwnext_candidatosCompleto;
		echo	$nColunas=$_POST[PesquisaAvancadaColunas];
			$colunaSQL='todos';
		break;
		case 'Idade':
			$tbSQL=vwnext_candidatosCompleto;
		break;

		case 'RegistroData':
			$_POST['xPesq']=converte_data($_POST['xPesq']);
			$tbSQL='tbMod_canditados';
			$colunaSQL='data';
		break;
		
		case 'RegistroDataAlterado':
			$_POST['xPesq']=converte_data($_POST['xPesq']);
			$tbSQL='tbMod_canditados';
			$colunaSQL='data';
		break;


		default;
			$tbSQL='tbMod_canditados';

		break;
		}
	
switch ($colunaSQL){
	case '':
 		$coluna=$_POST[PesquisaAvancadaColunas]." LIKE '%". $_POST[xPesq]."%' ";
		break;
		
		
		
	case 'direto':
	
		if($_POST[PesquisaAvancadaColunas]=='Codigo'){
			if($_POST[xPesq]!=''){
 			 $coluna= "Codigo = '".$_POST[xPesq]."' ";
			}else{
				$coluna=$_POST[PesquisaAvancadaColunas]." LIKE '%". $_POST[xPesq]."%' ";
				$OrdemSql='DESC';
				}}

		/*	
		if(($_POST[xPesq]=='')or($_GET[codigo]=='')){
			$coluna=$_POST[PesquisaAvancadaColunas]." LIKE '%". $_POST[xPesq]."%' ";
			}else{
 			$coluna= "Codigo = '".$_POST[xPesq]."'";
			}			
			*/
			
			
		break;
		
	case 'ano':
 		$coluna=" YEAR(". $_POST[PesquisaAvancadaColunas].")='". $_POST[xPesq]."'";
		break;
		
	case 'data':
 		$coluna=" DATE(". $_POST[PesquisaAvancadaColunas].")='". $_POST[xPesq]."'";
		break;
	case 'todos':
 		$coluna="Codigo LIKE '%". $_POST[xPesq]."%' OR 
		Nome LIKE '%". $_POST[xPesq]."%' OR
		CPF LIKE '%". $_POST[xPesq]."%' OR
		RG LIKE '%". $_POST[xPesq]."%' OR
		telefones LIKE '%". $_POST[xPesq]."%' OR
		Email LIKE '%". $_POST[xPesq]."%' OR
		CEP LIKE '%". $_POST[xPesq]."%' OR
		Endereco LIKE '%". $_POST[xPesq]."%' OR
		Bairro LIKE '%". $_POST[xPesq]."%' OR
		Estado LIKE '%". $_POST[xPesq]."%' OR
		Cidade LIKE '%". $_POST[xPesq]."%' OR
		Escolaridade LIKE '%". $_POST[xPesq]."%' OR
		Idade LIKE '%". $_POST[xPesq]."%' OR
		EstadoCivil LIKE '%". $_POST[xPesq]."%' OR
		Observacoes LIKE '%". $_POST[xPesq]."%'" ;
		break;
	default;
 	$coluna=$_POST[PesquisaAvancadaColunas]." LIKE '%". $_POST[xPesq]."%' ";
 	break;
}

// ORDEM

if($OrdemSql==''){$OrdemSql='ASC';}
/*iniciando Pesquisa*/
$maxRows_list_acao = 1;
$pageNum_list_acao = 0;
if (isset($_GET['pageNum_list_acao'])) {
  $pageNum_list_acao = $_GET['pageNum_list_acao'];
}
$startRow_list_acao = $pageNum_list_acao * $maxRows_list_acao;

mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT * FROM ".$tbSQL." WHERE ".$coluna."  ORDER BY Codigo ".$OrdemSql;
$query_limit_list_acao = sprintf("%s LIMIT %d, %d ", $query_list_acao, $startRow_list_acao, $maxRows_list_acao);
$list_acao = mysql_query($query_limit_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);

if (isset($_GET['totalRows_list_acao'])) {
  $totalRows_list_acao = $_GET['totalRows_list_acao'];
} else {
  $all_list_acao = mysql_query($query_list_acao);
  $totalRows_list_acao = mysql_num_rows($all_list_acao);
}
$totalPages_list_acao = ceil($totalRows_list_acao/$maxRows_list_acao)-1;


/*list_acao - fim*/

$_GET['Codigo']=$row_list_acao['Codigo'];

/*list_objetivos - inicio*/
mysql_select_db($database_connection, $connection);
$query_list_objetivos = "SELECT * FROM tbMod_canditadosObjet ORDER BY Objetivo ASC";
$list_objetivos = mysql_query($query_list_objetivos, $connection) or die(mysql_error());
$row_list_objetivos = mysql_fetch_assoc($list_objetivos);
$totalRows_list_objetivos = mysql_num_rows($list_objetivos);

/*list_objetivos - fim*/




/*list_acao_observaca - inicio*/
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
$query_list_acao_observacao = sprintf("SELECT * FROM tbMod_canditadosObser WHERE Codigo = %s  ORDER BY DataRegistroObs DESC", GetSQLValueString($colname_list_acao_observacao, "int"));
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
/*list_acao_observaca - fim*/

/*list_acao_emprego - inicio*/
$colname_list_acao_emprego = "-1";
if (isset($_GET['Codigo'])) {
  $colname_list_acao_emprego = $_GET['Codigo'];
}
mysql_select_db($database_connection, $connection);
 $query_list_acao_emprego = sprintf("SELECT * FROM tbMod_canditadosEmprego WHERE Codigo = %s ORDER BY IdEmprego DESC", GetSQLValueString($colname_list_acao_emprego, "int"));
$list_acao_emprego = mysql_query($query_list_acao_emprego, $connection) or die(mysql_error());
$row_list_acao_emprego = mysql_fetch_assoc($list_acao_emprego);
$totalRows_list_acao_emprego = mysql_num_rows($list_acao_emprego);


/*list_acao_emprego - fim*/


?>

<?php 
//Pesquisa barra avançada
include ("../mod_iep_candidatos/acao_alt_load_pesquisa_cod.php");
include ("../mod_iep_candidatos/acao_alt_load_pesquisa_bt.php");
?>



<script src="../mod_iep_candidatos/script_descricao.js"></script>


 <script src="../sistema_funcoes/jq_ifChecked.js"></script>
 <script src="../vendors/iCheck/icheck.min.js"></script>


<script>
$(function(){
	$(".mask_date_ma").mask("99/99/9999");
	$(".mask_date").mask("99/99/9999");
	
   $(".mask_fone").mask("(99)9999-9999");
   $(".mask_cel").mask("(99)9.9999-9999");
   $(".mask_tin").mask("99-9999999");
   $(".mask_ssn").mask("999-99-9999");
   $(".mask_cpf").mask("999.999.999-99");
   $(".mask_cnh").mask("999.999.999.99");
   $(".mask_rg").mask("99.999.99?*-***");/*muito bom!!!*/
  // $("#RG").mask("99.999.999.999-*?",{completed:function(){alert("Completo! Dados OK");}});
   $(".mask_cnpj").mask("99.999.999/9999-99");
   $(".mask_cep").mask("99999-999");
	});

</script>


<script src="../sistema_funcoes/fileUploadImg.js"></script>
<script src="../mod_iep_candidatos/script.js"></script>
<script src="../mod_iep_candidatos/script_empresa.js"></script>




<script>

function empregoEdit(){
	$("#editEmprego").show();
}
function empregoEditFecharAgora (){
    $("#editEmprego").hide();
}

</script>


<link rel="stylesheet" type="text/css" href="../sistema_funcoes/fileUploadImg.css">
<link rel="stylesheet" type="text/css" href="../mod_iep_candidatos/estulos.css">

    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">



<form action="?Codigo=<?php echo $row_list_acao['Codigo']; ?>&conteudo=candidatos-alt"   method="POST" enctype="multipart/form-data" name="acao" id="acao" >

  <div class="col-md-12 col-sm-12 col-xs-12 ">
        <h2>Pessoais</h2>
    </div>
<section id="acaoPrint">
  <?php do { ?>
<div class="col-md-10 col-sm-10 col-xs-12">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Codigo  </label>
        <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="CodigoD" type="text" disabled class="form-control col-md-7 col-xs-12"   placeholder="Codigo" value="<?php echo $Codigo=$row_list_acao['Codigo'];  ?>" title="<?php echo $row_list_acao['Codigo'];  ?>">
          <input name="id_usuario" type="hidden"  >
          <input name="Codigo" type="hidden"   id="Codigo"  value="<?php echo $row_list_acao['Codigo']; ?>">
          <input name="dataHorasInscricao" type="hidden"   id="dataHorasInscricao"  value="<?php  echo converte_data_horas(agoraDataHoras());?>">
          <input name="usuario_nome" type="hidden"   id="usuario_nome" value="<?php echo $_SESSION['MM_Username']; ?>" >
          <input name="res" type="hidden" id="res" value="res" />
          <input type="hidden" name="MM_update" id="MM_update"  value="acao">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nome
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input name="Nome" type="text" required     class="form-control col-md-12 col-xs-12" id="Nome" placeholder="Candidato" style="background-color:#FFFFFF;" autocomplete="off" value="<?php echo convert_utf8($row_list_acao['Nome']); ?>">
        </div>
        

   	</div>     
	<div class="col-md-12 col-sm-12 col-xs-12">
        <label for="heard" class="control-label col-md-1 col-sm-1 col-xs-12" >Objetivo</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="Objetivo"   class="form-control" id="Objetivo">
            <option value="" <?php if (!(strcmp("", $row_list_acao['Objetivo']))) {echo "selected=\"selected\"";} ?>>---</option>
            <?php do { ?>
            <option value="<?php echo convert_utf8($row_list_objetivos['Objetivo'])?>"
			<?php 
			$acaoObjetivo=$row_list_acao['Objetivo'];
			$Objetivo=convert_utf8($row_list_objetivos['Objetivo']);  
			if (!(strcmp($acaoObjetivo, $Objetivo))) {echo "selected=\"selected\"";} ?>><?php echo $Objetivo; ?></option>
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
       <input name="RegistroDataAlterado" type="hidden" disabled class="form-control col-md-2 col-xs-12 mask_date" id="RegistroDataAlterado"   placeholder="Data de Registro" value="<?php echo date(d."/".m."/".Y)?>">

		</div>
     
     
     
     
     
             <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nasc<span class="">imento</span></label>
        <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="DataNascimento" type="text"   class="form-control col-md-7 col-xs-12 mask_date" id="DataNascimento" placeholder="Nascimento" autocomplete="off" 
          value="<?php echo $DataNascimento=converte_data($row_list_acao['DataNascimento']); ?>">
        </div>
        
        <div class="col-md-2 col-sm-2 col-xs-12">
         <input name="DataNascimentoIdade" type="text"   class="form-control col-md-7 col-xs-12" style=" padding:0px 0px; " id="DataNascimentoIdade" placeholder="Idade"
          value="<?php $dataAgora=date(Y."-".m."-".d); echo periodoDataAno($row_list_acao['DataNascimento'],$dataAgora); ?> ">
		</div>
     
     
     
     
     
     
     
     
     
      </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nº Filhos  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
         <select name="NFilhos"   class="form-control" id="NFilhos"  >
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
           <option value="10" <?php if (!(strcmp(10, $row_list_acao['NFilhos']))) {echo "selected=\"selected\"";} ?>>10</option>
          </select>
		</div>        
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Id Filhos
        </label>
        
        
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input name="IdadeFilhos" type="text"     class="form-control col-md-7 col-xs-12" id="IdadeFilhos" placeholder="Filhos" value="<?php echo $row_list_acao['IdadeFilhos']; ?>">
        </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">

         
         
         <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Escolar<span class="">idade</span>  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="Escolaridade"   class="form-control" id="Escolaridade">
            <option value="" <?php if (!(strcmp("", $row_list_acao['Escolaridade']))) {echo "selected=\"selected\"";} ?>>Escolaridade</option>
            <option value="Nunca estudou" <?php if (!(strcmp("Nunca estudou", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Nunca Estudou</option>
            <option value="Primário Incomp." <?php if (!(strcmp("Primário Incomp.", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Primário Incompleto</option>
            <option value="Primário Comp." <?php if (!(strcmp("Primário Comp.", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Primário Completo</option>
            <option value="Fundam. Incomp." <?php if (!(strcmp("Fundam. Incomp.", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Fundamental Incompleto</option>
			<option value="Fundam. Compl." <?php if (!(strcmp("Fundam. Compl.", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Fundamental Completo</option>
            <option value="Fundam. Esdudando" <?php if (!(strcmp("Fundam. Esdudando", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Fundamental Esdudando</option>
            <option value="Médio Incomp." <?php if (!(strcmp("Médio Incomp.", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Médio Incompleto</option>
            <option value="Médio Compl." <?php if (!(strcmp("Médio Compl.",convert_utf8( $row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Médio Completo</option>
            <option value="Superior Incomp" <?php if (!(strcmp("Superior Incomp", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Superior Incompleto</option>
            <option value="Superior Compl" <?php if (!(strcmp("Superior Compl", convert_utf8($row_list_acao['Escolaridade'])))) {echo "selected=\"selected\"";} ?>>Superior completo</option>
          </select>
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado Civil  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="EstadoCivil"   class="form-control" id="EstadoCivil">
            <option value="" <?php if (!(strcmp("", $row_list_acao['EstadoCivil']))) {echo "selected=\"selected\"";} ?>>Estado Civil</option>
            <option value="amasiado" <?php if (!(strcmp("amasiado", convert_utf8($row_list_acao['EstadoCivil'])))) {echo "selected=\"selected\"";} ?>>Amasiado</option>
            <option value="casado" <?php if (!(strcmp("casado", convert_utf8($row_list_acao['EstadoCivil'])))) {echo "selected=\"selected\"";} ?>>Casado</option>
            <option value="divociado" <?php if (!(strcmp("divociado", convert_utf8($row_list_acao['EstadoCivil'])))) {echo "selected=\"selected\"";} ?>>Divociado</option>
            <option value="solteiro" <?php if (!(strcmp("Solteiro",convert_utf8($row_list_acao['EstadoCivil'])))) {echo "selected=\"selected\"";} ?>>Solteiro</option>
			<option value="viuvo" <?php if (!(strcmp("viuvo", convert_utf8($row_list_acao['EstadoCivil'])))) {echo "selected=\"selected\"";} ?>>Viuvo</option>
			<option value="outros" <?php if (!(strcmp("outros", convert_utf8($row_list_acao['EstadoCivil'])))) {echo "selected=\"selected\"";} ?>>Outros</option>
          </select>
		</div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CPF  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="CPF" type="text"     class="form-control col-md-7 col-xs-12 mask_cpf" id="CPF" placeholder="CPF" autocomplete="off" value="<?php echo $row_list_acao['CPF']; ?>">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">RG </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="RG" type="text"   class="mask_rg form-control col-md-7 col-xs-12" id="RG"  placeholder="RG" autocomplete="off" value="<?php echo $row_list_acao['RG']; ?>">
        </div>
         <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CNH </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="CNH" type="text" class="mask_rg form-control col-md-7 col-xs-12" id="CNH"  placeholder="Habilitação" autocomplete="off" value="<?php echo $row_list_acao['CNH']; ?>">
        </div>
        </div>
          
          
    </div> 
        <div class="col-md-2 col-sm-2 col-xs-12">
                         <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview " data-original-title="" title="">
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
				
				
				
			<?php 	
            
				mysql_select_db($database_connection, $connection);
				$query_list_fotos = "SELECT Foto,tipo FROM tbMod_canditadosFotos WHERE codigo ='". $Codigo ."'";
				$list_fotos = mysql_query($query_list_fotos, $connection) or die(mysql_error());
				$row_list_fotos = mysql_fetch_assoc($list_fotos);
				$totalRows_list_fotos = mysql_num_rows($list_fotos);

				if($row_list_fotos['tipo']!=""){

				// echo base64_encode($row_list_fotos['Foto']);	

					echo '<img src="data:' . $row_list_fotos['tipo'] . ';base64,'.base64_encode( $row_list_fotos['Foto'] ).'" class="img-responsive img-thumbnail " alt="Imagem do Cantidato" style="width:auto;height:auto; float:right;"/>';
				}

				mysql_free_result($list_fotos);
				
				?>
				</div> 
				
    </div>
        
               
    <div class="col-md-12 col-sm-12 col-xs-12 " >
        <h2>Endereço</h2>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CEP </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="CEP" type="text"   class="form-control col-md-7 col-xs-12 mask_cep" id="CEP" placeholder="CEP" autocomplete="off" onChange="vereficaCEP('CEP')" value="<?php echo $row_list_acao['CEP']; ?>">
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
      	<button class="options_action_link " title=" LINK " onclick="MM_openBrWindow('http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCepEndereco.cfm','','toolbar=yes,location=yes ,menubar=yes, status=yes, scrollbars=yes, resizable=yes, width=1024,height=768')" type="button"> </button>
      </div>
    </div>
    <span id="loadEndereco">
      <div class="col-md-12 col-sm-12 col-xs-12" >
  
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Endereço  </label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input name="Endereco" type="text"     class="form-control col-md-7 col-xs-12" id="Endereco" placeholder="Endereço" autocomplete="off" value="<?php echo convert_utf8($row_list_acao['Endereco']); ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Numero   </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
      	<input name="Endereco_nro" type="text"   class="form-control col-md-7 col-xs-12" id="Endereco_nro" placeholder="Nº" style=" padding:0px 0px; " autocomplete="off" value="<?php echo convert_utf8($row_list_acao['Endereco_nro']); ?>">
      </div>
      
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bairro   </label>
      <div class="col-md-3 col-sm-3 col-xs-12">
      	<input name="Bairro" type="text"     class="form-control col-md-7 col-xs-12" id="Bairro" placeholder="Bairro" autocomplete="off" value="<?php echo convert_utf8($row_list_acao['Bairro']); ?>">
      </div>
      </div>
      
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input name="Cidade" type="text"     class="form-control col-md-7 col-xs-12" id="Cidade" placeholder="Cidade" autocomplete="off" value="<?php echo convert_utf8($row_list_acao['Cidade']); ?>">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
        	<input name="Estado" type="text"     class="form-control col-md-7 col-xs-12" id="Estado" placeholder="Estado" autocomplete="off"  value="<?php echo convert_utf8($row_list_acao['Estado']); ?>">
        	<input name="end_cPais" type="hidden" id="end_cPais" value="">
        	<input name="end_xPais" type="hidden" id="end_xPais" value="">
        </div>
       <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Compl.  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<input name="Complemento" type="text"     class="form-control col-md-7 col-xs-12" id="Complemento" placeholder="Complemento" autocomplete="off"  value="<?php echo convert_utf8($row_list_acao['Complemento']); ?>">
        </div>
    </div>

	</span>
       <div class="col-md-12 col-sm-12 col-xs-12 ">
        <h2>Contato</h2>
    </div>
	
	

	
	
	
	    <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Celular  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
         <?php echo $row_list_acao['Telefone1']; ?>
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Celular  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <?php echo $row_list_acao['Telefone2']; ?>
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Telefone  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <?php echo $row_list_acao['Telefone3']; ?>
      </div>

   </div>
	
	
	
	
	 <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone1" type="text"  <?php if($row_list_acao['Telefone1']!=''){ echo 'required="required"';} ?>  class=" mask_cel form-control col-md-7 col-xs-12 " id="Telefone1" placeholder="Celular 1" autocomplete="off" value="<?php echo $row_list_acao['Telefone1']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone2" type="text" <?php if($row_list_acao['Telefone2']!='') {echo 'required="required"';} ?> class=" mask_cel form-control col-md-7 col-xs-12 " id="Telefone2" placeholder="Celular 2" autocomplete="off" value="<?php echo $row_list_acao['Telefone2']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone3" type="text" class="mask_fone form-control col-md-7 col-xs-12 " <?php   if($row_list_acao['Telefone3']!='') {echo 'required="required"';} ?> id="Telefone3" placeholder="Telefone " autocomplete="off" value="<?php echo $row_list_acao['Telefone3']; ?>">
      </div>

   </div>
	
	
	
	
	
	
	
	
   <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">e-mail  </label>
      <div class="col-md-5 col-sm-5 col-xs-12">
      	<input name="EMail" type="text" class="form-control col-md-7 col-xs-12" id="EMail" placeholder="e-mail" autocomplete="off" value="<?php echo $row_list_acao['EMail']; ?>">
      </div>
   </div>
   
   <div class="col-md-12 col-sm-12 col-xs-12"> 
   <input name="IdEmprego" type="hidden" id="IdEmprego" value="<?php echo convert_utf8($row_list_acao_emprego['IdEmprego']); ?>">
      <div class="col-md-12 col-sm-12 col-xs-12 " ><h2> Empresa</h2></div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12 " for="first-name">Empresa </label>
        <div class="col-md-4 col-sm-4 col-xs-12 ">
        <input name="EmpregoEmpresa" type="text"    class="form-control col-md-7 col-xs-12" id="EmpregoEmpresa" placeholder="Empresa" value="<?php echo convert_utf8($row_list_acao_emprego['EmpregoEmpresa']); ?>">
        <input name="DataRegistroEmp" type="hidden" id="DataRegistroEmp">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12 " for="first-name">Cargo  </label>
        <div class="col-md-2 col-sm-2 col-xs-12 ">
        <input name="EmpregoCargo" type="text"    class="form-control col-md-7 col-xs-12" id="EmpregoCargo"   placeholder="Cargo" value="<?php echo convert_utf8($row_list_acao_emprego['EmpregoCargo']); ?>">
        </div>

      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Motivo  </label>
      <div class="col-md-3 col-sm-3 col-xs-12">
          <input name="EmpregoMotivoSaida" type="text"      class="form-control col-md-7 col-xs-12 " id="EmpregoMotivoSaida" placeholder="Motivo da saída" value="<?php echo $row_list_acao_emprego['EmpregoMotivoSaida']; ?>">
      </div>


        
      
        
        
        
    </div> 
      <div class="col-md-12 col-sm-12 col-xs-12 ">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="EmpregoCidade" type="text"      class="form-control col-md-7 col-xs-12 " id="EmpregoCidade" placeholder="Cidade/UF" value="<?php echo $row_list_acao_emprego['EmpregoCidade']; ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">D.Entrada  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="EmpregoDataEntreda" type="text"  class="form-control col-md-7 col-xs-12 mask_date" id="EmpregoDataEntreda" placeholder="EmpregoDataEntreda" value="<?php echo converte_data($row_list_acao_emprego['EmpregoDataEntreda']); ?>">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12 " for="first-name">D. Saída  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="EmpregoDataSaida" type="text"  class="form-control col-md-7 col-xs-12 mask_date" id="EmpregoDataSaida" placeholder="EmpregoDataSaida" value="<?php echo converte_data($row_list_acao_emprego['EmpregoDataSaida']); ?>">

      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <a class="btn btn-default " id="empregoEdit" onClick="empregoEdit()">
              <i class="fa fa-edit"></i> Outros
        </a>
      </div>
 <div id="editEmprego">
        <?php  include ("../mod_iep_candidatos/emprego_acao_edit.php");?>
        </div>
   </div>
         
        
        <div class="col-md-12 col-sm-12 col-xs-12 ">
        	<h2>Observações</h2>
    	</div>
        
          <div class="col-md-12 col-sm-12 col-xs-12 " style="margin:5px;">
          
          
          <label>
            <input <?php if (!(strcmp($row_list_acao['FaseProva'],1))) {echo "checked=\"checked\"";} ?> name="FaseProva" type="checkbox" class="flat iCheck-helper" id="FaseProva" value="1"  /> Prova
          </label>
          <label>
            <input name="FaseEntrevista"  <?php if (!(strcmp($row_list_acao['FaseEntrevista'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" class="flat" id="FaseEntrevista" value="1" /> 
             
            Entrevista
          </label>
          <label>
            <input name="FaseTreinamento"  <?php if (!(strcmp($row_list_acao['FaseTreinamento'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" class="flat" id="FaseTreinamento" value="1" /> Treinamento
          </label>
          <label>
            <input name="FaseExIEP" class="flat" id="FaseExIEP" value="1"  <?php if (!(strcmp($row_list_acao['FaseExIEP'],1))) {echo "checked=\"checked\"";} ?> type="checkbox"  /> Ex IEP
          </label>
          <div id="loadDiv"></div>  
        </div>
      

        

     <div class="col-md-12 col-sm-12 col-xs-12 " >     
        <table width="100%" class="table table-hover ">
          <thead>
            <tr class="PrintTexto">
              <th width="10%">Data</th>
              <th width="12%">Usuario</th>
              <th width="66%">Observação</th>
              <th width="12%" align="right">             
              <button class="options_action_add_sec " title=" ADICIONAR " id="descricaoAdd" type="button"> </button>
              </th>
            </tr>
          </thead>
        </table>
        
        <div class="col-md-12 col-sm-12 col-xs-12 overflow" style="background-color:#FFFFFF" >
	  <table width="100%" class="table table-hover" id="tableDesc">
                      <tbody>
  
						<?php do { ?>
                        <tr class="PrintTexto">
                          <th><?php echo converte_data_horas($row_list_acao_observacao['DataRegistroObs']); ?></th>
                          <td><?php $id_usuario= $row_list_acao_observacao['id_usuario']; include "../sistema_usuario/list_usuario.php"; ?> <?php  echo $row_list_acao_usuario['nome']; ?></td>
                          <td class="PrintTextoM"><?php echo convert_utf8($row_list_acao_observacao['Observacoes']); ?></td>
                          <td></td>
                        </tr>
						<?php } while ($row_list_acao_observacao = mysql_fetch_assoc($list_acao_observacao)); ?>
                      </tbody>
          </table>

        </div>  
    </div>
           <div class="col-md-12 col-sm-12 col-xs-12"><br><br>

      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Data/ Registo  </label>
      <div class="col-md-3 col-sm-3 col-xs-12">
      	<input name="info1" type="text" disabled class="form-control col-md-7 col-xs-12" id="info1" placeholder="usuario" value="<?php echo converte_data_horas($row_list_acao['RegistroData']);?> ">
      </div>
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Data/ Atualização  </label>
      <div class="col-md-3 col-sm-3 col-xs-12">
      	<input name="info2" type="text" disabled class="form-control col-md-7 col-xs-12" id="info2" placeholder="Ultimo Registro " value="<?php echo converte_data_horas($row_list_acao['RegistroDataAlterado']); ?>">
      </div>
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Último Usuário  </label>
      <div class="col-md-3 col-sm-3 col-xs-12">
      	<input name="info1" type="text" disabled class="form-control col-md-7 col-xs-12" id="info1" placeholder="usuario" value="<?php $id_usuario= $row_list_acao['id_usuario']; include "../sistema_usuario/list_usuario.php"; ?> <?php  echo $row_list_acao_usuario['nome']; ?>">
      </div>
      
   </div>
        
        
      <?php } while ($row_list_acao = mysql_fetch_assoc($list_acao)); ?>

</section>   
<div class="btn-group">
<br><br><br>
	<button type="button"  id="form_bt_voltar" class="btn btn-default" onclick="MM_goToURL('parent','?conteudo=candidatos&Objetivo=<?php echo $_GET['Objetivo'];?>&xBairro=<?php echo $_GET['xBairro'];?>&pageNumList_list_acao=<?php echo $_GET['pageNumList_list_acao'];?>');return document.MM_returnValue"><i class="fa fa-chevron-left"></i> Voltar</button>
    <button type="button" id="hrefPrint" class="btn btn-warning"  onClick="MM_openBrWindow('../mod_iep_candidatos/acao_print.php?Codigo=<?php echo $Codigo;  ?>','','toolbar=yes,location=yes ,menubar=yes, status=yes, scrollbars=yes, resizable=yes, width=730,height=500')"><i class="fa fa-print"></i> Imprimir</button>

    <button type="button" 
onClick="loadsDataFormFile('#PesquisaAvancadaLoad','../mod_iep_candidatos/fotos_acao_add_get.php','#acao','&Codigo=<?php echo $Codigo;  ?>&conteudo=candidatos&Objetivo=<?php echo $_GET['Objetivo'];?>&xBairro=<?php echo $_GET['xBairro'];?>','','../mod_iep_candidatos/acao_alt_load.php')"
 class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar &nbsp;&nbsp;&nbsp;&nbsp;</button>
 
    <button type="button" class="btn btn-primary" onClick="loadsData('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_add_load.php')" ><i class="fa fa-file-text-o"></i> Novo</button>
    <button type="button" class="btn btn-danger" onClick="MM_goToURL('parent','?<?php echo $id_sistema; ?>=<?php echo $_GET['Codigo']; ?>&amp;conteudo=<?php echo "$conteudo_inf"; ?>-exc');return document.MM_returnValue"><i class="fa fa-times"></i> Apagar</button>

</div>

<div id="formmsn"></div>


 <!--loadsDataForm('#PesquisaAvancadaLoad','../mod_iep_candidatos/acao_alt_load.php','#acao','&Codigo=<?php echo $Codigo;  ?>&conteudo=candidatos&Objetivo=<?php echo $_GET['Objetivo'];?>&xBairro=<?php echo $_GET['xBairro'];?>') -->
  
</form> 

 <div id="reportarLoadForm"></div>
    
    
<!-- iCheck -->    
<script>
    function pageLoad(sender, args) { $(document).ready(function () { $('.iCheck-helper').on('click', function (event) { var mapper = $(this).siblings().find('input[type=radio]'); $('#' + $(mapper.prevObject).attr('id')).trigger("click"); }); }); }
 </script>



  <?php if ($_POST['res']=='res'){include "../sistema/res_alt_load.php";}?>
  <?php
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
	mysql_free_result($list_select);
  }
  mysql_free_result($list_objetivos);

mysql_free_result($list_acao);

mysql_free_result($list_acao_observacao);

mysql_free_result($list_acao_emprego);


//mysql_free_result($list_foto);
?>

  