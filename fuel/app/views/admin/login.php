<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> - 祥非常电脑</title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::css('admin.css') ?>
	<style>
		body { margin: 50px; }
		.form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
		.code-pic {
		    display: inline-block;
		}
		
		.code-pic img {
		    margin: 0 5px;
		    vertical-align: middle;
		}
	</style>
	<?php echo Asset::js(array(
		'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
		'bootstrap.js',
		'bootstrap-tooltip.js',
		'bootstrap-popover.js',
	)); ?>
	<script>
		$(function(){ $('.topbar').dropdown(); });
	</script>
</head>
<body>

<div class="container">

<?php echo Form::open(array('class'=>'form-signin')); ?>

	<?php if (isset($_GET['destination'])): ?>
		<?php echo Form::hidden('destination',$_GET['destination']); ?>
	<?php endif; ?>
	
	<h2 class="form-signin-heading">登陆</h2>

	<?php if (isset($login_error)): ?>
		<div class="error"><?php echo $login_error; ?></div>
	<?php endif; ?>

	<div class="row">
		<label for="email">邮箱或用户名：</label>
		<div class="input"><?php echo Form::input('email', Input::post('email')); ?></div>
		
		<?php if ($val->error('email')): ?>
			<div class="error"><?php echo $val->error('email')->get_message('必须提供:label地址'); ?></div>
		<?php endif; ?>
	</div>

	<div class="row">
		<label for="password">密码：</label>
		<div class="input"><?php echo Form::password('password'); ?></div>
		
		<?php if ($val->error('password')): ?>
			<div class="error"><?php echo $val->error('password')->get_message(':label不能为空'); ?></div>
		<?php endif; ?>
	</div>
	
	<div class="row">
		<label for="captcha">验证码：</label>
		<div class="input">
			<?php echo Form::input('captcha', Input::post('captcha'), array('class'=>'span1')); ?>
			<div class="code-pic">
				<img alt="captcha" src="<?php echo Uri::create('captcha'); ?>">
				<a id="change_code" href="#">换一个</a>
			</div>
		</div>
		
		<?php if ($val->error('captcha')): ?>
			<div class="error"><?php echo $val->error('captcha')->get_message('请输入正确的:label'); ?></div>
		<?php endif; ?>
	</div>
	
	<div class="row">
		<div class="actions">
			<?php echo Form::submit(array('value'=>'立即登陆', 'name'=>'submit', 'class'=>'btn btn-large btn-primary')); ?>
		</div>
	</div>

<?php echo Form::close(); ?>

</div>

</body>
</html>