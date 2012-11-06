<?php include('sidebar.php');?>

<div class="main-content">

	<div class="section">
		<h3>专利介绍</h3>
		<div class="content">
			<?php echo $Patent->description?>
		</div>
		<div class="content">
			<?php if($Patent->file){?>
			附件：<a target="_blank" href="<?php echo UPLOAD_HOME."/$Patent->file"?>">点击下载</a>
			<?php }?>
		</div>
	</div>	

	<?php if(!is_expert_object($User, $Patent)){?>
	<div class="section">
		<h3>给专利持有人留言</h3>
		<div class="content line-list">
			<?php if(!$buyed){?>
			<form action="" method="post">
				<div class="row">
					<label for="name">您的姓名</label>
					<input size="50" type="text" class="text" name="name" value="<?php echo $deal->name?>" />
					<span class="error"><?php echo $errors['name']?></span>
				</div>
				<div class="row">
					<label for="name">您的电话</label>
					<input size="50" type="text" class="text" name="phone" value="<?php echo $deal->phone?>" />
					<span class="error"><?php echo $errors['phone']?></span>
				</div>
				<div class="row">
					<label for="name">评估价格</label>
					<input size="50" type="text" class="text" name="price" value="<?php echo $deal->price?>" />
					<span>您认为这个技术价值多少</span>
					<span class="error"><?php echo $errors['price']?></span>
				</div>
				<div class="row">
					<label for="name">留言</label>
					<textarea rows="3" cols="70" name="note" style="border: 1px solid #DDD;"><?php echo $deal->note?></textarea>
					<span class="error"><?php echo $errors['note']?></span> <br>
				</div>
				<div class="row">
					<label for="name">提示</label>
					<span>给技术持有人留言，简要说明您的投资意向或问题，勿在详细内容里留下电话以防骚扰</span>
				</div>
				<div class="row">
					<label for="name"></label>
					<input type="submit" value="提交" class="btn fl">
					<input type="hidden" name="id" value="<?php echo $Patent->id?>">
					<a href="<?php echo $home.'/detail?id='.$Patent->id?>" class="back-btn">返回</a>
				</div>
			</form>
			<?php }else if(!output_edit_succ()){?>
				已购买
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	<?php }?>
	
</div><!--end for main-content-->