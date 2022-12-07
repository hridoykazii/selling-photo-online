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
                                        <form method="post" action="{{route('admin.updateBuyout')}}">
                                            <input type="hidden" name="photo_id" value="{{$photo->id}}">
                                            <input type="hidden" name="user_id" value="{{$photo->user->id}}">
                                            {{csrf_field()}}
                                            <select name="selling-status" id="">
                                                <option value="buy-out">Buy-Out</option>
                                                <option value="not-sellable">Not Selling</option>
                                            </select>
                                            <input type="number" step="any" name="price" >
                                            <input type="submit" value="Save" name="submit" class="btn btn-success btn-sm">
                                        </form>
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

