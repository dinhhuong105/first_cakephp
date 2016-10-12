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
    <?= $this->Html->css('bootstrap.min.css') ?>
	<?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('admin/style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    
</head>
<body class="fix-sidebar">
	
	<!-- loadings -->
	<div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	
	
	
	<div id="wrapper" class="wrapper">
		<!-- left side bar -->
		<div class="navbar-default sidebar">
			<?= $this->element('sidebar/admin_sidebar')?>
			<div class="clear"></div>
		</div>
		<!-- end left side bar -->
		
		<!-- page content -->
		<div id="page-wrapper">
			
			<?= $this->Flash->render() ?>
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
	
	
    <footer class="footer text-center"><?= '2016 © SPCVN'?></footer>
	
	<!-- javascript area -->
	<?= $this->Html->script('jquery-1.12.4.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
	<?= $this->Html->script('admin/jquery-ui.min.js') ?>
	<?= $this->Html->script('admin/sidebar-nav.min.js');?>
	<?= $this->Html->script('admin/jquery.slimscroll.js');?>
	<?= $this->Html->script('admin/waves.js');?>
	<?= $this->Html->script('admin/javascript.js');?>
	
	<?= $this->fetch('extScript')?>
	<?= $this->fetch('script') ?>

	<script>
		var baseUrl	= '<?= BASE_URL;?>';
	</script>
</body>
</html>
