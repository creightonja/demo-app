@extends('layouts.default')

@section('content')
@section('pageTitle', 'Edit Study - ' . $study->name)
{!! BootForm::open()->action( route('sponsors.studies.update', [$sponsor, $study]) )->put(); !!}
{!! BootForm::bind($study) !!}
    @include('studies/partials/_input_fields')
{!! BootForm::close() !!}

<hr>
{!! Form::buDeleteButton(route('sponsors.studies.destroy', [$sponsor, $study])) !!}

@endsection
