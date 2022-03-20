<?php
/**
 * Resolver for [[+packageName]] extra
 *
 * Copyright [[+copyright]] [[+author]] [[+email]]
 * Created on [[+createdon]]
 *
 * [[+license]]
 * @package [[+packageNameLower]]
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
                    $systemSetting->set('value', $doc->get('id'));
                     if ($systemSetting->save()) {
                         $modx->log(modX::LOG_LEVEL_INFO, 'Set System Setting with with key: ' . $key);
                     };
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