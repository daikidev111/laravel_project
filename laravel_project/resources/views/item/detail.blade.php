@extends('layouts.app')

@section('content')
<div class="container">
<table border="1" style="table-layout: fixed; width: 100%">
<tr>
<th>商品名</th>
<th>内容</th>
<th>値段</th>
<th>在庫有無</th>
</tr>
<tr>
<td>{{ $item['name'] }}</td>
<td>{{ $item['description'] }}</td>
<td>{{ $item['price'] }}</td>
@if ($item['stock'] > 0)
<td>有</td>
@else
<td>無</td>
@endif
</tr>
</table>
<a href="{{ route('item.index') }}">商品一覧へ</a>
</div>
@endsection
