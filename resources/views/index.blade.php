<html lang="ru">
<head>
    <title>Поиск района по адресу</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Поиск района по адресу">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ url()->current() }}"/>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">

    <script src="{{ asset('/js/app.js') }}"></script>
</head>
<body>
<main>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col mt-5 p-5">
                    <h1 class="text-center mb-5">Поиск района по адресу</h1>
                    <form id="main-form" action="/main-request" method="POST" onsubmit="event.preventDefault();" novalidate>
                        @csrf
                        <div class="input-group mb-3">
                            <input id="main-input" type="text" class="form-control" placeholder="Адрес" name="address" required>
                            <button class="btn btn-success" type="submit" id="main-button">Поиск</button>
                            <div class="invalid-feedback">
                                Пожалуйста введите адрес.
                            </div>
                        </div>
                    </form>
                    <div id="main-response" class="" role="alert">

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="footer">
    <div class="container">
        <div class="row">
            <p class="me-4 text-center fw-bold">По все вопросам </p>
            <div class="col d-flex justify-content-center">
                <ul class="list-unstyled d-flex">
                    <li class="me-3"><a href="https://telegram.me/ivan_meshcheryakov" target="_blank">Telegram</a></li>
                    <li><a href="mailto:meshcheryakovvrn@gmail.com">Mail</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
