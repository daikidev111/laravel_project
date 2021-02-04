@extends('layouts.app_admin')

@section('content')
<div class="container">
<h1>新規商品の追加</h1>
<form action="{{ route('admin.item.store') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="name" value="{{ old('name') }}">
<label class="mdl-textfield__label">商品名を入力してください</label>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" name="description" value="{{ old('description') }}">
<label class="mdl-textfield__label">商品内容を入力してください</label>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="price" value="{{ old('price') }}">
<label class="mdl-textfield__label">値段を入力してください</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>

<br>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="stock" value="{{ old('stock') }}">
<label class="mdl-textfield__label">在庫数を入力してください</label>
<span class="mdl-textfield__error">数字ではありません</span>
</div>

<br>

<input type="file" name="image" accept="image/jpeg, image/jpg, image/gif, image/png">

<br>
<br>

<input type="submit" value="追加する" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
</form>
<br>
@if ($errors->any())
<div class="errors">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<br>
<a href="{{ route('admin.item.index') }}">商品一覧へ</a>
</div>
@endsection
