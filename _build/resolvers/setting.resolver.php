<?php
/**
 * System Setting resolver  for Subscribe extra.
 * Sets template, parent, and (optionally) TV values
 *
 * Copyright 2012-2022 Bob Ray <https://bobsguides.com>
 * Created on 03-16-2022
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
 * @package subscribe
 * @subpackage build
 */


/* @var $object xPDOObject */
/* @var $modx modX */

/* @var array $options */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /* Setting key => resource alias */
            $settings = array(
               'sbs_confirm_register_page_id' => 'confirm-register',
               'sbs_login_page_id' => 'login',
               'sbs_manage_prefs_page_id' => 'manage-preferences',
               'sbs_register_page_id' => 'subscribe',
               'sbs_registration_confirmed_page_id' => 'registration-confirmed',
               'sbs_thank_you_page_id' => 'thanks-for-registering',
               'sbs_unsubscribe_page_id' => 'unsubscribe',
            );

            foreach ($settings as $key => $alias) {
                $systemSetting = $modx->getObject('modSystemSetting', array('key' => $key));
                $doc = $modx->getObject('modResource', array ('alias' => $alias));

                if ($systemSetting && $doc) {
                    $val = $systemSetting->get('value');
                    /* No action if Setting is already set */
                    if (empty($value) || ($value == '999')) {
                        $systemSetting->set('value', $doc->get('id'));
                        if ($systemSetting->save()) {
                            $modx->log(modX::LOG_LEVEL_INFO, 'Set System Setting with with key: ' . $key);
                        }
                    }
                } else {
                    $msg = 'Setting ' . $key . 'System Setting to id of resource with alias ' .
                            $alias . " failed. May have to be set manually\n";
                    $modx->log(modX::LOG_LEVEL_WARN, $msg);
                }
            }
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;