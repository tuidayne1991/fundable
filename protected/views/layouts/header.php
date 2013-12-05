<?
    $isLogin = !Yii::app( )->user->isGuest;
    if($isLogin)$owner = User::model( )->findByPk(Yii::app( )->user->_id);
?>
  
 <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
        <a href="/site/index" class="navbar-brand">Fundy</a>
    </div>
    
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <? if($isLogin){ ?>
            <li class="active">
              
            </li>
            <li class="active" style="width:1000px;text-align:center">
                <a href="/box/index">
                    <?= $owner->total_balance ?><?= "$" ?>
                </a>
            </li>
        <? } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <? if($isLogin){ ?>
            <li>
                <a class="dropdown-toggle" id="dropdownmenu" data-toggle="dropdown" style="font-size:18px;color:white;">
                    <i class="glyphicon glyphicon-align-justify .white"></i>
                </a>
                
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownmenu" >
                        <li role="presentation"><a href="/site/index" role="menuitem" tabindex="-1" href="#">Home</a></li>
                        <li role="presentation"><a href="/box/index" role="menuitem" tabindex="-1" href="#">Wallets</a></li>
                        <li role="presentation"><a href="/transaction/index" role="menuitem" tabindex="-1" href="#">Transactions</a></li>
                        <li role="presentation"><a href="/site/logout" role="menuitem" tabindex="-1">Logout</a></li>
                </ul>
            </li>
        <? }else{ ?>
            <li>
                <a href="/registration/create">Sign Up</a>                
            </li>
        <? } ?>
      </ul>
    </nav>

  </div>
</header>



<script type="text/javascript">
    $(function(){
        $(".dropdownmenu").dropdown();
    });  
</script>