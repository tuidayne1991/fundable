<?
class Util{
    public static function sendEmail($recipient, $subject, $body, $reply_to=null , $from_addr=null) {
        $app_email_name = Yii::app()->params['adminEmail'];

        $app_email = Yii::app()->params['adminEmail'];
        //If the 'from' address is specified
        if ($from_addr) {
            $app_email = $from_addr;
        }

        try {
            if($recipient != ""){
                $mail = new PHPMailerLite($exceptions = true);
                $mail->IsMail();
                $mail->CharSet = 'utf-8';

                if ($reply_to) {
                    $mail->AddReplyTo($reply_to);
                }

                $mail->SetFrom($app_email, $app_email_name);
                $mail->AddAddress($recipient);
                $mail->Subject ="=?UTF-8?B?" .base64_encode($subject). "?=";
                //$mail->AltBody  = "To view the message, please use an HTML compatible email viewer!";
                $mail->AltBody  = $body;
                $mail->MsgHTML($body);
                $mail->Send();
            }
        } catch (Exception $e) {
            Yii::log($e->getMessage(), 'error');
            return false;
        }
        return true;
    }
}
?>