@extends('superadmin.dashboard')

<style>
    @media (prefers-color-scheme: dark) {
        #contact-div {
            background: #DD5E89;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #F7BB97, #DD5E89);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #F7BB97, #DD5E89);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            min-height: 100vh;
        }
    }

    .social-link {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        border-radius: 50%;
        transition: all 0.3s;
        font-size: 0.9rem;
    }

    .social-link:hover,
    .social-link:focus {
        background: #ddd;
        text-decoration: none;
        color: #555;
    }
</style>

@section('content')
    <div id="contact-div">
        <div class="container py-5" style="margin-top: 0px">
            <div class="row text-center text-white">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4">Contact Us</h1>
                </div>
            </div>
        </div>

        <div class="container" style="min-height: 100vh">
            <div class="row text-center">
                <!-- Team item -->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4"><img
                            src="http://results.skcet.ac.in:610/assets/StudentImage/727721EUCS134.jpg" alt=""
                            width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Sanjeevi CS</h5>
                        <span class="small text-uppercase text-muted"> Fullstack Developer </span>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="mailto:sanjeevisakthivel2004@gmail.com" class="social-link">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End -->

                <!-- Team item -->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4">
                        <img src="http://results.skcet.ac.in:610/assets/StudentImage/727721EUCS140.jpg" alt=""
                            width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Shree Varshan G</h5><span class="small text-uppercase text-muted"> Fullstack
                            Developer </span>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="mailto:shreevarshang2003@gmail.com" class="social-link">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End -->

                <!-- Team item -->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4"><img
                            src="http://results.skcet.ac.in:610/assets/StudentImage/727721EUCS144.jpg" alt=""
                            width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Siddhesh Agarwal</h5>
                        <span class="small text-uppercase text-muted"> Fullstack Developer </span>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="mailto:siddhesh.agarwal@gmail.com" class="social-link">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End -->

                <!-- Team item -->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div class="bg-white rounded shadow-sm py-5 px-4"><img
                            src="http://results.skcet.ac.in:610/assets/StudentImage/727721EUCS159.jpg" alt=""
                            width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                        <h5 class="mb-0">Sundarakrishnan R M</h5>
                        <span class="small text-uppercase text-muted"> Testing and Research </span>
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="mailto:sunkrish2004@gmail.com" class="social-link">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>
    </div>
@endsection
