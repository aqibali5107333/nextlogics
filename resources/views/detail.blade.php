@extends("layouts.app")

@section("content")
    <h2>User {!! $user->name !!}</h2>
    <form class="form-horizontal" action="/users/{!! $user->id !!}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="DELETE">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">
                {!! $user->name !!}
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                {!! $user->email !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="/users" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
@endsection