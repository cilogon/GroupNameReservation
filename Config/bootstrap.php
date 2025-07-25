<?php

App::uses('CakeEventManager', 'Event');
App::uses('GroupNameReservationListener', 'GroupNameReservation.Lib');

CakeEventManager::instance()->attach(new GroupNameReservationListener());
