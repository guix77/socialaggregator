@extends('layouts.form')

@section('card')
@component('components.card')
@slot('title')
@lang('Create user')
@endslot
<form method="POST" action="{{ route('users.create') }}">
    @csrf
    @method('POST')

    @include('partials.form-group', [
    'title' => __('Name'),
    'type' => 'text',
    'name' => 'name',
    'required' => true
    ])

    @include('partials.form-group', [
    'title' => __('Email'),
    'type' => 'email',
    'name' => 'email',
    'required' => true
    ])

    @include('partials.form-group', [
    'title' => __('Password'),
    'type' => 'password',
    'name' => 'password',
    'required' => true
    ])

    @component('components.button')
    @lang('Create')
    @endcomponent
</form>
@endcomponent
@endsection
