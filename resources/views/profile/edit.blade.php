@extends('layouts.form')

@section('card')
@component('components.card')
@slot('title')
@lang('Edit profile')
<a href="{{ route('profile.destroy', $user->id) }}" class="btn btn-danger btn-sm float-right" role="button" aria-disabled="true"><i class="fas fa-angry fa-lg"></i> @lang('Delete my account')</a>
@endslot
<form method="POST" action="{{ route('profile.update', $user->id) }}">
    @csrf
    @method('PUT')

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

    @include('partials.form-group', [
    'title' => __('Twitter user ID'),
    'type' => 'number',
    'name' => 'twitter_user_id',
    'required' => false,
    'value' => $user->twitter_user_id,
    ])

    @include('partials.form-group', [
    'title' => __('LinkedIn user ID'),
    'type' => 'number',
    'name' => 'linkedin_user_id',
    'required' => false,
    'value' => $user->linkedin_user_id,
    ])

    @component('components.button')
    @lang('Save')
    @endcomponent
</form>
@endcomponent
@endsection

@section('script')
@include('partials.script-delete', ['text' => __('Really delete your account?'), 'return' => 'home'])
@endsection
