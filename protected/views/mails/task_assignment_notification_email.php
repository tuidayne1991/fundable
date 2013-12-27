<? 
    $url = $this->createAbsoluteUrl('task/view/id/'.$task->id);
?>

<?= $inviter->name ?> (<?= $inviter->email ?>) assigned new task to you in project "<?= $task->project->name ?>"<br/>
Click following link to view task <br/>
<a href="<?= $url?>"><?= $url ?></a>