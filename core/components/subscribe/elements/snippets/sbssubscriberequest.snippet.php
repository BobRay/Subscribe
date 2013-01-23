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
 * @version Version 1.0.0 Beta-1
 * 3/3/12
 *
 * @Description Display request to subscribe unless user is admin or logged in */


/**
 * @version Version 1.0.0 Beta-1
 * @package subscribe
 */


/* Display request to subscribe unless user is admin or logged in */
/* @var $modx modX */
/* @var $scriptProperties array */

/* Properties
 *
 * &registerPageId int (required) ID of Subscribe register form
 *
 * managePrefsPageId int (required) ID of Manage Prererences page
 *
 * &login page ID int (required) ID of Login page
 *
 * &sbsCssPath string
 *      default: MODX_ASSETS_PATH .components/subscribe/css/
 *
 *  &sbsCssFile string
 *      default: subscribe.css
 *
 * &whyDialogTpl string Tpl chunk for Why Subscribe dialog
 *      default: sbsWhyDialogTpl
 *
 * &whyDialogTextTpl string Tpl chunk for Why dialog text
 *      default: sbsWhyDialogTextTpl
 *
 * &privacyDialogTpl string Tpl chunk for Privacy dialog
 *      default: sbsPrivacyDialogTpl
 *
 * &privacyDialogTextTpl string Tpl chunk for Privacy dialog text
 *      default: sbsPrivacyDialogTextTpl
 * 
 *  &language string language to use for buttons and messages
 *      default: en
 *
 * */
if (! function_exists('setSystemSettings')) {
function setSystemSettings(&$modx) {
    /* @var $modx modX */
    /* @var $parent modResource */
    $parent = $modx->getObject('modResource', array('alias' => 'subscribe-folder'));
    $parentId = 0;
    if ($parent) {
        $parentId = $parent->get('id');
    } else {
        $modx->log(MODX::LOG_LEVEL_ERROR, 'Failed to retrieve Parent with alias: subscribe-folder');
    }
    $settings = array(
        'sbs_login_page_id' =>'login',
        'sbs_confirm_register_page_id' => 'confirm-register',
        'sbs_manage_prefs_page_id' => 'manage-preferences',
        'sbs_register_page_id' => 'subscribe',
        'sbs_thank_you_page_id' => 'thanks-for-registering',
    );
    foreach ($settings as $key => $value) {
        /* @var $resObj modResource */
        /* @var $setting modSystemSetting */
        $resObj = $modx->getObject('modResource', array('alias' => $value));
        $setting = $modx->getObject('modSystemSetting', array('key' => $key));
        if (! $resObj) {
            $modx->log(MODX::LOG_LEVEL_ERROR, 'Failed to retrieve Resource with alias: ' . $value);
        }
        if (! $setting) {
            $modx->log(MODX::LOG_LEVEL_ERROR, 'Failed to retrieve System Setting with key: ' . $key);
        }
        if ($resObj && $setting && $parentId) {
            $resObj->set('parent',$parentId);
            $resObj->save();
            $setting->set('value', $resObj->get('id'));
            $setting->save();
        }
    }
}
}
$ss = $modx->getOption('sbs_login_page_id',null);

if ($ss == '999') {
    setSystemSettings($modx);
}
$sp =& $scriptProperties;
$docId = $modx->resource->get('id');

$assetsUrl = $modx->getOption('subscribe.assets_url', $sp, MODX_ASSETS_URL . 'components/subscribe/');
$cssPath = $modx->getOption('sbsCssPath',$sp, $assetsUrl . 'css/' ) ;
$cssFile = $modx->getOption('sbsCssFile', $sp, null);
$cssFile = empty($cssFile) ? 'subscribe.css' : $cssFile;
/* load CSS file unless &sbsCssPath or &sbsCssFile is set to 'none' */
if ($cssFile != 'none') {
    $modx->regClientCSS($cssPath . $cssFile);
}


/* by default, don't show on these pages */
$noShows = array(
    $modx->getOption('sbs_login_page_id',$sp,null),
    $modx->getOption('sbs_register_page_id',$sp,null),
    $modx->getOption('sbs_manage_prefs_page_id',$sp,null),
    $modx->getOption('sbs_thank_you_page_id',$sp,null),
    $modx->getOption('sbs_confirm_register_page_id',$sp,null),
);

/* add in other pages from &noShows property */
$noShows = empty( $sp['noShows'])? $noShows : array_merge($noShows, explode(',', $sp['noShows']));

/* load language strings */
$language = !empty($scriptProperties['language'])
    ? $scriptProperties['language']
    : $modx->getOption('cultureKey', null, $modx->getOption('manager_language', null, 'en'));
$language = empty($language) ? 'en' : $language;
$modx->lexicon->load($language . ':subscribe:default');

/* set Tpl chunks */

$loggedOutDisplayTpl = $modx->getOption('loggedOutDisplayTpl', $sp, null);
$loggedOutDisplayTpl = empty($loggedOutDisplayTpl) ? 'sbsLoggedOutDisplayTpl' : $loggedOutDisplayTpl;

$loggedInDisplayTpl = $modx->getOption('loggedInDisplayTpl', $sp, null);
$loggedInDisplayTpl = empty($loggedInDisplayTpl) ? 'sbsLoggedInDisplayTpl' : $loggedInDisplayTpl;

$whyDialogTpl = $modx->getOption('whyDialogTpl', $sp, null);
$whyDialogTpl = empty($whyDialogTpl) ? 'sbsWhyDialogTpl' : $whyDialogTpl;

$whyTextTpl = $modx->getOption('whyDialogTextTpl', $sp, null);
$whyTextTpl = empty($whyTextTpl) ? 'sbsWhyDialogTextTpl' : $whyTextTpl;

$privacyDialogTpl = $modx->getOption('privacyDialogTpl', $sp, null);
$privacyDialogTpl = empty($privacyDialogTpl) ? 'sbsPrivacyDialogTpl' : $privacyDialogTpl;

$privacyTextTpl = $modx->getOption('privacyTextTpl', $sp, null);
$privacyTextTpl = empty($privacyTextTpl) ? 'sbsPrivacyDialogTextTpl' : $privacyTextTpl;

/* see if user is logged in */
$loggedIn = $modx->user->hasSessionContext($modx->context->get('key'));

if (in_array($docId, $noShows)) {
    /* not showing anything */
    /* maintains page layout - remove if necessary */
    $output = '<br />';
} else {
    if ($loggedIn) {
        $output = $modx->getChunk($loggedInDisplayTpl);
    } else {
        /* Show logged out display */
        /* all set as placeholders in case user wants to move them elsewhere in template */
        $ph = array();
        $ph['why_dialog_button'] = $modx->getChunk($whyDialogTpl);
        $ph['why_dialog_text'] = $modx->getChunk($whyTextTpl);
        $ph['privacy_dialog_button'] = $modx->getChunk($privacyDialogTpl);
        $ph['privacy_dialog_text'] = $modx->getChunk($privacyTextTpl);

        $modx->toPlaceholders($ph,'sbs', '_');

        $output = $modx->getChunk($loggedOutDisplayTpl);
    }
}

return $output;