<?php echo Form::open(array()); ?>

	<?php if (isset($_GET['destination'])): ?>
		<?php echo Form::hidden('destination',$_GET['destination']); ?>
	<?php endif; ?>

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
		<div class="input"><?php echo Form::input('captcha', Input::post('captcha'), array('class'=>'span1')); ?></div>
		
		<?php if ($val->error('captcha')): ?>
			<div class="error"><?php echo $val->error('captcha')->get_message('请输入正确的:label'); ?></div>
		<?php endif; ?>
	</div>
	
	<div class="row">
		<img alt="captcha" src="<?php echo Uri::create('captcha'); ?>">
	</div>

	<div class="actions">
		<?php echo Form::submit(array('value'=>'立即登陆', 'name'=>'submit')); ?>
	</div>

<?php echo Form::close(); ?>