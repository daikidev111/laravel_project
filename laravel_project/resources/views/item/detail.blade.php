@extends('layouts.app')

@section('content')
<div class="container">

{{-- display error --}}
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


{{-- table --}}
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: flex; width: 100%;">

{{-- table columns --}}
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">商品説明</th>
<th class="mdl-data-table__cell--non-numeric">値段</th>
<th class="mdl-data-table__cell--non-numeric"></th>
<th class="mdl-data-table__cell--non-numeric">在庫の有無</th>
<th class="mdl-data-table__cell--non-numeric">カートに追加</th>
</tr>
</thead>

{{-- table rows --}}
<tbody>
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $item['name'] }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $item['description'] }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $item['price'] }}円</td>

@if (empty($item['image']))
<td class="mdl-data-table__cell--non-numeric">未登録</td>
@else
<td class="mdl-data-table__cell--non-numeric"><img class="logo" src="{{ asset('storage/image/' . $item->image) }}" width="70px" height="70px"></td>
@endif

@if ($item['stock'] > 0)
<td class="mdl-data-table__cell--non-numeric">在庫あり</td>

{{-- For logged-in user --}}
@auth('user')
<td class="mdl-data-table__cell--non-numeric">

{{-- add form --}}
<form action="{{ route('cart.add') }}" method="POST">
{{ csrf_field() }}
<input type="hidden" name="item_id" value="{{ $item->id }}">
<input type="submit" value="カートに追加する" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">

{{-- Select box for quantity --}}
<small>数量</small>
<select name="quantity">
@for ($i = 1; $i <= $item['stock']; $i++)
<option>{{ $i }}</option>
@endfor
</select>
</form>
</td>



{{-- if not logged in --}}
@else
<td class="mdl-data-table__cell--non-numeric">ログインしてください</td>
@endauth

{{-- no stock available--}}
@else
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>

{{-- for logged-in user --}}
@auth('user')
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>
{{-- if no logged in --}}
@else
<td class="mdl-data-table__cell--non-numeric">ログインしてください</td>
@endif
@endif
</table>
<br>
<a href="{{ route('item.index') }}">商品一覧へ戻る</a>
</div>
@endsection
