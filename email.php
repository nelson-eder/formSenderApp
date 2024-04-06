<?php

trait Email {
    public $to;
    public $fromMail;
    public $fromName;
    public $subject;

    public function setEmailVars($to, $fromMail ,$fromName, $subject){
        $this->to       = $to;
        $this->fromMail = $fromMail;
        $this->fromName = $fromName;
        $this->subject  = $subject;
    }

    public function sendEmail(){
        $boundary = "XYZ-".md5(date("dmYis"))."-ZYX";
        $to = $this->to;
        $fromName = $this->fromName;
        $fromMail = $this->fromMail;
        $subject = $this->subject;

        $headers = "From: $fromName <$fromMail>"  . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; ";
        $headers .= "boundary=" . $boundary . "\r\n";
        $headers .= "$boundary" . "\r\n";


        // Falta o fechamento de uma div
        $message = "--$boundary" . "\r\n";
        $message .= "Content-Type: text/html; charset='utf-8'" . "\r\n";
        $message .= 
        "
            <div style='padding: 10px; padding-bototm: 5px; padding-top: 15px; background-color: #fafafa; border-radius: 2px' id='content'>
                    <h1 style='width: max-content; margin: 0px auto 10px auto;'>$this->subject</h1>    
                    
                    
        ";

        while($POST = current($_POST)){
            $k = key($_POST);
            $e = htmlspecialchars($k);
            $y = strip_tags($e);
            $POST_KEY = str_replace('_', ' ', $y);

            if($POST !== 'on' || $POST !== 'off'){
                $divRow = "
                <div style='margin: 10px' class='row'>
                    <label style='width: 100%; margin-top: 5px'>$POST_KEY</label>
                    <div style='width: 100%; margin: 10px 0px; margin-bottom: 15px; border-radius: 8px; border-width: 1px; border-color: #000000; border-style: solid;'>
                        <p style='margin: 8px;'>
                            $POST
                        </p>
                    </div>
                </div>
                ";
    
                $message .= $divRow;
            }else{
                $isChecked = $POST == 'on' ? 'checked' : '';
                $divRow = 
                "<div style='margin: 10px; border-radius: 14px; border-width: 1px; border-color: #000000; border-style: solid;'' class='row'>
                    <table cellspacing='0' cellpadding='0' border='0' style='width: 100%;'>
                        <tr>
                            <td style='vertical-align: center; width: 10%;'>
                                <table role='presentation' cellspacing='0' cellpadding='0' border='0'>
                                    <tr>
                                        <td style='vertical-align: top;'>
                                            <input $isChecked type='checkbox' style='margin: 0px 0px 0px 5px; width: 100%; height: min-content; margin-top: 3px; background-color: #000000; color: #000000; accent-color: #000000; border-color: #000000; border-radius: 999px; outline-color: #000000;'>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style='vertical-align: top;'>
                                <table role='presentation' cellspacing='0' cellpadding='0' border='0'>
                                    <tr>
                                        <td style='vertical-align: center;'>
                                            <div>
                                                <p style='margin: 8px;'>
                                                    $POST_KEY
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                ";
                
                $message .= $divRow;
            }
            next($_POST);
        } reset($_POST);

        $message .= "</div>" . "\r\n";
    

        if(mail($to,$subject,$message, $headers)){
            $this->exitSuccess($this->messages['FORM_SENDED']);
        }else{
            $this->exitError($this->messages['FORM_ERROR']);
        }
}
}
