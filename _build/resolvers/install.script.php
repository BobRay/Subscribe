<?php

/* File not used, but left here for possible future use */

/**
 * Subscribe resolver script - runs on install.
 *
 * Copyright 2012 Bob Ray <http://bobsguides/com>
 * @author Bob Ray <http://bobsguides/com>
 * 3/3/12
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
 * Subscribe; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package subscribe
 */
/**
 * Description: Resolver script for Subscribe package
 * @package subscribe
 * @subpackage build
 */

/* Example Resolver script */

/* The $modx object is not available here. In its place we
 * use $object->xpdo
 */

/* @var $modx modX */
/* @var $options array */
$modx =& $object->xpdo;

/* Remember that the files in the _build directory are not available
 * here and we don't know the IDs of any objects, so resources,
 * elements, and other objects must be retrieved by name with
 * $modx->getObject().
 */

$hasExistingSettings = true;



$modx->log(xPDO::LOG_LEVEL_INFO,'Running PHP Resolver.');

switch($options[xPDOTransport::PACKAGE_ACTION]) {

    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

        $settings = getSettings($modx);
        $resources = getResources($modx);

        /* see if the user opted to install resource */
        $installResources = $modx->getOption('install_resources', $options, false);

        if (! $installResources) {
            /* no -- just just System Settings and return */
            $modx->log(xPDO::LOG_LEVEL_INFO,'Not installing resources - set Subscribe System Settings manually');
            foreach ($settings as $setting) {
                if ($setting->save()) {
                    $modx->log(xPDO::LOG_LEVEL_INFO, 'System Setting Created: ' . $setting->get('key') . ' => ' . $setting->get('value'));
                }
            }
            return true;
        } else {
            $modx->log(xPDO::LOG_LEVEL_INFO,'Attempting to install resources . . .');
        }
        /* install resources */
        /* @var $resource modResource */
        /* @var $setting modSystemSetting */

/*        $resources = include(MODX_CORE_PATH . 'components/subscribe/resources/transport.resources');
        $settings = include(MODX_CORE_PATH . 'components/subscribe/resources/transport.settings');*/

        $parent = 0;
        foreach ($resources as $resource) {
            $fields = $resource->toArray();
            unset ($fields['id'],$fields['template']);
            /* @var $response modProcessorResponse */
            if ($parent) {
                $fields['parent'] = $parent;
            }
            /* create the resource */
            $response = $modx->runProcessor('resource/create', $fields);
            if ($response->isError()) {
                if ($response->hasFieldErrors()) {
                    $fieldErrors = $response->getAllErrors();
                    $errorMessage = implode("\n", $fieldErrors);
                    $modx->log(xPDO::LOG_LEVEL_ERROR,$errorMessage);
                } else {
                    $modx->log(xPDO::LOG_LEVEL_ERROR,'Error creating resource ' . $response->getMessage());
                }

            } else {
                $modx->log(xPDO::LOG_LEVEL_INFO,'Created resource: '. $resource->get('pagetitle'));
                $object = $response->getObject();
                $resourceId = $object['id'];
                if ($resource->get('alias') == 'subscribe-folder') {
                     $parent = $resourceId;
                }
                /* set System Setting values to resource IDs of the subscribe resources */
                $settingNames = array(
                     'login' => 'sbs_login_page_id',
                     'confirm-register' => 'sbs_confirm_register_page_id',
                     'manage-preferences' => 'sbs_manage_prefs_page_id',
                     'subscribe' => 'sbs_register_page_id',
                     'registration-confirmed' => 'sbs_registration_confirmed_page_id',
                     'thanks-for-registering' => 'sbs_thank_you_page_id',
                );

                foreach($settings as $setting) {
                    if ($settingNames[$fields['alias']] == $setting->get('key') ) {
                        $setting->set('value',$resourceId);
                    }
                }
            }
        }

        foreach ($settings as $setting) {
            if ($setting->save()) {
                $modx->log(xPDO::LOG_LEVEL_INFO, 'Set System Setting: ' . $setting->get('key') . ' => ' . $setting->get('value'));
            }
        }
        /* look for a login page and set the System Setting for it. */
        /* @var $loginPage modResource */
        $loginPage = $modx->getObject('modResource',array('alias' => 'login'));
        if (! $loginPage) {
            $loginPage = $modx->getObject('modResource',array('alias' => 'Login'));
        }
        if (! $loginPage) {
            $modx->log(xPDO::LOG_LEVEL_INFO, 'Login page not found - sbs_login_page_id System Settings must be set manually');
        } else {
            /* @var $loginSettingObj modSystemSetting */
            $loginSettingObj = $settings[2];
            $loginSettingObj->set('value',$loginPage->get('id'));
            if ($loginSettingObj->save()) {
                $modx->log(xPDO::LOG_LEVEL_INFO, 'Set System Setting: sbs_login_page_id');
            }
        }
        $success = true;
        break;

    /* This code will execute during an uninstall */
    case xPDOTransport::ACTION_UNINSTALL:
        /* @var $folder modResource */
        /* @var $child modResource */
        $modx->log(xPDO::LOG_LEVEL_INFO,'Uninstalling . . .');
        $modx->log(xPDO::LOG_LEVEL_INFO,'Removing Resources');
        $folder = $modx->getObject('modResource', array('alias' => 'subscribe-folder'));
        if ($folder) {
            $children = $folder->getMany('Children');
            if (! empty ($children)) {
                foreach ($children as $child) {
                    $name = $child->get('alias');
                    if ($child->remove()) {
                        $modx->log(xPDO::LOG_LEVEL_INFO,'Removed resource with alias: ' . $name);
                    }
                }
            }
            if ($folder->remove()) {
                $modx->log(xPDO::LOG_LEVEL_INFO,'Removed Subscribe Folder');

            }
        }
        $success = true;
        break;

        default:
        $success = true;
        break;

}
$modx->log(xPDO::LOG_LEVEL_INFO,'Script resolver actions completed');
return $success;

