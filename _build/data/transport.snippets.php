<?php
/**
 * Subscribe transport snippets
 * Copyright 2012 Bob Ray <http://bobsguides/com>
 * @author Bob Ray <http://bobsguides/com>
 * 3/3/12
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
 * Description:  Array of snippet objects for Subscribe package
 * @package subscribe
 * @subpackage build
 */

if (! function_exists('getSnippetContent')) {
    function getSnippetContent($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<?php','',$o);
        $o = str_replace('?>','',$o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
$snippets = array();

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'SmGetInterests',
    'description' => "Gets user interests from Register form and saves them in the 'comment'
     field of the User Profile.",
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/SmGetInterests.snippet.php'),
),'',true,true);
//$properties = include $sources['data'].'/properties/properties.mysnippet1.php';
//$snippets[1]->setProperties($properties);
//unset($properties);


$snippets[2]= $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 2,
    'name' => 'SmSubscribe',
    'description' => 'Displays request to subscribe if user is not logged in or logout link',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/SmSubscribe.snippet.php'),
),'',true,true);
//$properties = include $sources['data'].'/properties/properties.mysnippet2.php';
//$snippets[2]->setProperties($properties);
//unset($properties);
$snippets[3]= $modx->newObject('modSnippet');
$snippets[3]->fromArray(array(
    'id' => 3,
    'name' => 'SmLoadRegisterJS',
    'description' => 'Loads JS to validate registration form',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/SmLoadRegisterJS.snippet.php'),
),'',true,true);



return $snippets;