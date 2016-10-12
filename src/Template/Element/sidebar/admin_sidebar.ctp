<?php
	$sidebar = [
		'posts'			=>	[
			'name'			=>	'Contents',
			'controller'	=>	'posts',
			'action'		=>	'index',
			'icon'			=>	'fa fa-clone',
			'sub'			=>	[
				'add'		=>	'Add new',
				'index'		=>	'List'
			]
		],
		'categories'	=>	[
			'name'			=>	'Categories',
			'controller'	=>	'categories',
			'action'		=>	'index',
			'icon'			=>	'fa fa-folder-open-o',
			'sub'			=>	[
				'add'		=>	'Add new',
				'index'		=>	'List'
			]
		],
		'tags'			=>	[
			'name'			=>	'Tags',
			'controller'	=>	'tags',
			'action'		=>	'index',
			'icon'			=>	'fa fa-tags',
			'sub'			=>	[
				'add'		=>	'Add new',
				'index'		=>	'List'
			]
		],
		'users'			=>	[
			'name'			=>	'Users',
			'controller'	=>	'accounts',
			'action'		=>	'index',
			'icon'			=>	'fa fa-users',
			'sub'			=>	[
				'accounts-permissions'	=>	'Accounts Permissions',
				'accounts-groups'		=>	'Accounts Groups',
				'add'					=>	'Add new Account',
				'index'					=>	'Accounts Manager'
			]
		]
	];
    
?>
<div class="top-sidebar">
	<div class="logo">SPCVN</div>
	<div class="slogan">Second Penguin Company</div>
</div>
<div class="slimScrollDiv">
	<div class="sidebar-nav navbar-collapse slimscrollsidebar">
		
		<?php if (!empty($sidebar)) :?>
		<ul class="nav" id="side-menu">
		<?php foreach($sidebar as $menu) :?>
			<?php
                $active = '';
                if (strtolower($this->request->params['controller']) == $menu['controller']) {
                    $active = 'active';
                }
                $link = ADMIN_BASE_URL . strtolower($menu['controller']) . '/' . strtolower($menu['action']); 
            ?>
            <li class="<?= $active?>">
				<a class="waves-effect" href="<?= $link?>">
					<?php if (isset($menu['icon'])) :?>
					<i class="<?= $menu['icon']?>" aria-hidden="true"></i>
					<?php endif;?>
					<span class="hide-menu"><?= $menu['name']?></span>
					<?php if (isset($menu['sub'])) :?>
					<span class="fa fa-angle-down arrow"></span>
					<?php endif;?>
				</a>
				<?php if (isset($menu['sub'])) :?>
				<ul class="nav collapse">
				<?php foreach($menu['sub'] as $key => $name) :?>
					<?php 
                        $subActive = '';
                        if (strtolower($this->request->params['action']) == $key) {
                            $subActive = 'active';
                        }
                        $linkSub = ADMIN_BASE_URL . strtolower($menu['controller']) . '/' . strtolower($key); 
                    ?>
					<li><a class="<?= $subActive?>" href="<?= $linkSub?>"><?= $name?></a></li>
				<?php endforeach;?>
				</ul>
				<?php endif;?>
			</li>	
		<?php endforeach;?>
		</ul>
		<?php endif;?>
		
	</div>
</div>