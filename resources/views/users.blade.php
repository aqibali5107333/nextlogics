@extends("layouts.app")

@section("content")
    @if(Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {!! Session::get('error') !!}
        </div>
    @endif
    <h2>Users Listing</h2>
    <a href="/users/create" class="btn btn-success pull-right">Add New User</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->id !!}</td>
                <td>
                    @if($user->image)
                        <img src="{!! $user->image !!}" alt="{!! $user->name !!}">
                    @endif
                </td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td><a href="/users/{!! $user->id !!}/edit" class="btn btn-primary">Edit</a> || <a
                            href="/users/{!! $user->id !!}" class="btn btn-danger">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $users->links() !!}
@endsection