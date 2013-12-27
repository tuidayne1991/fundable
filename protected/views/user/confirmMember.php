<h3><?= Yii::t('app','You are right now in group') ?> <?= $group->name?></h3>

<p><?= CHtml::link(Yii::t('app','Go to Group'), array('team/view/id/'.$group->id)) ?></p>
