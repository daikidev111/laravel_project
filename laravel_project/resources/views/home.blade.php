@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ログイン状況</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログインに成功しました！
				</div>
			</div>
			<a href="{{ Route('item.index') }}">アイテム一覧へ</a>
        </div>
    </div>
</div>
@endsection