function getSettings(&$modx) {
    /* @var $modx modX */
    $systemSettings = array();

        $systemSettings[1] = $modx->newObject('modSystemSetting');
        $systemSettings[1] ->fromArray(array(
            'id' => 1,
            'key' => 'sbs_register_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[2] = $modx->newObject('modSystemSetting');
        $systemSettings[2] ->fromArray(array(
            'id' => 2,
            'key' => 'sbs_login_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[3] = $modx->newObject('modSystemSetting');
        $systemSettings[3] ->fromArray(array(
            'id' => 3,
            'key' => 'sbs_confirm_register_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[4] = $modx->newObject('modSystemSetting');
        $systemSettings[4] ->fromArray(array(
            'id' => 4,
            'key' => 'sbs_manage_prefs_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[5] = $modx->newObject('modSystemSetting');
        $systemSettings[5] ->fromArray(array(
            'id' => 5,
            'key' => 'sbs_registration_confirmed_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[6] = $modx->newObject('modSystemSetting');
        $systemSettings[6] ->fromArray(array(
            'id' => 6,
            'key' => 'sbs_thank_you_page_id',
            'value' => '999',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[7] = $modx->newObject('modSystemSetting');
        $systemSettings[7] ->fromArray(array(
            'id' => 7,
            'key' => 'sbs_method',
            'value' => 'comment',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[8] = $modx->newObject('modSystemSetting');
        $systemSettings[8] ->fromArray(array(
            'id' => 8,
            'key' => 'sbs_field_name',
            'value' => 'interests',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);
        $systemSettings[9] = $modx->newObject('modSystemSetting');
        $systemSettings[9] ->fromArray(array(
            'id' => 9,
            'key' => 'sbs_extended_field',
            'value' => 'interests',
            'xtype' => 'textfield',
            'namespace' => 'subscribe',
            'area' => 'subscribe',
        ),'',true,true);

        return $systemSettings;
}

function getResources(&$modx) {
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
    //$resources[1]->setContent(file_get_contents(MODX_COREPATH . 'components/subscribe/'.'resources/subscribe folder.content.html'));

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
    //$resources[2]->setContent(file_get_contents(MODX_COREPATH . 'components/subscribe/'.'resources/subscribe.content.html'));

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
    //$resources[3]->setContent(file_get_contents(MODX_COREPATH . 'components/subscribe/'.'resources/manage preferences.content.html'));

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
    //$resources[4]->setContent(file_get_contents(MODX_COREPATH . 'components/subscribe/'.'resources/thank you for registering.content.html'));

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
    //$resources[5]->setContent(file_get_contents(MODX_COREPATH . 'components/subscribe/'.'resources/registration confirmed.content.html'));

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
    //$resources[6]->setContent(file_get_contents(MODX_COREPATH . 'components/subscribe/'.'resources/confirmregister.content.html'));

    return $resources;

}