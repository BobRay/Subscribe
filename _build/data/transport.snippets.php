<?php
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = str_replace('<?php','',$o);
    $o = str_replace('?>','',$o);
    $o = trim($o);
    return $o;
}
$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1] ->fromArray(array(
    'id' => 1,
    'name' => 'SbsGetInterests',
    'description' => "Subscribe extra - Gets user interests from Register form or Manage Preferences form and saves them in the 'comment' field of the User Profile.",
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/sbsgetinterests.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[2] = $modx->newObject('modSnippet');
$snippets[2] ->fromArray(array(
    'id' => 2,
    'name' => 'SbsSubscribe',
    'description' => "Subscribe - Displays request to subscribe if user is not logged in or Logout  and Manage Preferences links",
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/sbssubscribe.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[3] = $modx->newObject('modSnippet');
$snippets[3] ->fromArray(array(
    'id' => 3,
    'name' => 'SbsLoadRegisterJS',
    'description' => "Subscribe - Loads JS to validate registration form",
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/sbsloadregisterjs.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[4] = $modx->newObject('modSnippet');
$snippets[4] ->fromArray(array(
    'id' => 4,
    'name' => 'SbsGetCurrentPrefs',
    'description' => "Subscribe extra snippet to populate user's current preferences",
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/sbsgetcurrentprefs.snippet.php'),
    'properties' => '',
),'',true,true);
return $snippets;