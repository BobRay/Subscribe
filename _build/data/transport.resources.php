<?php
/**
 * resources transport file for Subscribe extra
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
/* @var xPDOObject[] $resources */


$resources = array();

$resources[1] = $modx->newObject('modResource');
$resources[1]->fromArray(array (
  'id' => 1,
  'type' => 'document',
  'contentType' => 'text/html',
  'pagetitle' => 'Subscribe Folder',
  'longtitle' => '',
  'description' => '',
  'alias' => 'subscribe-folder',
  'alias_visible' => true,
  'link_attributes' => '',
  'published' => true,
  'isfolder' => true,
  'introtext' => '',
  'richtext' => false,
  'template' => 'default',
  'menuindex' => 28,
  'searchable' => true,
  'cacheable' => true,
  'createdby' => 1,
  'editedby' => 1,
  'deleted' => false,
  'deletedon' => 0,
  'deletedby' => 0,
  'menutitle' => '',
  'donthit' => false,
  'privateweb' => false,
  'privatemgr' => false,
  'content_dispo' => 0,
  'hidemenu' => true,
  'class_key' => 'modDocument',
  'context_key' => 'web',
  'content_type' => 1,
  'hide_children_in_tree' => 0,
  'show_in_tree' => 1,
  'properties' => '',
), '', true, true);
$resources[1]->setContent(file_get_contents($sources['data'].'resources/subscribe_folder.content.html'));

$resources[2] = $modx->newObject('modResource');
$resources[2]->fromArray(array (
  'id' => 2,
  'type' => 'document',
  'contentType' => 'text/html',
  'pagetitle' => 'Subscribe',
  'longtitle' => 'Become a subscriber',
  'description' => 'Subscribe extra registration page',
  'alias' => 'subscribe',
  'alias_visible' => true,
  'link_attributes' => '',
  'published' => true,
  'isfolder' => false,
  'introtext' => '',
  'richtext' => false,
  'template' => 'default',
  'menuindex' => 0,
  'searchable' => true,
  'cacheable' => true,
  'createdby' => 1,
  'editedby' => 1,
  'deleted' => false,
  'deletedon' => 0,
  'deletedby' => 0,
  'menutitle' => '',
  'donthit' => false,
  'privateweb' => false,
  'privatemgr' => false,
  'content_dispo' => 0,
  'hidemenu' => true,
  'class_key' => 'modDocument',
  'context_key' => 'web',
  'content_type' => 1,
  'hide_children_in_tree' => 0,
  'show_in_tree' => 1,
  'properties' => '',
), '', true, true);
$resources[2]->setContent(file_get_contents($sources['data'].'resources/subscribe.content.html'));

$resources[3] = $modx->newObject('modResource');
$resources[3]->fromArray(array (
  'id' => 3,
  'type' => 'document',
  'contentType' => 'text/html',
  'pagetitle' => 'Manage Preferences',
  'longtitle' => 'Manage Preferences',
  'description' => '',
  'alias' => 'manage-preferences',
  'alias_visible' => true,
  'link_attributes' => '',
  'published' => true,
  'isfolder' => false,
  'introtext' => '',
  'richtext' => false,
  'template' => 'default',
  'menuindex' => 1,
  'searchable' => true,
  'cacheable' => true,
  'createdby' => 1,
  'editedby' => 1,
  'deleted' => false,
  'deletedon' => 0,
  'deletedby' => 0,
  'menutitle' => 'manage-preferences',
  'donthit' => false,
  'privateweb' => false,
  'privatemgr' => false,
  'content_dispo' => 0,
  'hidemenu' => true,
  'class_key' => 'modDocument',
  'context_key' => 'web',
  'content_type' => 1,
  'hide_children_in_tree' => 0,
  'show_in_tree' => 1,
  'properties' => '',
), '', true, true);
$resources[3]->setContent(file_get_contents($sources['data'].'resources/manage_preferences.content.html'));

