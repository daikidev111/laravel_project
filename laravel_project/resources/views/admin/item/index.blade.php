@extends('layouts.app_admin')

@section('content')
<div class="container">
@if (session('success'))
<strong>{{ session('success') }}</strong>
@endif
<br>
<a href="{{ route('admin.item.create') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Create</a>
<br>
<br>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: fixed; width: 100%">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">値段</th>
<th class="mdl-data-table__cell--non-numeric">在庫有無</th>
<th class="mdl-data-table__cell--non-numeric">アクション</th>
</thead>
</tr>
<tbody>
@foreach ($item_arr as $item)
<tr>
<td class="mdl-data-table__cell--non-numeric"><a href="{{ route('admin.item.detail', $item->id) }}">{{ $item->name }}</a></td>
<td class="mdl-data-table__cell--non-numeric">{{ $item->price }}</td>
@if ($item->stock > 0)
<td class="mdl-data-table__cell--non-numeric">在庫有り</td>
@else
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>
@endif
<td class="mdl-data-table__cell--non-numeric"><a href="{{ route('admin.item.edit', $item->id) }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">編集</a>
<form action="{{ route('admin.item.destroy') }}" method="POST">
{{ method_field('DELETE') }}
{{ csrf_field() }}

</td>
</tr>
@endforeach
</tbody>
</table>
{{ $item_arr->links() }}
</div>
@endsection
