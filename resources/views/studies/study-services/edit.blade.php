@extends('layouts.default')
@section('content')
@section('pageTitle', 'Edit Study Travel Parameters')

{!! BootForm::open()->action( route('studies.study-services.update', [$study, $studyService]) )->put(); !!}
{!! BootForm::bind($studyService) !!}
    @include('studies/study-services/partials/_input_fields')
{!! BootForm::close() !!}

<hr>
{{-- Form::buDeleteButton(route('studies.study-services.destroy', [$study, $studyService])) --}}
@endsection