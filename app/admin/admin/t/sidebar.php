	
<ul>
	<?php 
		$array = array('pswd', 'pswd_succ');
		if($request->get_module() == 'admin' && in_array($request->get_method(), $array)){
	?>
	<li><a href="<?php echo ADMIN_HOME.'/pswd'?>" class="current"><span>修改密码</span></a></li>
	<?php 	
		}
		else{
	?>
	<li><a href="<?php echo ADMIN_COMPANY_HOME.'/index'?>"><span>企业用户管理</span></a></li>
	<li><a href="<?php echo ADMIN_EXPERT_HOME.'/index'?>"><span>专家用户管理</span></a></li>
	<li><a href="<?php echo ADMIN_ADMIN_HOME.'/index'?>" class="current"><span>管理员用户管理</span></a></li>
	<?php 
		}
	?>
</ul>		
