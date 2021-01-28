@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
<div class="errors">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="panel panel-default">
<div class="panel-heading">アカウント情報</div>

<div class="panel-body">
<h4>名前: </h4>
<h3><strong>{{ $account_detail->name }}</strong></h3>
<h4>メールアドレス: </h4>
<h3><strong>{{ $account_detail->email }}</strong></h4>
<br>
<br>
<br>
<div style="text-align:center;">
<a href="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">アカウントの編集</a>
</div>
</div>
</div>
@endsection
