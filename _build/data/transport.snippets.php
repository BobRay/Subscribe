<?php

$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1] ->fromArray(array(
    'id' => 1,
    'name' => 'SmGetInterests',
    'description' => "Subscribe extra - Gets user interests from Register form or Manage Preferences form and saves them in the 'comment' field of the User Profile.",
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/smgetinterests.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[2] = $modx->newObject('modSnippet');
$snippets[2] ->fromArray(array(
    'id' => 2,
    'name' => 'SmSubscribe',
    'description' => "Subscribe - Displays request to subscribe if user is not logged in or Logout  and Manage Preferences links",
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/smsubscribe.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[3] = $modx->newObject('modSnippet');
$snippets[3] ->fromArray(array(
    'id' => 3,
    'name' => 'SmLoadRegisterJS',
    'description' => "Subscribe - Loads JS to validate registration form",
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/smloadregisterjs.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[4] = $modx->newObject('modSnippet');
$snippets[4] ->fromArray(array(
    'id' => 4,
    'name' => 'SmGetCurrentPrefs',
    'description' => "Subscribe extra snippet to populate user's current preferences",
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/smgetcurrentprefs.snippet.php'),
    'properties' => '',
),'',true,true);
return $snippets;