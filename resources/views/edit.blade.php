@extends("layouts.app")

@section("content")
    <h2>Edit User</h2>
    <form class="form-horizontal" action="/users/{!! $user->id !!}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{!! $user->name !!}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{!! $user->email !!}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </div>
    </form>
@endsection