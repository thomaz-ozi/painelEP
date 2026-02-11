<?php require_once('../Connections/connection.php'); ?>
<?php include ("../sistema_funcoes/converter_utf8.php");?>
<?php include ("../sistema_funcoes/masc_clear_cep.php");?>
<?php require_once ("../sistema_funcoes/masc_clear_cpf_rg_cnh.php");?>

<?php
require_once ("../sistema_funcoes/agoraDataHoras.php");
include "../sistema_funcoes/converte_datas_horas.php";
require_once ("../sistema_funcoes/converte_datas.php");
 
	if (!isset($_SESSION)) {
  session_start();
 }
	$_POST['id_usuario']= $_SESSION['MM_UserGroup'];
	
	$_POST['RegistroData']=agoraDataHoras();
	$_POST['RegistroDataFotos']=agoraDataHoras();
	$_POST['RegistroDataAlterado']=agoraDataHoras();
	
	
    $_POST['CEP']=masc_clear_cpf($_POST['CEP']);
	$_POST['CPF']=masc_clear_cpf($_POST['CPF']);
    $_POST['RG']=masc_clear_rg($_POST['RG']);
    $_POST['CNH']=masc_clear_cnh($_POST['CNH']);
				   	
	
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
echo $insertSQL = sprintf("INSERT INTO tbMod_canditados (Codigo, Nome, DataNascimento, Objetivo, NFilhos, IdadeFilhos, Escolaridade, EstadoCivil, Endereco, Endereco_nro, Complemento, Bairro, Cidade, Estado, CEP, Telefone1, Telefone2, Telefone3, EMail, CPF, RG, CNH, FaseProva, FaseEntrevista, FaseTreinamento, FaseExIEP, RegistroData, id_usuario, RegistroDataAlterado) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Codigo'], "int"),
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
                       GetSQLValueString($_POST['RegistroData'], "date"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['RegistroDataAlterado'], "date"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
  
/*carrega o último registro*/
mysql_select_db($database_connection, $connection);
$query_list_acao = "SELECT Codigo, Nome FROM tbMod_canditados ORDER BY Codigo DESC";
$list_acao = mysql_query($query_list_acao, $connection) or die(mysql_error());
$row_list_acao = mysql_fetch_assoc($list_acao);
$totalRows_list_acao = mysql_num_rows($list_acao);


$_POST['Codigo']=$row_list_acao['Codigo'];

include ("../mod_iep_candidatos/acao_comum_emprego_add.php");
include ("../mod_iep_candidatos/acao_comum_obser_add.php");
include ("../mod_iep_candidatos/fotos_acao_add.php");



}
/*if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {
 $insertSQL = sprintf("INSERT INTO tbMod_canditadosFotos (Codigo, Foto, id_usuario, DataRegistroFotos) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($row_list_acao['Codigo'], "int"),
                       GetSQLValueString($_POST['foto'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"),
                       GetSQLValueString($_POST['DataRegistroFotos'], "date"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}*/
/*	
echo 	$_POST['CEP'];	
echo 	$_POST['Endereco'];
echo 	$_POST['Bairro'];
echo 	$_POST['Observacoes'];
*/

mysql_select_db($database_connection, $connection);
$query_list_objetivos = "SELECT * FROM tbMod_canditadosObjet ORDER BY Objetivo ASC";
$list_objetivos = mysql_query($query_list_objetivos, $connection) or die(mysql_error());
$row_list_objetivos = mysql_fetch_assoc($list_objetivos);
$totalRows_list_objetivos = mysql_num_rows($list_objetivos);

 ?>

<link rel="stylesheet" type="text/css" href="../sistema_funcoes/fileUploadImg.css">
<style>.overflowY{height:160px; margin-top:-20px;  overflow-x: hidden; overflow-y: scroll; border:#BCBCBC solid 1px; } #editEmprego{ display:none;}</style>

 <script>
$(function(){
	$(".mask_date_ma").mask("99/99/9999");



//----------------------------> DATA
$('#DataNascimento').change(function(){
	var data = $(this).val();
	var ano = data.slice(6, 10);
	var mes = data.slice(3, 5);
	var dia = data.slice(0, 2);
	var idade=calculoIdade(ano, mes, dia);
	$("#DataNascimentoIdade").val(idade);
});


	});

</script>
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
   $(".mask_cnpj").mask("99.999.999/9999-99");
   $(".mask_cep").mask("99999-999");
	});

</script>
<script src="../sistema_funcoes/fileUploadImg.js"></script>

<script src="../mod_iep_candidatos/script_descricao.js"></script>
<script src="../mod_iep_candidatos/script_empresa.js"></script>
<script src="../mod_iep_candidatos/script.js"></script>

