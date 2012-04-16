<?php

$settings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1] ->fromArray(array(
    'id' => 1,
    'key' => 'sbs_register_page_id',
    'value' => '326',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2] ->fromArray(array(
    'id' => 2,
    'key' => 'sbs_login_page_id',
    'value' => '108',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3] ->fromArray(array(
    'id' => 3,
    'key' => 'sbs_confirm_register_page_id',
    'value' => '331',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[4] = $modx->newObject('modSystemSetting');
$systemSettings[4] ->fromArray(array(
    'id' => 4,
    'key' => 'sbs_manage_prefs_page_id',
    'value' => '327',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[5] = $modx->newObject('modSystemSetting');
$systemSettings[5] ->fromArray(array(
    'id' => 5,
    'key' => 'sbs_registration_confirmed_page_id',
    'value' => '331',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[6] = $modx->newObject('modSystemSetting');
$systemSettings[6] ->fromArray(array(
    'id' => 6,
    'key' => 'sbs_thank_you_page_id',
    'value' => '329',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[7] = $modx->newObject('modSystemSetting');
$systemSettings[7] ->fromArray(array(
    'id' => 7,
    'key' => 'sbs_method',
    'value' => 'comment',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[8] = $modx->newObject('modSystemSetting');
$systemSettings[8] ->fromArray(array(
    'id' => 8,
    'key' => 'sbs_field_name',
    'value' => 'interests',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[9] = $modx->newObject('modSystemSetting');
$systemSettings[9] ->fromArray(array(
    'id' => 9,
    'key' => 'sbs_extended_field',
    'value' => 'interests',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
return $systemSettings;