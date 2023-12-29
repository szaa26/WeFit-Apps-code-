@extends('layouts.default')
@section('title', __( 'Withdrawal' ))
@section('content')
    @include('layouts.partials.notifications')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Balance</h3>
                </div>
                <form method="POST" action="{{ URL::to('/do-withdrawal') }}">
                    @csrf
                    <div class="card-body">
                        <center>
                            <h2 class="font-weight-bold">Rp. {{ number_format(total_balance(session('auth_user')['id'])) }}</h2>
                        </center>
                        <hr>
                        <div class="form-group">
                            <label class="">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" required>
                        </div>
                        <div class="form-group">
                            <label class="">Account Number</label>
                            <input type="text" class="form-control" name="account_number" placeholder="Account Number" required>
                        </div>
                        <div class="form-group">
                            <label class="">Account Name</label>
                            <input type="text" class="form-control" name="account_name" placeholder="Account Number" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Withdraw</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Withdrawal History</h3>
                </div>
                <div class="card-body">
                    @if(!empty($data))
                        <table class="table data-table">
                            <thead>
                                <th>No</th>
                                <th>Total</th>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach($data AS $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ number_format($value->total) }}</td>
                                        <td>{{ $value->bank_name }}</td>
                                        <td>{{ $value->account_number }}</td>
                                        <td>{{ $value->account_name }}</td>
                                        <td>{{ status_withdrawal($value->status) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <center>No History Found.!</center>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
    
@endsection
