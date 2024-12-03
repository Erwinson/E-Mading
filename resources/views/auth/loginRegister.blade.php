<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>eMading</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css_logreg/sourcesanspro-font.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css_logreg/style.css"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="form-v8" style="background-color: #1A1A1D;">
	<div class="page-content">
		<div class="form-right">
			<a href="/" class="back-icon" style="color: white;">
				<i class="bi bi-arrow-left-short"></i>
			</a>
			<!-- Existing content here -->
		</div>
		<div class="form-v8-content">
			<div class="form-left">
				<img src="images_logreg/form-v8.jpg" alt="form">
			</div>
			<div class="form-right">
				<div class="tab">
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Sign Up</button>
					</div>
					<div class="tab-inner">
						<button class="tablinks" onclick="openCity(event, 'sign-in')">Sign In</button>
					</div>
				</div>
				<form class="form-detail" action="{{ route('store') }}" method="post">
					@csrf
					<div class="tabcontent" id="sign-up">
						<div class="form-row">
							<label class="form-row-inner">
								<input type="text" class="input-text" @error('name') is-invalid @enderror" id="name" name="username" value="{{ old('username') }}" required>
								@if ($errors->has('username'))
									<span class="text-danger">{{ $errors->first('usersname') }}</span>
								@endif	
								<span class="label">Username</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input class="input-text @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required>
								@if ($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif	
								<span class="label">E-Mail</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input type="password" name="password" id="password" class="input-text" required>
								@if ($errors->has('password'))
									<span class="text-danger">{{ $errors->first('password') }}</span>
								@endif
									
								<span class="label">Password</span>
								<span class="border"></span>
							</label>
						</div>
						<div class="form-row-last">
							<input type="submit" name="register" class="register" value="Register">
						</div>
					</div>
				</form>
				<form class="form-detail" action="{{ route('authenticate') }}" method="post">
                    @csrf
					<div class="tabcontent" id="sign-in">
						<div class="form-row">
							<label class="form-row-inner">
								<input type="text" class="input-text" class=" @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
								@if ($errors->has('username'))
									<span class="text-danger">{{ $errors->first('username') }}</span>
								@endif
								<span class="label">User Name</span>
		  						<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
							<label class="form-row-inner">
								<input type="password" class="input-text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
								<span class="label">Password</span>
								<span class="border"></span>
							</label>
						</div>
						<div class="form-row">
						</div>
						<div class="form-row">
						</div>
						<div class="form-row-last">
							<input type="submit" class="register" value="Sign In">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.js"></script>

    <!-- Menampilkan SweetAlert jika ada notifikasi -->
    <script type="text/javascript">
        @if (session('successRegister'))
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful',
                text: '{{ session('successRegister') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
	
	<script type="text/javascript">
		@if (session('successLogout'))
			Swal.fire({
				icon: 'success',
				title: 'Logout Successful',
				text: '{{ session('successLogout') }}',
				confirmButtonText: 'OK'
			});
		@endif

	</script>

	<script type="text/javascript">
		@if($errors->has('login_error'))
			Swal.fire({
				icon: "error",
				title: "Oops... Something went wrong!",
				text: "{{ $errors->first('login_error') }}"
			});
		@endif
	</script>

	<script type="text/javascript">
		function openCity(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		}

		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
	</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>