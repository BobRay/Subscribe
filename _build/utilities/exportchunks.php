<?php
/**
 * ExportChunks
 *
 * Copyright 2011 Bob Ray
 *
 * @author Bob Ray
 * 3/27/12
 *
 * ExportChunks is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * ExportChunks is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * ExportChunks; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package exportchunks
 */
/**
 * MODx ExportChunks Snippet
 *
 * Description Extracts chunks from MODX install to build files
 *
 * @package exportchunks
 *
 */
/* @var $category string */

/* Usage
 *
 * Create a snippet called ExportCategorys, paste the code or
 * use this for the snippet code:
 *     return include 'path/to/this/file';
 *
 * Put a tag for the snippet on a page and preview the page
 *
 * Minimal snippet call [[!ExportCategory? &category=`MyCategory`]]
 *
 * Optional properties:
 *
 * &chunkPath  (directory for chunk code files)
 * defaults to assets/mycomponents/{categoryLower}/core/components/{categoryLower}/elements/chunks/
 *
 * &transportPath (directory for transport.chunks.php file)
 * defaults to assets/mycomponents/{categoryLower}/_build/data/
 *
 * &debug (if &debug=`1`, displays debug info - no files are written)
*/

$props =& $scriptProperties;
/* @var $modx modX */
$debug = $modx->getOption('export_debug', $props, null);
$prefix=$modx->getOption('prefix',$props,null);
$category = $modx->getOption('category', $props, null);
/* @var $categoryObj modCategory */
$categoryObj = $modx->getObject('modCategory', array('category' => $category));
if (!$categoryObj) {
    return 'Could not find category: ' . $category;
}
$categoryId = $categoryObj->get('id');
$categoryLower = strtolower($category);

$chunks = $modx->getCollection('modChunk', array('category' => $categoryId));
if (empty($chunks)) {
    return 'No Chunks found in category: ' . $category;
}
$chunkPath = $modx->getOption('chunkPath', $props, null);
$chunkPath = empty ($chunkPath) ? $modx->getOption('assets_path') . 'mycomponents/' . $categoryLower . '/core/components/' . $categoryLower . '/elements/chunks/' : $chunkPath;

$transportPath = $modx->getOption('transportPath', $props, null);
$transportPath = empty ($transportPath) ? $modx->getOption('assets_path') . 'mycomponents/' . $categoryLower . '/_build/data/' : $transportPath;

if (!is_dir($transportPath)) {
    return 'Bad transportPath: ' . $transportPath;
}

$transportFile = $transportPath . 'transport.chunks.php';
$transportFp = fopen($transportFile, 'w');
if (!$transportFp) {
    return 'Could not open transport file: ' . $transportFile;
}

echo '<h3><br />Processing Chunks</h3>';
echo '<br />Category: ' . $category;
if ($debug) {
    echo '<br /><b>Debug is on. No files will be created or altered.</b>';
}
echo '<br />TransportFile: ' . $transportFile;
$i = 1;

if (!$debug) {
    fwrite($transportFp, "<?php\n\n");
    fwrite($transportFp, "\$chunks = array();\n\n");
}
foreach ($chunks as $chunk) {
    /* @var $chunk modChunk */
    if ($props['CreateFiles']) {
        $content = $chunk->getContent();
        $fileName = $chunkPath . strtolower($chunk->get('name')) . '.chunk.html';
    }

    echo '<br />Processing chunk: ' . $chunk->get('name');


    if (!$debug) {
        if ($props['CreateFiles']) {
            $fp = fopen($fileName, 'w');
            if (!$fp) {
                return 'Could not open chunk file: ' . $fileName;
            }
            echo '<br />    Creating: ' . $fileName;
            fwrite($fp, $content);
            fclose($fp);
        }


        fwrite($transportFp, '$chunks[' . $i . '] = $modx->newObject(' . "'modChunk');" . "\n");
        fwrite($transportFp, '$chunks[' . $i . '] ->fromArray(array(' . "\n");
        fwrite($transportFp, "    'id' => " . $i . ",\n");
        fwrite($transportFp, "    'name' => '" . $chunk->get('name') . "',\n");
        fwrite($transportFp, "    'description' => '" . $chunk->get('description') . "',\n");
        fwrite($transportFp, "    'snippet' => file_get_contents(\$sources['source_core']." . "'/elements/chunks/" . $prefix . strtolower($chunk->get('name')) . ".chunk.html'),\n");
        $properties = $chunk->get('properties');
        $properties = empty($properties) ? '' : $modx->toJSON($properties);
        fwrite($transportFp, "    'properties' => '" . $properties . "',\n");
        fwrite($transportFp, "),'',true,true);\n");
    }

    $i++;
}
if (!$debug) {
    fwrite($transportFp, 'return $chunks;');
    fclose($transportFp);
}
return '<br /><br />Finished processing chunks';