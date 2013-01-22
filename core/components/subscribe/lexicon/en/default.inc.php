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
 * Default Lexicon Topic
 *
 * @package subscribe
 * @subpackage lexicon
 */

$_lang['subscribe'] = 'Subscribe';
$_lang['subscribe.menu_desc'] = 'Subscribe description';


/* Request to subscribe strings */

$_lang['sbs_subscribe_message'] = 'Become a subscriber!';
$_lang['sbs_subscribe_button_text'] = 'Subscribe me';
$_lang['sbs_login_button_text'] = 'Login';
$_lang['sbs_why_button_text'] = 'Why should I?';
$_lang['sbs_privacy_button_text'] = 'Privacy Policy';
$_lang['sbs_close_button_text'] = 'Close';
$_lang['sbs_logout_button_text'] = 'Logout';
$_lang['sbs_manage_prefs_button_text'] = 'Manage Preferences';

/* Setting names and descriptions */

$_lang['setting_prefListTpl'] = 'prefListTpl';
$_lang['setting_prefListTpl_desc'] = 'Tpl to use for the list of user preferences; default: sbsPrefListTpl';

$_lang['setting_groupListTpl'] = 'groupListTpl';
$_lang['setting_groupListTpl_desc'] = 'Tpl to use for the list of user groups; default: sbsGroupListTpl';

$_lang['setting_checkboxTpl'] = 'checkboxTpl';
$_lang['setting_checkboxTpl_desc'] = 'Outer Tpl to use for the list of user preferences; default: sbsCheckboxTpl';

$_lang['setting_loggedOutDisplayTpl'] = 'loggedOutDisplayTpl';
$_lang['setting_loggedOutDisplayTpl_desc'] = 'Tpl to use for the Subscribe logged-out display; default: sbsLoggedOutDisplayTpl';

$_lang['setting_loggedInDisplayTpl'] = 'loggedInDisplayTpl';
$_lang['setting_loggedInDisplayTpl_desc'] = 'Tpl to use for the Subscribe logged-in display; default: sbsLoggedInDisplayTpl';

$_lang['setting_whyDialogTpl'] = 'whyDialogTpl';
$_lang['setting_whyDialogTpl_desc'] = 'Outer Tpl to use for the Why Subscribe popup dialog; default: sbsWhyDialogTpl';

$_lang['setting_whyDialogTextTpl'] = 'whyDialogTextTpl';
$_lang['setting_whyDialogTextTpl_desc'] = 'Tpl to use for the text in the Why Subscribe popup dialog; default: sbsWhyDialogTextTpl';

$_lang['setting_privacyDialogTpl'] = 'privacyDialogTpl';
$_lang['setting_privacyDialogTpl_desc'] = 'Outer Tpl to use for the privacy Subscribe popup dialog; default:sbsPrivacyDialogTpl';

$_lang['setting_privacyDialogTextTpl'] = 'privacyDialogTextTpl';
$_lang['setting_privacyDialogTextTpl_desc'] = 'Tpl to use for the text in the privacy Subscribe popup dialog; default: sbsPrivacyDialogTextTpl';

$_lang['setting_sbsCssPath'] = 'sbsCssPath';
$_lang['setting_sbsCssPath_desc'] = 'Path to Subscribe CSS file; default :{assets_url}components/subscribe/css/';

$_lang['setting_sbsCssFile'] = 'sbsCssFile';
$_lang['setting_sbsCssFile_desc'] = 'File name of Subscribe CSS file; default: subscribe.css';

$_lang['setting_sbsJsPath'] = 'sbsJsPath';
$_lang['setting_sbsJsPath_desc'] = 'Path to Subscribe JS file; default :{assets_url}components/subscribe/js/';

$_lang['setting_sbsJsFile'] = 'sbsJsFile';
$_lang['setting_sbsJsFile_desc'] = 'File name of Subscribe JS file; default: subscribe.js';

