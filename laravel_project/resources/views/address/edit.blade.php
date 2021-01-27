@extends('layouts.app')

@section('content')
<script src='https://ajaxzip3.github.io/ajaxzip3.js' charset='UTF-8'></script>
<div class="container">
<div class="panel panel-default">
<div class="panel-heading">お届け先編集</div>
<div class="panel-body">
<form class="form-horizontal" action="{{ route('address.update', $address->id) }}" method="POST">
{{ method_field('PATCH') }}
{{ csrf_field() }}

氏名:
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="name" value="{{ $address->name }}">
<label class="mdl-textfield__label">変更先氏名を入力してください</label>
</div>

<br>

郵便番号:
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="postal_code" value="{{ $address->postal_code }}" onKeyUp="AjaxZip3.zip2addr(this, '', 'prefecture', 'city');">
<label class="mdl-textfield__label">変更先郵便番号を入力してください</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>

<br>

都道府県:
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="prefecture" value="{{ $address->prefecture }}">
<label class="mdl-textfield__label">変更先都道府県を入力してください</label>
</div>

<br>

市区町村:
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="city" value="{{ $address->city }}">
<label class="mdl-textfield__label">変更先市区町村を入力してください</label>
</div>

<br>

それ以下の住所:
@if ($address->building == null)
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="building" value="{{ old('building') }}">
<label class="mdl-textfield__label">それ以下の住所を入力してください</label>
</div>
@else
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="building" value="{{ $address->building }}">
<label class="mdl-textfield__label">それ以下の住所で変更がある場合は入力してください</label>
</div>
@endif

<br>

電話番号:
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="phone" value="{{ $address->phone }}">
<label class="mdl-textfield__label">変更先電話番号を入力してください</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>
<br>
<br>
<input type="submit" value="編集" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
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
