<?php
/**
 * @package consentfriend
 */
$xpdo_meta_map['ConsentfriendPurposes']= array (
  'package' => 'consentfriend',
  'version' => '1.1',
  'table' => 'consentfriend_purposes',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'key' => NULL,
    'title' => NULL,
    'description' => NULL,
    'active' => 0,
    'sortindex' => 0,
  ),
  'fieldMeta' => 
  array (
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => true,
    ),
    'title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => true,
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
    ),
    'sortindex' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'ServicePurposes' => 
    array (
      'class' => 'ConsentfriendServicePurposes',
      'local' => 'id',
      'foreign' => 'purpose_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
