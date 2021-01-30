@extends('layouts.app')

@section('content')
<div class="container">

{{-- display error message --}}
@if ($errors->any())
<div class="errors">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{{-- display message --}}
@if (session('message'))
<strong>{{ session('message') }}</strong>
@endif
<br>

<div class="panel panel-default">
<div class="panel-heading">アカウント情報</div>

<div class="panel-body">
<h4>名前: </h4>
<h3><strong>{{ $user->name }}</strong></h3>
<h4>メールアドレス: </h4>
<h3><strong>{{ $user->email }}</strong></h4>
<br>
<br>
<br>
<div style="text-align:center;">
<a href="{{ route('account.edit_account') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">アカウント情報の再設定</a>
<a href="{{ route('account.edit_password') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">パスワードの再設定</a>
</div>
</div>
</div>
@endsection
