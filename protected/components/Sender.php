<?
class Sender{
    public static function sendConfirmEmail($recipient){
        $prefix = "[".Yii::app()->name."]";
        $subject = '{$prefix} Registration Confirmation';
        $content = 'confirm_user_email';
        $params  = array('recipient'=>$recipient);
        Util::sendEmail($recipient->email , $subject , $content,$params);
    }

    public static function sendGroupMemberInvitationEmail($inviter,$group,$recipient){
        $prefix = "[".Yii::app()->name."]";
        $subject = "{$prefix} {$inviter->name} ({$inviter->email}) invites you to join the group '{$group->name}'";
        $content = 'group_member_invitation_email';
        $params  = array('inviter' => $inviter, 'group' => $group,'recipient'=>$recipient);
        Util::sendEmail($recipient->email , $subject , $content,$params);
    }
}
?>