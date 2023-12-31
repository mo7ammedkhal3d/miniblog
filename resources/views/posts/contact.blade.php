@extends('layouts.mainlayout')
@include('layouts.mainMenu')
@include('layouts.contactHeader')
@section('content')
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
            <div class="my-5">
                <form id="contactForm" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                        <label for="name">Name</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" name="phone" id="phone" type="tel" placeholder="Enter your phone number..." data-sb-validations="required" />
                        <label for="phone">Phone Number</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="message" id="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                        <label for="message">Message</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                    <br />
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <button class="btn btn-primary text-uppercase" id="btnSend" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="{{asset('assets/lib/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        contactForm = document.getElementById("contactForm");
        contactForm.addEventListener("submit", function (event) {
            // Prevent the default form submission
            event.preventDefault();
            
            var formData = new FormData(document.getElementById('contactForm'));
            
            fetch('http://127.0.0.1:8000/contact', {
                method: 'POST',
                body: formData,
                headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
            })
            .then(response => {  
                console.log('Response status:', response.status); // Log the response status

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    contactForm.reset();
                    swal({
                        //  title: title,
                        text: data.message,
                        content: true,
                        icon: "success",
                        classname: 'swal-IW',
                        timer: 1700,
                        buttons: false,
                    });
                    setTimeout(function() {
                    window.location.href = '/';
                    }, 1500);
                    
                }
            })
            .catch(error => {
                console.error('Error during fetch operation:', error);
            });
        });
    </script>
@endsection
@include('layouts.footer')