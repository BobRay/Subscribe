<?php
/**
 * Subscribe
 *
 *
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
 */
/**
 * Subscribe forms Lexicon Topic
 *
 * @package subscribe
 * @subpackage lexicon
 */
/* Register form success and error messages */

$_lang['sbs_js_username_required'] = 'Please enter a username';
$_lang['sbs_js_username_too_short'] = 'Username must be at least 6 characters long';
$_lang['sbs_js_password_required'] = 'Please enter a password';
$_lang['sbs_js_password_too_short'] = 'Password must be at least 6 characters long';
$_lang['sbs_js_password_mismatch'] = 'Password entries must match';
$_lang['sbs_js_email_required'] = 'Please enter an email address';
$_lang['sbs_js_bad_email'] = "That doesn't look like a valid email address";
$_lang['sbs_js_fullname_required'] = 'Please enter a full name';
$_lang['sbs_js_interests_required'] = 'Please check at least one checkbox';
$_lang['sbs_js_groups_required'] = 'Please check at least one group';


$_lang['sbs_interest_list_caption'] = '<p>Please keep me informed about new content in the following areas:</p>';
$_lang['sbs_groups_list_caption'] = '<p>Please subscribe me to the following groups:</p>';

$_lang['sbs_current_interests_caption'] = '<p>Your current interests</p>';
$_lang['sbs_current_groups_caption'] = '<p>Your current groups</p>';

$_lang['sbs_submit_button_text'] = 'Submit';
$_lang['sbs_unsubscribe'] = 'UNSUBSCRIBE';
$_lang['sbs_unsubscribe_success_message'] = '<h3>Unsubscription Successful</h3>
<p>Your preferences, username, and password, have been saved and you are welcome to resubscribe at any time. Just send an email requesting reactivation.</p>';
$_lang['sbs_unsubscribe_failure_message'] = '<h3>Sorry, unsubscription failed</h3>';
$_lang['sbs_anon_admin_error'] = '<h3>Unable to unsubscribe (anonymous) user or admin</h3>';
$_lang['sbs_change_prefs_success_message'] = '<h3>Preferences changed</h3>';
$_lang['sbs_change_prefs_failure_message'] = '<h3>Error: Preferences  not changed</h3>';
$_lang['sbs_not_logged_in_error_message'] = '<h3>You must be logged in to manage preferences</h3>';
