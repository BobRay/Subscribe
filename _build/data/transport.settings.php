<?php
/**
 * Subscribe
 * Copyright 2012-2017 Bob Ray <https://bobsguides/com>
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
 * @author Bob Ray <https://bobsguides/com>
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

$systemSettings = array();

        $systemSettings[1] = $modx->newObject('modSystemSetting');
        $systemSettings[1] ->fromArray(array(
            'id' => 1,
            'key' => 'sbs_register_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[2] = $modx->newObject('modSystemSetting');
        $systemSettings[2] ->fromArray(array(
            'id' => 2,
            'key' => 'sbs_login_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[3] = $modx->newObject('modSystemSetting');
        $systemSettings[3] ->fromArray(array(
            'id' => 3,
            'key' => 'sbs_confirm_register_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[4] = $modx->newObject('modSystemSetting');
        $systemSettings[4] ->fromArray(array(
            'id' => 4,
            'key' => 'sbs_manage_prefs_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[5] = $modx->newObject('modSystemSetting');
        $systemSettings[5] ->fromArray(array(
            'id' => 5,
            'key' => 'sbs_registration_confirmed_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[6] = $modx->newObject('modSystemSetting');
        $systemSettings[6] ->fromArray(array(
            'id' => 6,
            'key' => 'sbs_thank_you_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);



$systemSettings[7] = $modx->newObject('modSystemSetting');
$systemSettings[7] ->fromArray(array(
    'id' => 7,
    'key' => 'prefListTpl',
    'value' => 'sbsPrefListTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[8] = $modx->newObject('modSystemSetting');
$systemSettings[8]->fromArray(array(
   'id' => 8,
   'key' => 'groupListTpl',
   'value' => 'sbsGroupListTpl',
   'xtype' => 'textfield',
   'namespace' => 'subscribe',
   'area' => 'subscribe',
), '', true, true);


$systemSettings[9] = $modx->newObject('modSystemSetting');
$systemSettings[9] ->fromArray(array(
    'id' => 9,
    'key' => 'checkboxTpl',
    'value' => 'sbsCheckboxTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);


$systemSettings[10] = $modx->newObject('modSystemSetting');
$systemSettings[10] ->fromArray(array(
    'id' => 10,
    'key' => 'loggedOutDisplayTpl',
    'value' => 'sbsLoggedOutDisplayTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[11] = $modx->newObject('modSystemSetting');
$systemSettings[11] ->fromArray(array(
    'id' => 11,
    'key' => 'loggedInDisplayTpl',
    'value' => 'sbsLoggedInDisplayTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[12] = $modx->newObject('modSystemSetting');
$systemSettings[12] ->fromArray(array(
    'id' => 12,
    'key' => 'whyDialogTpl',
    'value' => 'sbsWhyDialogTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[13] = $modx->newObject('modSystemSetting');
$systemSettings[13] ->fromArray(array(
    'id' => 13,
    'key' => 'whyDialogTextTpl',
    'value' => 'sbsWhyDialogTextTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[14] = $modx->newObject('modSystemSetting');
$systemSettings[14] ->fromArray(array(
    'id' => 14,
    'key' => 'privacyDialogTpl',
    'value' => 'sbsPrivacyDialogTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);
$systemSettings[15] = $modx->newObject('modSystemSetting');
$systemSettings[15] ->fromArray(array(
    'id' => 15,
    'key' => 'privacyDialogTextTpl',
    'value' => 'sbsPrivacyDialogTextTpl',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[16] = $modx->newObject('modSystemSetting');
$systemSettings[16] ->fromArray(array(
    'id' => 16,
    'key' => 'sbsCssPath',
    'value' => '{assets_url}components/subscribe/css/',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[17] = $modx->newObject('modSystemSetting');
$systemSettings[17] ->fromArray(array(
    'id' => 17,
    'key' => 'sbsCssFile',
    'value' => 'subscribe.css',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[18] = $modx->newObject('modSystemSetting');
$systemSettings[18] ->fromArray(array(
    'id' => 18,
    'key' => 'sbsJsPath',
    'value' => '{assets_url}components/subscribe/js/',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[19] = $modx->newObject('modSystemSetting');
$systemSettings[19] ->fromArray(array(
    'id' => 19,
    'key' => 'sbsJsFile',
    'value' => 'subscribe.js',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);


$systemSettings[20] = $modx->newObject('modSystemSetting');
$systemSettings[20] ->fromArray(array(
    'id' => 20,
    'key' => 'sbs_use_comment_field',
    'value' => '1',
    'xtype' => 'combo-boolean',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[21] = $modx->newObject('modSystemSetting');
$systemSettings[21] ->fromArray(array(
    'id' => 21,
    'key' => 'sbs_extended_field',
    'value' => 'interests',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[22] = $modx->newObject('modSystemSetting');
$systemSettings[22] ->fromArray(array(
    'id' => 22,
    'key' => 'language',
    'value' => 'en',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
),'',true,true);

$systemSettings[23] = $modx->newObject('modSystemSetting');
$systemSettings[23]->fromArray(array(
    'id' => 23,
    'key' => 'sbs_secret_key',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
), '', true, true);
$systemSettings[24] = $modx->newObject('modSystemSetting');
$systemSettings[24]->fromArray(array(
   'id' => 24,
   'key' => 'sbs_unsubscribe_page_id',
   'value' => '999',
   'xtype' => 'textfield',
   'namespace' => 'subscribe',
   'area' => 'subscribe',
), '', true, true);

$systemSettings[25] = $modx->newObject('modSystemSetting');
$systemSettings[25]->fromArray(array(
    'id' => 25,
    'key' => 'sbs_user_roles',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
), '', true, true);

$systemSettings[26] = $modx->newObject('modSystemSetting');
$systemSettings[26]->fromArray(array(
    'id' => 26,
    'key' => 'sbs_show_interests',
    'value' => true,
    'xtype' => 'combo-boolean',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
), '', true, true);

$systemSettings[27] = $modx->newObject('modSystemSetting');
$systemSettings[27]->fromArray(array(
    'id' => 27,
    'key' => 'sbs_show_groups',
    'value' => false,
    'xtype' => 'combo-boolean',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
), '', true, true);

$systemSettings[28] = $modx->newObject('modSystemSetting');
$systemSettings[28]->fromArray(array(
    'id' => 28,
    'key' => 'sbs_field_name',
    'value' => 'interests',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
), '', true, true);

$systemSettings[29] = $modx->newObject('modSystemSetting');
$systemSettings[29]->fromArray(array(
    'id' => 29,
    'key' => 'sbs_groups_field_name',
    'value' => 'groups',
    'xtype' => 'textfield',
    'namespace' => 'subscribe',
    'area' => 'subscribe',
), '', true, true);


return $systemSettings;