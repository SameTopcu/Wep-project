<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/font_awesome_5_free.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/air-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
    @stack('styles')

    <script src="{{ asset('dist/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/popper.min.js') }}"></script>
    <script src="{{ asset('dist/js/tooltip.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('dist/js/stisla.js') }}"></script>
    <script src="{{ asset('dist/js/jscolor.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('dist/js/fontawesome-iconpicker.js') }}"></script>
    <script src="{{ asset('dist/js/air-datepicker.min.js') }}"></script>
    <script src="{{ asset('dist/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap4-toggle.min.js') }}"></script>
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        
        @yield(section: 'main_content')

    
    </div>
</div>

<div id="toast-data"
     data-success="{{ e(session('success') ?? '') }}"
     data-error="{{ e(session('error') ?? '') }}"
     data-warning="{{ e(session('warning') ?? '') }}"
     data-info="{{ e(session('info') ?? '') }}"
     data-validation-errors="{{ json_encode($errors->all() ?? []) }}"
     style="display:none;"></div>




 
<script src="{{ asset('dist/js/scripts.js') }}"></script>
<script src="{{ asset('dist/js/custom.js') }}"></script>
@stack('scripts')
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