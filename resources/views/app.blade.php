<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta
        name="description"
        content="Animezero - крупнейший кинотеатр где вы можете смотреть аниме бесплатно, в хорошем качестве без рекламы. Уникальные и популярные жанры вы найдете все что угодно.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Raleway:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link
        rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>{{config('app.name')}}</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>
    <link rel="icon" href="{{ asset('/img/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('/img/favicon.ico')}}" type="image/x-icon">
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(88663047, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/88663047" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
</head>
<body>
@routes
@inertia
</body>
<script src="{{ asset('/js/app.js') }}" defer></script>
</html>
