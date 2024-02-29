@extends('layouts.master')

@section('title') @lang('translation.Dashboard') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Dashboard @endslot
@endcomponent
@include('layouts.alert')
@if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
        {{ Session::get('message') }}
    </div>
@endif

<div class="row">
    <div class="card">
        <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 card-title flex-grow-1">Category List</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle dt-responsive nowrap w-100 table-check payment-list" id="payment-list">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
                <!-- end table -->
            </div>
        </div>
        <!-- end card body -->
    </div>
</div>
<!-- end row -->

@endsection