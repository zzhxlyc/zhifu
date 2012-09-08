<div class="register">
	<h2>登录</h2>
	<form action="" method="post" >
	<div class="row">
		<label for="">登录名</label>
		<input class="text" type="text" name="user" value="<?php echo $username?>" />
		<span class="error"><?php echo $errors['user']?></span>
	</div>
	<div class="row">
		<label for="">密码</label>
		<input class="text" type="password" name="pswd" />
		<span class="error"><?php echo $errors['pswd']?></span>
	</div>
	<div class="row">
		<label for="type">用户类型</label>
		<input type="radio" name="type" value="Company" <?php $HTML->checked($type, 'Company')?>/> 公司
		<input type="radio" name="type" value="Expert" <?php $HTML->checked($type, 'Expert')?>/> 专家
		<span class="error"><?php echo $errors['type']?></span>
	</div>
	<div class="row captcha">
		<label for="">验证码</label>
		<input class="text" type="text" name="captcha" />
		<img alt="验证码" src="<?php echo ROOT_URL.'/captcha'?>">
		<span class="error"><?php echo $errors['captcha']?></span>
	</div>
	<div class="row clearfix button-area">
		<input type="submit" class="submit btn fl" value="登陆" />
		<a href="<?php echo $home.'/forget'?>" class="fl">忘记密码</a>
	</div>
	</form>
	
</div>
