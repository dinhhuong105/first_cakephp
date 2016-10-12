<!-- tiny mce editor -->
<?= $this->Html->script('admin/tinymce/tinymce.min', ['block' => 'extScript']); ?>
<?= $this->Html->script('admin/tinymce/tinymce.load', ['block' => 'extScript']); ?>

<!-- bootstrap tags inputs -->
<?= $this->Html->css('admin/bootstrap-tagsinput', ['block' => 'extCss']); ?>
<?= $this->Html->script('admin/bootstrap-tagsinput.min', ['block' => 'extScript']); ?>
<?= $this->Html->script('admin/typeahead.bundle.min', ['block' => 'extScript']); ?>

<div class="header-form">
    <div class="mod-title page-title pull-left"><h1><?php if (isset($title)) { echo $title; } ?></h1></div>
    <div class="mod-actions pull-right">
        <?= $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'glyphicon glyphicon-circle-arrow-left']) . ' Back', 
            ['action' => 'index'], ['class' => 'btn btn-danger', 'escape' => false]);
        ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post, ['type' => 'file']) ?>
    <div class="col-md-8 pad-left-5 pad-right-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <?= $this->Form->input('title', ['class' => 'col-sm-12 form-control', 'placeholder' => __('title'), 'label' => __('title')]); ?>
                    <div class="clear"></div>
                </div>
                <div class="form-group">
                    <label for="short"><?= __('short') ?></label>
                    <?= $this->Form->textarea('short', ['id' => 'short', 'class' => 'col-sm-12 form-control', 'placeholder' => __('short')]); ?>
                    <div class="clear"></div>
                </div>
                <div class="form-group">
                    <label for="description"><?= __('content') ?></label>
                    <?= $this->Form->textarea('content', ['id' => 'description', 'class' => 'tinymce']) ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 pad-left-5 pad-right-5">
        <div class="panel panel-default">
            <div class="panel-heading"><?= __('actions') ?></div>
            <div class="panel-body">
                <div class="pull-left"><?= $this->Form->button(__('preview'), ['id' => 'mceu_278-text', 'class' => 'btn btn-default mce-text', 'type' => 'button']) ?></div>
                <div class="pull-right"><?= $this->Form->button(__('submit'), ['class' => 'btn btn-primary']) ?></div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading required">
                <label><?= __('categories') ?></label>
            </div>
            <div class="panel-body">
                <?=
                #$this->Form->select('category_id', $categories, ['class' => 'col-sm-12 form-control', 'label' => false])
                $this->Form->input('category_id', [
                    'option' => $categories,
                    'empty'  => 'Select --',
                    'class'  => 'col-sm-12 form-control',
                    'label'  => false,
                    'type'   => 'select'
                ])
                ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><?= __('featured_image') ?></div>
            <div class="panel-body">
            <?php
                if ($post->picture and is_file( 'uploads/pictures/thumbs/' . $post->picture)) {
                    $img = '/uploads/pictures/thumbs/' . $post->picture;
                    echo '<div class="feature-image"><p>' . $this->Html->image($img, ['alt' => $post->title, 'width' => '100%']) . '</p><div class="delete-icon"><i class="glyphicon glyphicon-trash"></i></div></div>';
                }
                echo $this->Form->file('picture', ['id' => 'picture', 'class' => 'form-control']);
                echo $this->Form->input('remove_feature_image', ['type' => 'hidden', 'id' => 'remove_feature_image', 'value' => 0]);
            ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= __('tags') ?>
                <span style="font-size: 11px; font-style: italic; color: #f00;">(<?= __('tags_note') ?>)</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <!--<?= $this->Form->input('tags', ['id' => 'tags', 'class' => 'typeahead col-sm-12 form-control', 'data-role' => 'tagsinput'])?>-->
                    <?php
                        $tags = [];
                        foreach ($post->tags as $tag) {
                            $tags[] = $tag->name;
                        }
                        $tags = implode(',', $tags);
                    ?>
                    <input name="tags" id="tags" class="typeahead col-sm-12 form-control" type="text" value="<?= $tags?>" data-role="tagsinput" placeholder="<?= __('add_new {0}', __('tags'))?>"/>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><?= __('for_seo') ?></div>
            <div class="panel-body">
                <div class="form-group">
                    <?= $this->Form->input('alias', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('alias'), 'label' => __('alias')]); ?>
                    <div class="clear"></div>
                </div>
                <div class="form-group">
                    <?= $this->Form->input('meta_title', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('meta_title'), 'label' => __('meta_title')]); ?>
                    <div class="clear"></div>
                </div>
                <div class="form-group">
                    <?= $this->Form->input('meta_keyword', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('meta_keyword'), 'label' => __('meta_keyword')]); ?>
                    <div class="clear"></div>
                </div>
                <div class="form-group">
                    <?= $this->Form->input('meta_desc', ['type' => 'text', 'class' => 'col-sm-12 form-control', 'placeholder' => __('meta_desc'), 'label' => __('meta_desc')]); ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<?php
    // Append into the 'script' block.
    //$this->Html->scriptStart(['block' => true]);
    //echo    "listTags = " . array_values($tags);
    //$this->Html->scriptEnd();
?>