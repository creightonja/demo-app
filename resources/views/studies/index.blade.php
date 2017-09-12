@extends('layouts.default')
@section('content')
@section('pageTitle', "All Studies")

<div class="container">
        <list :list_items="{{ $studies }}" :searchable_columns="{{ json_encode(['Name' => 'name', 'Size' => 'study_size']) }}"></list>

</div>
@endsection
