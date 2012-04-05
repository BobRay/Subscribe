<?php
if (!$modx->user->hasSessionContext($modx->context->get('key'))) {
    $modx->sendUnauthorizedPage();
}
$language = !empty($scriptProperties['language'])
    ? $scriptProperties['language']
    : $modx->getOption('cultureKey', null, $modx->getOption('manager_language', null, 'en'));
$language = empty($language) ? 'en' : $language;

$modx->lexicon->load($language . ':subscribe:default');

$modx->setPlaceholder('sm_interests_required', $modx->lexicon('sm_interests_required'));

$profile = $modx->user->getOne('Profile');

$modx->setPlaceholder('username', $modx->user->get('username'));
if ($profile) {

    $prefs = $profile->get('comment');

    $modx->setPlaceholder('currentPrefs', $prefs);

}

return '';