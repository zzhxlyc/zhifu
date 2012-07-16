<?php

$ERROR = new Error();

$DB = new MySQLDatebase($CONF->get('DATABASE_HOST'), 
						$CONF->get('DATABASE_PORT'), 
						$CONF->get('DATABASE_USERNAME'), 
						$CONF->get('DATABASE_PASSWORD'), 
						$CONF->get('DATABASE_NAME'));