<?php
// Inicializa os dados da session
session_start();
 
// Definir o header como image/png para indicar que esta página contÃém dados
// do tipo image->PNG
header("Content-type: image/png");
 
// Criar um novo recurso de imagem a partir de um arquivo
$imagemCaptcha = imagecreatefrompng("imgs/captcha.png")
or die("Não foi possivel inicializar uma nova imagem");
 
//Carregar uma nova fonte
$fonteCaptcha = imageloadfont("anonymous.gdf");
 
// Criar o texto para o captcha
$textoCaptcha = substr(md5(uniqid('')),-9,9);
 
// Guardar o texto numa variÃ¡vel session
$_SESSION['session_textoCaptcha'] = $textoCaptcha;
 
// Indicar a cor para o texto
$corCaptcha = imagecolorallocate($imagemCaptcha,0,0,0);
 
// Escrever a string na cor escolhida
imagestring($imagemCaptcha,$fonteCaptcha,15,5,$textoCaptcha,$corCaptcha);
 
// Mostrar a imagem captha no formato PNG.
// Outros formatos podem ser usados com imagejpeg, imagegif, imagewbmp, etc.
imagepng($imagemCaptcha);
// Liberar memoria
imagedestroy($imagemCaptcha);
 
?>