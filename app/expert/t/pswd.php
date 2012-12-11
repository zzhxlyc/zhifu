<?php 
	if($error){
		output_error($error);
	}
	else{
		output_edit_succ();
?>
<h2>修改密码</h2>
<div class="register">
	<form action="<?php echo $home.'/pswd'?>" method="post" >
	
	<div class="row">
		<label for="name">原密码</label>
		<input size="50" type="password" class="text" name="password" />
		<span class="error"><?php echo $errors['password']?></span>
	</div>
	<div class="row">
		<label for="name">新密码</label>
		<input size="50" type="password" class="text" name="password1" />
		<span class="error"><?php echo $errors['password1']?></span>
		密码长度在6位到16位之间
		<div class="pwd-level clearfix">
			<span class="current">弱</span>
			<span>中</span>
			<span>强</span>
		</div>
	</div>
	<div class="row">
		<label for="name">确认密码</label>
		<input size="50" type="password" class="text" name="password2" />
		<span class="error"><?php echo $errors['password2']?></span>
	</div>

	<div class="row">
		<input type="submit" value="保存"  class="btn" />
		<a href="<?php echo $home.'/myself'?>" class="back-btn">返回</a>
	</div>
	</form>
</div>


<?php 
	}
?>

<script type="text/javascript">


$("input[name=password]").focusout(function(){
	if($(this).val().trim().length==0){
		$(this).addClass('error');
		$(this).next().html('原密码不能为空');
	}else{
		$(this).removeClass('error');
		$(this).next().html('');
	}
	
});

$("input[name=password1]").focusout(function(){
	if($(this).val().trim().length==0){
		$(this).addClass('error');
		$(this).next().html('新密码不能为空');
	}else{
		$(this).removeClass('error');
		$(this).next().html('');
	}
	
});

$("input[name=password2]").focusout(function(){
	var pwd=$("input[name=password]").val();
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
	
	$("input[name=password1]").keydown(function(){
		checkPwdLevel($(this));

    });
	$("input[name=password1]").keyup(function(){
		checkPwdLevel($(this));

    });
</script>