<?php
/**
 * Inserts the javascript code to validate the form.
 *
 */

/* javascript validation */
/* load email check  JS */

/* Properties
 *
 * &cssPath string
 *      default: MODX_ASSETS_PATH .components/subscribe/css/ 
 *  &cssFile string
 *      default: subscribe.css
 *  &jsPath string
*      default: MODX_ASSETS_PATH .components/subscribe/js/
 *  &jsFile string default: emailcheck.js
 *  &language string default: en
 * */

/* @var $modx modX */

$sp =& $scriptProperties;

if ($sp['cssFile'] == 'none') {
    $useCss = false;
} else {
    $useCss = true;
    $cssPath = $modx->getOption('cssPath', $sp, null);
    $cssPath = empty($cssPath)
        ? MODX_ASSETS_URL . 'components/subscribe/css/'
        : $cssPath;

    $cssFile = $modx->getOption('cssFile', $sp, null);
    $cssFile = empty($cssFile)
        ? 'subscribe.css'
        : $cssFile;
}

$jsPath = $modx->getOption('jsPath', $sp, null);
$jsPath = empty($jsPath)
    ? MODX_ASSETS_URL . 'components/subscribe/js/'
    : $jsPath;

$jsFile = $modx->getOption('jsFile', $sp, null);
$jsFile = empty($jsFile)
    ? 'emailcheck.js'
    : $jsFile;

if ($useCss) {
    $inFile = $cssPath . $cssFile;
    $modx->regClientCSS($inFile);
}

$inFile = $jsPath . $jsFile;
$modx->regClientStartupScript($inFile);


if (!empty($scriptProperties['language'])) {
    $modx->setOption('cultureKey', $scriptProperties['language']);
}
$language = !empty($scriptProperties['language'])
    ? $scriptProperties['language']
    : $modx->getOption('cultureKey', null, $modx->getOption('manager_language', null, 'en'));
$language = empty($language) ? 'en' : $language;

$modx->lexicon->load($language . ':subscribe:default');
$fields = array();
$fields['sbs_username_required'] = $modx->lexicon('sbs_username_required');
$fields['sbs_username_too_short'] = $modx->lexicon('sbs_username_too_short');
$fields['sbs_password_required'] = $modx->lexicon('sbs_password_required');
$fields['sbs_password_too_short'] = $modx->lexicon('sbs_password_too_short');
$fields['sbs_password_mismatch'] = $modx->lexicon('sbs_password_mismatch');
$fields['sbs_email_required'] = $modx->lexicon('sbs_email_required');
$fields['sbs_bad_email'] = $modx->lexicon('sbs_bad_email');
$fields['sbs_fullname_required'] = $modx->lexicon('sbs_fullname_required');
$fields['sbs_interests_required'] = $modx->lexicon('sbs_interests_required');


$src = $modx->getChunk('SbsRegisterJsTpl', $fields);

$modx->regClientStartupScript($src);

return '';