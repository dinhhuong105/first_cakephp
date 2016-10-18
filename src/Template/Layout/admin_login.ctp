<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
	<?php if (!isset($title)) {$title = 'SPCVN';}?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
		<?= $title?>
    </title>
	
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css'); ?>
	<?= $this->Html->css('font-awesome.min.css'); ?>
    <?= $this->Html->css('admin/style.css'); ?>
    <?= $this->Html->css('admin/login.css'); ?>
    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('extCss')?>
    
</head>
<body class="fix-sidebar">
	
	<!-- loadings -->
	<div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	
	<div id="login-wrapper" class="login-wrapper">
        
		<!-- page content -->
		<div id="login-page-wrapper">
			
			<div class="container-fluid clearfix">
				<div class="page-content">
				<?= $this->fetch('content') ?>
				</div>
			</div>
			
			<div class="clear"></div>
		</div>
		<!-- end #page-wrapper -->
		<div class="clear"></div>
	</div>
	<!-- end #wrapper -->
		
	<!-- javascript area -->
	<?= $this->Html->script('jquery-1.12.4.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('admin/sidebar-nav.min.js');?>
	<?= $this->Html->script('admin/jquery.slimscroll.js');?>
	<?= $this->Html->script('admin/waves.js');?>
	
	<?= $this->fetch('extScript')?>
    <?= $this->Html->script('admin/javascript.js');?>
	<?= $this->fetch('script') ?>
	
	<script>
		var baseUrl	= '<?= $this->request->webroot?>';
	</script>
</body>
</html>
