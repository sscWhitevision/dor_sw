<?php
/**
 * @package consentfriend
 */
$xpdo_meta_map['ConsentfriendServicePurposes']= array (
  'package' => 'consentfriend',
  'version' => '1.1',
  'table' => 'consentfriend_servicepurposes',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'service_id' => 0,
    'purpose_id' => NULL,
  ),
  'fieldMeta' => 
  array (
    'service_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'purpose_id' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
  'indexes' => 
  array (
    'service_id' => 
    array (
      'alias' => 'service_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'service_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'purpose_id' => 
    array (
      'alias' => 'purpose_id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'purpose_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Service' => 
    array (
      'class' => 'ConsentfriendServices',
      'local' => 'service_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Purpose' => 
    array (
      'class' => 'ConsentfriendPurposes',
      'local' => 'purpose_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
