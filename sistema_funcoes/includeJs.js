function include (filePath)
{
//BR: O paramêtro caminho, e aonde está localizado o seu arquivo (.js) que vc deseja incluir
//EN: arameter to the path, and where is located your file (. Js) that you want to include
var elementFilePath = document.createElement("script");
elementFilePath.setAttribute("type","text/javascript");
elementFilePath.setAttribute("src", filePath); // setAttribute("src","/js/pag.js");
document.getElementsByTagName("head")[0].appendChild(elementFilePath);
}
//EX: include('/js/pag.js');
