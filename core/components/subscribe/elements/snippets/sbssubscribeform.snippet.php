<?php
/**
 * Subscribe
 * Copyright 2012-2022 Bob Ray <https://bobsguides/com>
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

/* Properties (note these should be set as System Settings)
 *
 *
 * &confirmRegisterPageId int (required) ID of ConfirmRegister resource
 *     default: empty
 *
 * &thankYouPageId int (required) ID of Thank You for Registering page
 *     default: empty
 *
 * &sbsCssPath string
 *      default: {assets_url}components/subscribe/css/
 *
 *  &sbsCssFile string
 *      default: subscribe.css
 *
 *  &sbsJsPath string
 *      default:  {assets_url}components/subscribe/js/
 *
 *  &sbsJsFile string
 *      default: subscribe.js
 *  &activationEmailTpl string Name of activation email Tpl chunk
 *      default: activatEmailTpl
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


$sp =& $scriptProperties;
//return 'test';
/* don't allow manage preferences if user is not logged in */
if ($sp['form'] == 'managePrefs') {
    if (!$modx->user->hasSessionContext($modx->context->get('key'))) {
        $modx->sendUnauthorizedPage();
    }
}
$assetsUrl = $modx->getOption('subscribe.assets_url', $sp, MODX_ASSETS_URL);
$cssPath = $modx->getOption('sbsCssPath',$sp, $assetsUrl  . '/components/subscribe/css/');
$cssFile = $modx->getOption('sbsCssFile', $sp, null);
$cssFile = empty($cssFile) ? 'subscribe.css' : $cssFile;
/* load CSS file unless &sbsCssPath or &sbsCssFile is set to 'none' */
if ($cssFile != 'none') {
    $modx->regClientCSS($cssPath . $cssFile);
}

/* load language strings */
$language = !empty($scriptProperties['language'])
    ? $scriptProperties['language']
    : $modx->getOption('cultureKey', null, 'en', true);

$modx->lexicon->load($language . ':subscribe:forms');

$s = $modx->lexicon->fetch($prefix = 'sbs_js_', $removePrefix = false);
$sj = $modx->toJSON($s);
$modx->setPlaceholder('sbs_lexicon_json', $sj);

/* load JS file */

$jsPath = $modx->getOption('sbsJsPath',$sp, $assetsUrl . 'components/subscribe/js/');
$jsFile = $modx->getOption('sbsJsFile', $sp, null);
$jsFile = empty($jsFile) ? 'subscribe-min.js' : $jsFile;

if ($jsFile != 'none' && $jsFile != 'None') {
    $modx->regClientStartupScript($jsPath . $jsFile);
}

$corePath = $modx->getOption('subscribe.core_path',$sp,$modx->getOption('core_path',null,MODX_CORE_PATH).'components/subscribe/');
require_once($corePath . 'model/subscribe/checkboxes.class.php');


$output = '';
$prefs = new CheckBoxes($modx, $sp);
if (isset($_POST) && !empty($_POST) ) {
    $prefs->cleanse($_POST);  /* sanitize $_POST */
}

if (isset($hook) && ($sp['form'] == 'register')) {
    /* We're acting as a register postHook - no display, definitely a repost */
    $prefs->init($hook->getValue('register.user'), $hook->getValue('register.profile'), true);
    if (!$prefs->saveUserPrefs()) {
        die('Failed to save prefs');
    }
    $output = true;

} elseif ($sp['form'] == 'register') {
        /* Acting as Register form - not a repost */
        /** @var $profile  modUserProfile*/
        $profile = $modx->user->getOne('Profile');
        $prefs->init($modx->user, $profile);
        $prefs->createDisplay('register');
        $modx->setPlaceholder('sbs_username', $modx->user->get('username'));

} elseif ($sp['form'] == 'managePrefs') {
    /* Acting as Manage Prefs form - may or may not be a repost */

    if (!$modx->user->hasSessionContext($modx->context->get('key'))) {
        return $modx->lexicon('sbs_not_logged_in_error_message');
    }

    $prefs = new CheckBoxes($modx, $sp);
    $profile = $modx->user->getOne('Profile');
    $prefs->init($modx->user, $profile, false, true);
    $modx->setPlaceholder('sbs_username', $modx->user->get('username'));
    $prefs->saveUserPrefs();

    /* Check for Repost */
    if (isset($_POST['unsubscribe']) && ($_POST['unsubscribe'] == 'sbs_unsubscribe')) {
        if ($modx->user->get('username') == '(anonymous)' || $modx->user->get('id') == '1') {
            $modx->setPlaceholder('sbs_error_message', $modx->lexicon('sbs_anon_admin_error'));
        } else {
            $modx->user->set('active', '0');
            if ($modx->user->save()) {
                $modx->setPlaceholder('sbs_success_message', $modx->lexicon('sbs_unsubscribe_success_message'));
            } else {
                $modx->setPlaceholder('sbs_error_message', $modx->lexicon('sbs_unsubscribe_failure_message'));

            }
        }
    }
    $prefs->createDisplay('manage_prefs');

} else {
        die('Unauthorized Access');
}

return $output;