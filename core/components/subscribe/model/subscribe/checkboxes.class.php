<?php
/**
 * Subscribe
 *
 * Copyright 2010 by Shaun McCormick <shaun@modx.com>
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
 * MODX CheckBoxes Class
 *
 * @package subscribe
 */

class CheckBoxes{

    /** @var $method string - method used for storing interests (comment or extended) */
    protected $method;

    /** @var $extendedField string - user profile extended field to use if method is 'extended' */
    protected $extendedField;

    /** @var $tpls array - array of Tpl contents used by form */
    protected $tpls;

    /** @var $errors array - array of error messages */
    protected $errors;

    /** @var $showInterests bool - Display the interests section of form; default: true */
    protected $showInterests;

    /** @var $showGroups bool - Display the groups section of form; default: false */
    protected $showGroups;

    /** @var $userPrefsArray array - Interest selections for current user */
    protected $userPrefsArray;

    /** @var $userGroupsArray array - Group selections for current user */
    protected $userGroupsArray;

    /* @var $userObj modUser -  current user object */
    protected $userObj;

    /* @var $userProfile modUserProfile - current user profile */
    protected $userProfile;

    /** @var $userRoles array - array of groupname => role */
    protected $userRoles;

    /* @var $possibleInterests array - All possible Interests to show on form */
    protected $possibleInterests;

    /* @var $possibleGroups array - All possible User Groups to show on form */
    protected $possibleGroups;

    /* @var $fieldName string - name to user for interests checkboxes */
    protected $fieldName;

    /* @var $groupsFieldName string - name to user for groups checkboxes */
    protected $groupsFieldName;


    /**
     * Constructor
     * @param $modx modX - $modx object
     * @param array $props - $scriptProperties array
     */
    function __construct(&$modx, array $props ) {
      $this->modx = $modx;
      $this->props = $props;
    }

    /**
     * @param $userObj modUser - current user object
     * @param $profile modUserProfile - current user profile object
     * @param bool $saveOnly - If set, no display is created since page will reload
     */
    public function init($userObj, $profile, $saveOnly = false, $markCurrent = false) {
        $this->userObj = $userObj;
        $this->userProfile = $profile;
        $this->showInterests = $this->modx->getOption('sbs_show_interests', $this->props, true);
        $this->showGroups = $this->modx->getOption('sbs_show_groups', $this->props, false);
        $useCommentField = $this->modx->getOption('sbs_use_comment_field', $this->props, true);
        $this->method = $useCommentField
            ? 'comment'
            : 'extended';
        $this->fieldName = $this->modx->getOption('sbs_field_name', $this->props, 'interests');
        $this->groupsFieldName = $this->modx->getOption('sbs_groups_field_name', $this->props, 'groups');
        $this->extendedField = $this->modx->getOption('sbs_extended_field', $this->props, 'interests');


        $chunkName = $this->modx->getOption('prefListTpl', $this->props, 'sbsPrefListTpl');
        $tpl = $this->modx->getChunk($chunkName);
        if (empty($tpl)) {
            $this->setError('No Interest list chunk');
        } else {
            $this->tpls['prefListTpl'] = $tpl;
            $this->possibleInterests = $this->parseOptions($tpl);
        }

        $chunkName = $this->modx->getOption('groupListTpl', $this->props, 'sbsGroupListTpl');
        $tpl = $this->modx->getChunk($chunkName);
        if (empty($tpl)) {
            $this->setError('No group list chunk');
        } else {
            $this->possibleGroups = $this->parseOptions($tpl);
        }
        $roles = $this->modx->getOption('sbs_user_roles', null, '');
        if (!empty($roles)) {
            $roles = explode(',', $roles);
            foreach($roles as $role) {
                $couple = explode(':', $role);
                $this->userRoles[trim($couple[0])] = trim($couple[1]);
            }
        }

        if (! $saveOnly) {
            $this->getTpls();

            /* Get the users current prefs and/or groups */
            if ($markCurrent) {
                if ($this->showInterests) {
                    $this->getUserPrefs();
                }
                if ($this->showGroups) {
                    $this->getUserGroups();
                }
            }
        }
    }

