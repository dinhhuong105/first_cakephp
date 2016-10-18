<div class="header-form">
	<div class="mod-title page-title pull-left"><h1><?php if(isset($title)) { echo $title; } ?></h1></div>
	<div class="mod-actions pull-right">
		<?= $this->Html->link(
			$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-circle-arrow-left']) . ' Back',
			['controller' => 'Accounts', 'action' => 'index'], ['class' => 'btn btn-danger', 'escape' => false])
		?>
	</div>
	<div class="clearfix"></div>
</div>

<div class="posts form large-9 medium-8 columns content">
	<?= $this->Form->create($accounts, ['type' => 'file']) ?>
	<div class="col-md-8 pad-left-5 pad-right-5">
		<div class="panel panel-default">
            <div class="panel-heading">
                <?= __('login_info')?>
            </div>
			<div class="panel-body">
				<div class="form-group">
					<?= $this->Form->input('username', ['class' => 'col-sm-12 form-control', 'placeholder' => __('username'), 'label' => __('username')])?>
					<div class="clear"></div>
				</div>
                <div class="form-group">
					<?= $this->Form->input('password', ['class' => 'col-sm-12 form-control', 'label' => __('password')])?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
        
        <div class="panel panel-default">
			<div class="panel-heading">
				<?= __('account_info') ?>
			</div>
			<div class="panel-body">
                <div class="form-group">
					<?= $this->Form->input('first_name', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('first_name'), 'label' => __('first_name')])?>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<?= $this->Form->input('last_name', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('last_name'), 'label' => __('last_name')])?>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<?= $this->Form->input('email', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('email'), 'label' => __('email')])?>
					<div class="clear"></div>
				</div>
				<div class="form-group">
					<?= $this->Form->input('address', ['class' => 'col-sm-12 form-control', 'placeholder' => __('address'), 'label' => __('address')])?>
					<div class="clear"></div>
				</div>
                <div class="form-group">
					<?= $this->Form->input('phone', ['class' => 'col-sm-12 form-control', 'placeholder' => __('phone'), 'label' => __('phone')])?>
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
        
        <div class="panel panel-default">
			<div class="panel-heading required">
                <label><?= __('group_name') ?></label>
			</div>
			<div class="panel-body">
                <?= 
                    $this->Form->input('group_id', [
                        'option' => $groups,
                        'empty'  => 'Select --',
                        'class'  => 'col-sm-12 form-control',
                        'label'  => false,
                        'type'   => 'select'
                    ])
                ?>
			</div>
		</div>
        
        <div class="panel panel-default">
			<div class="panel-heading">
				<?= __('avatar') ?>
			</div>
			<div class="panel-body">
				<?= $this->Form->file('avatar', ['id' => 'picture', 'class' => 'form-control']); ?>
			</div>
		</div>
		
	</div>
	
	<?= $this->Form->end() ?>
</div>