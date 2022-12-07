@extends('layouts.master')

@section('content')
    <h2>Welcome To Your Gallery</h2>
    <div class="container">
        <div class="row">
            @foreach($photos as $photo)
            <div class="card" style="width:400px">
                <img class="card-img-top img-fluid" style="height:250px" src="{{asset('uploads').'/'.$photo->image}}" alt="Card image">
                <div class="card-body">
                    <h4 class="card-title">Name: {{$photo->name}}</h4>
                    <p class="card-text">Details: {{$photo->details}}</p>
                    <span class="card-text">Status: {{ucfirst($photo->status)}}</span>
                    @if($photo->status =='approved')
                        <a class="btn btn-primary" href="{{route('user.submitForSell',$photo->id)}}">Submit For Sell</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
