<?php

$chunks = array();

$chunks[1] = $modx->newObject('modChunk');
$chunks[1] ->fromArray(array(
    'id' => 1,
    'name' => 'sbswhyDialogTextTpl',
    'description' => 'Text for Subscribe Why Dialog',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbswhydialogtexttpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[2] = $modx->newObject('modChunk');
$chunks[2] ->fromArray(array(
    'id' => 2,
    'name' => 'sbsPrivacyDialogTextTpl',
    'description' => 'Text for Subscribe Privacy Policy dialog',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsprivacydialogtexttpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[3] = $modx->newObject('modChunk');
$chunks[3] ->fromArray(array(
    'id' => 3,
    'name' => 'sbsWhyDialogTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbswhydialogtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[4] = $modx->newObject('modChunk');
$chunks[4] ->fromArray(array(
    'id' => 4,
    'name' => 'sbsPrivacyDialogTpl',
    'description' => 'Subscribe Tpl chunk for Privacy Policy dialog',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsprivacydialogtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[5] = $modx->newObject('modChunk');
$chunks[5] ->fromArray(array(
    'id' => 5,
    'name' => 'sbsLoggedOutDisplayTpl',
    'description' => 'Subscribe extra display for users who are not logged in',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsloggedoutdisplaytpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[6] = $modx->newObject('modChunk');
$chunks[6] ->fromArray(array(
    'id' => 6,
    'name' => 'sbsLoggedInDisplayTpl',
    'description' => 'Displays Logout and Manage Preferences buttons for Subscribe extra',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsloggedindisplaytpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[7] = $modx->newObject('modChunk');
$chunks[7] ->fromArray(array(
    'id' => 7,
    'name' => 'sbsRegisterFormTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsregisterformtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[8] = $modx->newObject('modChunk');
$chunks[8] ->fromArray(array(
    'id' => 8,
    'name' => 'sbsPrefListTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbspreflisttpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[9] = $modx->newObject('modChunk');
$chunks[9] ->fromArray(array(
    'id' => 9,
    'name' => 'sbsCheckboxTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbscheckboxtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[10] = $modx->newObject('modChunk');
$chunks[10] ->fromArray(array(
    'id' => 10,
    'name' => 'sbsManagePrefsFormTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsmanageprefsformtpl.chunk.html'),
    'properties' => '',
),'',true,true);
$chunks[11] = $modx->newObject('modChunk');
$chunks[11] ->fromArray(array(
    'id' => 11,
    'name' => 'sbsActivationEmailTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/sbsactivationemailtpl.chunk.html'),
    'properties' => '',
),'',true,true);

$chunks[12] = $modx->newObject('modChunk');
$chunks[12]->fromArray(array(
    'id' => 12,
    'name' => 'sbsUserNotFoundTpl',
    'description' => '',
    'snippet' => file_get_contents($sources['source_core'] . '/elements/chunks/sbsusernotfoundtpl.chunk.html'),
    'properties' => '',
), '', true, true);



return $chunks;