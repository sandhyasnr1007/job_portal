<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Elevate Workforce Solutions | Find Best Jobs</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta name="csrf-token" content="{{ csrf_token() }}" />


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">
<header>
	<nav  class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
			<a class="navbar-brand" href="{{ route('home') }}">Elevate Workforce Solutions</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
					</li>	
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('jobs') }}">Get Hire </a>
					</li>			
                    <li class="nav-item">
						<a class="nav-link" aria-current="page" href="jobs.html">Blog </a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('contact.submit') }}">Contact Us </a>
					</li>							
				</ul>	

				@if(!Auth::check())
                <a class="btn btn-custom btn-spacing" href="{{ route('account.login') }}" type="button">Login</a>
                <a class="btn btn-outline-custom" href="{{ route('account.createJob') }}" type="submit">Hire </a>


                @else
                <a class="btn btn-custom btn-spacing" href="{{ route('account.profile') }}" type="submit">Account</a>
                <a class="btn btn-outline-custom" href="{{ route('account.logout') }}" type="submit">Logout</a>


                @endif

			</div>
		</div>
	</nav>
</header>

@yield('main')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="profilePicForm" name="profilePicForm" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
           <p class="text-danger" id="image-errors"></p>
			</div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-custom mx-3">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="bg-blue-900 text-white py-8">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
      
      <!-- Company Info -->
      <div>
        <h2 class="text-xl font-semibold mb-2 text-white">Elevate Workforce Solutions</h2>
        <p class="text-sm">Connecting talent with opportunity. Your gateway to a better career.</p>
      </div>
  
      <!-- Quick Links -->
      <div>
        <h3 class="text-lg font-semibold mb-2">Quick Links</h3>
        <ul class="space-y-1 text-sm">
          <li><a href="#" class="hover:text-white">Home</a></li>
          <li><a href="#" class="hover:text-white">Find Jobs</a></li>
          <li><a href="#" class="hover:text-white">Post a Job</a></li>
          <li><a href="#" class="hover:text-white">Contact Us</a></li>
        </ul>
      </div>
  
      <!-- Resources -->
      <div>
        <h3 class="text-lg font-semibold mb-2">Resources</h3>
        <ul class="space-y-1 text-sm">
          <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-white">Terms of Service</a></li>
          <li><a href="#" class="hover:text-white">FAQ</a></li>
        </ul>
      </div>
  
      <!-- Contact Info -->
      <div>
        <h3 class="text-lg font-semibold mb-2">Contact</h3>
        <p class="text-sm">info@workforcesolutions.com</p>
        <p class="text-sm">+977-9800000000</p>
        <p class="text-sm">Pokhara, Nepal</p>
      </div>
      
    </div>
  
    <div class="mt-8 border-t border-blue-700 pt-4 text-center text-sm">
      © 2025 Workforce Solutions. All rights reserved.
    </div>
  </footer>
       
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>




<script>
    // Ensure CSRF token is included for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Fix the submit handler
    $("#profilePicForm").submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('account.updateProfilePic') }}",
            type: 'post',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === false) {
                    var errors = response.errors;
                    if (errors.image) {
                        $('#image-errors').html(errors.image); // Add quotes and fix selector
                    }
                } else {
                    window.location.href = "{{ url()->current() }}"; // Typo fixed (locarion ➜ location)
                    // return response()->json([
                    //   'status' => true,
                    //   'message' => 'Profile updated successfully.']);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });

        
    });
</script>



@yield('customJs')
</body>
</html>