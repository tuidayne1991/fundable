<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$events = Event::model()->findAll( );
?>
</br>
<div class="jumbotron">
  <h1>Welcome to Dr.Startup</h1>
  <p>This is social network for entrepreneur, who never stop trying to change the world</p>
  <p><a href="/site/contact" class="btn btn-danger btn-lg" role="button">About Us</a></p>
</div>
<h1>Comming Events</h1>
<ul class="list-group">
<? foreach($events as $event){ ?>
    <li class="list-group-item">
        <a href="/event/view/id/<?= $event->id?>"><?= $event->name ?></a>
    </li>
<?  } ?>
</ul>