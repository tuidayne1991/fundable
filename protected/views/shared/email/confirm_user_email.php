<? 
    $url = $this->createAbsoluteUrl('user/confirm', array('key' => $recipient->unique_id , 'ac' => $recipient->activation_code));
?>
Hi, please click following link to confirm your email<br/>
<a href="<?= $url?>"><?= $url ?></a>

