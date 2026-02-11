<?php $seguranca_externa=21;
// $usuario=$_GET['usuario'];?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
  //ativo=021;
 
}

// ** Logout the current user. **
// ** Sair do usuário atual. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  //para sair completamente um visitante que precisamos para limpar a sessão varialbles

  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['LOCAL']);
	
  $logoutGoTo = "../sistema_usuario/login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../sistema_usuario/login.php?erro=3";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
//INICIANDO SISTEMA DE MANEJO DE ANIMAIS
if(isset($_GET['local'])){
 $_SESSION['LOCAL']=$_GET['local'];
}


if ($row_perfusuario['ativado']==2){
	include "sem_permissao.php";
	exit;
	}
?>
<?php $id_session=$_SESSION['MM_UserGroup']; ?>
<?php  include "../sistema_funcoes/cabecalho.php"; ?>
<?php // include"../sistema_funcoes/perfcliente.php";?>

<link href="../sistema_bootstrap/bootstrap.css" rel="stylesheet">
    <link href="../sistema_bootstrap/simple-sidebar.css" rel="stylesheet">
    <link href="../sistema_bootstrap/font-awesome.css" rel="stylesheet">
<?php  include"../sistema_funcoes/perfusuario.php"; ?>

<?php  include "include_url.php"; ?>


    
    
    
    <script src="../sistema/ckeditor/ckeditor.js"></script>
<link href="../sistema_jquery/css/<?php echo $row_perfusuario['cor_jqueryui_custom']; ?>" rel="stylesheet">
<script src="../sistema_jquery/js/jquery-1.9.1.js"></script>
<script src="../sistema_jquery/js/jquery-ui-1.10.3.custom.js"></script>
<script src='../sistema_jquery/spectrum.js'></script>
<link  href='../sistema_jquery/spectrum.css' rel='stylesheet' />
<script src="../sistema_funcoes/jq_mascaras.js"></script>
<script src="../sistema_funcoes/jq_maskmoney.js"></script>
<script src="../sistema_funcoes/includeJs.js"></script>
<script src="../sistema_funcoes/js_mods.js"></script>
    
    

</head>





<body style="padding-top: 52px">
    <nav class="navbar navbar-default  navbar-fixed-top" id="barh">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand ">
                
                    <button type="button" class="navbar-toggle " data-toggle="collapse" id="menu-toggle">
                      <span class="fa fa-bars" ></span>
                    </button>
                    
                  <a class="navbar-brand" href="#"><i class="fa fa-rocket fa-4"></i> <?php echo $row_perfusuario['tratamento']; ?> <?php echo $row_perfusuario['nome']; ?></a>  
                  <div class="user"><?php echo $row_perfusuario['tratamento']; ?> <?php echo $row_perfusuario['nome']; ?></div>     
                </div><!-- navbar-header-->

                <div class="collapse navbar-collapse" id="">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2">
                                <div class="fa fa-bars"></div>
                                 </button>
                                 </li>
                            </ul>
                <!-- bs-example-navbar-collapse-1 -->
          </div>
    </nav>
    <div class="toggled" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">

                <li class="active">
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-dashboard fa-stack-1x "></i></span> Painel</a>
                       <ul class="nav-pills nav-stacked" style="list-style-type: none; display: none;">
                        <li><a href="?startmod=&conteudo=inicio&local=selec">Inicio</a></li>
                        <li><a href="?startmod=usuario_aparencia&conteudo=uap">Aparência</a></li>
                        <li><a href="?startmod=setor&conteudo=usu_setor">Setor</a></li>
                        <li><a href="?startmod=usuario&conteudo=uu">Perfil do usuario</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span> Cadas. Jurídico/Físico</a>
                    <ul class="nav-pills nav-stacked" style="list-style-type: none; display: none;">
                        <li><a href="?startmod=empresa_clientes&conteudo=clien">Cliente</a></li>
                        <li><a href="#">link2</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-cubes fa-stack-1x "></i></span> Cadas. Produtos/Serviços</a>
                    <ul class="nav-pills nav-stacked" style="list-style-type: none; display: none;">
                        <li><a href="?startmod=empresa_clientes&conteudo=clien">Cliente</a></li>
                        <li><a href="#">link2</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-dollar fa-stack-1x "></i></span>Financeiro</a>
                         <ul class="nav-pills nav-stacked" style="list-style-type: none; display: none;">
                        	<li><a href="?startmod=vendas&conteudo=vendas">Pedido de Vendas</a></li>
                                <li> <a href="?startmod=areceber&conteudo=areceber">À Receber</a> </li>
                        <li><a href="#">link2</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-cart-plus fa-stack-1x "></i></span>Events</a>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-youtube-play fa-stack-1x "></i></span>About</a>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-wrench fa-stack-1x "></i></span>Services</a>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-server fa-stack-1x "></i></span>Contact</a>
                </li>
            </ul>
        </div><!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="wrappe-content">
                          <?php
		//echo $SESSION_FAZENDA= $_SESSION['FAZENDA'];
		//echo  $_SESSION['startmod'];
		//echo $modulo_local;
		// recebe a variavel do arquivo ../sistem/includ_url.php
		
		if($modulo_local==''){echo "<br><br>Opção não encontrada!<br><br><br>";}else{
		
		 include $modulo_local;
		 }
		  ?>
          

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
<script src="../sistema_bootstrap/bootstrap.js"></script>
<script src="../sistema_bootstrap/sidebar_menu.js"></script>  

    







</body></html>