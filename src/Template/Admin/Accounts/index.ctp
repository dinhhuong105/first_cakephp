
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
			<td style="text-align: center;"><?= $this->Form->checkbox('ids[]', ['class' => 'checkbox']);?></td>
			<td><?= $this->Html->link(h($data->name), ['controller' => 'AccountsGroups', 'action' => 'edit']);?></td>
			<td style="text-align: center;">
				<?= $this->Html->link(
					$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-pencil']),
					['action' => 'edit', $data->id], ['class' => 'btn btn-primary', 'escape' => false]) 
				?>
				<?= $this->Form->postLink(
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

	
	<div class="clear"></div>
</div>