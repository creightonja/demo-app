@extends('layouts.default')

@section('content')
@section('pageTitle', 'Create Study')

{!! BootForm::open()->action( route('sponsors.studies.store', $sponsor) )->post(); !!}
{!! BootForm::bind($study) !!}
    @include('studies/partials/_input_fields')
{!! BootForm::close() !!}

@endsection
