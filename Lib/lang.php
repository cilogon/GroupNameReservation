<?php
/**
 * COmanage Registry Group Name Reservation Language File
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
 * @package       registry-plugin
 * @since         COmanage Registry v4.6.0
 * @license       Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */

global $cm_lang, $cm_texts;

// When localizing, the number in format specifications (eg: %1$s) indicates the argument
// position as passed to _txt.  This can be used to process the arguments in
// a different order than they were passed.

$cm_group_name_reservation_texts['en_US'] = array(
  // Titles, per-controller
  'ct.group_name_reservations.1'  => 'Group Name Reservation',
  'ct.group_name_reservations.pl' => 'Group Name Reservations',

  //Fields
  'fd.gnr.error_message'	=> 'Error Message',
  'fd.gnr.error_message.desc'	=> 'Error message to display when a CO Person tries to create a group name that matches a pattern reserved for Administrators',
  'fd.gnr.name_format'		=> 'Name Format',
  'fd.gnr.name_format.desc' 	=> 'Regular expression describing a group name pattern that is reserved for Administrators,including delimiters. See <a href="https://www.php.net/manual/en/reference.pcre.pattern.syntax.php">PCRE Pattern Syntax</a> in the PHP Manual for more information',
 
);
