@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-4">
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
                            @can('update', $user)
                            <a href={{ route('users.edit', $user->id) }} class="btn btn-primary btn-sm">
                                {{ __('Edit') }}
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger btn-sm" value={{ __('Delete user') }}>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @can('create user')
            <a href={{ route('users.create') }} class="btn btn-primary">{{ __('Create user') }}</a>
            @endcan
        </div>
    </div>
    <div class="row my-4">
        <div class="col-12">
            <h2>{{ __('Items') }}</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Network</th>
                        <th scope="col">Item</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->network }}</td>
                        <td><a href={{ $item->url }} target="_blank">{{ $item->title }}</a></td>
                        <td>
                            @can('update', $item)
                            <form method="POST" action="{{ route('items.update', $item->id) }}" class="d-inline-block">
                                @csrf
                                @method('PUT')
                                @if ($item->status === config('constants.status.published'))
                                <input type="hidden" name="status" value={{ config('constants.status.unpublished') }}>
                                <input type="submit" class="btn btn-secondary btn-sm" value={{ __('Unpublish') }}>
                                @elseif ($item->status === config('constants.status.unpublished'))
                                <input type="hidden" name="status" value={{ config('constants.status.published') }}>
                                <input type="submit" class="btn btn-primary btn-sm" value={{ __('Publish') }}>
                                @endif
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