    /**
     * Gets various Tpls;
     * also sets $this->possibleInterests and $this->possibleGroups from Tpl chunks.
     */
    protected function getTpls() {

    $this->tpls = array();
    $chunkName = $this->modx->getOption('checkboxTpl',$this->props,'sbsCheckBoxTpl');

    $tpl = $this->modx->getChunk($chunkName);
    $this->tpls['checkboxTpl'] = empty($tpl)?
    '<input type="checkbox" name="[[+fieldName]][]" value="[[+sbs_value]]" [[+sbs_checked]]>[[+sbs_caption]]<br />'
        : $tpl;

}


    /**
     * Adds an error message to the error array
     *
     * @param $error string - single error message
     */
    protected function setError($error) {
        $this->errors[] = $error;

    }

    /**
     * @return array - Returns array of error messages or empty array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Gets preferences of current user from $_POST if set, from DB if not
     */
    protected function getUserPrefs() {
        /* @var $user modUser */

        $this->userPrefsArray = array();
        $tempArray = array();
        if (isset($_POST[$this->fieldName]) && !empty($_POST[$this->fieldName])) {
            $this->userPrefsArray = $_POST[$this->fieldName];
        } else {

            switch($this->method) {
                case 'comment':
                default:
                    $tempArray = explode(',' , $this->userProfile->get('comment'));
                    break;

                case 'extended':
                    $extended = $this->userProfile->get('extended');
                    $tempArray = explode(',' , $extended[$this->extendedField]);
                    break;
            }
        }

        if (!empty($tempArray)) {
            foreach($tempArray as $k => $v) {
                $this->userPrefsArray[trim($k)] = trim($v);
            }
        }
        unset ($tempArray);
    }

    /**
     * Set $this->userGroupsArray with user groups from either $_POST or DB
     *
     */
    protected function getUserGroups() {
        $this->userGroupsArray = array();
        if (isset($_POST[$this->groupsFieldName]) && !empty($_POST[$this->groupsFieldName])) {
            $this->userGroupsArray = $_POST[$this->groupsFieldName];
        } else {
            /* Get user groups from DB */
            $this->userGroupsArray = array();
            $user = $this->userObj;
            $ugms = $user->getMany('UserGroupMembers');
            foreach ($ugms as $ugm) {
                /* @var $ugm modUserGroupMember */
                $group = $ugm->getOne('UserGroup');
                $this->userGroupsArray[] = $group->get('name');
            }
            unset($user, $group, $ugms);
        }
    }

    /**
     * Adds Interests and/or Groups sections to form via placeholders
     *
     * @param $action string - current action (register or managePrefs)
     */
    public function createDisplay($action) {
        /* Do Interests section */
        if ($this->showInterests) {
            $lexKey = 'sbs_interests_caption';
            $msg = $action == 'register'
                ? $this->modx->lexicon('sbs_interest_list_caption')
                : $this->modx->lexicon('sbs_current_interests_caption');

            $this->modx->setPlaceholder($lexKey, $msg);

            $output = $this->createSectionDisplay('interests',$this->possibleInterests,
                $this->userPrefsArray);
            $this->modx->setPlaceholder('sbs_interest_list', $output);
            /* Next line for backward compatibility */
            $this->modx->setPlaceholder('sbs_current_prefs', $output);

        } else {
            $this->modx->setPlaceholder('sbs_interests_caption', '');
            $this->modx->setPlaceholder('sbs_interest_list', '');
            /* Next line for backward compatibility */
            $this->modx->setPlaceholder('sbs_current_prefs', '');
        }

        /* Do Groups section */
        if ($this->showGroups) {
            $placeHolder = 'sbs_groups_caption';
            $msg = $action == 'register'
                ? $this->modx->lexicon('sbs_groups_list_caption')
                : $this->modx->lexicon('sbs_current_groups_caption');

            $this->modx->setPlaceholder($placeHolder, $msg);
            $output = $this->createSectionDisplay('groups', $this->possibleGroups,
                $this->userGroupsArray);
            $this->modx->setPlaceholder('sbs_groups_list', $output);
        } else {
            $this->modx->setPlaceholder('sbs_groups_caption', '');
            $this->modx->setPlaceholder('sbs_groups_list', '');
        }
    }

