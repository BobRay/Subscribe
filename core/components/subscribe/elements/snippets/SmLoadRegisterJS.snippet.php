<?php
/**
 * Inserts the javascript code to validate the form.
 *
 */

/* javascript validation */
/* load email check  JS */
/* @var $modx modX */
$inFile = $modx->getOption('assets_url') . "components/subscribe/js/emailcheck.js";
$modx->regClientStartupScript($inFile);

$inFile = $modx->getOption('assets_url') . "components/subscribe/css/subscribe.css";
$modx->regClientCSS($inFile);



if (!empty($scriptProperties['language'])) {
    $modx->setOption('cultureKey', $scriptProperties['language']);
}
$language = !empty($scriptProperties['language'])
    ? $scriptProperties['language']
    : $modx->getOption('cultureKey', null, $modx->getOption('manager_language', null, 'en'));
$language = empty($language) ? 'en' : $language;

$modx->lexicon->load($language . ':subscribe:default');
$fields = array();
$fields['sm_username_required'] = $modx->lexicon('sm_username_required');
$fields['sm_username_too_short'] = $modx->lexicon('sm_username_too_short');
$fields['sm_password_required'] = $modx->lexicon('sm_password_required');
$fields['sm_password_too_short'] = $modx->lexicon('sm_password_too_short');
$fields['sm_password_mismatch'] = $modx->lexicon('sm_password_mismatch');
$fields['sm_email_required'] = $modx->lexicon('sm_email_required');
$fields['sm_bad_email'] = $modx->lexicon('sm_bad_email');
$fields['sm_fullname_required'] = $modx->lexicon('sm_fullname_required');
$fields['sm_interests_required'] = $modx->lexicon('sm_interests_required');


$src = $modx->getChunk('SmRegisterJS', $fields);

$modx->regClientStartupScript($src);

return '';