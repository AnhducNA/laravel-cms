@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>

    <!-- Tailwind is included -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/main.css')}}">

    <link rel="apple-touch-icon" sizes="180x180"
          href="{{asset('assets/admin/images/tailwind-favicons/apple-touch-icon.png')}}"/>
    <link rel="icon" type="image/png" sizes="32x32"
          href="{{asset('assets/admin/images/tailwind-favicons/favicon-32x32.png')}}"/>
    <link rel="icon" type="image/png" sizes="16x16"
          href="{{asset('assets/admin/images/tailwind-favicons/favicon-16x16.png')}}"/>
    <link color="#00b4b6" href="safari-pinned-tab.svg" rel="mask-icon"/>

    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css" media="all"
          rel="stylesheet" type="text/css"/>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

<div id="app">
    <nav class="navbar is-fixed-top" id="navbar-main">
        <div class="navbar-brand">
            <!-- Mobile -->
            <a class="navbar-item mobile-aside-button">
                <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
            </a>
        </div>
        <div class="navbar-brand is-right">
            <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
                <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
            </a>
        </div>
        <!-- navbar-menu -->
        <div class="navbar-menu" id="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item dropdown has-divider has-user-avatar">
                    <a class="navbar-link">
                        <div class="user-avatar">
                            <img alt="Admin" class="rounded-full"
                                 src="https://avatars.dicebear.com/v2/initials/{{Auth::user()->name}}.svg">
                        </div>
                        <div class="is-user-name"><span>{{Auth::user()->name}}</span></div>
                        <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
                    </a>
                    <div class="navbar-dropdown">
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="{{route('admin.logout')}}">
                            <span class="icon"><i class="mdi mdi-logout"></i></span>
                            <span>Log Out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <x-admin.sidebar-left/>
    <div>
        {{$slot}}
    </div>

    <footer class="footer">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
            <div class="flex items-center justify-between space-x-3">
                <div>
                    ** Lê Anh Đức **
                </div>
            </div>
        </div>
    </footer>
</div>


<!-- Scripts below are for demo only -->
<script src="{{asset('assets/admin/js/main.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    function all_check(source){
        checkboxes = document.getElementsByClassName('element_check');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '658339141622648');
    fbq('track', 'PageView');
</script>

@livewireScripts
</body>
</html>
