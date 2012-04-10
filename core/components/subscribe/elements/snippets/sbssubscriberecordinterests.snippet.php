<?php
/**
 * Subscribe
 * Copyright 2012 Bob Ray <http://bobsguides/com>
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
 * Description:
 *
 * Unsubscribe, on request from Manage Preferences form
 *
 * or
 *
 * get user interests from Register form or
 * Manager Preferences form and save them in the 'comment'
 * field of the User Profile
 *
 * /

/** Properties
 * @package subscribe

 */

/* @var $ints string */
/* @var $profile modUserProfile */
/* @var $output string */
/* @var $modx modX */
/* @var $hook object */

$ref = ''; /* which form called us */
$setPrefs = false; /* set user prefs (or not) */

if (isset($_POST['sbs_register_form'])) {
    /* coming from register form, get prefs from form and profile */
    $ref = 'register';
    $setPrefs = true;
    $ints = $hook->getValue('interests');
    $profile = $hook->getValue('register.profile');
} elseif (isset($_POST['sbs_manage_prefs_form'])) {
    /* check login status for security */
    if (! $modx->user->hasSessionContext($modx->context->get('key'))) {
        die('Unauthorized Access');
    }

    $ref = 'manage_prefs';
    /* coming from Manage Preferences form */
    $userName = $modx->user->get('username');
    $userId = $modx->user->get('id');

    /* see if user is unsubscribing */
    if (isset($_POST['unsubscribe']) && ($_POST['unsubscribe'] == 'sbs_unsubscribe')) {
        /* unsubscribe user, but not if it's (anonymous) or admin */
        if (($userName != '(anonymous)') && ($userId != 1)) {
            $modx->user->set('active', 0);
            $modx->user->save();
            $modx->setPlaceholder('sbs_success_message', $modx->lexicon('sbs_unsubscribe_success_message'));
        } else {
            $modx->setPlaceholder('sbs_error_message', $modx->lexicon('sbs_anon_admin_error'));
        }
        /* return without setting prefs */
        return '';
    } else {
        /* not unsubscribing, get current prefs from form and profile */
        $setPrefs = true;
        $ints = $_POST['interests'];
        $profile = $modx->user->getOne('Profile');
    }

} else { /* not coming from either form */
    return '';
}

/* not unsubscribing -- set prefs based on form*/

$intString = implode(',', $ints);
if ($setPrefs && $profile) {
    $profile->set('comment', $intString);

    if (!$profile->save()) {
        die('could not save profile');
    } else {
        $modx->setPlaceholder('sbs_current_prefs', $intString);
        $modx->setPlaceholder('sbs_success_message', $modx->lexicon('sbs_change_prefs_success_message'));
    }
} else {
    if (!$profile) {
        $output .= 'No Profile';
        die($output);

    }
}

/* need to return true for register form */
return $ref == 'register' ? true : '';