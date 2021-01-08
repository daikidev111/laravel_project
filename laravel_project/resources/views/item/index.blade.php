@extends('layouts.app')

@section('content')
<div class="container">
@foreach ($items as $item)
{{$item->id}}
@endforeach
</div>
@endsection
