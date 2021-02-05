@extends('layouts.app_admin')

@section('content')
<div class="container">
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: flex; width: 100%;">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">商品説明</th>
<th class="mdl-data-table__cell--non-numeric">値段</th>
<th class="mdl-data-table__cell--non-numeric"></th>
<th class="mdl-data-table__cell--non-numeric">在庫の有無</th>
</tr>
</thead>
<tbody>
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $item_arr->name }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $item_arr->description }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $item_arr->price }}</td>

@if (empty($item_arr->image))
<td class="mdl-data-table__cell--non-numeric">未登録</td>
@else
<td class="mdl-data-table__cell--non-numeric"><img class="logo" src="{{ asset('storage/image/' . $item_arr->image) }}" width="70px" height="70px"></td>
@endif

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

