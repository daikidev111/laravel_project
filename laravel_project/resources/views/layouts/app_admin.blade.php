<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

	<style> body{ background-color: #CCFFCC; } </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin/login') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
						@auth('admin')
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
									{{ auth('admin')->user()->name }}<span class="caret"></span>
								</a>

								<ul class="dropdown-menu">

									<li>
										<a href="{{ route('admin.item.index') }}">商品一覧</a>
									</li>

									<li>
										<a href="{{ route('admin.account.index') }}">会員一覧</a>
									</li>

									<li>
										<a href="{{ route('admin.logout') }}"
											onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
											ログアウト
										</a>

										<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>

								</ul>
							</li>
						@else
							<li><a href="{{ route('login') }}">User Login</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
