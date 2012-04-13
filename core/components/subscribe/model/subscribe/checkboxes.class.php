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
 * MODx Subscribe Class
 *
 * @package subscribe
 */

class CheckBoxes{
    protected $method; // (comment/extended)
    protected $tpls;
    protected $errors;
    protected $postPrefsArray;
    protected $userPrefsArray;
    protected $markCurrent;
    protected $extendedField;
    protected $fieldName;
    /* @var $userObj modUser */
    protected $userObj;
    /* @var $userProfile modUserProfile */
    protected $userProfile;


    function __construct(modX &$modx, array $props ) {
      $this->modx = $modx;
      $this->props = $props;
    }
    public function init($userObj, $profile, $saveOnly = false) {
        $this->userObj = $userObj;
        $this->userProfile = $profile;
        $this->method = $this->modx->getOption('method', $this->props,'comment');
        $this->extendedField = $this->modx->getOption('extendedField',$this->props,'interests');
        if (! $saveOnly) {
            $this->getTpls();
            $this->markCurrent = $this->modx->getOption('markCurrent',$this->props,false);

            if ($this->markCurrent)
               $this->getUserPrefs();
        }
    }
protected function getTpls() {

    $this->tpls = array();
    $chunkName = $this->modx->getOption('checkboxTpl',$this->props,'sbsCheckBoxTpl');
    //echo "ChunkName: " . $chunkName . "\n\r";
    $tpl = $this->modx->getChunk($chunkName);
    $this->tpls['checkboxTpl'] = empty($tpl)?
    '<input type="checkbox" name="[[+fieldName]][]" value="[[+sbs_value]]" [[+sbs_checked]]>[[+sbs_caption]]<br />'
        : $tpl;
   //echo 'checkboxTpl: ' . $this->tpls['checkboxTpl'] . "\n" ;
    $chunkName = $this->modx->getOption('prefListTpl', $this->props, 'sbsPrefListTpl');
    //echo 'Chunk name: ' . $chunkName . "\n";
    $tpl = $this->modx->getChunk($chunkName);
    if (empty($tpl)) {
        $this->setError('No Interest list chunk');
    } else {
        $this->tpls['prefListTpl'] = $tpl;
    }

    // echo 'PrefList: ' . $this->tpls['prefListTpl'] . "\n\n" ;

}



    protected function setError($error) {
        $this->errors[] = $error;

    }
    public function getErrors() {
        return $this->errors;
    }

    protected function getUserPrefs() {
        /* @var $user modUser */

        $this->userPrefsArray = array();
        $tempArray = array();
        if (isset($_POST[$this->props['fieldName']]) && !empty($_POST[$this->props['fieldName']])) {
            $this->userPrefsArray = $_POST['interests'];
            // echo 'POST: ' . print_r($this->userPrefsArray,true) . "\n";
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
        // echo 'DB: ' . print_r($this->userPrefsArray,true) . "\n";
        // echo 'Method: ' . $this->method . "\n";


    }

    public function createDisplay($placeholder) {
        if (isset($this->props['interestList']) && !empty($this->props['interestList'])) {
            // echo "Interest list set\n";
            $ints = explode('||', $this->props['interestList']);
        } else {
            $ints = explode('||',$this->tpls['prefListTpl']);
        }

        $intsPh = '';

        foreach($ints as $s) {
            $couple = explode ('==', $s);
            $result[trim($couple[0])] = trim($couple[1]);
            $line = str_replace('[[+sbs_value]]', trim($couple[0]),$this->tpls['checkboxTpl']);
            $line = str_replace('[[+sbs_caption]]', trim($couple[1]),$line);
            $line = str_replace('[[+fieldName]]',$this->props['fieldName'], $line);
            $checked = $this->markCurrent? in_array($couple[0],array_values($this->userPrefsArray))? 'checked="checked"': '' : '';

            $line = str_replace('[[+sbs_checked]]',$checked, $line);

            $intsPh .= $line . "\n";
        }
        $this->modx->setPlaceholder($placeholder,$intsPh);
         //echo $intsPh;
    }
    public function saveUserPrefs(){
        //echo "Attempting Save\n";
        //echo "fieldName: " . $this->props['fieldName'] . "\n";
        if ( (!isset($_POST[$this->props['fieldName']])) || empty($_POST[$this->props['fieldName']])) {
            return false;
        }
        /* now it's a genuine repost */

        $ints = implode(',', $_POST[$this->props['fieldName']]);
        //echo 'Save ints: ' . $ints . "\n";
        switch($this->method) {
            case 'comment':
                $this->userProfile->set('comment', $ints);
                break;
            case 'extended':
                $extended = $this->userProfile->get('extended');
                $extended[$this->extendedField] = $ints;
                $this->userProfile->set('extended', $extended);
                // echo 'Saving extended : ' . print_r($extended,true) . "\n";
                break;
            default:
                return false;
                break;

        }

        if ($this->userProfile->save() ) {
            $this->modx->setPlaceholder('sbs_success_message', $this->modx->lexicon('sbs_change_prefs_success_message'));
            return true;
        } else {
            $this->modx->setPlaceholder('sbs_error_message', $this->modx->lexicon('sbs_change_prefs_failure_message'));
            return false;
        }
    }
} /* end class */


if (false) {
    define('MODX_CORE_PATH', dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))))) . '/core/');
    define('MODX_BASE_PATH', dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))))) . '/');
    define('MODX_MANAGER_PATH', MODX_BASE_PATH . 'manager/');
    define('MODX_CONNECTORS_PATH', MODX_BASE_PATH . 'connectors/');
    define('MODX_ASSETS_PATH', MODX_BASE_PATH . 'assets/');

    /* @var $userObj modUser */
    /* @param $profile modUserProfile */
    //require_once $sources['build'].'build.config.php';
    require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

    $modx = new modX();
    $modx->initialize('web');
    $modx->setLogLevel(xPDO::LOG_LEVEL_INFO);
    $modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

    $props = array('checkboxTpl' => 'sbsxCheckboxTpl', 'prefListTpl' => 'sbsPrefListTpl');
    $_POST['interests'] = array('Option1', 'Option3');
    $props['markCurrent'] = true;
    $props['placeholder'] = 'sbs_interest_list';
    $props['method'] = 'extended';
    $props['fieldName'] = 'interests';
    $props['extendedField'] = 'preferences';
    $prefs = new CheckBoxes($modx, $props);
    $userObj = $modx->getObject('modUser', 308);
    $profile = $userObj->getOne('Profile');
    $prefs->init($userObj, $profile);
    echo "\n";
    $prefs->createDisplay('placeholder');
    $errors = $prefs->getErrors();
    if (!empty($errors)) {
        echo 'Errors: ' . print_r($prefs->getErrors(), true) . "\n";
    }
    if ($prefs->saveUserPrefs()) {
        echo 'SAVED';
    }
    $props['interestList'] = 'unsubscribe==UNSUBSCRIBE';
    $props['fieldName'] = 'unsubscribe';
    $prefs = new CheckBoxes($modx, $props);

    $prefs->init($userObj, $profile);
    echo "\n";
    $prefs->createDisplay('placeholder2');
}