<?php
/**
 * Subscribe
 *
 * Copyright 2012-2017 Bob Ray <https://bobsguides.com>
 *
 * Subscribe is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Subscribe is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Subscribe; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package subscribe
 */
/**
 * @var modX $modx
 */
/* @var $modx modX */
    $resources = array();

    $resources[1] = $modx->newObject('modResource');
    $resources[1] ->fromArray(array(
        'id' => 1,
        'type' => 'document',
        'contentType' => 'text/html',
        'pagetitle' => 'Subscribe Folder',
        'longtitle' => '',
        'description' => '',
        'alias' => 'subscribe-folder',
        'link_attributes' => '',
        'published' => '1',
        'isfolder' => '1',
        'introtext' => '',
        'richtext' => '0',
        'menuindex' => '1',
        'searchable' => '1',
        'cacheable' => '1',
        'createdby' => '1',
        'editedby' => '1',
        'deleted' => '0',
        'deletedon' => '0',
        'deletedby' => '0',
        'menutitle' => '',
        'donthit' => '0',
        'privateweb' => '0',
        'privatemgr' => '0',
        'content_dispo' => '0',
        'hidemenu' => '1',
        'class_key' => 'modDocument',
        'context_key' => 'web',
        'content_type' => '1',
        'hide_children_in_tree' => '0',
        'show_in_tree' => '1',
        'properties' => '',
        'content' => '<p>This resource is not used by the Subscribe package. It exists only to organize the subscribe resources</p>',
    ),'',true,true);

    $resources[2] = $modx->newObject('modResource');
    $resources[2] ->fromArray(array(
        'id' => 2,
        'type' => 'document',
        'contentType' => 'text/html',
        'pagetitle' => 'Subscribe',
        'longtitle' => 'Become a subscriber',
        'description' => 'Subscribe extra registration page',
        'alias' => 'subscribe',
        'link_attributes' => '',
        'published' => '1',
        'isfolder' => '0',
        'introtext' => '',
        'richtext' => '0',
        'menuindex' => '0',
        'searchable' => '1',
        'cacheable' => '1',
        'createdby' => '1',
        'editedby' => '1',
        'deleted' => '0',
        'deletedon' => '0',
        'deletedby' => '0',
        'menutitle' => '',
        'donthit' => '0',
        'privateweb' => '0',
        'privatemgr' => '0',
        'content_dispo' => '0',
        'hidemenu' => '1',
        'class_key' => 'modDocument',
        'context_key' => 'web',
        'content_type' => '1',
        'hide_children_in_tree' => '0',
        'show_in_tree' => '1',
        'properties' => '',
        'content' => '<p>Please fill out the following form to register at [[++site_name]]:</p>
    [[$sbsRegisterFormTpl]]',

    ),'',true,true);

    $resources[3] = $modx->newObject('modResource');
    $resources[3] ->fromArray(array(
        'id' => 3,
        'type' => 'document',
        'contentType' => 'text/html',
        'pagetitle' => 'Manage Preferences',
        'longtitle' => 'Manage Preferences',
        'description' => '',
        'alias' => 'manage-preferences',
        'link_attributes' => '',
        'published' => '1',
        'isfolder' => '0',
        'introtext' => '',
        'richtext' => '0',
        'menuindex' => '1',
        'searchable' => '1',
        'cacheable' => '1',
        'createdby' => '1',
        'editedby' => '1',
        'deleted' => '0',
        'deletedon' => '0',
        'deletedby' => '0',
        'menutitle' => 'manage-preferences',
        'donthit' => '0',
        'privateweb' => '0',
        'privatemgr' => '0',
        'content_dispo' => '0',
        'hidemenu' => '1',
        'class_key' => 'modDocument',
        'context_key' => 'web',
        'content_type' => '1',
        'hide_children_in_tree' => '0',
        'show_in_tree' => '1',
        'properties' => '',
        'content' => '[[$sbsManagePrefsFormTpl]]',
    ),'',true,true);

    $resources[4] = $modx->newObject('modResource');
    $resources[4] ->fromArray(array(
        'id' => 4,
        'type' => 'document',
        'contentType' => 'text/html',
        'pagetitle' => 'Thank You for Registering',
        'longtitle' => '',
        'description' => '',
        'alias' => 'thanks-for-registering',
        'link_attributes' => '',
        'published' => '1',
        'isfolder' => '0',
        'introtext' => '',
        'richtext' => '0',
        'menuindex' => '2',
        'searchable' => '1',
        'cacheable' => '1',
        'createdby' => '1',
        'editedby' => '1',
        'deleted' => '0',
        'deletedon' => '0',
        'deletedby' => '0',
        'menutitle' => '',
        'donthit' => '0',
        'privateweb' => '0',
        'privatemgr' => '0',
        'content_dispo' => '0',
        'hidemenu' => '1',
        'class_key' => 'modDocument',
        'context_key' => 'web',
        'content_type' => '1',
        'hide_children_in_tree' => '0',
        'show_in_tree' => '1',
        'properties' => '',
        'content' => '<p>
    Thanks for registering at [[++site_name]]. You will receive an email message soon
    containing a link that will activate your subscription. Please
    click on the link in the message to become an active subscriber.
    </p>',

    ),'',true,true);

    $resources[5] = $modx->newObject('modResource');
    $resources[5] ->fromArray(array(
        'id' => 5,
        'type' => 'document',
        'contentType' => 'text/html',
        'pagetitle' => 'Registration Confirmed',
        'longtitle' => '',
        'description' => '',
        'alias' => 'registration-confirmed',
        'link_attributes' => '',
        'published' => '1',
        'isfolder' => '0',
        'introtext' => '',
        'richtext' => '0',
        'menuindex' => '3',
        'searchable' => '1',
        'cacheable' => '1',
        'createdby' => '1',
        'editedby' => '0',
        'deleted' => '0',
        'deletedon' => '0',
        'deletedby' => '0',
        'menutitle' => '',
        'donthit' => '0',
        'privateweb' => '0',
        'privatemgr' => '0',
        'content_dispo' => '0',
        'hidemenu' => '1',
        'class_key' => 'modDocument',
        'context_key' => 'web',
        'content_type' => '1',
        'hide_children_in_tree' => '0',
        'show_in_tree' => '1',
        'properties' => '',
        'content' => '<p>Congratulations, you are now a subscriber!</p>',
    ),'',true,true);

    $resources[6] = $modx->newObject('modResource');
    $resources[6] ->fromArray(array(
        'id' => 6,
        'type' => 'document',
        'contentType' => 'text/html',
        'pagetitle' => 'ConfirmRegister',
        'longtitle' => '',
        'description' => '',
        'alias' => 'confirm-register',
        'link_attributes' => '',
        'published' => '1',
        'isfolder' => '0',
        'introtext' => '',
        'richtext' => '0',
        'menuindex' => '4',
        'searchable' => '1',
        'cacheable' => '1',
        'createdby' => '1',
        'editedby' => '1',
        'deleted' => '0',
        'deletedon' => '0',
        'deletedby' => '0',
        'menutitle' => '',
        'donthit' => '0',
        'privateweb' => '0',
        'privatemgr' => '0',
        'content_dispo' => '0',
        'hidemenu' => '1',
        'class_key' => 'modDocument',
        'context_key' => 'web',
        'content_type' => '1',
        'hide_children_in_tree' => '0',
        'show_in_tree' => '1',
        'properties' => '',
        'content' => '
    [[!ConfirmRegister?
        &redirectTo=`[[++sbs_registration_confirmed_page_id]]`
        &errorPage=`[[++site_start]]`
    ]]',

    ),'',true,true);

