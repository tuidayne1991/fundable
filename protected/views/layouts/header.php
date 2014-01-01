<?php
    $project = isset(Yii::app()->controller->module->id)?Yii::app()->controller->module->id:"drstartup";
    $logo = "";
    $link = "";
    switch($project){
        case "msfundy":
            $logo = "Ms.Fundy";
            $link = "/msfundy";
        break;
        default:
            $logo = "Dr.Startup";
            $link = "/site/index";
        break;
    }
    $isLogin = !Yii::app( )->user->isGuest;
    $owner = "";
    if($isLogin)$owner = User::model( )->findByPk(Yii::app( )->user->_id);
?>
  
 <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
        <a href="<?= $link?>" class="navbar-brand"><?= $logo?></a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <? if($middle){ ?>
          <ul class="nav navbar-nav">
            <? if($isLogin){ ?>
                <li class="active" style="width: 890px;text-align:center;">
                    <a href="/box/index">
                        <?= $owner->name ?> - <?= $owner->total_balance ?> <?= $owner->currency ?>
                    </a>
                </li>
            <? } ?>
          </ul>
      <? }else{ ?>
            <ul class="nav navbar-nav">
            <? if($isLogin){ ?>
                <li class="active" style="width: 890px;text-align:center;">
                    <a href="/user/profile">
                        <?= $owner->name ?>
                    </a>
                </li>
            <? } ?>
          </ul>
      <? } ?>
      <ul class="nav navbar-nav navbar-right">
        <? if($isLogin){ ?>
            <? if($project == "drstartup"){ ?>
            <li>
                <a class="dropdown-toggle" id="applst" data-toggle="dropdown" style="font-size:18px;color:white;padding-top: 10px;padding-bottom: 10px;">
                    <img src="/images/team.png" style="width:30px;height:30px;"/>
                </a>
                
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="applst">    
                        <? foreach($owner->teams as $team){ ?>
                            <li role="presentation"><a href="/team/internal/<?= $team->id?>" role="menuitem" tabindex="-1" href="#"><?= $team->name ?></a></li>                            
                        <? } ?>
                        <li role="presentation"><a href="/team/create" role="menuitem" tabindex="-1">
                            <i class="glyphicon glyphicon-plus"></i> Create Team</a></li>
                </ul>
            </li>
            <? } ?>
            <li>
                <a class="dropdown-toggle" id="dropdownmenu" data-toggle="dropdown" style="font-size:18px;color:white;padding-bottom: 10px;">
                    <i class="glyphicon glyphicon-align-justify .white"></i>
                </a>
                
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownmenu" >
                        <li role="presentation"><a href="/site/index" role="menuitem" tabindex="-1">Home</a></li>
                        <? if($project == "msfundy"){ ?>
                            <li role="presentation"><a href="/msfundy/box/index" role="menuitem" tabindex="-1">Wallets</a></li>
                            <li role="presentation"><a href="/msfundy/transaction/index" role="menuitem" tabindex="-1">Transactions</a></li>
                        <? } ?>
                            <li role="presentation"><a href="/user/private" role="menuitem" tabindex="-1">My Inside</a></li>
                            <li role="presentation"><a href="/msfundy" role="menuitem" tabindex="-1">My Money</a></li>
                            <li role="presentation"><a href="/site/logout" role="menuitem" tabindex="-1">Logout</a></li>
                </ul>
            </li>
        <? }else{ ?>
            <li>
                <a href="/site/contact">About Us</a>                
            </li>
            <li>
                <a href="/registration/create">Sign Up</a>                
            </li>
            <li>
                <a href="/site/login">Login</a>                
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