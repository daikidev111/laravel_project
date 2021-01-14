@extends('layouts.app_admin')

@section('content')
<div class="container">
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: fixed; width: 100%">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">商品説明</th>
<th class="mdl-data-table__cell--non-numeric">値段</th>
<th class="mdl-data-table__cell--non-numeric">在庫の有無</th>
</tr>
</thead>
<tbody>
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $item_arr->name }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $item_arr->description }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $item_arr->price }}</td>
@if ($item_arr->stock > 0)
<td class="mdl-data-table__cell--non-numeric">在庫あり</td>
@else
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>
@endif
</tr>
</tbody>
</table>
<a href="{{ route('admin.item.index') }}">商品一覧へ</a>
</div>
@endsection

