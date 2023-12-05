<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TABISH ENTERPRISES</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet"
        href="{{url('/')}}/theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="{{url('/')}}/theme/dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/daterangepicker/daterangepicker.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{url('/')}}/theme/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{url('/')}}/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    @vite(['resources/js/app.js'])

    <script nonce="5fb7c5a8-07cb-41e2-b42d-5cbcf0c7264f">
        (function (w, d) {
            ! function (j, k, l, m) {
                j[l] = j[l] || {};
                j[l].executed = [];
                j.zaraz = {
                    deferred: [],
                    listeners: []
                };
                j.zaraz.q = [];
                j.zaraz._f = function (n) {
                    return async function () {
                        var o = Array.prototype.slice.call(arguments);
                        j.zaraz.q.push({
                            m: n,
                            a: o
                        })
                    }
                };
                for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                j.zaraz.init = () => {
                    var q = k.getElementsByTagName(m)[0],
                        r = k.createElement(m),
                        s = k.getElementsByTagName("title")[0];
                    s && (j[l].t = k.getElementsByTagName("title")[0].text);
                    j[l].x = Math.random();
                    j[l].w = j.screen.width;
                    j[l].h = j.screen.height;
                    j[l].j = j.innerHeight;
                    j[l].e = j.innerWidth;
                    j[l].l = j.location.href;
                    j[l].r = k.referrer;
                    j[l].k = j.screen.colorDepth;
                    j[l].n = k.characterSet;
                    j[l].o = (new Date).getTimezoneOffset();
                    if (j.dataLayer)
                        for (const w of Object.entries(Object.entries(dataLayer).reduce(((x, y) => ({
                                ...x[1],
                                ...y[1]
                            })), {}))) zaraz.set(w[0], w[1], {
                            scope: "page"
                        });
                    j[l].q = [];
                    for (; j.zaraz.q.length;) {
                        const z = j.zaraz.q.shift();
                        j[l].q.push(z)
                    }
                    r.defer = !0;
                    for (const A of [localStorage, sessionStorage]) Object.keys(A || {}).filter((C => C
                        .startsWith("_zaraz_"))).forEach((B => {
                        try {
                            j[l]["z_" + B.slice(7)] = JSON.parse(A.getItem(B))
                        } catch {
                            j[l]["z_" + B.slice(7)] = A.getItem(B)
                        }
                    }));
                    r.referrerPolicy = "origin";
                    r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                    q.parentNode.insertBefore(r, q)
                };
                ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);

    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{url('/')}}/theme/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('includes.sidebar')
        <div id="app" class="content-wrapper">
            @yield('body')
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>


    <script src="{{url('/')}}/theme/plugins/jquery/jquery.min.js"></script>

    <script src="{{url('/')}}/theme/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>

    <script src="{{url('/')}}/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{url('/')}}/theme/plugins/chart.js/Chart.min.js"></script>

    <script src="{{url('/')}}/theme/plugins/sparklines/sparkline.js"></script>

    <script src="{{url('/')}}/theme/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="{{url('/')}}/theme/plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="{{url('/')}}/theme/plugins/moment/moment.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="{{url('/')}}/theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="{{url('/')}}/theme/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="{{url('/')}}/theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="{{url('/')}}/theme/dist/js/adminlte.js?v=3.2.0"></script>

    <script src="{{url('/')}}/theme/dist/js/demo.js"></script>

    <script src="{{url('/')}}/theme/dist/js/pages/dashboard.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="{{url('/')}}/theme/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="{{url('/')}}/theme/plugins/daterangepicker/daterangepicker.js"></script>

</body>

</html>
