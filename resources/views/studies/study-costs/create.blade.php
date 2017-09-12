@extends('layouts.default')

@section('content')
@section('pageTitle', 'Create Study Costs')

{!! BootForm::open()->action( route('studies.study-costs.store', $study) )->post(); !!}
{!! BootForm::bind($studyCost) !!}
    @include('studies/study-costs/partials/_input_fields')
{!! BootForm::close() !!}

@endsection