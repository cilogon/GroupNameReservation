<?php
/**
 * COmanage Registry Group Name Reservations Controller
 *
 * Portions licensed to the University Corporation for Advanced Internet
 * Development, Inc. ("UCAID") under one or more contributor license agreements.
 * See the NOTICE file distributed with this work for additional information
 * regarding copyright ownership.
 *
 * UCAID licenses this file to you under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with the
 * License. You may obtain a copy of the License at:
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @link          http://www.internet2.edu/comanage COmanage Project
 * @package       registry
 * @since         COmanage Registry v4.6.0
 * @license       Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */

App::uses("StandardController", "Controller");
 
class GroupNameReservationsController extends StandardController {
  // Class name, used by Cake
  public $name = "GroupNameReservations";
 
  // This controller needs a CO to be set
  public $requires_co = true;

  /**
   * Authorization for this Controller, called by Auth component
   * - precondition: Session.Auth holds data used for authz decisions
   * - postcondition: $permissions set with calculated permissions
   *
   * @since  COmanage Registry v0.6
   * @return Array Permissions
   */

  function isAuthorized() {
    $roles = $this->Role->calculateCMRoles();

    // Construct the permission set for this user, which will also be passed to the view.
    $p = array();

    // Determine what operations this user can perform

    // Add a new Group Name Reservation?
    $p['add'] = ($roles['cmadmin'] || $roles['coadmin']);

    // Delete an existing Group Name Reservation?
    $p['delete'] = ($roles['cmadmin'] || $roles['coadmin']);

    // Edit an existing Group Name Reservation?
    $p['edit'] = ($roles['cmadmin'] || $roles['coadmin']);

    // View all existing Group Name Reservations?
    $p['index'] = ($roles['cmadmin'] || $roles['coadmin']);

    // View an existing Group Name Reservation?
    $p['view'] = ($roles['cmadmin'] || $roles['coadmin']);

    $this->set('permissions', $p);

    return $p[$this->action];
  }

 /* function index() {

    //See it there are any active GroupNameReservations for the current CO

    $coId = $this->cur_co['Co']['id'];

    $args = array();
    $args['conditions']['co_id'] = $coId;
    $args['conditions']['GroupNameReservation.status'] = SuspendableStatusEnum::Active;
    $args['contain'] = false;

    $activeReservations = $this->GroupNameReservation->find('first', $args);

    //If there is an active reservation, set the view variable so we can disable the add button in the View
    if (!empty($activeReservations)) {
        $this->set('vv_active_reservation', true);
    } else {
        $this->set('vv_active_reservation', false);
    }

    //call the parent index function
    parent::index();
  } */

} 
