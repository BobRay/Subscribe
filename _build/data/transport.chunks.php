<?php

$chunks = array();

$chunks[1] = $modx->newObject('modChunk');
$chunks[1] ->fromArray(array(
    'id' => 1,
    'name' => 'SbsActivateEmailTpl',
    'description' => 'Tpl chunk to use for Subscribe activation email',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsactivateemailtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[2] = $modx->newObject('modChunk');
$chunks[2] ->fromArray(array(
    'id' => 2,
    'name' => 'SbsRegisterFormTpl',
    'description' => 'Chunk containing Subscribe register form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsregisterformtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[3] = $modx->newObject('modChunk');
$chunks[3] ->fromArray(array(
    'id' => 3,
    'name' => 'SbsSubscribeTpl',
    'description' => 'Subscribe extra chunk containing request to subscribe',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbssubscribetpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[4] = $modx->newObject('modChunk');
$chunks[4] ->fromArray(array(
    'id' => 4,
    'name' => 'SbsRegisterJsTpl',
    'description' => 'Subscribe extra chunk containing JS code to validate the Register form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsregisterjstpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[5] = $modx->newObject('modChunk');
$chunks[5] ->fromArray(array(
    'id' => 5,
    'name' => 'SbsLogoutLinkTpl',
    'description' => 'Subscribe extra logout link',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbslogoutlinktpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[6] = $modx->newObject('modChunk');
$chunks[6] ->fromArray(array(
    'id' => 6,
    'name' => 'SbsManagePrefsLinkTpl',
    'description' => 'Chunk containing request to subscribe',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsmanageprefslinktpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[7] = $modx->newObject('modChunk');
$chunks[7] ->fromArray(array(
    'id' => 7,
    'name' => 'SbsManagePrefsFormTpl',
    'description' => 'Subscribe extra Form for users to manage preferences',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsmanageprefsformtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[8] = $modx->newObject('modChunk');
$chunks[8] ->fromArray(array(
    'id' => 8,
    'name' => 'SbsUnsubscribeMessageTpl',
    'description' => 'Subscribe extra chunk containing unsubscribe success message',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsunsubscribemessagetpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[9] = $modx->newObject('modChunk');
$chunks[9] ->fromArray(array(
    'id' => 9,
    'name' => 'SbsChangePrefsSuccessMessageTpl',
    'description' => 'Success message for Subscribe change preferences form',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbschangeprefssuccessmessagetpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[10] = $modx->newObject('modChunk');
$chunks[10] ->fromArray(array(
    'id' => 10,
    'name' => 'SbsInterestListTpl',
    'description' => 'Interest list checkboxes for Subscribe Register and Manage Preferences forms.',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsinterestlisttpl.chunk.html'),
    'properties' => '',
),'',true,true);
return $chunks;