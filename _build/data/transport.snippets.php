<?php
if (! function_exists('getSnippetContent')) {
    function getSnippetContent($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<?php','',$o);
        $o = str_replace('?>','',$o);
        $o = trim($o);
        return $o;
    }
}
$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1] ->fromArray(array(
    'id' => 1,
    'name' => 'SubscribeRequest',
    'description' => "Displays request-to-subscribe or manage prefs/logout for Subscribe extra.",
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/sbssubscriberequest.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[2] = $modx->newObject('modSnippet');
$snippets[2] ->fromArray(array(
    'id' => 2,
    'name' => 'SubscribeForm',
    'description' => "Displays the Register form and the Manage Preferences form",
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/sbssubscribeform.snippet.php'),
    'properties' => '',
),'',true,true);

$snippets[3] = $modx->newObject('modSnippet');
$snippets[3]->fromArray(array(
     'id' => 3,
     'name' => 'Unsubscribe',
     'description' => "Processes Unsubscribe requests",
     'snippet' => getSnippetContent($sources['source_core'] . '/elements/snippets/sbsunsubscribe.snippet.php'),
     'properties' => '',
), '', true, true);

$snippets[4] = $modx->newObject('modSnippet');
$snippets[4]->fromArray(array(
     'id' => 4,
     'name' => 'InterestReport',
     'description' => "Displays a table showing the user-count for interest and (optionally) groups",
     'snippet' => getSnippetContent($sources['source_core'] . '/elements/snippets/sbsinterestreport.snippet.php'),
     'properties' => '',
), '', true, true);


return $snippets;