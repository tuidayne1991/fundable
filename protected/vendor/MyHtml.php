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

}
?>