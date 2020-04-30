@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>{{ __('Users') }}</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            <a href={{ route('users.edit', $user->id) }} class="btn btn-primary btn-sm">
                                {{ __('Edit') }}
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger btn-sm" value={{ __('Delete user') }}>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href={{ route('users.create') }} class="btn btn-primary">{{ __('Create user') }}</a>
        </div>
    </div>
</div>
@endsection
