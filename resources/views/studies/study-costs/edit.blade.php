@extends('layouts.default')

@section('content')
@section('pageTitle', 'Edit Study Costs')

{!! BootForm::open()->action( route('studies.study-costs.update', [$study, $studyCost]) )->put(); !!}
{!! BootForm::bind($studyCost) !!}
    @include('studies/study-costs/partials/_input_fields')
{!! BootForm::close() !!}

{{-- Form::buDeleteButton(route('studies.study-costs.destroy', [$study, $studyCost])) --}}
@endsection