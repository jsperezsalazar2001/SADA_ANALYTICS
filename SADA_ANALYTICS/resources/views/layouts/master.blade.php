<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title','Home Page')</title>
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customStyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.css" integrity="sha384-AfEj0r4/OFrOo5t7NnNe46zW/tFgW6x/bCJG8FqQCEo3+Aro6EYUG4+cU+KJWu/X" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.js" integrity="sha384-g7c+Jr9ZivxKLnZTDUhnkOnsh30B4H0rpLUpJ4jAIKs4fnJI+sEnkvrMWph2EDg4" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/contrib/auto-render.min.js" integrity="sha384-mll67QQFJfxn0IYznZYonOWZ644AWYC+Pt2cHqMaRhXVrursRwvLnLaebdGIlYNa" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            renderMathInElement(document.body, {
                // ...options...
            });
        });
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SADA ANALYTICS
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('master.root_methods') }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('bisection') }}">{{ __('bisection.title') }}</a>
                                <a class="dropdown-item" href="{{ route('false_position') }}">{{ __('false_position.title') }}</a>
                                <a class="dropdown-item" href="{{ route('newton') }}">{{ __('newton.title') }}</a>
                                <a class="dropdown-item" href="{{ route('multiple_roots') }}">{{ __('multiple_roots.title') }}</a>
                                <a class="dropdown-item" href="{{ route('fixed_point') }}">{{ __('fixed_point.title') }}</a>
                                <a class="dropdown-item" href="{{ route('secant') }}">{{ __('secant.title') }}</a>
                                <a class="dropdown-item" href="{{ route('steffensen') }}">{{ __('steffensen.title') }}</a>
                                <a class="dropdown-item" href="{{ route('incremental_search') }}">{{ __('incremental.title') }}</a>
                                <a class="dropdown-item" href="{{ route('muller') }}">{{ __('muller.title') }}</a>
                                <a class="dropdown-item" href="{{ route('aitken') }}">{{ __('aitken.title') }}</a>
                                <a class="dropdown-item" href="{{ route('lagrange') }}">Lagrange</a>
                            </div>

                        </div>
                    </ul>
                    <ul class="navbar-nav mr-auto">
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('master.matrix_methods') }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('gaussian') }}"> {{ __('gaussian_method.title') }}</a>
                                <a class="dropdown-item" href="{{ route('factorization_l_u') }}"> {{ __('factorization_l_u_method.title') }}</a>
                            </div>

                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Button trigger modal -->
        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

