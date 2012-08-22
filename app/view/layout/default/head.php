<div class="header_wrap">
	<div class="header">
		<h1 class="logo"><a href="#">知富网</a></h1>
		<?php if(isset($User)){?>
		<div class="top-nav">
			<a href="<?php echo ROOT_URL?>">首页</a>|
			<a href="<?php echo ROOT_URL.'/home'?>">个人主页</a>|
			<a href="<?php echo ROOT_URL.'/feed'?>">我的订阅</a>|
			<a href="<?php echo ROOT_URL.'/setting'?>">用户中心</a>|
			<a href="#" class="add-content">
				<?php if($User->is_company()){?>
					<a href="<?php echo PROBLEM_HOME.'/add'?>">发布难题</a>
					<a href="<?php echo IDEA_HOME.'/add'?>">创意悬赏</a>
				<?php }?>
				<?php if($User->is_expert()){?>
					<a href="<?php echo PATENT_HOME.'/add'?>">发布专利</a>
				<?php }?>
					<a href="<?php echo VIDEO_HOME.'/add'?>">发布视频</a>
			</a>
		</div>
		<?php }else{?>
		<div class="top-nav">
			<a href="<?php echo ROOT_URL?>">首页</a>|
			<a href="<?php echo ROOT_URL.'/register'?>">注册</a>|
			<a href="<?php echo ROOT_URL.'/login'?>">登陆</a>
		</div>
		<?php }?>
		
		<ul class="main-nav">
			<li><a href="<?php echo PROBLEM_HOME?>" <?php head_tab1()?>>企业难题</a></li>
			<li><a href="<?php echo IDEA_HOME?>" <?php head_tab2()?>>创意悬赏</a></li>
			<li><a href="<?php echo PATENT_HOME?>" <?php head_tab3()?>>技术专利</a></li>
			<li><a href="<?php echo RECRUIT_HOME?>" <?php head_tab4()?>>兼职顾问</a></li>
			<li><a href="<?php echo EXPERT_HOME?>" <?php head_tab5()?>>领域专家</a></li>
			<li><a href="<?php echo VIDEO_HOME?>" <?php head_tab6()?>>视频</a></li>
			<li><a href="<?php echo TOPIC_HOME?>" <?php head_tab7()?>>话题</a></li>
			<li><a href="<?php echo ARTICLE_HOME?>" class="last<?php head_tab8()?>">案例展示</a></li>

		</ul>
	</div><!--end for header-->

</div><!--end for header_wrap-->