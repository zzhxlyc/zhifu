<form action="" method="post" >
<div class="row">
	<label for="">邮件</label>
	<input class="text" type="text" name="email" value="<?php echo $email?>" />
	<span class="error"><?php echo $errors['email']?></span>
</div>
<div class="row">
	<label for="type">用户类型</label>
	<input type="radio" name="type" value="Company" <?php $HTML->checked($type, 'Company')?>/> 公司
	<input type="radio" name="type" value="Expert" <?php $HTML->checked($type, 'Expert')?>/> 专家
	<span class="error"><?php echo $errors['type']?></span>
</div>
<div class="row">
	<label for="">验证码</label>
	<input class="text" type="text" name="captcha" />
	<img alt="验证码" src="<?php echo ROOT_URL.'/captcha'?>">
	<span class="error"><?php echo $errors['captcha']?></span>
</div>
<div class="row">
	<input type="submit" value="发送邮件" />
	<a href="<?php echo $home?>">返回</a>
</div>
</form>