<?
class Util{
    public function sendEmail($email,$subject,$content,$params){   
        $message            = new YiiMailMessage;
        // from
        $message->from = Yii::app( )->params['adminEmail'];   
        // to               
        $message->addTo($email);
        // subject
        $message->subject = $subject;
        // content
        $message->view = $content;
        // params
        $message->setBody($params, 'text/html');
        // send
        Yii::app()->mail->send($message);
    }
}
?>