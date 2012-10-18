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
		<h3>购买专利</h3>
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
					<textarea rows="3" cols="70" name="note"><?php echo $deal->note?></textarea>
					<span class="error"><?php echo $errors['note']?></span>
				</div>
				<input type="submit" value="有意向购买" class="btn fl">
				<input type="hidden" name="id" value="<?php echo $Patent->id?>">
				<a href="<?php echo $home.'/detail?id='.$Patent->id?>" class="back-btn">返回</a>
			</form>
			<?php }else if(!output_edit_succ()){?>
				已购买
			<?php }?>
		</div><!--end for list-->
	</div><!--end for section-->	
	<?php }?>
	
</div><!--end for main-content-->