$resources[7] = $modx->newObject('modResource');
$resources[7]->fromArray(array(
    'id' => 7,
    'type' => 'document',
    'contentType' => 'text/html',
    'pagetitle' => 'Unsubscribe',
    'longtitle' => '',
    'description' => '',
    'alias' => 'unsubscribe',
    'link_attributes' => '',
    'published' => '1',
    'isfolder' => '0',
    'introtext' => '',
    'richtext' => '0',
    'menuindex' => '5',
    'searchable' => '0',
    'cacheable' => '1',
    'createdby' => '1',
    'editedby' => '1',
    'deleted' => '0',
    'deletedon' => '0',
    'deletedby' => '0',
    'menutitle' => '',
    'donthit' => '0',
    'privateweb' => '0',
    'privatemgr' => '0',
    'content_dispo' => '0',
    'hidemenu' => '1',
    'class_key' => 'modDocument',
    'context_key' => 'web',
    'content_type' => '1',
    'hide_children_in_tree' => '0',
    'show_in_tree' => '1',
    'properties' => '',
    'content' => '[[!Unsubscribe]]',

), '', true, true);

$resources[8] = $modx->newObject('modResource');
$resources[8]->fromArray(array(
    'id' => 8,
    'type' => 'document',
    'contentType' => 'text/html',
    'pagetitle' => 'Interest Report',
    'longtitle' => '',
    'description' => '',
    'alias' => 'interest-report',
    'link_attributes' => '',
    'published' => '0',
    'isfolder' => '0',
    'introtext' => '',
    'richtext' => '0',
    'menuindex' => '5',
    'searchable' => '0',
    'cacheable' => '1',
    'createdby' => '1',
    'editedby' => '1',
    'deleted' => '0',
    'deletedon' => '0',
    'deletedby' => '0',
    'menutitle' => '',
    'donthit' => '0',
    'privateweb' => '0',
    'privatemgr' => '0',
    'content_dispo' => '0',
    'hidemenu' => '1',
    'class_key' => 'modDocument',
    'context_key' => 'web',
    'content_type' => '1',
    'hide_children_in_tree' => '0',
    'show_in_tree' => '1',
    'properties' => '',
    'content' => '[[!InterestReport]]',

    ), '', true, true);

return $resources;