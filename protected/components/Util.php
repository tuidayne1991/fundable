<?
class Util{
    public function sendMail($email,$subject,$content){   
        $message            = new YiiMailMessage;
        $message->view = $content;
        $params              = array('myMail'=>1);
        $message->subject    = $subject;
        $message->setBody($params, 'text/html');
        //email                
        $message->addTo($email);
        $message->from = Yii::app( )->params['adminEmail'];   
        Yii::app()->mail->send($message);
    }
}
?>