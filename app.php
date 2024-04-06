<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dataIsOk.php';
require_once __DIR__ . '/email.php';

class FormSenderApp extends Config{
    use Email;
    use DataIsOk;

    public function __construct($to, $fromMail, $fromName, $subject, $regex, $maxOrPregPOST, $urlToExit){
                $this->setConfig($regex, $maxOrPregPOST, $urlToExit);
                $this->setEmailVars($to, $fromMail ,$fromName, $subject);
    }

    public function exitError($errorMessage){
        if(isset($_POST)){ unset($_POST); }

        session_start();
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = $errorMessage;
        echo "<script>window.location.href='$this->urlToExit';</script>";
        exit();
    }

    public function exitSuccess($successMessage){
        if(isset($_POST)){ unset($_POST); }

        session_start();
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = $successMessage;
        echo "<script>window.location.href='$this->urlToExit';</script>";
        exit();
    }
}