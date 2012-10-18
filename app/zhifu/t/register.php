
<div class="register">
	<h2>注册</h2>
	<form action="" method="post" >
	<div class="row">
		<label for="">用户名*</label>
		<input class="text" type="text" name="user" value="<?php echo $username?>" />
		<span class="error"><?php echo $errors['user']?></span>
		须大于3位小于20位的英文加数字，不能有特殊符号
	</div>
	<div class="row">
		<label for="">密码*</label>
		<input class="text" type="password" name="pswd" />
		<span class="error"><?php echo $errors['pswd']?></span>
		密码长度在6位到16位之间
		<div class="pwd-level clearfix">
			<span class="current">弱</span>
			<span>中</span>
			<span>强</span>
		</div>
	</div>
	<div class="row">
		<label for="">确认密码*</label>
		<input class="text" type="password" name="pswd2" />
		<span class="error"><?php echo $errors['pswd2']?></span>
		请再输入一遍密码
	</div>
	<div class="row">
		<label for="type">用户类型*</label>
		<input type="radio" name="type" value="Company" <?php $HTML->checked($type, 'Company')?>/> 公司
		<input type="radio" name="type" value="Expert" <?php $HTML->checked($type, 'Expert')?>/> 专家
		<span class="error"><?php echo $errors['type']?></span>
	</div>
	<div class="row">
		<label for="">手机*</label>
		<input class="text" type="text" name="mobile" value="<?php echo $mobile?>" />
		<span class="error"><?php echo $errors['mobile']?></span>
	</div>
	<div class="row">
		<label for="">邮件*</label>
		<input class="text" type="text" name="email" value="<?php echo $email?>" />
		<span class="error"><?php echo $errors['email']?></span>
	</div>
	<div class="row captcha">
		<label for="">验证码</label>
		<input class="text" type="text" name="captcha" />
		<img alt="验证码" src="<?php echo ROOT_URL.'/captcha'?>" onclick="this.src='<?php echo ROOT_URL.'/captcha'?>'" style="cursor:pointer">
		<span class="error"><?php echo $errors['captcha']?></span>
	</div>
	<div class="row captcha">
		<input type="checkbox" name="agree" />
		同意会员注册服务条款
		<span class="error"><?php echo $errors['agree']?></span>
	</div>
	<div class="row">
		<input type="submit" class="submit btn" value="注册" />
	</div>
	</form>
	
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name=user]").focusin(function(){
       	 

    });
	$("input[name=user]").focusout(function(){
		if($(this).val().trim().length==0){
			$(this).addClass('error');
			$(this).next().html('用户名不能为空');
		}else{
			$(this).removeClass('error');
			$(this).next().html('');
		}
		
	});
	
	function checkPwdLevel(box){
		var pwd=box.val();
       	if(pwd.length<5){
			$('.pwd-level').children().removeClass('current');
			$('.pwd-level span:eq(0)').addClass('current');
			
		}else if(pwd.length>=5&&pwd.length<8){
			$('.pwd-level').children().removeClass('current');
			$('.pwd-level span:eq(1)').addClass('current');
		}else{
			$('.pwd-level').children().removeClass('current');
			$('.pwd-level span:eq(2)').addClass('current');			
		}
	}
	
	$("input[name=pswd]").keydown(function(){
		checkPwdLevel($(this));

    });
	$("input[name=pswd]").keyup(function(){
		checkPwdLevel($(this));

    });

	$("input[name=pswd]").focusin(function(){
       	 

    });
	$("input[name=pswd]").focusout(function(){
		if($(this).val().trim().length==0){
			$(this).addClass('error');
			$(this).next().html('密码不能为空');
		}else{
			$(this).removeClass('error');
			$(this).next().html('');
		}
		
	});

	$("input[name=pswd2]").focusin(function(){
       	 

    });
	$("input[name=pswd2]").focusout(function(){
		var pwd=$("input[name=pswd]").val();
		var pwd2=$(this).val();
		if(pwd2.length==0){
			$(this).addClass('error');
			$(this).next().html('确认密码不能为空');
		}else{
			if(pwd2!=pwd){
				$(this).addClass('error');
				$(this).next().html('密码不一致');
			}else{
				$(this).removeClass('error');
				$(this).next().html('');
			}
			
		}
		
		
		
	});
	$("input[name=email]").focusin(function(){
       	 

    });
	$("input[name=email]").focusout(function(){
		var email=$("input[name=email]").val();
		if(email.length==0){
			$(this).addClass('error');
			$(this).next().html('邮箱不能为空');
		}else{
			if(isEmail(email)){
				$(this).removeClass('error');
				$(this).next().html('');	
			}
			
			else{
				$(this).addClass('error');
				$(this).next().html('邮箱格式不正确');
			}
		
		}
		
		
	});
	
	
	function isEmail(email){
		var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
		chkFlag = pattern.test(email);
		if(chkFlag){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
});	
	
</script>