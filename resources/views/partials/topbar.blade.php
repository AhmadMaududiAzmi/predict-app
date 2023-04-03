<nav class="navbar navbar-expand navbar-light">
	<a class="sidebar-toggle js-sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>

	<h3 class="fw-bold mb-0 me-3">{{ $pagename }}</h3>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
					<i class="align-middle" data-feather="settings"></i>
				</a>

				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src="{{ url('/' . auth()->user()->avatar) }}"
						class="avatar img-fluid rounded-circle border me-1" alt="{{ auth()->user()->fullname }}" />
					<span class="text-dark fw-bold">{{ auth()->user()->fullname }}</span>
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="{{ route('users.editprofil', auth()->user()->id) }}">
						<i class="align-middle me-1" data-feather="user"></i> Profil
					</a>
					<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirm-modal">
						<i class="align-middle me-1" data-feather="log-out"></i> Keluar
					</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

{{-- confirm logout --}}
<div class="modal fade" id="confirm-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="delete" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<form id="delete-form" action="/signout">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="delete">Konfirmasi</h5>
					<button type="button" class="btn btn-light-danger btn-close-modal" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<div class="modal-body">
					<p class="text-center"> Apakah Anda yakin ingin <strong class="text-danger"> Keluar </strong> dari
						aplikasi?</p>

					<div class="d-flex justify-content-center">
						<button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
							<span class="btn-icon-label">
								<i data-feather="x" class="me-2"></i>
								<span> Batal </span>
							</span>
						</button>
						<button type="submit" class="btn btn-danger">
							<span class="btn-icon-label">
								<i data-feather="log-out" class="me-2"></i>
								<span> Keluar </span>
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
