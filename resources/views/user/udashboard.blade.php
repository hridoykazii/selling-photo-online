@extends('layouts.master')

@section('content')
    <h2>Welcome To Dashboard</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <form class="form-group" action="{{route('user.upload')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <label>Photo Name:
                        <input class="form-control" type="text" name="name">
                    </label><br>
                    <label>Details:
                        <input class="form-control" type="text" name="details">
                    </label><br>
                    <input  type="file" name="image"><br>
                    <input class="btn btn-primary" type="submit" name="submit" value="Upload"><br>
                </form>
            </div>
        </div>
    </div>

@endsection
