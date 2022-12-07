@extends('layouts.adminMaster')

@section('content')
    <h2>Payment Approval Page</h2>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Sl.</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($cashOut as $key=> $payment)
                    <tr>

                        <td>{{$payment->id}}</td>
                        <td>{{$payment->user->name}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>
                           @if($payment->status == 'pending')
                            <a class="btn btn-success" href="{{route('status.cashOut',[$payment->id,'approve'])}}">Approved</a> ||
                            <a class="btn btn-danger" href="{{route('status.cashOut',[$payment->id,'decline'])}}">Rejected</a>
                            @else
                            <p>{{$payment->status}}</p>
                               @endif
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

