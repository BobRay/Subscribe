<?php
/**
 * systemSettings transport file for Subscribe extra
 *
 * Copyright 2012-2014 Bob Ray <https://bobsguides.com>
 * Created on 03-17-2022
 *
 * @package subscribe
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'language',
  'value' => 'en',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Language',
  'description' => 'Language to use for Subscribe\' default: en',
), '', true, true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
  'key' => 'sbs_extended_field',
  'value' => 'interests',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Subscribe extended field',
  'description' => 'Name of field to store user prefs in user profile extended fields. Ignored unless useCommentField is set to \'no\'; default: interests',
), '', true, true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3]->fromArray(array (
  'key' => 'sbs_use_comment_field',
  'value' => '1',
  'xtype' => 'combo-boolean',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Use Comment Field',
  'description' => 'If set to \'Yes\' user preferences are stored in the comment field of the User Profile. If set to \'No\', prefs are stored as an extended field in the user profile in the field specified by the \'sbs_extended_field\' setting. Default: \'comment\'. The default setting (\'Yes\') is recommended unless you need the comment field for something else.',
), '', true, true);
$systemSettings[4] = $modx->newObject('modSystemSetting');
$systemSettings[4]->fromArray(array (
  'key' => 'sbsJsFile',
  'value' => 'subscribe.js',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'sbsJsFile',
  'description' => 'File name of Subscribe JS file; default: subscribe.js',
), '', true, true);
$systemSettings[5] = $modx->newObject('modSystemSetting');
$systemSettings[5]->fromArray(array (
  'key' => 'sbsJsPath',
  'value' => '{assets_url}components/subscribe/js/',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'sbsJsPath',
  'description' => 'Path to Subscribe JS file; default :{assets_url}components/subscribe/js/',
), '', true, true);
$systemSettings[6] = $modx->newObject('modSystemSetting');
$systemSettings[6]->fromArray(array (
  'key' => 'sbsCssFile',
  'value' => 'subscribe.css',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'sbsCssFile',
  'description' => 'File name of Subscribe CSS file; default: subscribe.css',
), '', true, true);
$systemSettings[7] = $modx->newObject('modSystemSetting');
$systemSettings[7]->fromArray(array (
  'key' => 'sbsCssPath',
  'value' => '{assets_url}components/subscribe/css/',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'sbsCssPath',
  'description' => 'Path to Subscribe CSS file; default :{assets_url}components/subscribe/css/',
), '', true, true);
$systemSettings[8] = $modx->newObject('modSystemSetting');
$systemSettings[8]->fromArray(array (
  'key' => 'privacyDialogTextTpl',
  'value' => 'sbsPrivacyDialogTextTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'privacyDialogTextTpl',
  'description' => 'Tpl to use for the text in the privacy Subscribe popup dialog; default: sbsPrivacyDialogTextTpl',
), '', true, true);
$systemSettings[9] = $modx->newObject('modSystemSetting');
$systemSettings[9]->fromArray(array (
  'key' => 'privacyDialogTpl',
  'value' => 'sbsPrivacyDialogTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'privacyDialogTpl',
  'description' => 'Outer Tpl to use for the privacy Subscribe popup dialog; default:sbsPrivacyDialogTpl',
), '', true, true);
$systemSettings[10] = $modx->newObject('modSystemSetting');
$systemSettings[10]->fromArray(array (
  'key' => 'whyDialogTextTpl',
  'value' => 'sbsWhyDialogTextTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'whyDialogTextTpl',
  'description' => 'Tpl to use for the text in the Why Subscribe popup dialog; default: sbsWhyDialogTextTpl',
), '', true, true);
$systemSettings[11] = $modx->newObject('modSystemSetting');
$systemSettings[11]->fromArray(array (
  'key' => 'whyDialogTpl',
  'value' => 'sbsWhyDialogTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'whyDialogTpl',
  'description' => 'Outer Tpl to use for the Why Subscribe popup dialog; default: sbsWhyDialogTpl',
), '', true, true);
$systemSettings[12] = $modx->newObject('modSystemSetting');
$systemSettings[12]->fromArray(array (
  'key' => 'loggedInDisplayTpl',
  'value' => 'sbsLoggedInDisplayTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'loggedInDisplayTpl',
  'description' => 'Tpl to use for the Subscribe logged-in display; default: sbsLoggedInDisplayTpl',
), '', true, true);
$systemSettings[13] = $modx->newObject('modSystemSetting');
$systemSettings[13]->fromArray(array (
  'key' => 'loggedOutDisplayTpl',
  'value' => 'sbsLoggedOutDisplayTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'loggedOutDisplayTpl',
  'description' => 'Tpl to use for the Subscribe logged-out display; default: sbsLoggedOutDisplayTpl',
), '', true, true);
$systemSettings[14] = $modx->newObject('modSystemSetting');
$systemSettings[14]->fromArray(array (
  'key' => 'checkboxTpl',
  'value' => 'sbsCheckboxTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'checkboxTpl',
  'description' => 'Outer Tpl to use for the list of user preferences; default: sbsCheckboxTpl',
), '', true, true);
$systemSettings[15] = $modx->newObject('modSystemSetting');
$systemSettings[15]->fromArray(array (
  'key' => 'groupListTpl',
  'value' => 'sbsGroupListTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'groupListTpl',
  'description' => 'Tpl to use for the list of user groups; default: sbsGroupListTpl',
), '', true, true);
$systemSettings[16] = $modx->newObject('modSystemSetting');
$systemSettings[16]->fromArray(array (
  'key' => 'prefListTpl',
  'value' => 'sbsPrefListTpl',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'prefListTpl',
  'description' => 'Tpl to use for the list of user preferences; default: sbsPrefListTpl',
), '', true, true);
$systemSettings[17] = $modx->newObject('modSystemSetting');
$systemSettings[17]->fromArray(array (
  'key' => 'sbs_thank_you_page_id',
  'value' => '999',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Thanks for Registering page ID',
  'description' => 'Resource ID of the Subscribe Thanks for Registering page (the page the user is sent to immediately after submitting the registration form); default: (set automatically)',
), '', true, true);
$systemSettings[18] = $modx->newObject('modSystemSetting');
$systemSettings[18]->fromArray(array (
  'key' => 'sbs_registration_confirmed_page_id',
  'value' => '999',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Registration Confirmed page ID',
  'description' => 'Resource ID of the Subscribe Registration Confirmed page (the page the user is sent to after clicking on the link in the registration email); default: (set automatically)',
), '', true, true);
$systemSettings[19] = $modx->newObject('modSystemSetting');
$systemSettings[19]->fromArray(array (
  'key' => 'sbs_manage_prefs_page_id',
  'value' => '999',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Manage Preferences page ID',
  'description' => 'Resource ID of the Subscribe Manage Preferences page; default: (set automatically)',
), '', true, true);
$systemSettings[20] = $modx->newObject('modSystemSetting');
$systemSettings[20]->fromArray(array (
  'key' => 'sbs_confirm_register_page_id',
  'value' => '999',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Subscribe Confirm Register page ID',
  'description' => 'Resource ID of the Subscribe Confirm Register page; default (set automatically)',
), '', true, true);
$systemSettings[21] = $modx->newObject('modSystemSetting');
$systemSettings[21]->fromArray(array (
  'key' => 'sbs_login_page_id',
  'value' => '999',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Login page ID',
  'description' => 'Resource ID of the Login page; default: (set automatically)',
), '', true, true);
$systemSettings[22] = $modx->newObject('modSystemSetting');
$systemSettings[22]->fromArray(array (
  'key' => 'sbs_register_page_id',
  'value' => '999',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Register page ID',
  'description' => 'Resource ID of the Subscribe Register page (with the registration form); default: (set automatically)',
), '', true, true);
$systemSettings[23] = $modx->newObject('modSystemSetting');
$systemSettings[23]->fromArray(array (
  'key' => 'sbs_secret_key',
  'value' => '',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Subscribe Secret Key (DO NOT CHANGE)',
  'description' => 'Subscribe Secret Key for unsubscribe link (DO NOT CHANGE)',
), '', true, true);
$systemSettings[24] = $modx->newObject('modSystemSetting');
$systemSettings[24]->fromArray(array (
  'key' => 'sbs_unsubscribe_page_id',
  'value' => '999',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Subscribe Unsubscribe page ID',
  'description' => 'Resource ID of the Subscribe Unsubscribe page; default (set automatically)',
), '', true, true);
$systemSettings[25] = $modx->newObject('modSystemSetting');
$systemSettings[25]->fromArray(array (
  'key' => 'sbs_user_roles',
  'value' => '',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Subscribe User Roles',
  'description' => 'User Roles for groups in the form: group1:Editor,group2:Publisher',
), '', true, true);
$systemSettings[26] = $modx->newObject('modSystemSetting');
$systemSettings[26]->fromArray(array (
  'key' => 'sbs_show_interests',
  'value' => true,
  'xtype' => 'combo-boolean',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Show Interests Section',
  'description' => 'If true, the Manage Preferences and Register forms will show the User Interests section; default: true',
), '', true, true);
$systemSettings[27] = $modx->newObject('modSystemSetting');
$systemSettings[27]->fromArray(array (
  'key' => 'sbs_show_groups',
  'value' => false,
  'xtype' => 'combo-boolean',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Show Groups Section',
  'description' => 'Field name to use for User Groups checkboxes; no need to change this unless there is a conflict with something else on the page; default: groups',
), '', true, true);
$systemSettings[28] = $modx->newObject('modSystemSetting');
$systemSettings[28]->fromArray(array (
  'key' => 'sbs_field_name',
  'value' => 'interests',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'Subscribe field name',
  'description' => 'Name of field to use in Subscribe forms for preference checkboxes; default: interests',
), '', true, true);
$systemSettings[29] = $modx->newObject('modSystemSetting');
$systemSettings[29]->fromArray(array (
  'key' => 'sbs_groups_field_name',
  'value' => 'groups',
  'xtype' => 'textfield',
  'namespace' => 'subscribe',
  'area' => 'subscribe',
  'name' => 'setting_sbs_groups_field_name',
  'description' => 'setting_sbs_groups_field_name_desc',
), '', true, true);
return $systemSettings;
