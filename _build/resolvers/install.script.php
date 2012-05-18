<?php

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
if ($object->xpdo) {
    $modx =& $object->xpdo;
}

/* Remember that the files in the _build directory are not available
 * here and we don't know the IDs of any objects, so resources,
 * elements, and other objects must be retrieved by name with
 * $modx->getObject().
 */


switch($options[xPDOTransport::PACKAGE_ACTION]) {

    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:

    /* @var $resource modResource */
    /* @var $setting modSystemSetting */

    $parent = null;
    $defaultTemplate = $modx->getOption('default_template',null);

    /* get subscribe folder */
    /* @var $folder modResource */
    $folder = $modx->getObject('modResource', array ('alias' => 'subscribe-folder'));

    if (!$folder) {
        $modx->log(xPDO::LOG_LEVEL_ERROR,'Could not find subscribe-folder resource');
        $folderId = null;
    } else {
        $folderId = $folder->get('id');
        $folder->set('template', $defaultTemplate);
        $folder->save();
    }

    /* look for a login page and set the System Setting for it. */
    /* @var $loginPage modResource */
    $loginPage = $modx->getObject('modResource',array('alias' => 'login'));
    if (! $loginPage) {
        $loginPage = $modx->getObject('modResource',array('alias' => 'Login'));
    }
    if (! $loginPage) {
        $modx->log(xPDO::LOG_LEVEL_ERROR, 'Login page not found - sbs_login_page_id System Settings must be set manually');
    } else {
        /* @var $ss modSystemSetting */
        $ss = $modx->getObject('modSystemSetting', array('key' => 'sbs_login_page_id'));
        if (!$ss) {
            $modx->log(xPDO::LOG_LEVEL_ERROR, 'sbs_login_page_id System Setting not found');
        } else {
            $ss->set('value', $loginPage->get('id'));
            if ($ss->save()) {
                $modx->log(xPDO::LOG_LEVEL_INFO, 'set sbs_login_page_id System Setting to ID of Login page');
            }

        }
    }
   /* set other System Setting values to resource IDs of the subscribe resources
    * this array is in the form 'alias' =>

   */
    $settingNames = array(
         'confirm-register' => 'sbs_confirm_register_page_id',
         'manage-preferences' => 'sbs_manage_prefs_page_id',
         'subscribe' => 'sbs_register_page_id',
         'registration-confirmed' => 'sbs_registration_confirmed_page_id',
         'thanks-for-registering' => 'sbs_thank_you_page_id',
    );

    foreach($settingNames as $key => $value) {
        /* @var $systemSetting modSystemSetting */
        $resource = $modx->getObject('modResource', array ('alias' => $key));
        $systemSetting = $modx->getObject('modSystemSetting', array ('key' => $value));

        if ($resource && $systemSetting) {
            $systemSetting->set('value', $resource->get('id'));
            if ($systemSetting->save()) {
                $modx->log(xPDO::LOG_LEVEL_INFO, 'set ' . $value . 'System Setting to ID of ' . $key . ' page');
            }
            if ($folderId) {
                $resource->set('template', $defaultTemplate);
                $resource->set('parent', $folderId);
                $resource->save();
            }


        } else {
            if (! $resource) {
                $modx->log(xPDO::LOG_LEVEL_ERROR, 'Unable to get resource with alias: ' . $key);
            }
            if (! $systemSetting) {
                $modx->log(xPDO::LOG_LEVEL_ERROR, 'Unable to get System Setting with key: ' . $value);
            }
        }
    }


    $success = true;
    break;

    /* This code will execute during an uninstall */
    case xPDOTransport::ACTION_UNINSTALL:
    default:

}

return true;

