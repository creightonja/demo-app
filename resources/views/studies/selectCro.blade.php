@extends('layouts.default')

@section('content')
@section('pageTitle', 'Select A CRO')

<div class="container">

    <list :list_items="{{ $cros }}" :searchable_columns="{{ json_encode(['ID' => 'id', 'Cro Name' => 'name', 'Logo' => 'logo', 'Address' => 'addressString']) }}"></list>

</div>
@endsection