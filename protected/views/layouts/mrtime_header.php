<?php
    $isLogin = !Yii::app( )->user->isGuest;
    $owner = "";
    if($isLogin)$owner = User::model( )->findByPk(Yii::app( )->user->_id);
?>
  
 <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
        <a href="/mrtime" class="navbar-brand">Mr.Time</a>
    </div>
    
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">

      <ul class="nav navbar-nav navbar-right">
        <? if($isLogin){ ?>
             <li>
                <a class="dropdown-toggle" id="dropdownmenu" data-toggle="dropdown" style="font-size:18px;color:white;">
                    <i class="glyphicon glyphicon-align-justify .white"></i>
                </a>
                
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownmenu" >
                        <li role="presentation"><a href="/site/logout" role="menuitem" tabindex="-1">Logout</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" id="applst" data-toggle="dropdown" style="font-size:18px;color:white;">
                    <i class="glyphicon glyphicon-th .white"></i>
                </a>
                
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="applst" >
                        <li role="presentation"><a href="/site/index" role="menuitem" tabindex="-1" href="#">Fundy</a></li>
                        <li role="presentation"><a href="/mrtime" role="menuitem" tabindex="-1" href="#">MrTime</a></li>
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