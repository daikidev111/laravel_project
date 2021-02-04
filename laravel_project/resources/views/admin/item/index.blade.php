@extends('layouts.app_admin')

@section('content')
<div class="container">
@if (session('success'))
<strong>{{ session('success') }}</strong>
@endif
<br>
<a href="{{ route('admin.item.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">作成</a>
<br>
<br>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: flex; width: 100%;">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">値段</th>
<th class="mdl-data-table__cell--non-numeric">在庫の有無</th>
<th class="mdl-data-table__cell--non-numeric"></th>
<th class="mdl-data-table__cell--non-numeric">編集</th>
</thead>
</tr>
<tbody>
@foreach ($item_arr as $item)
<tr>
<td class="mdl-data-table__cell--non-numeric"><a href="{{ route('admin.item.detail', $item->id) }}">{{ $item->name }}</a></td>
<td class="mdl-data-table__cell--non-numeric">{{ $item->price }}</td>
@if ($item->stock > 0)
<td class="mdl-data-table__cell--non-numeric">在庫あり</td>
@else
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>
@endif

@if (empty($item->image))
<td class="mdl-data-table__cell--non-numeric">未登録</td>
@else
<td class="mdl-data-table__cell--non-numeric"><img class="logo" src="{{ asset('storage/image/' . $item->image) }}" width="70px" height="70px"></td>
@endif

<td class="mdl-data-table__cell--non-numeric"><a href="{{ route('admin.item.edit', $item->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">編集</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $item_arr->links() }}
</div>
@endsection
