<?php
/**
 * Subscribe
 * Copyright 2012 Bob Ray <http://bobsguides/com>
 *
 * Subscribe is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * Subscribe is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Subscribe; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package subscribe
 * @author Bob Ray <http://bobsguides/com>
 *
 * 3/5/12
 *
 * @Description: Installs System Settings that are  *not* set in install script */


/**
  * @package subscribe
  * @subpackage build
*/

$settings = array();
/* @var $modx modX */


$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1] ->fromArray(array(
    'id' => 1,
    'key' => 'prefListTpl',
    'value' => 'sbsPrefListTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2] ->fromArray(array(
    'id' => 2,
    'key' => 'checkboxTpl',
    'value' => 'sbsCheckboxTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);


$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3] ->fromArray(array(
    'id' => 3,
    'key' => 'loggedOutDisplayTpl',
    'value' => 'sbsLoggedOutDisplayTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[4] = $modx->newObject('modSystemSetting');
$systemSettings[4] ->fromArray(array(
    'id' => 4,
    'key' => 'loggedInDisplayTpl',
    'value' => 'sbsLoggedInDisplayTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[5] = $modx->newObject('modSystemSetting');
$systemSettings[5] ->fromArray(array(
    'id' => 5,
    'key' => 'whyDialogTpl',
    'value' => 'sbsWhyDialogTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[6] = $modx->newObject('modSystemSetting');
$systemSettings[6] ->fromArray(array(
    'id' => 6,
    'key' => 'whyDialogTextTpl',
    'value' => 'sbsWhyDialogTextTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[7] = $modx->newObject('modSystemSetting');
$systemSettings[7] ->fromArray(array(
    'id' => 7,
    'key' => 'privacyDialogTpl',
    'value' => 'sbsPrivacyDialogTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[8] = $modx->newObject('modSystemSetting');
$systemSettings[8] ->fromArray(array(
    'id' => 8,
    'key' => 'privacyDialogTextTpl',
    'value' => 'sbsPrivacyDialogTextTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[9] = $modx->newObject('modSystemSetting');
$systemSettings[9] ->fromArray(array(
    'id' => 9,
    'key' => 'cssPath',
    'value' => '{assets_url}components/subscribe/css/',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[10] = $modx->newObject('modSystemSetting');
$systemSettings[10] ->fromArray(array(
    'id' => 10,
    'key' => 'cssFile',
    'value' => 'subscribe.css',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[11] = $modx->newObject('modSystemSetting');
$systemSettings[11] ->fromArray(array(
    'id' => 11,
    'key' => 'jsPath',
    'value' => '{assets_url}components/subscribe/js/',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[12] = $modx->newObject('modSystemSetting');
$systemSettings[12] ->fromArray(array(
    'id' => 12,
    'key' => 'jsFile',
    'value' => 'subscribe.js',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);



$systemSettings[13] = $modx->newObject('modSystemSetting');
$systemSettings[13] ->fromArray(array(
    'id' => 13,
    'key' => 'sbs_use_comment_field',
    'value' => '1',
    'xtype' => 'combo-boolean',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[14] = $modx->newObject('modSystemSetting');
$systemSettings[14] ->fromArray(array(
    'id' => 14,
    'key' => 'sbs_extended_field',
    'value' => 'interests',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[15] = $modx->newObject('modSystemSetting');
$systemSettings[15] ->fromArray(array(
    'id' => 15,
    'key' => 'language',
    'value' => 'en',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);


return $systemSettings;