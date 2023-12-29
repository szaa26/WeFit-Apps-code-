@extends('layouts.default')
@section('title', __( 'Add User Venue' ))
@section('content')
@include('layouts.partials.notifications')
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Add User Venue</h3>
        <div class="card-tools">
            <a type="button" class="btn btn-info btn-sm" href="{{ URL::to('/venue-users') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
    <form method="POST" action="{{ URL::to('/do-add-venue-users') }}">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Name</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" placeholder="Name" name="name" required="">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">Email</label>
                <div class="col-md-5">
                    <input type="email" class="form-control" placeholder="E-Mail" name="email" required="">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">Phone</label>
                <div class="col-md-5">
                    <input type="number" class="form-control" placeholder="Phone" name="phone" required="">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">Province</label>
                <div class="col-md-5">
                    <select class="form-control" name="province" id="province" required>
                        <option value="">-- SELECT PROVINCE --</option>
                        @foreach($province as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label">City</label>
                <div class="col-md-5">
                    <select class="form-control" name="city" id="city" required>
                        <option value="">-- SELECT CITY --</option>
                    </select>
                </div>
            </div>            

            <div class="form-group row">
                <label class="col-md-2 col-form-label">Password</label>
                <div class="col-md-5">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script type="text/javascript">

    $("#province").on('change', function(event) {
        province_id = $(this).val();
        request_city_option(province_id)
    });

    function request_city_option(province_id){
        $.ajax({
            url: '{{ URL::to('/api/ajax-city-options') }}'+'/'+province_id,
            type: 'GET',
            dataType: 'html',
            async: true
        })
        .done(function(e) {
            $("#city").html(e);
        })
        .fail(function() {
            alert('Something went wrong.!');
        })
        .always(function() {
            console.log("complete");
        });
        
    }

</script>
@endsection
