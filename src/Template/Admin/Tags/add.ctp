<div class="header-form">
	<div class="mod-title page-title pull-left"><h1><?php if(isset($title)) { echo $title; } ?></h1></div>
	<div class="mod-actions pull-right">
		<?= $this->Html->link(
			$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-circle-arrow-left']) . ' Back',
			['controller' => 'Tags', 'action' => 'index'], ['class' => 'btn btn-danger', 'escape' => false]);
		?>
	</div>
	<div class="clearfix"></div>
</div>

<div class="posts form large-9 medium-8 columns content">
	<?= $this->Form->create($tags) ?>
	<div class="col-md-8 pad-left-5 pad-right-5">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<?= $this->Form->input('name', ['class' => 'col-sm-12 form-control', 'placeholder' => __('name'), 'label' => __('name')]);?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
        
        <div class="panel panel-default">
			<div class="panel-heading">
				<?= __('for_seo') ?>
			</div>
			<div class="panel-body">
                <div class="form-group">
					<?= $this->Form->input('alias', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('alias'), 'label' => __('alias')]);?>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<?= $this->Form->input('meta_title', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('meta_title'), 'label' => __('meta_title')]);?>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<?= $this->Form->input('meta_keyword', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('meta_keyword'), 'label' => __('meta_keyword')]);?>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<?= $this->Form->input('meta_desc', ['class' => 'col-sm-12 form-control', 'placeholder' => __('meta_desc'), 'label' => __('meta_desc')]);?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
        
	</div>
	
	<div class="col-md-4 pad-left-5 pad-right-5">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<?= __('actions') ?>
			</div>
			<div class="panel-body">
				<div class="pull-right"><?= $this->Form->button(__('submit'), ['class' => 'btn btn-primary']) ?></div>
				<div class="clear"></div>
			</div>
		</div>
		
	</div>
	
	<?= $this->Form->end() ?>
</div>