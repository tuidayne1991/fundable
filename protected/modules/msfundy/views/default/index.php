<ul class="nav nav-tabs">
  <li class="active"><a href="#earning" data-toggle="tab">Earning</a></li>
  <li><a href="#spending" data-toggle="tab">Spending</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="earning">
      <div class="panel-group" id="transaction-container">
      <? foreach($owner->getAllEarningTransaction( ) as $tran){ ?>
          <?= MyHtml::createTransactionItemHtml($tran) ?>        
      <? } ?>
    </div>
  </div>
  <div class="tab-pane" id="spending">
      <div class="panel-group" id="transaction1-container">
      <? foreach($owner->getAllSpendingTransaction( ) as $tran){ ?>
          <?= MyHtml::createTransactionItemHtml($tran,"transaction1-container") ?>        
      <? } ?>
    </div>
  </div>
</div>
