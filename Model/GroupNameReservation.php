<?php

class GroupNameReservation extends AppModel {
  // Required by COmanage Plugins

  public $name = "GroupNameReservation";

  public $belongsTo = array(
    "Co",
  );

  public $cmPluginHasMany = array(
    "Co" => array("GroupNameReservation")
  );

  public $cmPluginType = "other";
  
  public $displayField = "description";

  // Validation rules for table elements
  public $validate = array(
    'co_id' => array(
      'rule' => 'numeric',
      'required' => true,
      'message' => 'A CO ID must be provided'
    ),
    'description' => array(
      'rule' => array('validateInput'),
      'required' => false,
      'allowEmpty' => true
    ),
    'status' => array(
      'rule' => array('inList', array(SuspendableStatusEnum::Active,
                                      SuspendableStatusEnum::Suspended)),
      'required' => true,
      'allowEmpty' => false
    ),
    'name_format' => array(
      'rule' => '/.*/',
      'required' => true,
      'allowEmpty' => false
    ),
    'error_message' => array(
      'rule' => array('validateInput'),
      'required' => true,
      'allowEmpty' => false
    )
  );
        


  public function cmPluginMenus() {
    return array(
      "coconfig" => array(_txt('ct.group_name_reservations.1') =>
        array('icon'       => 'done_all',
              'controller' => 'group_name_reservations',
              'action'     => 'index')
      )
    );
  }

}
