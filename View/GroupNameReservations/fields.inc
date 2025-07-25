<?php
/**
 * COmanage Registry CO Group Name Reservation Fields
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

  // Determine if fields are editable
  $e = false;
  
  if(($this->action == "add" && $permissions['add']) || ($this->action == "edit" && $permissions['edit']))
    $e = true;
    
  // We shouldn't get here if we don't have at least read permission, but check just in case
  
  if(!$e && !$permissions['view'])
    return(false);

  // Add breadcrumbs
  print $this->element("coCrumb");
  $args = array();
  $args['plugin'] = 'group_name_reservation';
  $args['controller'] = 'group_name_reservations';
  $args['action'] = 'index';
  $args['co'] = $cur_co['Co']['id'];
  $this->Html->addCrumb(_txt('ct.group_name_reservations.pl'), $args);

  $crumbTxt = _txt('op.' . $this->action . '-a', array(_txt('ct.group_name_reservations.1')));
  $this->Html->addCrumb($crumbTxt);
  
  print $this->Form->hidden('co_id', array('default' => $cur_co['Co']['id'])) . "\n";
?>

<ul id="<?php print $this->action; ?>_group_name_reservation" class="fields form-list form-list-admin">
  <li>
    <div class="field-name">
      <div class="field-title">
        <?php print ($e ? $this->Form->label('description', _txt('fd.desc')) : _txt('fd.desc')); ?>
      </div>
    </div>
    <div class="field-info">
      <?php print ($e
                   ? $this->Form->input('description', array('class' => 'focusFirst'))
                   : filter_var($group_name_reservations[0]['GroupNameReservation']['description'],FILTER_SANITIZE_SPECIAL_CHARS)); ?>
    </div>
  </li>
  <li>
    <div class="field-name">
      <?php print ($e ? $this->Form->label('status', _txt('fd.status')) : _txt('fd.status')); ?>
    </div>
    <div class="field-info">
      <?php
        global $cm_lang, $cm_texts;
        
        $attrs = array();
        $attrs['value'] = (isset($group_name_reservations) ? $group_name_reservations[0]['GroupNameReservation']['status'] : SuspendableStatusEnum::Active);
        $attrs['empty'] = false;

        if($e) {
          print $this->Form->select('status',
                                    $cm_texts[ $cm_lang ]['en.status.susp'],
                                    $attrs);

          if($this->Form->isFieldError('status')) {
            print $this->Form->error('status');
          }
        } else {
          print _txt('en.status', null, $group_name_reservations[0]['GroupNameReservation']['status']);
        }
      ?>
    </div>
  </li>
  <li>
    <div class="field-name vtop">
      <div class="field-title">
        <?php print ($e ? $this->Form->label('name_format', _txt('fd.gnr.name_format')) : _txt('fd.gnr.name_format')); ?>
      </div>
      <div class="field-desc"><?php print _txt('fd.gnr.name_format.desc'); ?></div>
    </div>
    <div class="field-info">
      <?php print ($e ? $this->Form->input('name_format') : filter_var($group_name_reservations[0]['GroupNameReservation']['name_format'],FILTER_SANITIZE_SPECIAL_CHARS)); ?>
    </div>
  </li>
  <li>
    <div class="field-name vtop">
      <div class="field-title">
        <?php print ($e ? $this->Form->label('error_message', _txt('fd.gnr.error_message')) : _txt('fd.gnr.error_message')); ?>
      </div>
      <div class="field-desc"><?php print _txt('fd.gnr.error_message.desc'); ?></div>
    </div>
    <div class="field-info">
      <?php print ($e ? $this->Form->input('error_message') : filter_var($group_name_reservations[0]['GroupNameReservation']['error_message'],FILTER_SANITIZE_SPECIAL_CHARS)); ?>
    </div>
  </li>
  <?php if($e): ?>
    <li class="fields-submit">
      <div class="field-name"></div>
      <div class="field-info">
        <?php print $this->Form->submit($submit_label); ?>
      </div>
    </li>
  <?php endif; ?>
</ul>


