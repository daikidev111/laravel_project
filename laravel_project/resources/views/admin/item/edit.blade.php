@extends('layouts.app_admin')

@section('content')
<div class="container">
<h1>既存商品の編集</h1>
<form action="{{ route('admin.item.update', $item_arr->id) }}" method="POST" enctype="multipart/form-data">
{{ method_field('PATCH') }}
{{ csrf_field() }}

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="name" value="{{ $item_arr->name }}">
<label class="mdl-textfield__label">商品名を入力してください</label>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="description" value="{{ $item_arr->description }}">
<label class="mdl-textfield__label">商品内容を入力してください</label>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="stock" value="{{ $item_arr->stock }}">
<label class="mdl-textfield__label">在庫数を入力してください</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>
<br>

<input type="file" name="image">

<br>
<br>
<input type="submit" value="編集する" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
</form>
<br>
<a href="{{ route('admin.item.index') }}">商品一覧へ</a>
<br>
@if ($errors->any())
<div class="erros">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
</div>
@endsection
