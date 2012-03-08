/**
     * SubscribeMe
     * Copyright 2012 Bob Ray <http://bobsguides/com>
     *
     * SubscribeMe is free software; you can redistribute it and/or modify it
     * under the terms of the GNU General Public License as published by the Free
     * Software Foundation; either version 2 of the License, or (at your option) any
     * later version.
     *
     * SubscribeMe is distributed in the hope that it will be useful, but WITHOUT ANY
     * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
     * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License along with
     * SubscribeMe; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
     * Suite 330, Boston, MA 02111-1307 USA
     *
     * @package subscribeme
     * @author Bob Ray <http://bobsguides/com>
     *
     * @version Version 1.0.0 Beta-1
     * 3/3/12
     *
     * @Description Display request to subscribe unless user is admin or logged in */


    /**
     *  @version Version 1.0.0 Beta-1
     *  @package subscribeme
     */


/* Display request to subscribe unless user is admin or logged in */
/* @var $modx modX */ 
/* @var $scriptProperties array */

  $sp =& $scriptProperties;
if ($modx->user->hasSessionContext($modx->context->get('key')) ) {
   return '<a href="[[!~' . $scriptProperties['loginPageId'] . ']]? &service=logout" style="padding-left:30px;color:lavender">Log out</a>';
} else {
   $modx->regClientCSS(MODX_ASSETS_URL . 'components/subscribeme/css/subscribeme.css');
   $modx->regClientCSS('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css');
    $modx->regClientStartupScript('http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js');
    $modx->regClientStartupScript('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js');
    
    $fields = array();
    $fields['registerPageId'] = $sp['registerPageId'];
    $fields['loginPageId'] = $scriptProperties['loginPageId'];

    $fields['whyDialogHeight'] = $modx->getOption('whyDialogHeight',$sp, 475);
    $fields['whyDialogWidth'] = $modx->getOption('whyDialogWidth',$sp, 300);
    $fields['whyDialogTop'] = $modx->getOption('whyDialogTop',$sp, 55);
    $fields['whyDialogLeft'] = $modx->getOption('whyDialogLeft',$sp, 212);

    $fields['privacyDialogHeight'] = $modx->getOption('privacyDialogHeight',$sp, 500);
    $fields['privacyDialogWidth'] = $modx->getOption('privacyDialogWidth',$sp, 300);
    $fields['privacyDialogTop'] = $modx->getOption('privacyDialogTop',$sp, 55);
    $fields['privacyDialogLeft'] = $modx->getOption('privacyDialogLeft',$sp, 347);


    return $modx->getChunk('SmSubscribe', $fields) ;
}