<x-guest-layout>

    <!-- Hero Start -->
    <section class="bg-home bg-circle-gradiant d-flex align-items-center">
        <div class="bg-overlay bg-overlay-white"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 text-primary fw-bold">Welcome to EasySME</h1>
                    <p class="text-black-50 mb-4">Your ultimate solution for managing small and medium enterprises efficiently.</p>
                    <div>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get started</a>
                    </div>
                </div>
            </div>
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Hero End -->

    <!-- Services Section Start -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold">Our Services</h2>
                    <p class="text-muted mb-5">Explore the wide range of services that EasySME offers to boost your business.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <div class="icon mb-4">
                                <i class="mdi mdi-chart-line text-primary h2"></i>
                            </div>
                            <h5 class="card-title">Business Analytics</h5>
                            <p class="text-muted">Gain insights into your business performance with our advanced analytics tools.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <div class="icon mb-4">
                                <i class="mdi mdi-account-multiple text-primary h2"></i>
                            </div>
                            <h5 class="card-title">Customer Management</h5>
                            <p class="text-muted">Manage your customers efficiently with our comprehensive CRM solution.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <div class="icon mb-4">
                                <i class="mdi mdi-store text-primary h2"></i>
                            </div>
                            <h5 class="card-title">Inventory Management</h5>
                            <p class="text-muted">Keep track of your inventory with our easy-to-use inventory management tools.</p>
                        </div>
                    </div>
                </div>
            </div> <!--end row-->
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Services Section End -->

    <!-- Features Section Start -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold">Why Choose EasySME?</h2>
                    <p class="text-muted mb-5">Here are some of the reasons why businesses trust EasySME.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <div class="icon mb-4">
                                <i class="mdi mdi-clock-outline text-primary h2"></i>
                            </div>
                            <h5 class="card-title">24/7 Support</h5>
                            <p class="text-muted">Our dedicated support team is always available to assist you with your needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <div class="icon mb-4">
                                <i class="mdi mdi-lock-outline text-primary h2"></i>
                            </div>
                            <h5 class="card-title">Secure & Reliable</h5>
                            <p class="text-muted">We prioritize your business data with top-notch security and reliability.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 text-center">
                        <div class="card-body">
                            <div class="icon mb-4">
                                <i class="mdi mdi-sync text-primary h2"></i>
                            </div>
                            <h5 class="card-title">Seamless Integration</h5>
                            <p class="text-muted">Integrate with your existing tools and systems without any hassle.</p>
                        </div>
                    </div>
                </div>
            </div> <!--end row-->
        </div> <!--end container-->
    </section><!--end section-->
    <!-- Features Section End -->

    <!-- Footer Start -->
    <footer class="footer section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">© <script>document.write(new Date().getFullYear())</script> EasySME. All Rights Reserved.</p>
                        <p class="mb-0 mt-3"><a href="{{ route('login') }}" class="text-muted">Sign In</a> | <a href="{{ route('register') }}" class="text-muted">Sign Up</a></p>
                    </div>
                </div>
            </div> <!--end row-->
        </div> <!--end container-->
    </footer><!--end footer-->
    <!-- Footer End -->

</x-guest-layout>
