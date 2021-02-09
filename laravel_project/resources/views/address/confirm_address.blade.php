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
{{-- for displaying a message --}}
@if (session('message'))
<strong>  {{ session('message') }}</strong>
@endif
<br>

<div class="panel panel-default">
<div class="panel-heading">住所選択</div>

<div class="panel-body">
{{-- If address does not exist --}}
@if ($address == null)
<p>住所は未登録です。登録してください</p>


{{-- If address does exist --}}
@else
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" class="table table-hover" border="1" style="table-layout: flex; width: 100%">

{{-- table columns --}}
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">選択</th>
<th class="mdl-data-table__cell--non-numeric">氏名</th>
<th class="mdl-data-table__cell--non-numeric">郵便番号</th>
<th class="mdl-data-table__cell--non-numeric">都道府県</th>
<th class="mdl-data-table__cell--non-numeric">市区町村</th>
<th class="mdl-data-table__cell--non-numeric">それ以下の住所</th>
<th class="mdl-data-table__cell--non-numeric">電話番号</th>
</tr>
</thead>
{{-- table rows --}}
<tbody>
@foreach ($address as $addr)
<tr>

<td class="mdl-data-table__cell--non-numeric">
<a href="{{ route('payment.index', $addr->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">確定</a>
</td>

<td class="mdl-data-table__cell--non-numeric">{{ $addr->name }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $addr->postal_code }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $addr->prefecture }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $addr->city }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $addr->building }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $addr->phone }}</td>
</td>
</tr>
@endforeach
@endif
</tbody>
</table>
</div>
</div>
<a href="{{ route('cart.index') }}">カート内容へ戻る</a>｜<a href="">購入手続きへ</a>
@endsection
