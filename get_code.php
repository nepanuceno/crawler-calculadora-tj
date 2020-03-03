<?php
header('Content-Type: application/json');

require_once (__DIR__."/Calculadora.php");

$calc = new Calculadora();

$resp = json_decode($calc->calcular());

//echo $resp->atoEscrivaniaSubtotal;

$hash = json_decode($calc->gerarHash());

$str = utf8_decode($calc->gerarCodigo($hash));

$re = '/<h3>(.*?)<b>(.*?)<\/b><\/h3>/s';

preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0);
$dados = mb_convert_encoding($matches,"UTF-8","auto");

try{
    $error = json_last_error_msg ();
    if(!$error)
        $dados['status'] = $error;
    else
        $dados['status'] = 'ok';
}  catch(Exception $e) {
    $dados['status'] = $e->getMessage();
} finally {
    echo json_encode($dados);
}
