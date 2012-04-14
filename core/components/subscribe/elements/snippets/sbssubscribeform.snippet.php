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
 * &confirmRegisterPageId int (required) ID of ConfirmRegister resource
 *     default: empty
 *
 * &thankYouPageId int (required) ID of Thank You for Registering page
 *     default: empty
 *
 * &cssPath string
 *      default: MODX_ASSETS_PATH .components/subscribe/css/
 *
 *  &cssFile string
 *      default: subscribe.css
 *
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
$cssPath = $modx->getOption('cssPath',$sp, $assetsUrl) . 'css/';
$cssFile = $modx->getOption('cssFile', $sp, null);
$cssFile = empty($cssFile) ? 'subscribe.css' : $cssFile;
/* load CSS file unless &cssPath or &cssFile is set to 'none' */
if ($cssFile != 'none') {
    $modx->regClientCSS($cssPath . $cssFile);
}

/*if ($sp['cssPath'] == 'none' || $sp['cssFile'] == 'none') {
    $css = false;
} else {
    $cssPath = $modx->getOption('cssPath', $sp, null);
    $cssPath = empty($cssPath)
        ? MODX_ASSETS_URL . 'components/subscribe/css/'
        : $cssPath;

    $cssFile = $modx->getOption('cssFile', $sp, null);
    $cssFile = empty($cssFile)
        ? 'subscribe.css'
        : $cssFile;

    $css = $cssPath . $cssFile;
}*/
//echo "Css: $css<br />";

if ($css) {
    $modx->regClientCSS($css);
}

/* load language strings */
$language = !empty($scriptProperties['language'])
    ? $scriptProperties['language']
    : $modx->getOption('cultureKey', null, $modx->getOption('manager_language', null, 'en'));
$language = empty($language) ? 'en' : $language;
$modx->lexicon->load($language . ':subscribe:forms');

$s = $modx->lexicon->fetch($prefix = 'sbs_js_', $removePrefix = false);
$sj = $modx->toJSON($s);
$modx->setPlaceholder('sbs_lexicon_json', $sj);
//echo "Loading JS\n";
/* load JS file */

$jsPath = $modx->getOption('jsPath',$sp, $assetsUrl) . 'js/';
$jsFile = $modx->getOption('jsFile', $sp, null);
$jsFile = empty($jsFile) ? 'subscribe.js' : $jsFile;
$modx->regClientStartupScript($jsPath . $jsFile);

/*$jsPath = $modx->getOption('jsPath', $sp, null);
$jsPath = empty($jsPath)
    ? MODX_ASSETS_URL . 'components/subscribe/js/'
    : $jsPath;

$jsFile = $modx->getOption('jsFile', $sp, null);
$jsFile = empty($jsFile)
    ? 'subscribe.js'
    : $jsFile;*/

//echo "JS: " . $jsPath . $jsFile . "<br />";
//$modx->regClientStartupScript($jsPath . $jsFile);
//return "Done with snippet\n";
$corePath = $modx->getOption('subscribe.core_path',$sp,$modx->getOption('core_path',null,MODX_CORE_PATH).'components/subscribe/');
require_once($corePath . 'model/subscribe/checkboxes.class.php');
//require_once('c:/xampp/htdocs/addons/assets/mycomponents/subscribe/core/components/subscribe/model/subscribe/checkboxes.class.php');

/* ToDo: Sanitize MODX tags in post */
/* ToDo: Make sure admin and (anonymous) can't set prefs */
/* ToDo: Make these system settings  */
$sp['method'] = 'comment';
$sp['fieldName'] = 'interests';
$sp['extendedField'] = 'delights';
$output = '';


if ($hook && ($sp['form'] == 'register')) {
    /* We're acting as a register postHook */
    $prefs = new CheckBoxes($modx, $sp);
    $prefs->init($hook->getValue('register.user'), $hook->getValue('register.profile'), true);
    if (!$prefs->saveUserPrefs()) {
        /* ToDo: move this to checkboxes class */
        die('Failed to save prefs');
    }
    $output = true;

} elseif ($sp['form'] == 'register') {
        $sp['markCurrent'] = false;

        $prefs = new CheckBoxes($modx, $sp);
        $profile = $modx->user->getOne('Profile');
        $prefs->init($modx->user, $profile);
        $prefs->createDisplay('sbs_interest_list');
        $modx->setPlaceholder('sbs_username', $modx->user->get('username'));

} elseif ($sp['form'] == 'managePrefs') {

    if (!$modx->user->hasSessionContext($modx->context->get('key'))) {
        return $modx->lexicon('sbs_not_logged_in_error_message');
    }
    $sp['markCurrent'] = true;
    $prefs = new CheckBoxes($modx, $sp);
    $profile = $modx->user->getOne('Profile');
    $prefs->init($modx->user, $profile);
    $modx->setPlaceholder('sbs_username', $modx->user->get('username'));
    $prefs->saveUserPrefs();

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
    $prefs->createDisplay('sbs_current_prefs');

} else {
        die('Unauthorized Access');
}


//$output = str_replace('[[+sbs_interest_list]]', $intsPh, $output);
return $output;