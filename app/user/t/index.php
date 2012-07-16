124:<?php echo $name?>
<div>
	<?php 
		list($vars, $template) = call_controller('UserController', 'div');
		include($template);
	?>
</div>
<?php 
	foreach($list as $l){
		echo $l.'<br>';
	}
?>
<?php $HTML->text('name', '123');?>
