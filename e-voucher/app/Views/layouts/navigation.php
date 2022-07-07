<nav id="sidebar" class="sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="<?= base_url() ?>/dashboard">
      <span class="align-middle me-3"><?= $company_data['company_name'] ?></span>
    </a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Navigation
			</li>
			<li class="sidebar-item <?php if($page_title == 'Dashboard'): echo 'active'; endif; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>/dashboard">
		          <i class="align-middle" data-feather="airplay"></i> <span class="align-middle">Dashboard</span>
		        </a>
			</li>
			<?php if($user_permission): ?>

				<?php if(in_array('addUser', $user_permission) || in_array('editUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
					<li class="sidebar-item <?php if($page_title == 'Add User' || $page_title == 'Users'): echo 'active'; endif; ?>">
						<a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
			              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
			            </a>
						<ul id="users" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<?php if(in_array('addUser', $user_permission)): ?>
								<li class="sidebar-item"><a class="sidebar-link" href="<?= base_url() ?>/addUser">Add User</a></li>
							<?php endif ?>
							<?php if(in_array('editUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
								<li class="sidebar-item"><a class="sidebar-link" href="<?= base_url() ?>/users">All Users</a></li>
							<?php endif ?>
						</ul>
					</li>
				<?php endif ?>

				<?php if(in_array('editPermission', $user_permission)): ?>
					<li class="sidebar-item <?php if($page_title == 'Permission'): echo 'active'; endif; ?>">
						<a data-bs-target="#role_permission" data-bs-toggle="collapse" class="sidebar-link collapsed">
			              <i class="align-middle" data-feather="alert-triangle"></i> <span class="align-middle">Permission</span>
			            </a>
						<ul id="role_permission" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<?php if(session()->get('logged_user') == 1 ): ?>
								<?php foreach($roles_data as $roles): ?>
								<li class="sidebar-item"><a class="sidebar-link" href="<?= base_url() ?>/privileges/<?= $roles['role_id'] ?>"><?= $roles['role_name'] ?></a></li>
								<?php endforeach ?>
							<?php else: ?>
								<?php foreach($other_roles_data as $roles): ?>
									<li class="sidebar-item"><a class="sidebar-link" href="<?= base_url() ?>/privileges/<?= $roles['role_id'] ?>"><?= $roles['role_name'] ?></a></li>
								<?php endforeach ?>
							<?php endif ?>
						</ul>
					</li>
				<?php endif ?>

				<?php if(in_array('addVoucher', $user_permission) || in_array('editVoucher', $user_permission) || in_array('viewVoucher', $user_permission) || in_array('deleteVoucher', $user_permission)): ?>
					<li class="sidebar-item <?php if($page_title == 'Vouchers'): echo 'active'; endif; ?>">
						<a class="sidebar-link" href="<?= base_url() ?>/vouchers">
				          <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Vouchers</span>
				        </a>
					</li>
				<?php endif ?>

				<?php if(in_array('addSetting', $user_permission) || in_array('editSetting', $user_permission) || in_array('viewSetting', $user_permission) || in_array('deleteSetting', $user_permission)): ?>
					<li class="sidebar-item <?php if($page_title == 'Settings'): echo 'active'; endif; ?>">
						<a class="sidebar-link" href="<?= base_url() ?>/settings">
				          <i class="align-middle" data-feather="cpu"></i> <span class="align-middle">Administration</span>
				        </a>
					</li>
				<?php endif ?>
			<?php endif ?>
			<li class="sidebar-item <?php if($page_title == 'Change Log'): echo 'active'; endif; ?>">
				<a class="sidebar-link" href="<?= base_url() ?>/changelog">
		          <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">ChangeLog</span>
		        </a>
			</li>
		</ul>
	</div>
</nav>