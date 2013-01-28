<?php
/**
 * Subscribe
 * Copyright 2012-2013 Bob Ray <http://bobsguides/com>
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
 * Subscribe; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package subscribe
 * @author Bob Ray <http://bobsguides/com>
 *
 * @version Version 1.0.0 Beta-1
 * 3/3/12
 *
 * @Description Display request to subscribe unless user is admin or logged in
 */


/**
 * @package subscribe
 *
 * Description: Authenticates user based on $_GET params and
 * forwards authenticated users to Manage Prefs page
 */

/* @var $modx modX */
/* @var $scriptProperties array */

/* Properties
 *
 * &sbsUserNotFoundTpl string - name of chunk to show users if not found in DB;
 * default: sbsusernotfoundtpl
 *
 * &sbsContexts string - comma-separated list of contexts to log the user in to;
 * default: context of Unsubscribe Resource (usually 'web').
 *
 * */


$sp =& $scriptProperties;

$corePath = $modx->getOption('subscribe.core_path', null, $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/subscribe/');
require_once($corePath . 'model/subscribe/unsubscribe.class.php');

$tpl = $modx->getOption('sbsUserNotFoundTpl', $sp, 'sbsusernotfoundtpl');

$unSub = new Unsubscribe($modx, $sp);
$unSub->init();
$managePrefsId = $modx->getOption('sbs_manage_prefs_page_id', null, null);

$url = $modx->makeUrl($managePrefsId, "", "", "full");
$encodedEmail = $_GET['ue'];
$key = rawurlencode($_GET['uk']);

if (empty ($encodedEmail) || empty($key)) {
    $modx->sendUnauthorizedPage();
}

$userData = $unSub->getUserData($encodedEmail, $key);

if (!empty ($userData)) {
    /* @var $user modUser */
    $user = $userData['user'];
    $usr = $modx->getObject('modUser', $user->get('id'));
    $modx->user =& $usr;
    $modx->getUser();
    $contexts = $modx->getOption('sbsContexts', $sp, $modx->context->get('key'));
    $contexts = explode(',', $contexts);
    foreach ($contexts as $ctx) {
        $modx->user->addSessionContext($ctx);
    }
    $modx->sendRedirect($url);
} else {
    return $modx->getChunk($tpl);
}
