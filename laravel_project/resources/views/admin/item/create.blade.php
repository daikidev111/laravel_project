@extends('layouts.app_admin')

@section('content')
<div class="container">
<h1>新規商品の追加</h1>
<form action="{{ route('admin.item.store') }}" method="POST">
{{ csrf_field() }}

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="name">
<label class="mdl-textfield__label">商品名を入力してください</label>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="description">
<label class="mdl-textfield__label">商品内容を入力してください</label>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="price">
<label class="mdl-textfield__label">値段を入力してください</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="stock">
<label class="mdl-textfield__label">在庫数を入力してください</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>
<br>
<br>
<input type="submit" value="Create" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
</form>
</div>
@endsection