    /**
     * Gets options from a standard MODX option string in a chunk and returns them as an array, e.g.,
     * Option1==Option One||Option2==Option Two
     * @param $tpl string - Options string from Tpl
     * @return array
     */
    public function parseOptions($chunk) {
        $options = array();

        if (!empty($chunk)) {
            $tempArray = explode('||', $chunk);
            foreach($tempArray as $option) {
                $couple = explode('==', $option);
                $options[trim($couple[0])] = trim($couple['1']);
            }
        }
        return $options;
    }

    /**
     * Returns HTML for either interests or groups section
     * @param $fieldName string - field name to use for checkbox
     * @param $possibleInterests array - All possible options
     * @param array $currentInterests array - User-selected options
     * @return string - HTML for section
     */
    public function createSectionDisplay($fieldName, $possibleInterests, $currentInterests = array()) {
        $output = '';
        $tpl = $this->tpls['checkboxTpl'];

        foreach($possibleInterests as $caption => $key) {
            $line = str_replace('[[+sbs_value]]', $key, $tpl);
            $line = str_replace('[[+sbs_caption]]', $caption, $line);
            $line = str_replace('[[+fieldName]]', $fieldName, $line);
            $checked = ! empty($currentInterests)
                ? in_array($key, $currentInterests)
                    ? 'checked="checked"'
                    : ''
                : '';

            $line = str_replace('[[+sbs_checked]]', $checked, $line);
            $output .= $line;
        }
        return $output;

    }

    /**
     * Saves user interests and/or groups selected in form to DB
     * @return bool - true on success; false on failure
     */
    public function saveUserPrefs(){
        if ($this->showInterests) {
            if ( (!isset($_POST[$this->fieldName])) || empty($_POST[$this->fieldName]) ) {
                return false; /* nothing to save */
            }
        }
        if ($this->showGroups) {
            if ((!isset($_POST[$this->groupsFieldName])) || empty($_POST[$this->groupsFieldName])) {
                return false; /* Nothing to save */
            }
        }
        /* now it's a genuine repost */
        $success = true;

        /* Save interests */
        $ints = isset($_POST[$this->fieldName])
            ? implode(',', $_POST[$this->fieldName])
            : '';

        switch($this->method) {
            case 'comment':
                $this->userProfile->set('comment', $ints);
                break;
            case 'extended':
                $extended = $this->userProfile->get('extended');
                $extended[$this->extendedField] = $ints;
                $this->userProfile->set('extended', $extended);
                break;
            default:
                break;

        }

        if (! $this->userProfile->save() ) {
            $success = false;
        }

        /* Save User Groups */

        $selectedGroups = isset($_POST[$this->groupsFieldName])
            ? $_POST[$this->groupsFieldName]
            : array();

        $possibleGroups = $this->possibleGroups;

        foreach($possibleGroups as $group) {
            if (in_array($group, $selectedGroups)) {

                if (! $this->userObj->isMember($group)) {
                    $role = $this->userRoles[$group];
                    if (!$this->userObj->joinGroup($group, $role))
                        $this->modx->log(modX::LOG_LEVEL_ERROR,'[Subscribe] Failed to Join Group: ' . $group . 'with role: ' . $role);
                }
            } else {
                if ($this->userObj->isMember($group)) {
                    $this->userObj->leaveGroup($group);
                }
            }
        }

        /* set success or failure message */
        if ($success) {
            $this->modx->setPlaceholder('sbs_success_message',
                $this->modx->lexicon('sbs_change_prefs_success_message'));
        } else {
            $this->modx->setPlaceholder('sbs_error_message',
                $this->modx->lexicon('sbs_change_prefs_failure_message'));
        }
        return $success;
    }


    /**
     * Cleans the $_POST array and converts MODX tags to entities
     * @param $post
     */
    public function cleanse(&$post) {
        if (is_array($post)) {
            foreach($post as $p) {
            $this->cleanse($p);
            }
        } else {
            $post = preg_replace("/<script(.*)<\/script>/i",'',$post);
            $post = preg_replace("/<iframe(.*)<\/iframe>/i",'',$post);
            $post = preg_replace("/<iframe(.*)\/>/i",'',$post);
            $post = strip_tags($post);
            /* replace MODX tags with entities */
            $post = str_replace(array('[',']'),array('&#91;','&#93;'),$post);
        }

    }
} /* end class */
