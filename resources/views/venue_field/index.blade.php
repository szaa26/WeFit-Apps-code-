@extends('layouts.default')
@section('title', __( 'Venue Field' ))
@section('content')
    @include('layouts.partials.notifications')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Venue Field</h3>
            <div class="card-tools">
                @if(session('auth_user')['roles'] == 'admin')
                    <a type="button" class="btn btn-info btn-sm" href="{{ URL::to('/admin-venue') }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                @else
                    <a type="button" class="btn btn-info btn-sm" href="{{ URL::to('/venue') }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                @endif
                <a type="button" class="btn btn-primary btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#add-modal">
                    <i class="fa fa-plus"></i> Add Field
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <td style="width:8%;">Venue Name</td>
                    <td style="width:1%;">:</td>
                    <td style="width: 40%;">{{ $venue->venue_name }}</td>

                    <td style="width:10%">Province</td>
                    <td style="width:1%;">:</td>
                    <td>{{ $venue->province->name }}</td>
                </tr>

                <tr>
                    <td>Venue Owner</td>
                    <td>:</td>
                    <td>{{ $venue->user->name }}</td>

                    <td>City</td>
                    <td>:</td>
                    <td>{{ $venue->regency->name }}</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>Operation Time</td>
                    <td>:</td>
                    <td>{{ $venue->open_time }} - {{ $venue->close_time }}</td>
                </tr>
            </table>
            <hr>
            <center><h3 class="font-weight-bold">Field List</h3></center>
            <table class="table table-bordered table-striped data-table w-100">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Field Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data AS $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->field_name }}</td>
                            <td>Rp. {{ number_format($value->price) }} /Hour</td>
                            <td>{{ $value->category->category_name }}</td>
                            <td>
                                <a type="button" class="btn btn-warning btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#edit-modal-{{ $value->id }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="btn btn-danger btn-sm" href="{{ URL::to('/delete-venue-field/'.$venue->id.'/'.$value->id) }}" onclick="return confirm('Are you sure.?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ URL::to('/do-add-venue-field/'.$venue->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label">Category</label>
                            <div class="col-md-12">
                                <select class="form-control" name="category" required>
                                    <option value="">-- SELECT CATEGORY --</option>
                                    @foreach($category AS $ct)
                                        <option value="{{ $ct->id }}">{{ $ct->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label">Field Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Field Name, e.g: Field A, Filed B" name="name" required="">
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-12 col-form-label">Price /Hour</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" placeholder="Price" name="price" required="">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($data AS $value)
        <div class="modal fade" id="edit-modal-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Field</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ URL::to('/do-update-venue-field/'.$venue->id.'/'.$value->id) }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">Category</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="category" required>
                                        <option value="">-- SELECT CATEGORY --</option>
                                        @foreach($category AS $ct)
                                            <option value="{{ $ct->id }}" {{ selected($ct->id, $value->category_id) }}>{{ $ct->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">Field Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Field Name, e.g: Field A, Filed B" name="price" required="" value="{{ $value->field_name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-12 col-form-label">Price /Hour</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control" placeholder="Price" name="name" required="" value="{{ $value->price }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
