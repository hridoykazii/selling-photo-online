@extends('layouts.master')

@section('content')
    <h2>Welcome To Financial</h2>

    <h2>Total Balance: {{$balance}}$</h2>
    @if($balance >=5)
    <a class="btn btn-success" href="{{route('user.cashout',$balance)}}">Cash Out</a>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>Upload Date</th>
                    <th>Image</th>
                    <th>Price</th>

                </tr>
                </thead>
                <tbody>
                @foreach($buyOutimage as $key=> $photo)
                    <tr>

                        <td>{{$photo->id}}</td>
                        <td>{{date('Y-m-d',strtotime($photo->buyout_date))}}</td>
                        <td><img width="100px !important" class="img-fluid" src="{{asset('uploads').'/'.$photo->image}}"></td>
                        <td>{{$photo->rate}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
