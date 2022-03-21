<?php
/**
 * Generic resolver for Subscribe extra.
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
        /* set Secret Key */

        $ss = $modx->getObject('modSystemSetting', array('key' => 'sbs_secret_key'));

        if ($ss) {
            $val = $ss->get('value');
            if (empty($val)) {
                $k = uniqid('SBS');
                $ss->set('value', $k);
                if ($ss->save()) {
                    $modx->log(xPDO::LOG_LEVEL_INFO, 'set Secret Key System Setting');
                } else {
                    $modx->log(xPDO::LOG_LEVEL_INFO, 'Unable to set Secret Key System Setting');
                }
            }
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, 'Unable to get Secret Key System Setting');
        }

        $success = true;
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}

return true;