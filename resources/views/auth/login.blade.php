
<x-guest-layout>

    <!-- Hero Start -->
    <section class="bg-home bg-circle-gradiant d-flex align-items-center">
        <div class="bg-overlay bg-overlay-white"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card form-signin p-4 rounded shadow">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h5 class="mb-3 text-center">Please sign in</h5>

                            <div class="form-floating mb-2">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required autofocus>
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100" type="submit">Sign in</button>

                            <div class="col-12 text-center mt-3">
                                <p class="mb-0 mt-3"><small class="text-dark me-2">Don't have an account ?</small> <a href="{{ route('register') }}" class="text-dark fw-bold">Sign Up</a></p>
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
