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
  if($model->type == "team"){
    $status = $model->status?"btn-success":"";
    if($model->status){
      $duration = $model->duration + (strtotime(date('Y-m-d H:i:s')) - strtotime($model->start_time))*100;
    }else{
      $duration = $model->duration;
    }
    $html = <<<HTML
      <li id="task-item-{$model->id}">
        <div class="front" style="-webkit-transform: skewY(0deg) scale(1, 1); display: block;">
          <div class="pull-right">
                <div>
                  <button id="js_switch_task_clock" class="btn btn-sm {$status} pull-right" data-id="{$model->id}"><i class="glyphicon glyphicon-time"></i></button>
                </div>
                <div id="switch-{$model->id}" class="pull-right">
                  <span id="stopwatch-{$model->id}" style="font-size:15px;">00:00</span>
                </div>
            </div>
            <div style="display:inline-block;float:left;">
              <img src="{$model->project->logo}" 
                style="width:50px;height:50px;display: inline-block;max-width: 100%;padding: 1px;
                       line-height: 1.428571429;background-color: #fff;border: 1px solid #ddd;border-radius: 4px;
                       -webkit-transition: all .2s ease-in-out;transition: all .2s ease-in-out;"></img>
            </div>
            <div>
              <div style="float:left;margin-left:10px;font-size:18px;color: #353535;">
                <a href="{$model->project->url}">{$model->project->name}</a>#{$model->task_code}: <a href="/task/view/id/{$model->id}">{$model->name}</a>
              </div>
              <br/><br/>
              <div style="margin-left:10px;float:left;margin-top:-7px;">
                  by <a class="btn btn-info btn-xs" href="{$model->project->team->url}">
                  <img src="/images/team.png" style="width:20px;height:20px"/>  {$model->project->team->name}
                  </a>
              </div>
            </div>
            <div style="clear:both;"></div>
            Progress:
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {$model->progress}%">
                <div style="color:black;text-align: center;width: 100%;">{$model->progress}%</div>
            </div>
    </div>
          <div>Deadline : {$model->deadline}
            <div class="pull-right"><button class="edit-task btn btn-info btn-xs">Description</button></div>
            <div class="pull-right"><button id="js-edit-task" data-id="{$model->id}" class="btn btn-info btn-xs">Edit</button></div>
            <div class="pull-right"><button class="edit-task btn btn-info btn-xs">Comment</button></div>
          </div>
        </div>
        <div id="edit-task-form-container-{$model->id}" class="back" style="display: none; left: 0px; -webkit-transform: skewY(0deg) scale(1, 1);">
          
        </div>
      </li>
       <script>
            $(function(){
              var status = {$model->status};
              clocklst["mrtime{$model->id}"] = new MrTime("stopwatch-{$model->id}",{$duration});
              if(!status){
                clocklst["mrtime{$model->id}"].Timer.pause();
              }
              });
      </script>
      <!-- <li class="list-group-item"><a id="js-delete-action" data-id="{$model->id}" style="color:black"><i class="glyphicon glyphicon-trash"></i></a></li> -->
HTML;
      return $html;
}else if($model->type == 'user'){
  return MyHtml::createActionItemHtml($model);
}
}

