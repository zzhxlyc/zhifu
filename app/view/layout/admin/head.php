<div id="header">
	<h1 id="logo">
		科视网后台
		<a target="_blank" href="<?php echo ROOT_URL?>"><span style="font-size:12px">查看前台</span></a>
	</h1>
	<?php if(!$is_login){?>
	<ul id="nav" class="clearfix">
		<li><a href="<?php echo ADMIN_PROBLEM_HOME.'/index'?>" <?php if_tab1_current()?>><span>内容管理</span></a></li>
		<li><a href="<?php echo ADMIN_COMPANY_HOME.'/index'?>" <?php if_tab2_current()?>><span>用户管理</span></a></li>
		<li><a href="<?php echo ADMIN_WORD_HOME.'/index'?>" <?php if_tab3_current()?>><span>安全管理</span></a></li>
		<li><a href="<?php echo ADMIN_PAY_HOME.'/index'?>" <?php if_tab4_current()?>><span>支付通知</span></a></li>
		<li><a href="<?php echo ADMIN_MANAGE_HOME.'/base'?>" <?php if_tab5_current()?>><span>站务中心</span></a></li>
		<li><a href="<?php echo ADMIN_LINK_HOME.'/index'?>" <?php if_tab6_current()?>><span>广告位管理</span></a></li>
		<li><a href="<?php echo ADMIN_HOME.'/pswd'?>" <?php if_tab7_current()?>><span>个人中心</span></a></li>
	</ul>
	<?php }?>
</div>
