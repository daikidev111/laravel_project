@extends('layouts.app')

@section('content')
<div class="container">
<table border="1" style="table-layout: fixed; width: 100%">
<tr>
<th>商品名</th>
<th>値段</th>
<th>在庫の有無</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a></td>
<td>{{ $item->description }}</td>
@if ($item->stock > 0)
<td>在庫あり</td>
@else
<td>在庫無し</td>
@endif
</tr>
@endforeach
</table>
</div>
@endsection
