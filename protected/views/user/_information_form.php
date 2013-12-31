<?
    $add_information_attributes_script = <<<EO_SCRIPT
$(document).on('click', '.js-add-information', function(event){
    el = $(this);
    id = $("#origin").attr('data-id');
    id++;
    $("#origin").attr('data-id',id);
    $("#origin #key-title").html(el.attr('data-id'));
    $("#origin #key-title").attr('name','k' + id);
    clone = $("#origin").html( );
    event.preventDefault();
    var container = $('#information-attributes-container');
    container.append("<br/>");
    container.append(clone);

});

$(document).on('click', '.js-add-other-information', function(event){
    el = $(this);
    id = $("#origin").attr('data-id');
    id++;
    $("#origin").attr('data-id',id);
    $("#origin #key-title").replaceWith("<input id=key-title />");
    $("#origin #key-title").attr('name','k' + id);
    clone = $("#origin").html( );

    $("#origin #key-title").replaceWith("<span id=key-title></span>");

    event.preventDefault();
    var container = $('#information-attributes-container');
    container.append("<br/>");
    container.append(clone);

});
EO_SCRIPT;

$choose_information_attributes_script = <<<EO_SCRIPT
$(document).on('click', '.js-choose-information', function(event){
    el = $(this);
    new_value = el.attr('data-id');
    el.parent().parent( ).parent( ).find("#key-title").text(new_value);
});

$(document).on('click', '.js-choose-other-information', function(event){
    el = $(this);
    new_value = el.attr('data-id');
    el.parent().parent( ).parent( ).find("#key-title").text(new_value);
});
EO_SCRIPT;
Yii::app()->clientScript->registerScript('add_information_attributes', $add_information_attributes_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('choose_information_attributes', $choose_information_attributes_script, CClientScript::POS_READY);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'action'=>"/user/updateInfo/id/{$model->id}",
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>false,
        'validateOnType'=>false,
        'beforeValidate' => 'js:addJsonInfo',
        'afterValidate'=>"js:function(form, data, hasError){
            if(data.status == true){
                $('#profile-container').html(data.item);
                $('#profile-form-container').hide();
                $('#js-update-profile').show( );
                $('#update-btn-panel').show( );
            }
        }"
    ),
));

$add_json_info_script = <<< EOF_JS
function addJsonInfo() {
    var json_info = { };
    no = $("#origin").attr('data-id');
    for(var i = 1;i <= no;i++){
        json_info['i'+i] = $("[data-id="+i+"] #value").val();
    }
    return true;
}
EOF_JS;
Yii::app()->clientScript->registerScript('add_json_info', $add_json_info_script);
?>
    <div class="input-row">
        <?php echo $form->labelEx($model,'name',array('class' => 'login-lb')); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200,'disabled'=>'disabled')); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="input-row">
        <?php echo $form->labelEx($model,'currency',array('class' => 'login-lb')  ); ?>
        <?php echo $form->textField($model,'currency',array('disabled'=>'disabled')); ?>
        <?php echo $form->error($model,'currency'); ?>
    </div>
    
    <div id="information-attributes-container">
    </div>
    <div class="dropdown">
        <a id="js-choose-information-attributes" id="choose-information-attributes" data-toggle="dropdown" class="dropdown-toggle btn btn-info btn-xs"><i class="glyphicon glyphicon-plus"></i></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="choose-information-attributes">
            <? foreach(Util::getInfoList(true) as $key => $info){ ?>     
                    <? if($info == "Other"){ ?>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-add-other-information">
                            <?= $info ?>
                        </a>
                    </li>
                    <? }else{ ?>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-add-information">
                            <?= $info ?>
                        </a>
                    </li>
                    <? } ?>
            <? } ?>
        </ul>
    </div>  


    <br/></br>
    
    <div id="origin" style="display:none" data-id="0">
        <div class="dropdown">
            <div style="width:80px;float:left;text-align:right;margin-right:5px;">
                <span id="key-title"></span>
                <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="text-align:left;">
                    <? foreach(Util::getInfoList(true) as $key => $info){ ?>
                         <? if($info == "Other"){ ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-choose-other-information">
                                    <?= $info ?>
                                </a>
                            </li>
                            <? }else{ ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-choose-information">
                                    <?= $info ?>
                                </a>
                            </li>
                            <? } ?>
                    <? } ?>
                </ul>
            </div>
            <div>
                <input type="text" placeholder="value" id="value" />
            </div>
            <br/>
        </div>  
    </div>

    <div class="input-row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-info btn-xs')); ?>
        <button id="js-cancel-edit-info" class="btn btn-info btn-xs">Cancel</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->