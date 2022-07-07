<div class="main">
	<nav class="navbar navbar-expand navbar-light navbar-bg">
		<a class="sidebar-toggle">
		  <i class="hamburger align-self-center"></i>
		</a>
		
		<div class="navbar-collapse collapse">
			<ul class="navbar-nav navbar-align">
				<!-- <li class="nav-item dropdown">
					<a class="nav-icon dropdown-toggle" href="javascript:void(0)" id="messagesDropdown" data-bs-toggle="dropdown">
						<div class="position-relative">
							<i class="align-middle" data-feather="message-circle"></i>
							<span class="indicator">1</span>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
						<div class="dropdown-menu-header">
							<div class="position-relative">
								1 New Message
							</div>
						</div>
						<div class="list-group">
							<a href="pjavascript:void(0)" class="list-group-item">
								<div class="row g-0 align-items-center">
									<div class="col-2">
										<img src="<?= base_url() ?>/public/assets/img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Ashley Briggs">
									</div>
									<div class="col-10 ps-2">
										<div class="text-dark">Ashley Briggs</div>
										<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
										<div class="text-muted small mt-1">15m ago</div>
									</div>
								</div>
							</a>							
						</div>
						<div class="dropdown-menu-footer">
							<a href="javascript:void(0)" class="text-muted">Show all messages</a>
						</div>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-icon dropdown-toggle" href="pages-blank.html#" id="alertsDropdown" data-bs-toggle="dropdown">
						<div class="position-relative">
							<i class="align-middle" data-feather="bell-off"></i>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
						<div class="dropdown-menu-header">
							1 New Notifications
						</div>
						<div class="list-group">
							<a href="javascript:void(0)" class="list-group-item">
								<div class="row g-0 align-items-center">
									<div class="col-2">
										<i class="text-danger" data-feather="alert-circle"></i>
									</div>
									<div class="col-10">
										<div class="text-dark">Update completed</div>
										<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
										<div class="text-muted small mt-1">2h ago</div>
									</div>
								</div>
							</a>
						</div>
						<div class="dropdown-menu-footer">
							<a href="javascript:void(0)" class="text-muted">Show all notifications</a>
						</div>
					</div>
				</li> -->
				
				<li class="nav-item dropdown">
					<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="javascript:void(0)" data-bs-toggle="dropdown">
			          <i class="align-middle" data-feather="settings"></i>
			        </a>

			        <?php if(!empty(session()->get('profile_pic'))): ?>
						<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="javascript:void(0)" data-bs-toggle="dropdown">
				          <img src="<?= base_url() ?>/public/assets/img/avatars/<?= session()->get('profile_pic'); ?>" class="avatar img-fluid rounded-circle me-1" alt="<?= session()->get('name'); ?>" /> <span class="text-dark"><?= session()->get('name'); ?></span>
				        </a>
				    <?php else: ?>
				    	<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="javascript:void(0)" data-bs-toggle="dropdown">
				          <img src="<?= base_url() ?>/public/assets/img/avatars/me.png" class="avatar img-fluid rounded-circle me-1" alt="<?= session()->get('name'); ?>" /> <span class="text-dark"><?= session()->get('name'); ?></span>
				        </a>
				    <?php endif ?>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="<?= base_url() ?>/viewUser/<?= session()->get('logged_user'); ?>"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= base_url() ?>/change_password">Change Password</a>
						<a class="dropdown-item" href="<?= base_url() ?>/logout">Sign out</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>