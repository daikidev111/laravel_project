@extends('layouts.app_admin')

@section('content')
<div class="container">

<b>ユーザー情報</b>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: flex; width: 100%;">
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">ユーザー名</th>
<th class="mdl-data-table__cell--non-numeric">メールアドレス</th>
</tr>
</thead>
<tbody>
@foreach ($user_details as $user_detail)
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $user_detail->name }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $user_detail->email }}</td>
</tr>
@endforeach
</tbody>
</table>

<br>

<b>お届け先一覧</b>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="table-layout: flex; width: 100%;">

@if ($address_details->count() > 0)
<thead>
<tr>
<th class="mdl-data-table__cell--non-numeric">No.</th>
<th class="mdl-data-table__cell--non-numeric">氏名</th>
<th class="mdl-data-table__cell--non-numeric">郵便番号</th>
<th class="mdl-data-table__cell--non-numeric">住所</th>
<th class="mdl-data-table__cell--non-numeric">電話番号</th>
</tr>
</thead>
<tbody>
@foreach ($address_details as $address_detail)
<tr>
<td class="mdl-data-table__cell--non-numeric">{{ $loop->iteration }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address_detail->name }}</td>
<td class="mdl-data-table__cell--non-numeric">〒{{ $address_detail->postal_code }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address_detail->prefecture }}{{ $address_detail->city }}{{ $address_detail->building }}</td>
<td class="mdl-data-table__cell--non-numeric">{{ $address_detail->phone }}</td>
</tr>
@endforeach

@else
<tr>
<td class="mdl-data-table__cell--non-numeric" style="text-align: center;">未登録です</td>
</tr>
@endif

</tbody>
</table>
<br>
<a href="{{ route('admin.account.index') }}">会員一覧へ</a>
</div>
@endsection
