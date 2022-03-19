<?php
/**
 * chunks transport file for Subscribe extra
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
/* @var xPDOObject[] $chunks */


$chunks = array();

$chunks[1] = $modx->newObject('modChunk');
$chunks[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'sbsPrivacyDialogTextTpl',
  'description' => 'Text for Subscribe Privacy Policy dialog',
  'properties' => NULL,
), '', true, true);
$chunks[1]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsprivacydialogtexttpl.chunk.html'));

$chunks[2] = $modx->newObject('modChunk');
$chunks[2]->fromArray(array (
  'id' => 2,
  'property_preprocess' => false,
  'name' => 'sbsWhyDialogTpl',
  'description' => '',
  'properties' => NULL,
), '', true, true);
$chunks[2]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbswhydialogtpl.chunk.html'));

$chunks[3] = $modx->newObject('modChunk');
$chunks[3]->fromArray(array (
  'id' => 3,
  'property_preprocess' => false,
  'name' => 'sbsPrivacyDialogTpl',
  'description' => 'Subscribe Tpl chunk for Privacy Policy dialog',
  'properties' => NULL,
), '', true, true);
$chunks[3]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsprivacydialogtpl.chunk.html'));

$chunks[4] = $modx->newObject('modChunk');
$chunks[4]->fromArray(array (
  'id' => 4,
  'property_preprocess' => false,
  'name' => 'sbsLoggedOutDisplayTpl',
  'description' => 'Subscribe extra display for users who are not logged in',
  'properties' => NULL,
), '', true, true);
$chunks[4]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsloggedoutdisplaytpl.chunk.html'));

$chunks[5] = $modx->newObject('modChunk');
$chunks[5]->fromArray(array (
  'id' => 5,
  'property_preprocess' => false,
  'name' => 'sbsLoggedInDisplayTpl',
  'description' => 'Displays Logout and Manage Preferences buttons for Subscribe extra',
  'properties' => NULL,
), '', true, true);
$chunks[5]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsloggedindisplaytpl.chunk.html'));

$chunks[6] = $modx->newObject('modChunk');
$chunks[6]->fromArray(array (
  'id' => 6,
  'property_preprocess' => false,
  'name' => 'sbsRegisterFormTpl',
  'description' => '',
  'properties' => 
  array (
  ),
), '', true, true);
$chunks[6]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsregisterformtpl.chunk.html'));

$chunks[7] = $modx->newObject('modChunk');
$chunks[7]->fromArray(array (
  'id' => 7,
  'property_preprocess' => false,
  'name' => 'sbsPrefListTpl',
  'description' => '',
  'properties' => NULL,
), '', true, true);
$chunks[7]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbspreflisttpl.chunk.html'));

$chunks[8] = $modx->newObject('modChunk');
$chunks[8]->fromArray(array (
  'id' => 8,
  'property_preprocess' => false,
  'name' => 'sbsGroupListTpl',
  'description' => '',
  'properties' => NULL,
), '', true, true);
$chunks[8]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsgrouplisttpl.chunk.html'));

$chunks[9] = $modx->newObject('modChunk');
$chunks[9]->fromArray(array (
  'id' => 9,
  'property_preprocess' => false,
  'name' => 'sbsCheckboxTpl',
  'description' => '',
  'properties' => NULL,
), '', true, true);
$chunks[9]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbscheckboxtpl.chunk.html'));

$chunks[10] = $modx->newObject('modChunk');
$chunks[10]->fromArray(array (
  'id' => 10,
  'property_preprocess' => false,
  'name' => 'sbsManagePrefsFormTpl',
  'description' => '',
  'properties' => NULL,
), '', true, true);
$chunks[10]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsmanageprefsformtpl.chunk.html'));

$chunks[11] = $modx->newObject('modChunk');
$chunks[11]->fromArray(array (
  'id' => 11,
  'property_preprocess' => false,
  'name' => 'sbsActivationEmailTpl',
  'description' => '',
  'properties' => NULL,
), '', true, true);
$chunks[11]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsactivationemailtpl.chunk.html'));

$chunks[12] = $modx->newObject('modChunk');
$chunks[12]->fromArray(array (
  'id' => 12,
  'property_preprocess' => false,
  'name' => 'sbsWhyDialogTextTpl',
  'description' => 'Text for Subscribe Why Dialog',
  'properties' => NULL,
), '', true, true);
$chunks[12]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbswhydialogtexttpl.chunk.html'));

$chunks[13] = $modx->newObject('modChunk');
$chunks[13]->fromArray(array (
  'id' => 13,
  'property_preprocess' => false,
  'name' => 'sbsUserNotFoundTpl',
  'description' => '',
  'properties' => NULL,
), '', true, true);
$chunks[13]->setContent(file_get_contents($sources['source_core'] . '/elements/chunks/sbsusernotfoundtpl.chunk.html'));

return $chunks;
