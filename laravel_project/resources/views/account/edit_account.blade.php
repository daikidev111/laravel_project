@extends('layouts.app')

@section('content')
<div class="container">

{{-- error list --}}
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
<div class="panel-heading">アカウント情報再設定</div>

<div class="panel-body">
<form action="{{ route('account.send_mail') }}" method="POST">
{{ csrf_field() }}

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="name" value="{{ $user->name }}">
<label class="mdl-textfield__label">名前</label>
</div>

<br>

<small>※新しいメールアドレスに確認用メールを送付いたしますので、ご確認をお願い致します。</small>
<br>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="email" value="{{ $user->email }}">
<label class="mdl-textfield__label">メールアドレス</label>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="password" name="current_password">
<label class="mdl-textfield__label">現在のパスワード</label>
</div>

<br>
<br>

<input type="submit" value="編集" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">

</form>
<br>
<br>
<a href="{{ route('account.detail') }}">アカウント情報へ戻る</a>
</div>
</div>
@endsection
