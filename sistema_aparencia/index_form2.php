
    
<br>
<br>

//---------------------------------------> ADORDEÃO <-------------------------------------------//
<br>

<div class="accordion">
  <h3>Section 1</h3>
  <div>
    <p>Mauris mauris ante, blandit et, ultrices a, susceros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>
  </div>
  <h3>Section 2</h3>
  <div>
    <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>
  </div>
  <h3>Section 3</h3>
  <div>
    <p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>
    <ul>
      <li>List item</li>
      <li>List item</li>
      <li>List item</li>
      <li>List item</li>
      <li>List item</li>
      <li>List item</li>
      <li>List item</li>
    </ul>
  </div>
</div>

<br>
<br>

//---------------------------------------> ABAS <-------------------------------------------//
<br>

//----------------> ABA SIMPLES


<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />


<div id="TabbedPanels1" class="TabbedPanels">
    <ul class="TabbedPanelsTabGroup">
      <li class="TabbedPanelsTab" tabindex="0"><div class="txt">ABA 01 </div></li>
      <li class="TabbedPanelsTab" tabindex="0"><div class="txt">ABA 02  </div></li>
    </ul>
    <div class="TabbedPanelsContentGroup">
       <div class="TabbedPanelsContent">TESTE 01</div>
       <div class="TabbedPanelsContent">TESTE 02</div>
    </div>
</div>

<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
<div style="clear:both;"></div>
<br>
<br>
<br>

//--------------> ABA JQUERY UI <br>

<div class="tabs">
	<ul>
		<li><a href="#tabs-1">ABA 01</a></li>
        <li><a href="#tabs-2">ABA 02</a></li>
	</ul>
	<div id="tabs-1">    TESTE 01   </div> 
	
    <div id="tabs-2">    TESTE 02    </div>
</div>



  <br>
    <br>
  Textarea:<br>
  <textarea  > </textarea><br>
<br>
<br>

  
//------------------------> FORMULARIO EDITORES DE TEXTOS<br>
<br>
<br>

  //------>CLEAR<br>

  <textarea name="descricao_clear" id="descricao_clear" cols="90" rows="3" class="txt-form"></textarea>
  
  <script>
    CKEDITOR.replace( 'descricao_clear', {
    toolbar :'clear'
    });
    </script>


<br>
<br>

  //------>BASIC<br>

  <textarea name="descricao_basic" id="descricao_basic" cols="90" rows="3" class="txt-form"></textarea>
  
  <script>
    CKEDITOR.replace( 'descricao_basic', {
    toolbar :'basic'
    });
    </script>
  <br>
  //------> DEFAULT<br>
  
  <textarea name="descricao_default" id="descricao_default" cols="90" rows="3" class="txt-form"></textarea>
  
  <script>
    CKEDITOR.replace( 'descricao_default', {
    toolbar :'default',
		
    });
    </script>
  <br>
  //------> FULL<br>
  
  <textarea name="descricao_full" id="descricao_full" cols="90" rows="3" class="txt-form"></textarea>
  
  <script>
    CKEDITOR.replace( 'descricao_full', {
    toolbar :'full',
    });
    </script>
  
    
    
    
    