
<div class="main-content">

	<div class="section">
		<h3>站内信</h3>
		<div class="content line-list">
			<div class="row">
				<label for="name">发信人</label>
				<a href="<?php echo get_author_link($Message->from, $Message->from_type)?>">
					<?php echo $Message->from_name?>
					<?php if($Message->from_author){?>
					（<?php echo $Message->from_author?>）
					<?php }?>
				</a>
			</div>
			<!-- <div class="row">
				<label for="name">收信人</label>
				<a href="<?php echo get_author_link($Message->to, $Message->to_type)?>">
					<?php echo $Message->to_name?>
					<?php if($Message->to_author){?>
					（<?php echo $Message->to_author?>）
					<?php }?>
				</a>
			</div> -->
			<div class="row">
				<label for="name">发送时间</label>
				<?php echo $Message->time?>
			</div>
			<div class="row">
				<label for="name">标题</label>
				<?php echo $Message->title?>
			</div>
			<div class="row">
				<label for="">内容</label>
				<?php echo $Message->content?>
			</div>
			<?php if($Message->from_type != BelongType::ADMIN && 
						$User->id == $Message->to && $User->get_type() == $Message->to_type){?>
			<a href="<?php echo $home.'/send?user='.$Message->from_name?>" target="_blank"
				class="back-btn">回复</a>
			<?php }?>
			<a href="javascript:void(0)" onclick="history.back()" class="back-btn">返回</a>
		</div><!--end for list-->
	</div><!--end for section-->	
	
	
</div><!--end for main-content-->