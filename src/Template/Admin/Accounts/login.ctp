<?php $this->layout = 'admin_login';?>
<div class="login-wrapper" id="login-wrapper">
    <span href="#" class="button" id="toggle-login"><?= __('login')?></span>
    <div id="login">
        <div id="triangle"></div>
        <h1><?= __('welcome_login')?></h1>
        <?= $this->Flash->render() ?>
        <?= $this->Form->create(null) ?>
            <?= $this->Form->input('username', ['placeholder' => __('username'), 'label' => false])?>
            <?= $this->Form->input('password', ['placeholder' => __('password'), 'label' => false])?>
            <?= $this->Form->button(__('login')) ?>
        <?= $this->Form->end();?>
    </div>
    <div class="clear"></div>
</div>