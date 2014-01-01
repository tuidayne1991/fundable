<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
    $json_info =CJSON::decode($model->contact_json);
?>
<?
    $add_contact_attributes_script = <<<EO_SCRIPT
$(document).on('click', '.js-add-contact', function(event){
    event.preventDefault();
    $("#clone").removeClass("open");
    el = $(this);
    id = $("#origin").attr('data-id');
    id++;
    $("#origin").attr('data-id',id);
    $("#origin #key-title").html(el.attr('data-id'));
    $("#origin #key-title").attr('name','k' + id);
    $("#origin .dropdown").attr('data-id',id);

    clone = $("#origin").html( );
    event.preventDefault();
    var container = $('#contact-attributes-container');
    container.append(clone);
});

$(document).on('click', '.js-add-other-contact', function(event){
    event.preventDefault();
    $("#clone").removeClass("open");
    el = $(this);
    id = $("#origin").attr('data-id');
    id++;
    $("#origin").attr('data-id',id);
    $("#origin #key-title").replaceWith("<input id=key-title style='outline: none;border: 0;border-bottom: 1px solid #ddd;width: 60px;'/>");
    $("#origin #key-title").attr('name','k' + id);
    $("#origin .dropdown").attr('data-id',id);
    clone = $("#origin").html( );

    $("#origin #key-title").replaceWith("<span id=key-title></span>");

    event.preventDefault();
    var container = $('#contact-attributes-container');
    container.append(clone);

});
EO_SCRIPT;

$choose_contact_attributes_script = <<<EO_SCRIPT
$(document).on('click', '.js-choose-contact', function(event){
    event.preventDefault();
    el = $(this);
    new_value = el.attr('data-id');
    el.closest("#clone").find("#key-title").replaceWith("<span id=key-title>"+new_value+"</span>");
});

$(document).on('click', '.js-choose-other-contact', function(event){
    event.preventDefault();
    el = $(this);
    new_value = el.attr('data-id');
    el.closest("#clone").find("#key-title").replaceWith("<input id=key-title style='outline: none;border: 0;border-bottom: 1px solid #ddd;width: 60px;'/>");
});
EO_SCRIPT;

$submit_info_script = <<<EO_SCRIPT
$(document).on('click', '#js-submit-contact', function(event){
    event.preventDefault();
    var url = '/contact/createbyjson';
    json_contact = { };
    owner_id = "{$model->id}";
    no = $("#origin").attr('data-id');
    for(var i = 1;i <= no;i++){
        key = $("#clone[data-id='"+i+"'] #key-title").val();
        if(key == "")key = $("#clone[data-id='"+i+"'] #key-title").html();
        value = $("#clone[data-id='"+i+"'] #value").val();
        json_contact[key] = value; 
    }
    $.post(url,{json_contact:json_contact}, function(data){
        if(data.status){
           $('#new-contact-modal').modal('hide');
           $('#contact-container').append(data.item);
        }
    },'json');
});
EO_SCRIPT;
Yii::app()->clientScript->registerScript('add_information_attributes', $add_contact_attributes_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('choose_information_attributes', $choose_contact_attributes_script, CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('submit_info', $submit_info_script, CClientScript::POS_READY);
?>

<?

    $cancel_add_contact_script = <<<EO_SCRIPT
$(document).on('click', '#js-cancel-add-contact', function(event){
    event.preventDefault();
    $("#new-contact-modal").modal('hide');
});
EO_SCRIPT;

Yii::app()->clientScript->registerScript('cancel_add_contact', $cancel_add_contact_script, CClientScript::POS_READY);
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact-form',
    'action'=>$model->isNewRecord? '/contact/create' : "/contact/update/id/{$model->id}",
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>false,
        'validateOnType'=>false,
        'afterValidate'=>"js:function(form, data, hasError){
            if(data.status == true){
                $('#new-contact-modal').modal('hide');
                $('#contact-container').append(data.item);
                $('#add-contact-form-container').hide();
            }
        }"
    ),
)); ?>
    <?php echo $form->errorSummary($model); ?>
    <div id="contact-attributes-container">
    </div>

    <div class="dropdown">
        <a id="js-add-contact-attributes" data-toggle="dropdown" class="dropdown-toggle btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="choose-information-attributes">
            <? foreach(Util::getInfoList(true) as $key => $info){ ?>     
                    <? if($info == "Other"){ ?>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-add-other-contact">
                            <?= $info ?>
                        </a>
                    </li>
                    <? }else{ ?>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-add-contact">
                            <?= $info ?>
                        </a>
                    </li>
                    <? } ?>
            <? } ?>
        </ul>
    </div>  


<div id="origin" style="display:none" data-id="<?= count($json_info)?>">
        <div id="clone" class="dropdown" data-id="0">
            <div style="width:80px;float:left;text-align:right;margin-right:5px;">
                <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" style="text-decoration:none;color:black;"><span id="key-title"></span> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="text-align:left;">
                    <? foreach(Util::getInfoList(true) as $key => $info){ ?>
                         <? if($info == "Other"){ ?>
                            <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-choose-other-contact">
                                <?= $info ?>
                            </a>
                            </li>
                            <? }else{ ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#" data-id="<?= $key ?>" class="js-choose-contact">
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

    <?php echo $form->hiddenField($model,'owner_id'); ?>
    <br/>
    <div class="input-row buttons">
        <button id="js-submit-contact" class="btn btn-info btn-sm">Save</button>
        <button id="js-cancel-add-contact" class="btn btn-info btn-sm">Cancel</button>
    </div>
    <br/>
<?php $this->endWidget(); ?>

</div><!-- form -->