$resources[4] = $modx->newObject('modResource');
$resources[4]->fromArray(array (
  'id' => 4,
  'type' => 'document',
  'contentType' => 'text/html',
  'pagetitle' => 'Thank You for Registering',
  'longtitle' => '',
  'description' => '',
  'alias' => 'thanks-for-registering',
  'alias_visible' => true,
  'link_attributes' => '',
  'published' => true,
  'isfolder' => false,
  'introtext' => '',
  'richtext' => false,
  'template' => 'default',
  'menuindex' => 2,
  'searchable' => true,
  'cacheable' => true,
  'createdby' => 1,
  'editedby' => 1,
  'deleted' => false,
  'deletedon' => 0,
  'deletedby' => 0,
  'menutitle' => '',
  'donthit' => false,
  'privateweb' => false,
  'privatemgr' => false,
  'content_dispo' => 0,
  'hidemenu' => true,
  'class_key' => 'modDocument',
  'context_key' => 'web',
  'content_type' => 1,
  'hide_children_in_tree' => 0,
  'show_in_tree' => 1,
  'properties' => '',
), '', true, true);
$resources[4]->setContent(file_get_contents($sources['data'].'resources/thank_you_for_registering.content.html'));

$resources[5] = $modx->newObject('modResource');
$resources[5]->fromArray(array (
  'id' => 5,
  'type' => 'document',
  'contentType' => 'text/html',
  'pagetitle' => 'Registration Confirmed',
  'longtitle' => '',
  'description' => '',
  'alias' => 'registration-confirmed',
  'alias_visible' => true,
  'link_attributes' => '',
  'published' => true,
  'isfolder' => false,
  'introtext' => '',
  'richtext' => false,
  'template' => 'default',
  'menuindex' => 3,
  'searchable' => true,
  'cacheable' => true,
  'createdby' => 1,
  'editedby' => 0,
  'deleted' => false,
  'deletedon' => 0,
  'deletedby' => 0,
  'menutitle' => '',
  'donthit' => false,
  'privateweb' => false,
  'privatemgr' => false,
  'content_dispo' => 0,
  'hidemenu' => true,
  'class_key' => 'modDocument',
  'context_key' => 'web',
  'content_type' => 1,
  'hide_children_in_tree' => 0,
  'show_in_tree' => 1,
  'properties' => '',
), '', true, true);
$resources[5]->setContent(file_get_contents($sources['data'].'resources/registration_confirmed.content.html'));

$resources[6] = $modx->newObject('modResource');
$resources[6]->fromArray(array (
  'id' => 6,
  'type' => 'document',
  'contentType' => 'text/html',
  'pagetitle' => 'ConfirmRegister',
  'longtitle' => '',
  'description' => '',
  'alias' => 'confirm-register',
  'alias_visible' => true,
  'link_attributes' => '',
  'published' => true,
  'isfolder' => false,
  'introtext' => '',
  'richtext' => false,
  'template' => 'default',
  'menuindex' => 4,
  'searchable' => true,
  'cacheable' => true,
  'createdby' => 1,
  'editedby' => 1,
  'deleted' => false,
  'deletedon' => 0,
  'deletedby' => 0,
  'menutitle' => '',
  'donthit' => false,
  'privateweb' => false,
  'privatemgr' => false,
  'content_dispo' => 0,
  'hidemenu' => true,
  'class_key' => 'modDocument',
  'context_key' => 'web',
  'content_type' => 1,
  'hide_children_in_tree' => 0,
  'show_in_tree' => 1,
  'properties' => '',
), '', true, true);
$resources[6]->setContent(file_get_contents($sources['data'].'resources/confirmregister.content.html'));

$resources[7] = $modx->newObject('modResource');
$resources[7]->fromArray(array (
  'id' => 7,
  'type' => 'document',
  'contentType' => 'text/html',
  'pagetitle' => 'Unsubscribe',
  'longtitle' => '',
  'description' => '',
  'alias' => 'unsubscribe',
  'alias_visible' => true,
  'link_attributes' => '',
  'published' => true,
  'isfolder' => false,
  'introtext' => '',
  'richtext' => false,
  'template' => 0,
  'menuindex' => 5,
  'searchable' => true,
  'cacheable' => true,
  'createdby' => 1,
  'editedby' => 1,
  'deleted' => false,
  'deletedon' => 0,
  'deletedby' => 0,
  'menutitle' => '',
  'donthit' => false,
  'privateweb' => false,
  'privatemgr' => false,
  'content_dispo' => 0,
  'hidemenu' => true,
  'class_key' => 'modDocument',
  'context_key' => 'web',
  'content_type' => 1,
  'hide_children_in_tree' => 0,
  'show_in_tree' => 1,
  'properties' => NULL,
), '', true, true);
$resources[7]->setContent(file_get_contents($sources['data'].'resources/unsubscribe.content.html'));

return $resources;
