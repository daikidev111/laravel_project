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

@if (session('message'))
<strong>{{ session('message') }}</strong>
@endif

<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: flex; width: 100%">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">値段</th>
<th class="mdl-data-table__cell--non-numeric"></th>
<th class="mdl-data-table__cell--non-numeric">在庫の有無</th>
</tr>
</thead>
<tbody>
@foreach ($items as $item)
<tr>
<td class="mdl-data-table__cell--non-numeric"><a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a></td>
<td class="mdl-data-table__cell--non-numeric">{{ $item->price }}円</td>
@if (empty($item->image))
<td class="mdl-data-table__cell--non-numeric">未登録</td>
@else
<td class="mdl-data-table__cell--non-numeric"><img class="logo" src="{{ asset('storage/image/' . $item->image) }}" width="70px" height="70px"></td>
@endif
@if ($item->stock > 0)
<td class="mdl-data-table__cell--non-numeric">在庫あり</td>
@else
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>
@endif
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
