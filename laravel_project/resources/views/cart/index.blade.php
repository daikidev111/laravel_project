@extends('layouts.app')

@section('content')
<div class="container">
@if (session('message'))
<strong>{{ session('message') }}</strong>
@endif

@if ($carts->count() > 0)
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" order="1" style="table-layout: fixed; width: 100%">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">価格</th>
<th class="mdl-data-table__cell--non-numeric">購入数</th>
<th class="mdl-data-table__cell--non-numeric">小計</th>
<th class="mdl-data-table__cell--non-numeric">削除</th>
</tr>
</thead>
<tbody>
@foreach ($carts as $cart)
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->item->name }}</a></td>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->item->price }}円</td>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->quantity }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->quantity * $cart->item->price }}</td>
<td class="mdl-data-table__cell--non-numeric">
<form action="{{ route('cart.delete', $cart->item_id) }}" method="POST">
{{ method_field('DELETE') }}
{{ csrf_field() }}
<input type="submit" value="削除" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
税抜き価格: {{ $sub }}円
<br>
税込価格: {{ $total }}円
@else
<h1>カートが空です。</h1>
@endif
<br>
<br>
<a href="{{ route('item.index') }}">商品一覧へ</a> | <a href="{{ route('address.index') }}">お届け先選択</a>
</div>
@endsection
