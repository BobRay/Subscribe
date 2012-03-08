<?php

/**
 * properties for SubscribeMe propertyset2
 * @author Bob Ray <http://bobsguides/com>
 * 3/3/12
 *
 * @package subscribeme
 * @subpackage build
 */

/* These are example properties for a property set.
 * The description fields should match
 * keys in the lexicon property file
 *
 * Change propertyset1, propertyset2 to the name of your property set.
 * Change property1, property2 to the name of the property.
 * */


$properties = array(
    array(
        'name' => 'property1',
        'desc' => 'sm_propertyset2_property1_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => '1',
        'lexicon' => 'subscribeme:properties',
    ),
     array(
        'name' => 'property2',
        'desc' => 'sm_propertyset2_property2_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'Some other text',
        'lexicon' => 'subscribeme:properties',
    ),

);

return $properties;