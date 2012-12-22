<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> - 祥非常电脑</title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::css('admin.css') ?>
	<style>
		body { margin: 50px; }
	</style>
	<?php echo Asset::js(array(
		'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
		'bootstrap.js',
		'bootstrap-tooltip.js',
		'bootstrap-popover.js',
	)); ?>
	<script>
                window.root = '<?php echo Uri::base(); ?>';
		$(function(){ $('.topbar').dropdown(); });
	</script>
</head>
<body>

	<?php if ($current_user): ?>
	<div class="navbar navbar-fixed-top">
	    <div class="navbar-inner">
	        <div class="container">
	            <a href="#" class="brand">后台管理</a>
	            <ul class="nav">
	                <li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
						<?php echo Html::anchor('admin', '起始页') ?>
					</li>

					<?php foreach (glob(APPPATH.'classes/controller/admin/*.php') as $controller): ?>

						<?php
						$section_segment = basename($controller, '.php');
						
						/*
						 * 后台管理导航名称
						 
						switch ($section_segment)
						{
							case 'articles':
								$section_title = '文章';
								break;
						}
						*/
						$section_title = Inflector::humanize($section_segment);
						?>

	                <li class="<?php echo Uri::segment(2) == $section_segment ? 'active' : '' ?>">
						<?php echo Html::anchor('admin/'.$section_segment, $section_title) ?>
					</li>
					<?php endforeach; ?>
	          </ul>

	          <ul class="nav pull-right">

	            <li class="dropdown">
	              <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $current_user->username ?> <b class="caret"></b></a>
	              <ul class="dropdown-menu">
	               <li><?php echo Html::anchor('admin/logout', 'Logout') ?></li>
	              </ul>
	            </li>
	          </ul>
	        </div>
	    </div>
	</div>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="span12">
				<h1><?php echo $title; ?></h1>
				<hr>
<?php if (Session::get_flash('success')): ?>
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">×</button>
					<p><?php echo implode('</p><p>', (array) Session::get_flash('success')); ?></p>
				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert alert-error">
					<button class="close" data-dismiss="alert">×</button>
					<p><?php echo implode('</p><p>', (array) Session::get_flash('error')); ?></p>
				</div>
<?php endif; ?>
			</div>
			<div class="span12">
<?php echo $content; ?>
			</div>
		</div>
		<hr/>
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				<a href="http://fcleaf.com">祥非常电脑</a>.<br>
				<small>Version: <?php echo Lang::get('common.version'); ?></small>
			</p>
		</footer>
	</div>
	<?php if (isset($scripts)) echo $scripts; ?>
</body>
</html>
