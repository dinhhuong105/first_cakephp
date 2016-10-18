<?= $this->Form->create()?>
<div class="header-form">
	<div class="mod-title page-title pull-left"><h1><?php if(isset($title)) { echo $title; } ?></h1></div>
	<div class="mod-actions pull-right">
		<?= $this->Html->link(
			$this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-plus']) . ' Add new',
			['action' => 'add'], ['class' => 'btn btn-primary', 'escape' => false]);
		?>
		<?= $this->Form->button(
            $this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-trash']) . ' ' . __('delete_all'), 
            ['name' => 'delete-all', 'class' => 'btn btn-danger']) 
        ?>
	</div>
	<div class="clearfix"></div>
</div>

<div class="form-search">
    <div class="col-md-3 pad-left-5 pad-right-5">
        <div class="input-group" style="width: 100%;">
            <?= $this->Form->select('category_id', $categories, ['empty' => 'Select --', 'class' => 'col-sm-12 form-control', 'style' => 'width: 100%;', 'label' => 'aaa']) ?>
        </div>
    </div>
    <div class="col-md-3 pad-left-5 pad-right-5">
        <div class="input-group" style="width: 100%;">
            <?= $this->Form->select('category_id', $categories, ['empty' => 'Select --', 'class' => 'col-sm-12 form-control', 'style' => 'width: 100%;']) ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <input type="text" class="form-control" aria-label="...">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#">Title</a></li>
                    <li><a href="#">Poster</a></li>
                    <li><a href="#">Date post</a></li>
                </ul>
                <div class="pull-right"><?= $this->Form->button(__('submit'), ['class' => 'btn btn-primary']) ?></div>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
    </div>
    
    <div class="clear"></div>
</div>
<br/>
<div class="list-items">
	<table class="table table-bordered table-hover table-striped">
		<tr>
			<td style="width: 2%; text-align: center;"><?= $this->Form->checkbox('checkall', ['id' => 'checkall']);?></td>
            <td style="width: 8%; text-align: center;"><?= __('picture')?></td>
			<td style="width: 35%"><?= __('title')?></td>
            <td style="width: 20%"><?= __('tags')?></td>
            <td style="width: 15%"><?= __('poster')?></td>
			<td style="width: 10%; text-align: center;"><?= __('actions')?></td>
		</tr>
		
		<?php if (!empty($datas)) :?>
		<?php foreach ($datas as $data) :?>		
		<tr>
			<td style="text-align: center;"><?= $this->Form->checkbox('ids[]', ['value' => $data->id, 'class' => 'checkbox', 'hiddenField' => false]);?></td>
			<td style="text-align: center;">
            <?php
                if ($data->picture and is_file( 'uploads/pictures/thumbs/' . $data->picture)) {
                    $img = '/uploads/pictures/thumbs/' . $data->picture;
                } else {
                    $img = '/uploads/no_image.png';
                }
                
                echo $this->Html->link(
                    $this->Html->image($img, ['alt' => $data->title, 'width' => '100px']),
                    ['action' => 'edit', $data->id], ['escape' => false]
                );
            ?>
            </td>
            <td style="vertical-align: middle;">
                <?= $this->Html->link(h($data->title), ['controller' => 'Posts', 'action' => 'edit', $data->id]);?>
                <div class="alias"><?= $data->alias?></div>
            </td>
            <td style="vertical-align: middle;">
                <?php
                    foreach ($data->tags as $tag) {
                        echo $this->Html->link(
                            $this->Html->tag('span', $tag->name, ['class' => 'label label-success']), 
                            ['controller' => 'Tags', 'action' => 'edit', $tag->id],['class' => 'tag-item', 'escape' => false]);
                    }
                ?>
            </td>
			<td style="vertical-align: middle;"><?= $data->account->full_name?></td>
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
<?= $this->Form->end()?>