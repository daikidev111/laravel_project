@extends('layouts.app_admin')

@section('content')
<div class="container">
<table border="1" style="table-layout: fixed; width: 100%">
<tr>
<th>商品名</th>
<th>値段</th>
<th>在庫有無</th>
</tr>
@foreach ($item_arr as $item)
<tr>
<td><a href="{{route('admin.item.show', $item->id)}}">{{ $item->name }}</a></td>
<td>{{ $item->description }}</td>
@if ($item->stock > 0)
<td>有</td>
@else
<td>無</td>
@endif
</tr>
@endforeach
</table>
</div>
@endsection
