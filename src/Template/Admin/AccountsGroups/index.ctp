<?= $this->form->create(null)?>
<div class="header-form">
	<div class="mod-title page-title pull-left"><h1><?php if(isset($title)) { echo $title; } ?></h1></div>
	<div class="mod-actions pull-right">
		<?= $this->Html->link(
			$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . __('add_new {0}', ''),
			['action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]);
		?>
		<?= $this->Form->button(
            $this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-trash']) . ' ' . __('delete_all'), 
            ['name' => 'delete-all', 'class' => 'btn btn-danger']) 
        ?>
	</div>
	<div class="clearfix"></div>
</div>


<div class="list-items">
	<table class="table table-bordered table-hover table-striped">
		<tr>
			<td style="width: 5%; text-align: center;"><?= $this->Form->checkbox('checkall', ['id' => 'checkall']);?></td>
			<td style="width: 65%"><?= __('name');?></td>
			<td style="width: 15%; text-align: center;"><?= __('actions')?></td>
		</tr>
		
		<?php if (!empty($datas)) :?>
		<?php foreach ($datas as $data) :?>		
		<tr>
			<td style="text-align: center; vertical-align: middle;"><?= $this->Form->checkbox('ids[]', ['value' => $data->id, 'class' => 'checkbox', 'hiddenField' => false])?></td>
            <td style="vertical-align: middle;"><?= $this->Html->link(h($data->name), ['controller' => 'AccountsGroups', 'action' => 'edit', $data->id])?></td>
			<td style="text-align: center; vertical-align: middle;">
				<?= $this->Html->link(
					$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-pencil']),
					['action' => 'edit', $data->id], ['class' => 'btn btn-primary', 'escape' => false]) 
				?>
				<?= $this->Html->link(
					$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-trash']), 
					['action' => 'delete', $data->id], 
					['confirm' => __('confirm_delete {0}', $data->id), 'class' => 'btn btn-danger', 'escape' => false]); 
				?>
			</td>
		</tr>
		<?php endforeach;?>
		<?php else :?>
			<td colspan="10"><?= __('no_item');?></td>
		<?php endif;?>
		
	</table>

    <div class="paginator">
        <?php if ($this->Paginator->numbers()) :?>
        <ul class="pagination">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
        <?php endif;?>
    </div>
	
	<div class="clear"></div>
</div>
<?= $this->form->end()?>