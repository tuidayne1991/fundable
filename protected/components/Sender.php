<?
class Sender{
    public static function sendConfirmEmail($controller,$recipient){
        $subject = 'Friend Request';
        $body = $controller->renderPartial('//shared/email/confirm_user_email' , array(
            'recipient' => $recipient
        ) , true);
        $content = $controller->renderEmail('main', array('content'=>$body));
        Util::sendEmail($recipient->email , $subject , $content);
    }
}
?>