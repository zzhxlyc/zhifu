<div>
	<span>当前位置：</span>
	<a href="<?php echo ROOT_URL?>">首页</a> > 
	<a href="<?php echo $home?>">科技成果</a> >
	<a><?php echo $Patent->title?></a>
</div>

<?php include('sidebar.php');?>

<div class="main-content">
	<!-- 
	<div class="section">
		<h3>项目状态
			<?php if(is_company($User)){?>
			<a href="<?php echo $home.'/submit?id='.$Patent->id?>" class="join-btn btn">我要购买</a>
			<?php }?>
			<?php if(is_expert($User) && $User->id == $Patent->expert){?>
			<a href="<?php echo $home.'/edit?id='.$Patent->id?>" class="edit">编辑</a>
			<?php }?>
			
		</h3>
		<div class="content status clearfix">
		</div>
	</div>
	 -->
	 
	<div class="section">
		<h3>专利介绍
		<?php if(is_expert($User) && $User->id == $Patent->expert){?>
			<a href="<?php echo $home.'/edit?id='.$Patent->id?>" class="edit">编辑</a>
			<?php }?>
		</h3>
		<div class="content">
			<?php echo $Patent->description?>
		</div>
		<div class="content">
			<?php if($Patent->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Patent->file"?>">点击下载</a>
			<?php }?>
		</div>
	</div>	

	<div class="section">
		<h3>购买者留言</h3>
		<div class="content line-list">
			<?php 
				foreach($deals as $deal){
					$buyer = $buyers[$deal->id];
			?>
			<div class="item clearfix">
				<!-- 
				<div class="pic">
					<a target="_blank" href="<?php echo get_author_link($buyer->id, $buyer->get_type())?>">
					<img src="<?php img($buyer->image, $buyer->default_image())?>" alt="<?php echo $buyer->name?>"
						 width="100" height="100"/>
					</a>
					<span class="name">
						<a target="_blank" href="<?php echo get_author_link($buyer->id, $buyer->get_type())?>">
						<?php output_username($buyer)?>
						</a>
					</span>
				</div>
				 -->
				<div class="des">
					<p><?php echo $deal->note?></p>
					<p>购买时间：<?php echo $deal->time?></p>
					<?php if(is_expert_object($User, $deal) || is_his_object($User, $deal)){?>
					<p>购买者：<a href="<?php echo get_author_link($deal->belong, $deal->type)?>"><?php echo $deal->name?></a></p>
					<p>联系方式：<?php echo $deal->phone?></p>
					<p>评估价格：<?php echo $deal->price?></p>
					<?php }?>
				</div>
			</div><!--end for item-->
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	<div class="section patent-comment">
		<h3>相关咨询与投资意向</h3>
		<div class="content line-list">
			
			<div class="item">
				<div class="meta">
					<span>用户名</span>来自：<span>地方</span><span>2012-11-11 11:11</span>
				</div>
				<div class="des">
					内容
				</div>
				<div class="price clearfix">评估价值：<span>20000</span> <span class="fr"><a href="">回复</a></span></div>
			</div><!--end for item-->
			<div class="child-item">
				<div class="meta">
					<span>用户名</span>来自：<span>地方</span> <span>2012-11-11 16：40</span>
				</div>
				<div class="des">。。。。</div>
			</div>
			
			
		</div><!--end for list-->
	</div><!--end for section-->	
	
	<div class="leave-comment section">
		<h3>如果您有意向投资或咨询，请给技术持有人留言</h3>
		<div class="row">
			<label for="">您的姓名</label>
			<input type="" class="text" />
		</div>
		<div class="row">
			<label for="">您的电话</label>
			<input type="" class="text" />
		</div>
		<div class="row">
			<label for="">评估价格</label>
			<input type="" class="text" />您认为这个技术价值多少
		</div>
		<div class="row clearfix">
			<label for="">留言</label>
			<textarea name="" class="text fl"></textarea>
			<p style="clear:both;padding-left:70px;padding-top:10px">提示：给技术持有人留言，简要说明您的投资意向或问题，勿在详细内容里留下电话以防骚扰</p>
			
		</div>
		
		<a href="javascript:void(0)" class="btn">回复</a>
		
	</div>
	
	<?php comment_div($comments, $links, $Patent, BelongType::PATENT, $User)?>
	
</div><!--end for main-content-->

<?php comment_js()?>