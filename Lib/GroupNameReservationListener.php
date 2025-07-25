<?php

App::uses('CakeEventListener', 'Event');
App::uses('CakeEvent', 'Event');
App::uses('CakeSession', 'Model/Datasource');
App::uses("GroupNameReservation", "GroupNameReservation.Model");

class GroupNameReservationListener implements CakeEventListener {

  public function implementedEvents() {
    return array(
      'Model.beforeSave' => 'checkGroupName'
    );
  }

  public function checkGroupName(CakeEvent $event) {
    // The subject of the event is a Model object.
    $model = $event->subject();
    // We only intend to intercept the CoGroup model.
    if(!($model->name === 'CoGroup')) {
      return true;
    }

    // Grab the data being used for the save action.
    $group = $model->data;
     
    // Only intercept standard groups and not auto groups.
    if(!empty($group['CoGroup']['group_type'])) {
      if($group['CoGroup']['group_type'] != GroupEnum::Standard) {
        return true;
      }
    }
    
    if(!empty($group['CoGroup']['auto'])) {
      if($group['CoGroup']['auto'] == true) {
        return true;
      }
    }

    // Get the authenticated user.
    $user = CakeSession::read('Auth.User');

    // Is the authenticated user a platform admin?
    $isPlatformAdmin = $user['cos']['COmanage']['groups']['CO:admins']['member'] ?? false;

    //get the CO id for the group 
    $coId = $group['CoGroup']['co_id'];

    // Is the authenticated user a CO admin for the active CO?
    $isCoAdmin = false;
    foreach($user['cos'] as $co) {
      if($co['co_id'] == $coId) {
        $isCoAdmin = $co['groups']['CO:admins']['member'] ?? false;
        break;
      }
    }

    // Is the authenticated user an admin?
    $isAdmin = $isPlatformAdmin || $isCoAdmin;
    
    if ($isAdmin) {
       return true;
    }

    //Get the Group Name Reservations, if there are any, for this CO. 

    $reservationModel = new GroupNameReservation();

    $args = array();
    $args['conditions']['co_id'] = $coId;
    $args['conditions']['GroupNameReservation.status'] = SuspendableStatusEnum::Active;
    $arg['contain'] = true;
 
    $reservations = $reservationModel->find('all', $args);
    
    //check if empty 
    if (empty($reservations)) {
       return true;
    }

    // Test the group name against the configured regular expression(s)
    // and intercept any names that match.

    foreach($reservations as $res) {

      $pattern = $res['GroupNameReservation']['name_format'];

      $match = preg_match($pattern, $group['CoGroup']['name']);

      if($match == 0) {
        continue;
      } else {
        // Set the Message stored in the session and used by the Flash component.
        // We append a new message to any existing messasges.
        $messages = (array)CakeSession::read('Message');

        $newMessage = array(
          'message' => $res['GroupNameReservation']['error_message'], 
          'key' => 'error',
          'element' => 'default',
          'params' => array()
        );

        $messages[] = $newMessage;

        CakeSession::write('Message.' . 'error', $messages);

        // Return false to prevent the save.
        return false;
      }
    }
    return true;
  }
}
