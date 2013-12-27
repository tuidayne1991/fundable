<? 
    $url = $this->createAbsoluteUrl('project/view/id/'.$project->id);
    $group_url = $this->createAbsoluteUrl('team/view/id'.$project->team->id);
?>

<?= $inviter->name ?> (<?= $inviter->email ?>) added you to project "<?= $project->name ?>" ( this project belongs to group <a href="<?= $group_url ?>" ><?= $project->team->name?></a>) <br/>
Click following link to visit project <br/>
<a href="<?= $url?>"><?= $url ?></a>