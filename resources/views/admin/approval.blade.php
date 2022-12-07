@extends('layouts.adminMaster')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Upload Date</th>
                                <th>User</th>
                                <th>Image</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($photos as $key=> $photo)
                            <tr>

                                <td>{{$photo->id}}</td>
                                <td>{{\Carbon\Carbon::parse($photo->created_at)->format('Y-m-d')}}</td>
                                <td>{{$photo->user->name}}</td>
                                <td><img width="100px !important" class="img-fluid" src="{{asset('uploads').'/'.$photo->image}}"></td>
                                <td>
                                    <a class="btn btn-success" href="{{route('admin.updateApproval',[$photo->id,'approved'])}}">Approve</a> ||
                                    <a class="btn btn-danger" href="{{route('admin.updateApproval',[$photo->id,'rejected'])}}">Rejected</a>
                                </td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
