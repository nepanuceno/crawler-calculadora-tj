<?php
header('Content-Type: application/json');

require_once (__DIR__."/Calculadora.php");

define("URL", "http://wwa.tjto.jus.br/calculadora/Home");

$calc = new Calculadora(URL);

$dados_1 = array(
    'grau'=>1,
    'tipo'=>1,
    'precatorio'=>0,
    'idNatureza'=>82,
    'tipoPreparo'=>1,
    'valorCausa'=>1100,
    'validadoEscrivania'=>true,
    'validadoSecretaria'=>true,
    'quantidadeDistribuicao'=>2,
    'quantidadeDeRegistros'=>1,
    'validadoDistribuicao'=>true,
    'urbana'=>0,
    'suburbana'=>0,
    'rural'=>0,
    'urbanaHC'=>0,
    'suburbanaHC'=>0,
    'ruralHC'=>0,
    'mesmoMandado'=>0,
    'mandadoDiferente'=>0,
    'quantidadePostais'=>0,
    'validadoOficialJustica'=>true,
    'validado'=>true
);

$resp = json_decode($calc->calcular($dados_1));

//echo $resp->atoEscrivaniaSubtotal;

$dados_2 = array(
    'objCalculo[grau]'=>1,
    'objCalculo[tipo]'=>1,
    'objCalculo[precatorio]'=>0,
    'objCalculo[idNatureza]'=>82,
    'objCalculo[tipoPreparo]'=>1,
    'objCalculo[valorCausa]'=>1100,
    'objCalculo[observacao]'=>false,
    'objCalculo[validadoEscrivania]'=>true,
    'objCalculo[validadoSecretaria]'=>true,
    'objCalculo[quantidadeDistribuicao]'=>2,
    'objCalculo[quantidadeDeRegistros]'=>1,
    'objCalculo[validadoDistribuicao]'=>true,
    'objCalculo[urbana]'=>0,
    'objCalculo[suburbana]'=>0,
    'objCalculo[rural]'=>0,
    'objCalculo[urbanaHC]'=>0,
    'objCalculo[suburbanaHC]'=>0,
    'objCalculo[ruralHC]'=>0,
    'objCalculo[mesmoMandado]'=>0,
    'objCalculo[mandadoDiferente]'=>0,
    'objCalculo[quantidadePostais]'=>0,
    'objCalculo[validadoOficialJustica]'=>true

);

$hash = json_decode($calc->gerarHash($dados_2));

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