<form  action="" id="acao" name="acao"  method="POST" enctype="multipart/form-data" >
   <div class="col-md-12 col-sm-12 col-xs-12">
        <h2>Pessoais</h2>
    </div>
<section id="acaoPrint">
<div class="col-md-10 col-sm-10 col-xs-12">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Codigo  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
          <input name="Codigo" type="text" disabled="disabled"  class="form-control col-md-7 col-xs-12"   placeholder="Codigo">
          <input name="id_usuario" type="hidden"  >
          <input name="usuario_nome" type="hidden"  id="usuario_nome" value="<?php echo $row_perfusuario['nome'];?>" >
          <input name="dataHorasInscricao" type="hidden"   id="dataHorasInscricao"  value="<?php  echo converte_data_horas(agoraDataHoras());?>">
          	        <input name="res" type="hidden" id="res" value="res" />

        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nome <span class="">*</span>
        </label>
        <div class="col-md-5 col-sm-5 col-xs-12">
          <input name="Nome" type="text"    class="form-control col-md-7 col-xs-12" id="Nome" placeholder="Candidato" value="">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nascimento
        </label>
        <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="DataNascimento" type="text"  class="form-control col-md-7 col-xs-12 mask_date" id="DataNascimento" placeholder="Nascimento" value="">
        </div>
        
        <div class="col-md-1 col-sm-1 col-xs-12">
         <input name="DataNascimentoIdade" type="text"  class="form-control col-md-7 col-xs-12" id="DataNascimentoIdade" placeholder="Idade">
		</div>
   	</div>     
	<div class="col-md-12 col-sm-12 col-xs-12">
        <label for="heard" class="control-label col-md-1 col-sm-1 col-xs-12" >Objetivo</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="Objetivo"  class="form-control" id="Objetivo">
            <option value="">---</option>
            <?php do {  ?>
            
            <option value="<?php echo convert_utf8($row_list_objetivos['Objetivo'])?>"><?php echo convert_utf8($row_list_objetivos['Objetivo'])?></option>
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
                   <input name="DataRegistro" type="text" disabled class="form-control col-md-2 col-xs-12 mask_date" id="DataRegistro"   placeholder="Data de Registro" value="<?php echo date(d."/".m."/".Y)?>">
                   <input name="DataRegistroAlterado" type="hidden" disabled class="form-control col-md-2 col-xs-12 mask_date" id="DataRegistroAlterado"   placeholder="Data de Registro" value="<?php echo date(d."/".m."/".Y)?>">

		</div>
     
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nº Filhos  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
         <select name="NFilhos"  class="form-control" id="NFilhos" style=" padding:0px 0px;">
         	<option value="">---</option>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
		</div>        
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Id Filhos <span class="">*</span>
        </label>
        
        
        <div class="col-md-4 col-sm-4 col-xs-12">
          <input name="IdadeFilhos" type="text"    class="form-control col-md-7 col-xs-12" id="IdadeFilhos" placeholder="Filhos">
        </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">

         
         
         <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Escolaridade  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="Escolaridade"  class="form-control" id="Escolaridade">
         
            
             <option value="" >Escolaridade</option>
            <option value="Nunca estudou" >Nunca Estudou</option>
            <option value="Primário Incomp." >Primário Incompleto</option>
            <option value="Primário Comp." >Primário Completo</option>
            <option value="Fundam. Incomp." >Fundamental Incompleto</option>
			<option value="Fundam. Compl." >Fundamental Completo</option>
            <option value="Fundam. Esdudando" >Fundamental Estudando</option>
            <option value="Médio Incomp." >Médio Incompleto</option>
            <option value="Médio Compl." >Médio Completo</option>
            <option value="Superior Incomp" >Superior Incompleto</option>
            <option value="Superior Compl" >Superior completo</option>

            
            
            
          </select>
		</div>
		<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado Civil  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select name="EstadoCivil"  class="form-control" id="EstadoCivil">
            <option value="">Estado Civil</option>
            <option value="amasiado">Amasiado</option>
            <option value="casado">casado</option>
            <option value="divociado">Divociado</option>
            <option value="Solteiro">Solteiro</option>
            <option value="viuvo">Viuvo</option>
            <option value="outros">Outros</option>
          </select>
		</div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CPF  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="CPF" type="text"    class="form-control col-md-7 col-xs-12 mask_cpf" id="CPF" placeholder="CPF" value="<?php echo $_POST['acaoCPF'] ?>">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">RG </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="RG" id="RG" type="text"  class="mask_rg form-control col-md-7 col-xs-12"  placeholder="RG">
        </div>
         <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CNH </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="CNH" id="CNH" type="text" class="mask_rg form-control col-md-7 col-xs-12"  placeholder="Habilitação">
        </div>
        </div>
          
          
        </div> 
        <div class="col-md-2 col-sm-2 col-xs-12">
                         <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview" data-original-title="" title="">
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
   </div>
        
       <div class="col-md-12 col-sm-12 col-xs-12 " >
        <h2>Endereço</h2>
    </div>            

    <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CEP  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <input type="text" id="CEP" name="CEP"  class="form-control col-md-7 col-xs-12 mask_cep" onChange="vereficaCEP('CEP')" placeholder="CEP">
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
      	<button class="options_action_link" title=" LINK " onclick="MM_openBrWindow('http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCepEndereco.cfm','','toolbar=yes,location=yes ,menubar=yes, status=yes, scrollbars=yes, resizable=yes, width=1024,height=768')" type="button"> </button>
      </div>
    </div>
    <span id="loadEndereco">
      <div class="col-md-12 col-sm-12 col-xs-12" >
  
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Endereço  </label>
      <div class="col-md-4 col-sm-4 col-xs-12">
      	<input name="Endereco" type="text"    class="form-control col-md-7 col-xs-12" id="Endereco" placeholder="Endereço" value="">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Numero   </label>
      <div class="col-md-1 col-sm-1 col-xs-12">
      	<input type="text" id="end_nro" name="end_nro"  class="form-control col-md-7 col-xs-12" placeholder="Nº" value="">
      </div>
      
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bairro   </label>
      <div class="col-md-3 col-sm-3 col-xs-12">
      	<input name="Bairro" type="text"    class="form-control col-md-7 col-xs-12" id="Bairro" placeholder="Bairro" value="">
      </div>
      </div>
      
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <input name="Cidade" type="text"    class="form-control col-md-7 col-xs-12" id="Cidade" placeholder="Cidade" value="">
        </div>
        
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Estado  </label>
        <div class="col-md-1 col-sm-1 col-xs-12">
        	<input name="Estado" type="text"    class="form-control col-md-7 col-xs-12" id="Estado" placeholder="Estado"  value="">
        	<input name="end_cPais" type="hidden" id="end_cPais" value="">
        	<input name="end_xPais" type="hidden" id="end_xPais" value="">
        </div>
         <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Compl.  </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        	<input name="Complemento" type="text"     class="form-control col-md-7 col-xs-12" id="Complemento" placeholder="Complemento" autocomplete="off"  value="">
        </div>
    </div>

	</span>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h2>Contato</h2>
    </div>  
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Celular  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone1" type="text"    class="mask_cel form-control col-md-7 col-xs-12 " id="Telefone1" placeholder="Telefone 1">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Celular  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone2" type="text" class="mask_cel form-control col-md-7 col-xs-12 " id="Telefone2" placeholder="Telefone 2">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Telefone outro   </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="Telefone3" type="text" class="mask_fone form-control col-md-7 col-xs-12 " id="Telefone3" placeholder="Telefone 3">
      </div>
   </div>
   <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">e-mail  </label>
      <div class="col-md-5 col-sm-5 col-xs-12">
      	<input name="EMail" type="text" class="form-control col-md-7 col-xs-12" id="EMail" placeholder="e-mail">
      </div>
   </div>
   
   
   
	<div class="col-md-12 col-sm-12 col-xs-12">
	  <h2> Empresa</h2></div>
   	<div class="col-md-12 col-sm-12 col-xs-12"> 
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Empresa </label>
        <div class="col-md-4 col-sm-4 col-xs-12">
        <input name="EmpregoEmpresa_insert[]" type="text"  class="form-control col-md-7 col-xs-12" id="EmpregoEmpresa_insert" placeholder="Empresa">
        <input name="DataRegistroEmp" type="hidden" id="DataRegistroEmp">
        </div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cargo  </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
        <input name="EmpregoCargo_insert[]" type="text"  class="form-control col-md-7 col-xs-12" id="EmpregoCargo_insert"   placeholder="Cargo">
        </div>
        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Motivo  </label>
      	<div class="col-md-2 col-sm-2 col-xs-12">
          <input name="EmpregoMotivoSaida_insert[]" type="text" class="form-control col-md-7 col-xs-12 " id="EmpregoMotivoSaida_insert" placeholder="Motivo da saída" value="">
      	</div>

        
      
    </div> 
        <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input name="EmpregoCidade_insert[]" type="text"    class="form-control col-md-7 col-xs-12 " id="EmpregoCidade_insert" placeholder="Cidade/UF" value="">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">D.Entrada</label>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="EmpregoDataEntreda_insert[]" type="text" class="form-control col-md-7 col-xs-12 mask_date" id="EmpregoDataEntreda_insert" placeholder="EmpregoDataEntreda" value="">
      </div>
      
      <label class="control-label col-md-1 col-sm-1 col-xs-12 " for="first-name">D. Saída  </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
        <input name="EmpregoDataSaida_insert[]" type="text" class="form-control col-md-7 col-xs-12 mask_date" id="EmpregoDataSaida_insert" placeholder="EmpregoDataSaida" value="">
      </div>
	   <div class="col-md-2 col-sm-2 col-xs-12">
         <a class="btn btn-default " id="empregoEdit" onClick="empregoEdit()">
              <i class="fa fa-edit"></i> Outros
         </a>
       </div>	        
          <div id="editEmprego" >
        <?php  include ("../mod_iep_candidatos/emprego_acao_edit.php");?>
        </div>

   </div>
        
        
        
         <div class="col-md-12 col-sm-12 col-xs-12">
        	<h2>Observações</h2>
    	</div>       
        
          <div class="col-md-12 col-sm-12 col-xs-12" style="margin:5px;">
          <label>
            <input name="FaseProva" type="checkbox" class="flat" id="FaseProva" value="1"   /> Prova
          </label>
          <label>
            <input name="FaseEntrevista" type="checkbox" class="flat" id="FaseEntrevista" value="1"  /> Entrevista
          </label>
          <label>
            <input name="FaseTreinamento" type="checkbox" class="flat" id="FaseTreinamento" value="1"  /> Treinamento
          </label>
          <label>
            <input name="FaseExIEP" type="checkbox" class="flat" id="FaseExIEP" value="1"  /> Ex IEP
          </label>
          <div id="loadDiv"></div>  
        </div>

        <table width="100%" class="table table-hover">
          <thead>
            <tr>
              <th width="15%">Data</th>
              <th width="12%">Usuario</th>
              <th width="61%">Observação</th>
              <th width="12%" align="right">             
              <button class="options_action_add_sec oculPrint" title=" ADICIONAR " id="descricaoAdd" type="button"> </button>
              </th>
            </tr>
            
            
           
            
          </thead>
        </table>
        <div class="col-md-12 col-sm-12 col-xs-12 overflowY" style="background-color:#FFFFFF;" >
	  <table width="100%" class="table table-hover" id="tableDesc">
                      <tbody >
                        <tr>
                          <th width="15%" ></th>
                          <td width="12%"></td>
                          <td width="64%"></td>
                          <td width="9%" ></td>
                        </tr>
                         <tr id="tableTr1" scope="row"><td align="left">&nbsp;<?php echo converte_data_horas(agoraDataHoras());?></td><td align="left">&nbsp; <?php $id_usuario= $_POST['id_usuario']; include "../sistema_usuario/list_usuario.php"; ?> <?php  echo $row_list_acao_usuario['nome']; ?></td><td align="left"> <textarea name="Observacoes[]" rows="1" required class="form-control col-md-7 col-xs-12 Observacoes" id="Observacoes1" style="height:80px;">&nbsp;</textarea></td><td align="right"></td></tr>
                      </tbody>
          </table>
        
        </div>  
        
        
        
        
    
</section>   
      <div class="col-md-12 col-sm-12 col-xs-12 btn-group"><br><br><br>
        	<button type="button"  id="form_bt_voltar" class="btn btn-default" onclick="MM_goToURL('parent','?conteudo=candidatos&Objetivo=<?php echo $_GET['Objetivo'];?>&xBairro=<?php echo $_GET['xBairro'];?>&pageNumList_list_acao=<?php echo $_GET['pageNumList_list_acao'];?>');return document.MM_returnValue"><i class="fa fa-chevron-left"></i> Voltar</button>
        <button type="button" class="btn btn-primary"  onClick="MM_goToURL('parent','?conteudo=candidatos-alt');return document.MM_returnValue" ><i class="fa fa-file-text-o"></i> Alterar</button>
       
    <button type="button" onClick="loadsDataFormFile('#PesquisaAvancadaLoad','../mod_iep_candidatos/fotos_acao_add_load.php','#acao','&Codigo=<?php echo $Codigo;  ?>','','../mod_iep_candidatos/acao_add_load.php')"
 class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i> Salvar &nbsp;&nbsp;&nbsp;&nbsp;</button>
 

        
      	<input type="hidden" name="MM_insert" value="acao">

  </div>

</form> 



<div id="reportarLoadForm"></div>
<!-- iCheck -->    
<script>
    function pageLoad(sender, args) { $(document).ready(function () { $('.iCheck-helper').on('click', function (event) { var mapper = $(this).siblings().find('input[type=radio]'); $('#' + $(mapper.prevObject).attr('id')).trigger("click"); }); }); }
 </script>
 <script src="../vendors/iCheck/icheck.min.js"></script>
<script src="../sistema_funcoes/jq_ifChecked.js"></script>


  <?php if ($_POST['res']=='res'){
	  echo "../mod_iep_candidatos/res_add.php";
	  include "../mod_iep_candidatos/res_add.php";}?>
  <?php
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "acao")) {

mysql_free_result($list_acao);


  }mysql_free_result($list_objetivos);
?>