public static function createActionItemHtml($model) {
   $status = $model->status?"btn-success":"";
    if($model->status){
      $duration = $model->duration + (strtotime(date('Y-m-d H:i:s')) - strtotime($model->start_time))*100;
    }else{
      $duration = $model->duration;
    }
    $created_at = date("F j, Y, g:i a",strtotime($model->created_at));
    $html = <<<HTML
      <li id="task-item-{$model->id}">
        <div class="front" style="-webkit-transform: skewY(0deg) scale(1, 1); display: block;">
          <div class="pull-right">
                <div>
                  <button id="js_switch_task_clock" class="btn btn-sm {$status} pull-right" data-id="{$model->id}"><i class="glyphicon glyphicon-time"></i></button>
                </div>
                <div id="switch-{$model->id}" class="pull-right">
                  <span id="stopwatch-{$model->id}" style="font-size:15px;">00:00</span>
                </div>
            </div>
            <div style="display:inline-block;float:left;">
              <img src="{$model->category->logo}" 
                style="width:50px;height:50px;display: inline-block;max-width: 100%;padding: 1px;
                       line-height: 1.428571429;background-color: #fff;border: 1px solid #ddd;border-radius: 4px;
                       -webkit-transition: all .2s ease-in-out;transition: all .2s ease-in-out;"></img>
            </div>
            <div>
              <div style="float:left;margin-left:10px;font-size:18px;color: #353535;">
                <a href="/task/view/id/{$model->id}">{$model->name}</a>
              </div>
              <br/><br/>
              <div style="margin-left:10px;float:left;margin-top:-7px;color:#999;font-size:13px;">
                  {$created_at}
              </div>
            </div>
            <div style="clear:both;"></div>
            Progress:
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {$model->progress}%">
                <div style="color:black;text-align: center;width: 100%;">{$model->progress}%</div>
            </div>
    </div>
          <div>Deadline : {$model->deadline}
            <div class="pull-right"><button class="edit-task btn btn-info btn-xs">Description</button></div>
            <div class="pull-right"><button id="js-edit-task" data-id="{$model->id}" class="btn btn-info btn-xs">Edit</button></div>
            <div class="pull-right"><button class="edit-task btn btn-info btn-xs">Comment</button></div>
          </div>
        </div>
        <div id="edit-task-form-container-{$model->id}" class="back" style="display: none; left: 0px; -webkit-transform: skewY(0deg) scale(1, 1);">
          
        </div>
      </li>
       <script>
            $(function(){
              var status = {$model->status};
              clocklst["mrtime{$model->id}"] = new MrTime("stopwatch-{$model->id}",{$duration});
              if(!status){
                clocklst["mrtime{$model->id}"].Timer.pause();
              }
              });
      </script>
      <!-- <li class="list-group-item"><a id="js-delete-action" data-id="{$model->id}" style="color:black"><i class="glyphicon glyphicon-trash"></i></a></li> -->
HTML;
      return $html;
    }

    public static function createUserProfileHtml($model){
      $isOwner = !Yii::app()->user->isGuest && Yii::app()->user->_id == $model->id;
      $currency = $isOwner?"Currency: {$model->currency}</br>":"";
$html = <<<HTML
      {$currency}
HTML;
        return $html;
    }

    public static function createUserInfoHtml($model){
      $json_info =CJSON::decode($model->json_information);
      $data = "";
      if($json_info != null){
        foreach ($json_info as $key => $value) {
          $data = $data . $key . " : " . $value. "<br/>"; 
        }
      }
      $html = <<<HTML
      {$data}    
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

    public static function createContactItemHtml($model){
$html = <<<HTML
      <div style="float:left;">
        <a id="contact-item" class="contact-{$model->id}" data-id="{$model->id}">
          <img data-toggle="tooltip" data-placement="top" data-original-title="{$model->name}" src="{$model->image}" style="width:25px;height:25px;"></img>
        </a>
      </div>
      <script>
        $(function(){
          $('#contact-{$model->id}').tooltip('hide');
        });
      </script>
HTML;
        return $html;
    }

    public static function createSpecViewHtml($model){
$html = <<<HTML
  <div class="page-header">
    <h1>{$model->title}</h1>
    <div>Project <a href="{$model->project->profileUrl}">{$model->project->name}</a> by 
      <a class="btn btn-info btn-sm" href="{$model->project->team->profileUrl}">
        <img src="/images/team.png" style="width:20px;height:20px"/> {$model->project->team->name}
      </a>
    </div>
  </div>
<div id="page-content">
  {$model->content}
</div>
HTML;
return $html;
    }
}
?>