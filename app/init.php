<?php

include(MODEL_DIR.'/AppModel.php');
include(MODEL_DIR.'/User.php');
Model::add_model('AppModel');
Model::add_model('User');

Model::load(array('BelongType', 'Word', 'Option', 
		'Expert', 'Company', 'Admin'));

App::load('util', 'TrieTree');
App::load('util', 'FileSystem');

include(LIB_DIR.'/AppController.php');
include(LIB_DIR.'/functions.php');