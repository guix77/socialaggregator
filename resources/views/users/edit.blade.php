@extends('layouts.form')

@section('card')
@component('components.card')

@slot('title')
@lang('Edit user')
@endslot

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    @include('partials.form-group', [
    'title' => __('Name'),
    'type' => 'text',
    'name' => 'name',
    'required' => true,
    'value' => $user->name,
    ])

    @include('partials.form-group', [
    'title' => __('GitHub user name'),
    'type' => 'text',
    'name' => 'github_user_name',
    'required' => false,
    'value' => $user->github_user_name,
    ])

    @include('partials.form-group', [
    'title' => __('Drupal user ID'),
    'type' => 'number',
    'name' => 'drupal_user_id',
    'required' => false,
    'value' => $user->drupal_user_id,
    ])

    @component('components.button')
    @lang('Save')
    @endcomponent
</form>

@slot('footer')
@can('delete', $user)
<div>
    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value={{ __('Delete user') }}>
    </form>
</div>
@endcan
@endslot

@endcomponent
@endsection
