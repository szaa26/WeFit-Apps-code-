@extends('layouts.default')
@section('title', __( 'Venues' ))
@section('content')
    @include('layouts.partials.notifications')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Venues</h3>
            <div class="card-tools">
                <a type="button" class="btn btn-primary btn-sm" href="{{ URL::to('/add-venue') }}">
                    <i class="fa fa-plus"></i> Add Venue
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped data-table w-100">
                <thead>
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th>Venue Name</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Map</th>
                        <th>Opration Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data AS $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->venue_name }}</td>
                            <td>{{ $value->province->name }}</td>
                            <td>{{ $value->regency->name }}</td>
                            <td>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $value->lat }},{{ $value->lng }}" target="_blank">See Map</a>
                            </td>
                            <td>{{ $value->open_time }} - {{ $value->close_time }}</td>
                            <td>
                                <a type="button" class="btn btn-warning btn-sm" href="{{ URL::to('/edit-venue/'.$value->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="btn btn-danger btn-sm" href="{{ URL::to('/delete-venue/'.$value->id) }}" onclick="return confirm('Are you sure.?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="{{ URL::to('venue-field', $value->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-swimmer"></i> Field List
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
