<nav class="main-header navbar navbar-expand navbar-dark border-bottom-0" style="background-color: #007bff;">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		{{-- profile --}}
		<li class="nav-item dropdown user user-menu">
			<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
				<img src="{{ asset('assets/images/profile-default.png') }}" class="user-image" alt="User Image">
				<span class="hidden-xs">Profile</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded p-4" style="left: inherit; right: 0px;">
				<div class="user-header text-center">
					<img src="{{ asset('assets/images/profile-default.png') }}" class="img-circle img-fluid w-50" alt="User Image">
					<hr>
					<h6>
						{{ Auth::user()->name ?? '-' }} - <span class="text-danger">{{ Auth::user()->role->name ?? '-' }}</span>
					</h6>

				</div>
				<hr style="margin-top: -4px;">
				<table style="width: 100%;" border="0">
					<tr>
						<td style="width: 50%; text-align: left;">
							@if (Auth::user()->role->id == '3')
								<a style="width: 78px;" class="btn btn-sm btn-info"><i class="fas fa-user"></i>
									Profile</a>
							@else
								<a style="width: 78px;" href="{{ url('profile') }}" class="btn btn-sm btn-info"><i class="fas fa-user"></i>
									Profile</a>
							@endif

						</td>
						<td style="width: 50%; text-align: right;">
							<a style="width: 78px;" href="logout" class="btn btn-sm btn-danger"
								onclick="event.preventDefault(); document.getElementById('logout-form2').submit();"><i
									class="fas fa-sign-out-alt"></i> Logout</a>
							<form id="logout-form2" action="{{ url('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</td>
					</tr>
				</table>
			</div>
		</li>

		{{-- full page --}}
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
	</ul>
</nav>
