<?php
/**
 * snippets transport file for Subscribe extra
 *
 * Copyright 2012-2022 Bob Ray <https://bobsguides.com>
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
/* @var xPDOObject[] $snippets */


$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array (
  'id' => 1,
  'property_preprocess' => false,
  'name' => 'sbsInterestReport',
  'description' => 'Report on subscribers',
  'properties' => NULL,
), '', true, true);
$snippets[1]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/sbsinterestreport.snippet.php'));

$snippets[2] = $modx->newObject('modSnippet');
$snippets[2]->fromArray(array (
  'id' => 2,
  'property_preprocess' => false,
  'name' => 'sbsSubscribeForm',
  'description' => 'Creates the subscribe form',
  'properties' => 
  array (
  ),
), '', true, true);
$snippets[2]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/sbssubscribeform.snippet.php'));

$snippets[3] = $modx->newObject('modSnippet');
$snippets[3]->fromArray(array (
  'id' => 3,
  'property_preprocess' => false,
  'name' => 'sbsSubscribeRequest',
  'description' => 'Creates the Request to Subscribe display',
  'properties' => NULL,
), '', true, true);
$snippets[3]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/sbssubscriberequest.snippet.php'));

$snippets[4] = $modx->newObject('modSnippet');
$snippets[4]->fromArray(array (
  'id' => 4,
  'property_preprocess' => false,
  'name' => 'sbsUnsubscribe',
  'description' => 'Processes incoming links from Notify or EmailResource unsubscribe links',
  'properties' => NULL,
), '', true, true);
$snippets[4]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/sbsunsubscribe.snippet.php'));

return $snippets;
