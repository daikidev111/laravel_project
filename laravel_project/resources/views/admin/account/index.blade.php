@extends('layouts.app_admin')

@section('content')
<div class="container">
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: flex; width: 100%;">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">会員一覧</th>
</tr>
</thead>
<tbody>
@foreach ($users as $user)
<tr>
<td class="mdl-data-table__cell--non-numeric"><a href="{{ route('admin.account.detail', $user->id) }}">{{ $user->name }}</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $users->links() }}
<br>
<a href="{{ route('admin.item.index') }}">商品一覧へ</a>
</div>
@endsection
