<?php
/**
 * SubscribeMe transport chunks
 * Copyright 2012 Bob Ray <http://bobsguides/com>
 * @author Bob Ray <http://bobsguides/com>
 * 3/3/12
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
 * SubscribeMe; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package subscribeme
 */
/**
 * Description: Array of chunk objects for SubscribeMe package
 * @package subscribeme
 * @subpackage build
 */

$chunks = array();
/* @var $modx modX */
$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
    'id' => 1,
    'name' => 'SmActivateEmailTpl',
    'description' => 'Tpl chunk to use for SubscribeMe activation email',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/SmActivateEmailTpl.chunk.html'),
    'properties' => '',
),'',true,true);

$chunks[2]= $modx->newObject('modChunk');
$chunks[2]->fromArray(array(
    'id' => 2,
    'name' => 'SmLoadFiles',
    'description' => 'Chunk to load JS and CSS files for SubscribeMe',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/SmLoadfiles.chunk.html'),
    'properties' => '',
),'',true,true);

$chunks[3]= $modx->newObject('modChunk');
$chunks[3]->fromArray(array(
    'id' => 3,
    'name' => 'SmRegisterForm',
    'description' => 'Chunk containing SubscribeMe register form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/SmRegisterForm.chunk.html'),
    'properties' => '',
),'',true,true);

$chunks[4]= $modx->newObject('modChunk');
$chunks[4]->fromArray(array(
    'id' => 4,
    'name' => 'SmSubscribe',
    'description' => 'Chunk containing request to subscribe',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/SmSubscribe.chunk.html'),
    'properties' => '',
),'',true,true);


$chunks[5]= $modx->newObject('modChunk');
$chunks[5]->fromArray(array(
    'id' => 5,
    'name' => 'SmRegisterJS',
    'description' => 'Chunk containing JS code to validate the Register form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/SmRegisterJS.chunk.html'),
    'properties' => '',
),'',true,true);
return $chunks;