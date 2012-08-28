<?php

include(LIB_DIR.'/mail/gmail.php');

function send_forget_email($name){
	send_gmail();
}