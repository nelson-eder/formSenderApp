<?php
require_once __DIR__ . '/app.php';

trait DataIsOk {
    public function dataIsOk(){

        if(!isset($_POST)){
            $this->exitError($this->message['POST_LENGTH']);
        }

        #LENGTH POST VERIFICATION (IF IS SET)
        if(gettype($this->maxOrPregPOST) === 'integer'){
            if(sizeof($_POST) > 23){        
                $this->exitError($this->message['POST_LENGTH']);
            }
        }

        while($POST = current($_POST)){
            #PREG POST VERIFICATION (IF IS SET)
            if(gettype($this->maxOrPregPOST) === 'array'){
                in_array(key($_POST), $this->maxOrPregPOST) === false
                ? $this->exitError($this->message['POST_UNKNOWN'])
                : 'miau';
            }

            #REGEX VERIFICATION
            if (preg_match($this->regex, $POST)) {
    
            }else {
                $this->exitError($this->message['POST_CHARS']);
            }
            next($_POST);
        }
        reset($_POST);
    }
}