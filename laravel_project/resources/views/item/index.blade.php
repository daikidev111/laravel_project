@extends('layouts.app')

@section('content')
<div class="container">
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" border="1" style="table-layout: fixed; width: 100%">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">商品名</th>
<th class="mdl-data-table__cell--non-numeric">値段</th>
<th class="mdl-data-table__cell--non-numeric">在庫の有無</th>
<th class="mdl-data-table__cell--non-numeric">カートに追加</th>
</tr>
</thead>
<tbody>
@foreach ($items as $item)
<tr>
<td class="mdl-data-table__cell--non-numeric"><a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a></td>
<td class="mdl-data-table__cell--non-numeric">{{ $item->description }}</td>
@if ($item->stock > 0)
<td class="mdl-data-table__cell--non-numeric">在庫あり</td>
@auth('user')
<td class="mdl-data-table__cell--non-numeric">

<form action="{{ route('cart.add') }}" method="POST">
{{ csrf_field() }}
<input type="hidden" name="item_id" value="{{ $item->id }}">
<input type="submit" value="カートに追加する" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
<small>数量</small>
<select name="quantity">
@for ($i = 1; $i <= $item->stock; $i++)
<option>{{ $i }}</option>
@endfor
</select>
</form>

</td>

@else
<td class="mdl-data-table__cell--non-numeric">ログインしてください</td>
@endauth

@else
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>
@auth('user')
<td class="mdl-data-table__cell--non-numeric">在庫無し</td>
@else
<td class="mdl-data-table__cell--non-numeric">ログインしてください</td>
@endif
@endif
</tr>
@endforeach
</tbody>
</table>
</>
@endsection
