<div class="header-form">
	<div class="mod-title page-title pull-left"><h1><?php if(isset($title)) { echo $title; } ?></h1></div>
	<div class="mod-actions pull-right">
		<?= $this->Html->link(
			$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-circle-arrow-left']) . ' Back',
			['controller' => 'AccountsGroups', 'action' => 'index'], ['class' => 'btn btn-danger', 'escape' => false]);
		?>
	</div>
	<div class="clearfix"></div>
</div>

<div class="posts form large-9 medium-8 columns content">
	<?= $this->Form->create($accountGroup) ?>
	<div class="col-md-8 pad-left-5 pad-right-5">
		<div class="panel panel-default">
            <div class="panel-heading"><?= __('group_name')?></div>
			<div class="panel-body">
				<div class="form-group">
					<?= $this->Form->input('name', ['class' => 'col-sm-12 form-control', 'placeholder' => __('name'), 'label' => false]);?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
        <div class="panel panel-success">
            <div class="panel-heading"><?= __('permissions')?></div>
		</div>
        <?php foreach ($permissions as $perms) : ?>
        <?php if ($perms->actions) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-left"><?= $perms->controller?></div>
                    <div class="pull-right checkbox">
                        <label>
                            <?= $this->Form->input('perms[' . $perms->id . '][full_actions]', ['type' => 'hidden', 'class' => 'full-action', 'value' => 0])?>
                            <?= $this->Form->checkbox('checkall', ['class' => 'checkall-perms', 'hiddenField' => false])?>
                            <?= __('full_actions')?>
                        </label>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php
                            $actions = explode(',', $perms->actions);
                            foreach ($actions as $act):
                        ?>                        
                        <div class="checkbox col-md-2" style="margin-top: 10px;">
                            <label>
                                <?= $this->Form->checkbox('perms[' . $perms->id . '][actions][]', ['value' => $act, 'class' => 'checkbox', 'hiddenField' => false])?>
                                <?= $act?>
                            </label>
                        </div>
                        
                        <?php endforeach;?>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <?php endforeach;?>
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