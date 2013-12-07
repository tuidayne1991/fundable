<?
class Sender{
    public static function sendConfirmEmail($recipient){
        $subject = 'Registration Confirmation';
        $content = 'confirm_user_email';
        $params  = array('recipient'=>$recipient);
        Util::sendEmail($recipient->email , $subject , $content,$params);
    }
}
?>