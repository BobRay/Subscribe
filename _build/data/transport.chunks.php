<?php

$chunks = array();

$chunks[1] = $modx->newObject('modChunk');
$chunks[1] ->fromArray(array(
    'id' => 1,
    'name' => 'SmActivateEmailTpl',
    'description' => 'Tpl chunk to use for Subscribe activation email',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smactivateemailtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[2] = $modx->newObject('modChunk');
$chunks[2] ->fromArray(array(
    'id' => 2,
    'name' => 'SmRegisterForm',
    'description' => 'Chunk containing Subscribe register form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smregisterform.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[3] = $modx->newObject('modChunk');
$chunks[3] ->fromArray(array(
    'id' => 3,
    'name' => 'SmSubscribe',
    'description' => 'Subscribe extra chunk containing request to subscribe',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smsubscribe.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[4] = $modx->newObject('modChunk');
$chunks[4] ->fromArray(array(
    'id' => 4,
    'name' => 'SmRegisterJS',
    'description' => 'Subscribe extra chunk containing JS code to validate the Register form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smregisterjs.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[5] = $modx->newObject('modChunk');
$chunks[5] ->fromArray(array(
    'id' => 5,
    'name' => 'SmLogoutLink',
    'description' => 'Subscribe extra logout link',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smlogoutlink.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[6] = $modx->newObject('modChunk');
$chunks[6] ->fromArray(array(
    'id' => 6,
    'name' => 'SmManagePrefsLink',
    'description' => 'Chunk containing request to subscribe',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smmanageprefslink.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[7] = $modx->newObject('modChunk');
$chunks[7] ->fromArray(array(
    'id' => 7,
    'name' => 'SmManagePrefsForm',
    'description' => 'Subscribe extra Form for users to manage preferences',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smmanageprefsform.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[8] = $modx->newObject('modChunk');
$chunks[8] ->fromArray(array(
    'id' => 8,
    'name' => 'SmUnsubscribeMessage',
    'description' => 'Subscribe extra chunk containing unsubscribe success message',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smunsubscribemessage.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[9] = $modx->newObject('modChunk');
$chunks[9] ->fromArray(array(
    'id' => 9,
    'name' => 'SmChangePrefsSuccessMessage',
    'description' => 'Success message for Subscribe change preferences form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/smchangeprefssuccessmessage.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[10] = $modx->newObject('modChunk');
$chunks[10] ->fromArray(array(
    'id' => 10,
    'name' => 'SmInterestList',
    'description' => 'Interest list checkboxes for Subscribe Register and Manage Preferences forms.',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sminterestlist.chunk.html'),
    'properties' => '',
),'',true,true);
return $chunks;