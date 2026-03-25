<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>TripSummit</title>

        <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">

        <!-- All CSS -->
        <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/meanmenu.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/spacing.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/style.css') }}">
        
        <!-- All Javascripts -->
        <script src="{{ asset('dist-front/js/jquery-3.6.1.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/wow.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/select2.full.js') }}"></script>
        <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/moment.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/counterup.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/multi-countdown.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.meanmenu.js') }}"></script>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 left-side">
                        <ul>
                            <li class="phone-text"><i class="fas fa-phone"></i> 111-222-3333</li>
                            <li class="email-text"><i class="fas fa-envelope"></i> contact@example.com</li>
                        </ul>
                    </div>
                    <div class="col-md-6 right-side">
                        <ul class="right">
                            @if(Auth::guard('web')->check())
                            <li class="menu">
                                <a href="{{ route('user_dashboard') }}"><i class="fas fa-user"></i> {{ Auth::guard('web')->user()->name }}</a>
                            </li>
                            

                            @else
                            <li class="menu">
                                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                            </li>
                            <li class="menu">
                                <a href="{{route('registration')}}"><i class="fas fa-user"></i> Sign Up</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

       @include('front.layout.nav')

        
        @yield(section: 'main_content')
        
        
        <div class="footer pt_70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Important Pages</h2>
                            <ul class="useful-links">
                                <li><a href="{{ route('home') }}"><i class="fas fa-angle-right"></i> Home</a></li>
                                <li><a href="{{ route('destinations') }}"><i class="fas fa-angle-right"></i> Destinations</a></li>
                                <li><a href="{{ route('blog') }}"><i class="fas fa-angle-right"></i> Blog</a></li>
                                <li><a href="{{ route('about') }}"><i class="fas fa-angle-right"></i> About</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Useful Links</h2>
                            <ul class="useful-links">
                            <li><a href="{{ route('faq') }}"><i class="fas fa-angle-right"></i> FAQ</a></li>
                            <li><a href="{{ route('packages') }}"><i class="fas fa-angle-right"></i> Packages</a></li>
                            <li><a href="{{ $setting->footer_email ? 'mailto:' . $setting->footer_email : '#' }}"><i class="fas fa-angle-right"></i> Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Contact</h2>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="right">
                                    {{ $setting->footer_address }}
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="right">{{ $setting->footer_phone }}</div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="right">{{ $setting->footer_email }}</div>
                            </div>
                            <ul class="social">
                                @if($setting->facebook)
                                <li><a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($setting->twitter)
                                <li><a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if($setting->youtube)
                                <li><a href="{{ $setting->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                @endif
                                @if($setting->linkedin)
                                <li><a href="{{ $setting->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                                @if($setting->instagram)
                                <li><a href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Newsletter</h2>
                            <p>
                                To get the latest news from our website, please
                                subscribe us here:
                            </p>
                            <form action="{{ route('subscriber_submit') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Subscribe Now">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="copyright">
                            {!! $setting->footer_copyright !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="scroll-top">
            <i class="fas fa-angle-up"></i>
        </div>


        <div id="toast-data"
           data-success="{{ e(session('success') ?? '') }}"
           data-error="{{ e(session('error') ?? '') }}"
           data-warning="{{ e(session('warning') ?? '') }}"
           data-info="{{ e(session('info') ?? '') }}"
           data-validation-errors="{{ json_encode($errors->all() ?? []) }}"
           style="display:none;"></div>




        <script src="{{ asset('dist-front/js/custom.js') }}"></script>
        <script>
    // iziToast is already imported above:
    // CSS: dist/css/iziToast.min.css
    // JS : dist/js/iziToast.min.js

    const toastDataEl = document.getElementById('toast-data');
    if (!toastDataEl) {
        console.warn('Toast data element not found');
    } else {
        const __flash = {
            success: toastDataEl.dataset.success || '',
            error: toastDataEl.dataset.error || '',
            warning: toastDataEl.dataset.warning || '',
            info: toastDataEl.dataset.info || '',
        };

        let __validationErrors = [];
        try {
            const raw = toastDataEl.dataset.validationErrors || '[]';
            __validationErrors = JSON.parse(raw);
        } catch (e) {
            console.error('Error parsing validation errors:', e);
            __validationErrors = [];
        }

        if (typeof iziToast !== 'undefined') {
            if (__flash.success && __flash.success.trim()) {
                iziToast.success({ title: 'Başarılı', message: __flash.success, position: 'topRight' });
            }
            if (__flash.error && __flash.error.trim()) {
                iziToast.error({ title: 'Hata', message: __flash.error, position: 'topRight' });
            }
            if (__flash.warning && __flash.warning.trim()) {
                iziToast.warning({ title: 'Uyarı', message: __flash.warning, position: 'topRight' });
            }
            if (__flash.info && __flash.info.trim()) {
                iziToast.info({ title: 'Bilgi', message: __flash.info, position: 'topRight' });
            }

            if (Array.isArray(__validationErrors) && __validationErrors.length > 0) {
                __validationErrors.forEach((msg) => {
                    if (msg && msg.trim()) {
                        iziToast.error({ title: 'Hata', message: msg, position: 'topRight' });
                    }
                });
            }
        } else {
            console.warn('iziToast not loaded. Check dist/js/iziToast.min.js');
        }
    }
</script>
    </body>
</html>
