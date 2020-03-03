<?php

class Calculadora {

    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    private function requisicao($data=null, $sUrl, $method='POST'){

        try{

            $params = array('http' => array(
                'method' =>  $method,
                'content' => $data ? http_build_query($data) : ''
            ));

            $ctx = stream_context_create($params);
            $fp = @fopen($sUrl, 'rb', false, $ctx);
            $response = @stream_get_contents($fp);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        return $response;
    }


    public function calcular($data){

        $sUrl = $this->url."/PreCalculo";
        return $this->requisicao($data, $sUrl);
    }


    public function gerarHash($data){

        $sUrl = $this->url."/Salvar";
        return $this->requisicao($data, $sUrl);
    }


    public function gerarCodigo($hash) {

        $sUrl = $this->url."/Visualizar/$hash?v=1";
        return $this->requisicao(null, $sUrl, 'GET');
    }
}
