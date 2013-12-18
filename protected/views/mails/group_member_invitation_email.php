<? 
    $url = $this->createAbsoluteUrl('user/confirmMember', array('key' => $recipient->unique_id , 'ac' => $recipient->activation_code,'group' => $group->id));
?>

<?= $inviter->name ?> (<?= $inviter->email ?>) has invited you to join the group "<?= $group->name?>"</br>
Please, accept the invitation at: <br/>
<a href="<?= $url?>"><?= $url ?></a>