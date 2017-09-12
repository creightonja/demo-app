@extends('layouts.default')

@section('content')
@section('pageTitle', 'Create Study Travel Parameters')

{!! BootForm::open()->action( route('studies.study-services.store', $study) )->post(); !!}
{!! BootForm::bind($studyService) !!}
    @include('studies/study-services/partials/_input_fields')
{!! BootForm::close() !!}

@endsection