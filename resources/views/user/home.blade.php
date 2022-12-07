@extends('layouts.master')
@section('slideImg','img/home-bg.jpg')

@section('slideTitle','Clean Blog')
@section('slideDetails','A Blog Theme by Start Technology')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach($photos as $photo)
                    <div class="col-md-4">
                        <img class="img-fluid" style="height:250px" src="{{asset('uploads').'/'.$photo->image}}" alt="Card image">
                    </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

    <hr>
@endsection
