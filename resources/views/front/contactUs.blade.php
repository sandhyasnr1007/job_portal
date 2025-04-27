@extends('front.layouts.app')

@section('main')
<section class="section-3 py-5 bg-2">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h2>Contact Us</h2>

                @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

                <p class="text-muted">We'd love to hear from you. Please fill out the form below.</p>
            </div>
        </div>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-7">
                <form action="{{ route('contact.submit') }}" method="POST" id="contactForm">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Full Name" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="form-label fw-bold">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label fw-bold">Message</label>
                        <textarea name="message" id="message" rows="6" class="form-control" placeholder="Your message here..." required></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom btn-lg">Send Message</button>
                    </div>
                </form>
            </div>

            <!-- Contact Details -->
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm rounded">
                    <h4 class="mb-3">Get in Touch</h4>
                    <p><i class="fa fa-map-marker-alt me-2"></i>Pokhara, Nepal</p>
                    <p><i class="fa fa-envelope me-2"></i>info@elevatefrcsln.com</p>
                    <p><i class="fa fa-phone me-2"></i>+977 9800000000</p>

                    <hr>

                    <h5>Follow Us</h5>
                    <p>
                        <a href="#" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
$('#contactForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route('contact.submit') }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.redirect) {
                window.location.href = "route('contact.submit')"; // Redirect to login
            } else if (response.success) {
                alert('Message sent successfully!');
                $('#contactForm')[0].reset();
            } else {
                alert('Something went wrong.');
            }
        },
        error: function(xhr) {
            alert('Error occurred.');
        }
    });
});
</script>
@endsection
