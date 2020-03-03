<?php

class Calculadora {

    private function requisicao($params, $sUrl){

        try{
            $ctx = stream_context_create($params);
            $fp = @fopen($sUrl, 'rb', false, $ctx);
            $response = @stream_get_contents($fp);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        return $response;
    }

    public function calcular($url=null, $method='POST', $content=''){

        $params = array('http' => array(
            'method' => $method,
            'content' => 'grau=1&tipo=1&precatorio=0&idNatureza=82&tipoPreparo=1&valorCausa=1100&validadoEscrivania=true&validadoSecretaria=true&quantidadeDistribuicao=2&quantidadeDeRegistros=1&validadoDistribuicao=true&urbana=0&suburbana=0&rural=0&urbanaHC=0&suburbanaHC=0&ruralHC=0&mesmoMandado=0&mandadoDiferente=0&quantidadePostais=0&validadoOficialJustica=true&validado=true'
        ));

        $sUrl = "http://20.14.3.152/calculadora/Home/PreCalculo";
        return $this->requisicao($params, $sUrl);
    }

    public function gerarHash($url=null, $method='POST', $content=''){


        $params = array('http' => array(
            'method' => $method,
            'content' => 'objCalculo[grau]=1&objCalculo[tipo]=1&objCalculo[precatorio]=0&objCalculo[idNatureza]=82&objCalculo[tipoPreparo]=1&objCalculo[valorCausa]=1100&objCalculo[observacao]=false&objCalculo[validadoEscrivania]=true&objCalculo[validadoSecretaria]=true&objCalculo[quantidadeDistribuicao]=2&objCalculo[quantidadeDeRegistros]=1&objCalculo[validadoDistribuicao]=true&objCalculo[urbana]=0&objCalculo[suburbana]=0&objCalculo[rural]=0&objCalculo[urbanaHC]=0&objCalculo[suburbanaHC]=0&objCalculo[ruralHC]=0&objCalculo[mesmoMandado]=0&objCalculo[mandadoDiferente]=0&objCalculo[quantidadePostais]=0&objCalculo[validadoOficialJustica]=true'
        ));

        $sUrl = "http://20.14.3.152/calculadora/Home/Salvar";
        return $this->requisicao($params, $sUrl);
    }


    public function gerarCodigo($hash, $url=null, $method='GET', $content='') {

        $params = array('http' => array(
            'method' =>  $method,
            'content' => $content,
        ));
        $sUrl = "http://20.14.3.152/calculadora/Home/Visualizar/$hash?v=1";

        return $this->requisicao($params, $sUrl);
    }
}
