<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
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
<br>
<br>
{{-- display message --}}
@if (session('message'))
<strong>{{ session('message') }}</strong>
@endif
<br>
<br>
<div class="panel panel-default">
<div class="panel-heading">購入情報確認</div>

<div class="panel-body">

{{-- 住所情報 --}}
<p><strong>お届け先住所</strong></p>
@if ($address == null)
<p>住所は未登録です。登録してください</p>


{{-- If address does exist --}}
@else
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" class="table table-hover" border="1" style="table-layout: flex; width: 100%">

{{-- table columns --}}
<thead>
<tr>
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
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $address->name }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address->postal_code }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address->prefecture }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address->city }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address->building }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address->phone }}</td>
</tr>
@endif
</tbody>
</table>

<br>
<br>

{{-- カート情報 --}}
<p><strong>カート情報</strong></p>
@if ($carts->count() > 0)
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" order="1" style="table-layout: flex; width: 100%">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">価格</th>
<th class="mdl-data-table__cell--non-numeric">購入数</th>
<th class="mdl-data-table__cell--non-numeric">小計</th>
</tr>
</thead>
<tbody>
@foreach ($carts as $cart)
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->item->name }}</a></td>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->item->price }}円</td>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->quantity }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $cart->quantity * $cart->item->price }}</td>
</tr>
@endforeach
</tbody>
</table>
<br>
<div style="text-align:center">
<h4>税抜き価格: {{ $sub }}円</h4>
<h4>税込価格: {{ $total }}円</h4>
</div>
@else
<h1>カートが空です。</h1>
@endif
<br>
</div>
</div>

@if ($address !== null &&  $carts->count() > 0)
{{-- 決済 --}}
<form action="{{ route('payment.pay') }}" method="POST">
{{ csrf_field() }}
<div style="text-align: center;">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="{{ env('STRIPE_KEY') }}"
data-amount={{ $total }}
data-name="決済情報入力"
data-label="決済をする"
data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
data-locale="auto"
data-currency="JPY"
>
</script>
<input type="hidden" name="address_id" value="{{ $address->id }}">
</form>
</div>
@endif

</body>
