
<div class="x_title">
<h2><img src="<?php echo "$icons_sistema_nome"; ?>"  />&nbsp;&nbsp;  <?php echo "$sistema_nome"; ?>&nbsp;&nbsp;<?php 
if(isset($acao_icons)){
	 echo '<img src="'.$local_icons.$acao_icons.'" width="30" height="30"  />'.$acao_comum; }?>
</h2>
<ul class="nav navbar-right panel_toolbox">
  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#">Settings 1</a>
      </li>
      <li><a href="#">Settings 2</a>
      </li>
    </ul>
  </li>
  <li><a class="close-link"><i class="fa fa-close"></i></a>
  </li>
</ul>
<div class="clearfix"></div>
</div>
<?php

if(isset($msn)){
	 echo $msn; }?>
