<x-guest-layout>

    <!-- Hero Start -->
    <section class="bg-home bg-circle-gradiant d-flex align-items-center">
        <div class="bg-overlay bg-overlay-white"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card form-signin p-4 rounded shadow">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h5 class="mb-3 text-center">Create Your Account</h5>

                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required autofocus>
                                <label for="name">Full Name</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                <label for="password_confirmation">Confirm Password</label>
                            </div>

                            <button class="btn btn-primary w-100" type="submit">Sign Up</button>

                            <div class="col-12 text-center mt-3">
                                <p class="mb-0 mt-3"><small class="text-dark me-2">Already have an account?</small> <a href="{{ route('login') }}" class="text-dark fw-bold">Sign In</a></p>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='{{ url('/') }}'">Cancel</button>
                            </div>

                            <p class="mb-0 text-muted mt-3 text-center">© <script>document.write(new Date().getFullYear())</script> EasySME.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Hero End -->

</x-guest-layout>
