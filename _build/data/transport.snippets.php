<?php

$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1] ->fromArray(array(
    'id' => 1,
    'name' => 'SubscribeRequest',
    'description' => "Displays request-to-subscribe or manage prefs/logout for Subscribe extra.",
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/sbssubscriberequest.snippet.php'),
    'properties' => '',
),'',true,true);
$snippets[2] = $modx->newObject('modSnippet');
$snippets[2] ->fromArray(array(
    'id' => 2,
    'name' => 'SubscribeForm',
    'description' => "",
    'snippet' => file_get_contents($sources['source_core'].'/elements/snippets/sbssubscribeform.snippet.php'),
    'properties' => '',
),'',true,true);
return $snippets;