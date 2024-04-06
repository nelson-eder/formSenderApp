<?php
class Config {
    public $regex;
    public $urlToExit;
    public $maxOrPregPOST;
    public $messages = [
        'POST_LENGTH' => "Erro interno ao enviar formulário (maxLengthPOST)",
        'POST_CHARS' => "Caracteres não permitidos.",
        'POST_UNKNOWN' => "Houve um erro ao enviar o formulário (unknownPOST)",
        'POST_NULL' => "Você tentou enviar um formulário vazio. (POST_NULL)",
        'FORM_ERROR' => "Erro ao enviar formulário (mailFunction)",

        'FORM_SENDED' => "Formulário enviado com sucesso.",
    ];

    public function setConfig($regex, $maxOrPregPOST, $urlToExit){
        $this->regex = $regex;
        $this->maxOrPregPOST = $maxOrPregPOST;
        $this->urlToExit = $urlToExit;
        
    }
}