$_lang['setting_sbs_extended_field'] = 'Subscribe extended field';
$_lang['setting_sbs_extended_field_desc'] = "Name of field to store user prefs in user profile extended fields. Ignored unless useCommentField is set to 'no'; default: interests";

$_lang['setting_sbs_field_name'] = 'Subscribe field name';
$_lang['setting_sbs_field_name_desc'] = "Name of field to use in Subscribe forms for preference checkboxes; default: interests";

$_lang['setting_sbs_use_comment_field'] = 'Use Comment Field';
$_lang['setting_sbs_use_comment_field_desc'] = "If set to 'Yes' user preferences are stored in the comment field of the User Profile. If set to 'No', prefs are stored as an extended field in the user profile in the field specified by the 'sbs_extended_field' setting. Default: 'comment'. The default setting ('Yes') is recommended unless you need the comment field for something else.";

$_lang['setting_sbs_confirm_register_page_id'] = 'Subscribe Confirm Register page ID';
$_lang['setting_sbs_confirm_register_page_id_desc'] = 'Resource ID of the Subscribe Confirm Register page; default (set automatically)';

$_lang['setting_sbs_login_page_id'] = 'Login page ID';
$_lang['setting_sbs_login_page_id_desc'] = "Resource ID of the Login page; default: (set automatically)";

$_lang['setting_sbs_manage_prefs_page_id'] = 'Manage Preferences page ID';
$_lang['setting_sbs_manage_prefs_page_id_desc'] = "Resource ID of the Subscribe Manage Preferences page; default: (set automatically)";

$_lang['setting_sbs_unsubscribe_page_id'] = 'Subscribe Unsubscribe page ID';
$_lang['setting_sbs_unsubscribe_page_id_desc'] = 'Resource ID of the Subscribe Unsubscribe page; default (set automatically)';

$_lang['setting_sbs_register_page_id'] = 'Register page ID';
$_lang['setting_sbs_register_page_id_desc'] = "Resource ID of the Subscribe Register page (with the registration form); default: (set automatically)";

$_lang['setting_sbs_registration_confirmed_page_id'] = 'Registration Confirmed page ID';
$_lang['setting_sbs_registration_confirmed_page_id_desc'] = "Resource ID of the Subscribe Registration Confirmed page (the page the user is sent to after clicking on the link in the registration email); default: (set automatically)";

$_lang['setting_sbs_thank_you_page_id'] = 'Thanks for Registering page ID';
$_lang['setting_sbs_thank_you_page_id_desc'] = "Resource ID of the Subscribe Thanks for Registering page (the page the user is sent to immediately after submitting the registration form); default: (set automatically)";

$_lang['setting_language'] = 'Language';
$_lang['setting_language_desc'] = "Language to use for Subscribe' default: en";

$_lang['setting_sbs_secret_key'] = 'Subscribe Secret Key (DO NOT CHANGE)';
$_lang['setting_sbs_secret_key_desc'] = 'Subscribe Secret Key for unsubscribe link (DO NOT CHANGE)';

$_lang['setting_sbs_user_roles'] = 'Subscribe User Roles';
$_lang['setting_sbs_user_roles_desc'] = 'User Roles for groups in the form: group1:Editor,group2:Publisher';

$_lang['setting_sbs_show_interests'] = 'Show Interests Section';
$_lang['setting_sbs_show_interests_desc'] = 'If true, the Manage Preferences and Register forms will show the User Interests section; default: true';

$_lang['setting_sbs_show_groups'] = 'Show Groups Section';
$_lang['setting_sbs_show_groups_desc'] = 'If true, the Manage Preferences and Register forms will show the User Groups section; default: false';

$_lang['setting_field_name'] = 'Interests field name';
$_lang['setting_sbs_show_groups_desc'] = 'Field name to use for interests checkboxes; no need to change this unless there is a conflict with something else on the page; default: interests';

$_lang['setting_groups_field_name'] = 'Groups field name';
$_lang['setting_sbs_show_groups_desc'] = 'Field name to use for User Groups checkboxes; no need to change this unless there is a conflict with something else on the page; default: groups';








