<?php
/**
 * ExportTvs
 *
 * Copyright 2011 Bob Ray
 *
 * @author Bob Ray
 * 3/27/12
 *
 * ExportTvs is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * ExportTvs is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * ExportTvs; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package exporttvs
 */
/**
 * MODx ExportTvs Snippet
 *
 * Description Extracts TVs from MODX install to build files
 *
 * @package exporttvs
 *
 */
/* @var $category string */

/* Usage
 *
 * Create a snippet called ExportTvs, paste the code or
 * use this for the snippet code:
 *     return include 'path/to/this/file';
 *
 * Put a tag for the snippet on a page and preview the page
 *
 * Minimal snippet call [[!ExportSystemSettings? &category=`MyCategory`]]
 *
 * Optional properties:
 *

 * &transportPath (directory for transport.tvs.php file)
 * defaults to assets/mycomponents/{categoryLower}/_build/data/
 *
 * &debug (if &debug=`1`, displays debug info - no files are written)
*/

$props =& $scriptProperties;
/* @var $modx modX */
$debug = $modx->getOption('export_debug', $props, null);

$category = $modx->getOption('category', $props, null);
/* @var $categoryObj modCategory */
$categoryObj = $modx->getObject('modNamespace', array('name' => $category));
if (!$categoryObj) {
    return 'Could not find namespace: ' . $category;
}
$categoryId = $categoryObj->get('id');
$categoryLower = strtolower($category);


$c = $modx->newQuery('modSystemSetting');

$c->where(array('namespace'=>$categoryLower));

$settings = $modx->getCollection('modSystemSetting', $c);
if (empty($settings)) {
    return 'No System Settings found in category: ' . $category;
}

$transportPath = $modx->getOption('transportPath', $props, null);
$transportPath = empty ($transportPath) ? $modx->getOption('assets_path') . 'mycomponents/' . $categoryLower . '/_build/data/' : $transportPath;

if (!is_dir($transportPath)) {
    return 'Bad transportPath: ' . $transportPath;
}

$transportFile = $transportPath . 'transport.settings.php';
$transportFp = fopen($transportFile, 'w');
if (!$transportFp) {
    return 'Could not open transport file: ' . $transportFile;
}



echo '<h3><br />Processing System Settings</h3>';
echo '<br />Namespace: ' . $category;
if ($debug) {
    echo '<br /><b>Debug is on. No files will be created or altered.</b>';
}

echo '<br />TransportFile: ' . $transportFile;

$i = 1;
fwrite($transportFp, "<?php\n\n");
fwrite($transportFp, "\$settings = array();\n\n");
foreach ($settings as $setting) {
    /* @var $setting modSystemSetting */

    echo '<br />Setting: ' . $setting->get('key');

    if (! $debug) {
        fwrite($transportFp, '$systemSettings[' . $i . '] = $modx->newObject(' . "'modSystemSetting');" . "\n");
        fwrite($transportFp, '$systemSettings[' . $i . '] ->fromArray(array(' . "\n");
        fwrite($transportFp, "    'id' => " . $i . ",\n");
        fwrite($transportFp, "    'key' => '" . $setting->get('key') . "',\n");
        fwrite($transportFp, "    'value' => '" . $setting->get('value') . "',\n");
        fwrite($transportFp, "    'xtype' => '" . $setting->get('xtype') . "',\n");
        fwrite($transportFp, "    'namespace' => '" . $setting->get('namespace') . "',\n");
        fwrite($transportFp, "    'area' => '" . $category . "',\n");
        fwrite($transportFp, "),'',true,true);\n");
    }

    $i++;
}


if (! $debug) {
    fwrite($transportFp, 'return $systemSettings;');
    fclose($transportFp);
}return '<br /><br />Finished processing System Settings';
