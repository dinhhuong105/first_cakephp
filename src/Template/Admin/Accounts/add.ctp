<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($accountGroup) ?>
    <fieldset>
        <?= $this->Form->input('name');?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>