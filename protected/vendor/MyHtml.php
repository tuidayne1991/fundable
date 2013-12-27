<?
class MyHtml {
    public static function createBoxItemHtml($model) {
    $html = <<<HTML
       <div class="panel panel-default" id="box-{$model->id}">
        <div class="panel-heading" data-toggle="collapse" data-parent="#box-container" href="#collapse{$model->id}">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#box-container" href="#collapse{$model->id}">
              {$model->source}
            </a>
          </h4>
        </div>
        <div id="collapse{$model->id}" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="pull-right">
              <a id="js-delete-box" data-id="{$model->id}"><i class="glyphicon glyphicon-trash"></i>
              </a>
            </div>
            Balance: {$model->balance} {$model->currency}</br>
          </div>
        </div>
      </div>
HTML;
        return $html;
    }

    public static function createTransactionItemHtml($model,$id = "transaction-container") {
  $html = <<<HTML
       <div class="panel panel-default" id="transaction-{$model->id}">
        <div class="panel-heading" data-toggle="collapse" data-parent="#{$id}" href="#collapse{$model->id}">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#{$id}" href="#collapse{$model->id}">
              {$model->created_at}
            </a>
          </h4>
        </div>
        <div id="collapse{$model->id}" class="panel-collapse collapse">
          <div class="panel-body">
              <div class="pull-right">
              <a id="js-delete-transaction" data-id="{$model->id}"><i class="glyphicon glyphicon-trash"></i>
              </a>
            </div>
            Balance: {$model->money} {$model->currency}</br>
          </div>
        </div>
      </div>
HTML;
        return $html;
    }

public static function createTaskItemHtml($model){
  $status = "";
  $html = <<<HTML
 <div id="action-{$model->id}" class="time-control" data-id="{$model->id}">
  <ul class="list-group">
    <li class="list-group-item">
        <div id= "switch-{$model->id}" class="make-switch js-switch-time-btn" data-on-label="YES" data-off-label="NO" data-id="{$model->id}">
            <input type="checkbox" {$status}>
        </div>
        {$model->name}
        <div class="pull-right">
           <span id="stopwatch-{$model->id}">00:00:00</span>
        </div>
    </li>
    <!-- <li class="list-group-item"><a id="js-delete-action" data-id="{$model->id}" style="color:black"><i class="glyphicon glyphicon-trash"></i></a></li> -->
    <li class="list-group-item">{$model->description}</li>
  </ul> 
  </div>
HTML;
        return $html;

}

public static function createActionItemHtml($model) {
  if($model->status){
    $duration = $model->duration + (strtotime(date('Y-m-d H:i:s')) - strtotime($model->start_time))*100;
  }else{
    $duration = $model->duration;
  }
  $status = $model->status?"checked":"";
$html = <<<HTML
 <div id="action-{$model->id}" class="time-control" data-id="{$model->id}">
  <ul class="list-group">
    <li class="list-group-item">
        <div id= "switch-{$model->id}" class="make-switch js-switch-time-btn" data-on-label="YES" data-off-label="NO" data-id="{$model->id}">
            <input type="checkbox" {$status}>
        </div>
        {$model->name}
        <div class="pull-right">
           <span id="stopwatch-{$model->id}">00:00:00</span>
        </div>
    </li>
    <!-- <li class="list-group-item"><a id="js-delete-action" data-id="{$model->id}" style="color:black"><i class="glyphicon glyphicon-trash"></i></a></li> -->
    <li class="list-group-item">{$model->description}</li>
  </ul> 
  </div>
      <script>
          $(function(){
            var status = "{$status}";
            clocklst["mrtime{$model->id}"] = new MrTime("stopwatch-{$model->id}",{$duration});
            if(status != "checked"){
              clocklst["mrtime{$model->id}"].Timer.pause();
            }
            $('#switch-{$model->id}').bootstrapSwitch('setOnClass', 'success');
            $('#switch-{$model->id}').bootstrapSwitch('setOnLabel', '<i class="glyphicon glyphicon-time" style="line-height: normal;height: 20px;"></i>');
            $('#switch-{$model->id}').bootstrapSwitch('setOffLabel', 'Stop');
          });
      </script>
HTML;
        return $html;
    }

    public static function createUserProfileHtml($model){
      $isOwner = !Yii::app()->user->isGuest && Yii::app()->user->_id == $model->id;
      $currency = $isOwner?"Currency: {$model->currency}</br>":"";
$html = <<<HTML
      <h3>{$model->name}</h3>
      {$currency}
HTML;
        return $html;
    }

    public static function createProjectMemberItemHtml($model){
$html = <<<HTML
    <li>
      {$model->name}
    </li>
HTML;
        return $html;
    }
}
?>