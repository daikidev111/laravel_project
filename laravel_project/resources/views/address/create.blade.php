@extends('layouts.app')

@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-heading">お届け先登録</div>
<div class="panel-body">
<form class="form-horizontal" action="{{ route('address.store') }}" method="POST">
{{ csrf_field() }}

氏名:
<div class="mdl-textfield mdl-js-textfield mdl-textfield-label">
<input class="mdl-textfield__input" type="text" name="name" value="{{ old('name') }}">
<label class="mdl-textfield__label">山田太郎</label>
</div>

<br>

郵便番号:
<div class="mdl-textfield mdl-js-textfield mdl-textfield-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="postal_code" value="{{ old('postal_code') }}">
<label class="mdl-textfield__label">0000000</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>

<br>

都道府県:
<div class="mdl-textfield mdl-js-textfield mdl-textfield-label">
<input class="mdl-textfield__input" type="text" name="prefecture" value="{{ old('prefecture') }}">
<label class="mdl-textfield__label">東京都</label>
</div>

<br>

市区町村:
<div class="mdl-textfield mdl-js-textfield mdl-textfield-label">
<input class="mdl-textfield__input" type="text" name="city" value="{{ old('city') }}">
<label class="mdl-textfield__label">千代田区</label>
</div>

<br>

それ以下の住所:
<div class="mdl-textfield mdl-js-textfield mdl-textfield-label">
<input class="mdl-textfield__input" type="text" name="building" value="{{ old('building') }}">
<label class="mdl-textfield__label">○○ビル</label>
</div>

<br>

電話番号:
<div class="mdl-textfield mdl-js-textfield mdl-textfield-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="phone" value="{{ old('phone') }}">
<label class="mdl-textfield__label">000123456789</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>
<br>
<br>
<input type="submit" value="登録" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
</form>
@if ($errors->any())
<div class="errors">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
</div>
<br>
</div>
<a href="{{ route('address.index') }}">お届け先一覧へ</a>
<br>
@endsection
