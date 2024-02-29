@extends('layouts.master')

@section('title')
    Menu
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Menu
        @endslot
        @slot('title')
            Menu List
        @endslot
    @endcomponent
    @include('layouts.alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Menu List</h5>
                        <div class="flex-shrink-0">
                            <a data-bs-toggle="modal" data-bs-target="#bank-create" class="btn btn-primary">Sync</a>
                        </div>
                        @include('pages.menu.sync')
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle dt-responsive nowrap w-100 table-check">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($menuLists as $menu)
                                    <tr>
                                        <td>{{$menu->api_id}}</td>
                                        <td><img src="{{$menu->image }}"  alt=""class="avatar-md rounded d-block mx-auto" style="float: left;"></td>
                                        <td>{{$menu->name}}</td>
                                        <td>{{$menu->category}}</td>
                                        <td>{{$menu->price}}</td>
                                        <td>{{$menu->description}}</td>
                                        <td>{{$menu->qty}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                            
                                                <a class="dropdown-item" href="{{route('menu.sync', ['id' => $menu->id])}}">
                                                <i class="bx bx-show-alt"></i> Sync</a>
                                            
                                                <a class="dropdown-item edit-btn" href="#" data-menu-id="{{$menu->id}}">
                                                <i class="bx bx-show-alt"></i> Edit</a>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->
                        <!-- BEGIN: Pagination -->
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                            <nav class="w-full sm:w-auto sm:mr-auto">
                                <ul class="pagination">
                                    {{ $menuLists->links('vendor.pagination.bootstrap-5') }}
                            </nav>
                        </div>
                        <!-- END: Pagination -->
                </div>
                <!-- end card body -->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.edit-btn', function(e) {
                e.preventDefault();

                var menuId = $(this).data('menu-id');

                $.ajax({
                    type: 'GET',
                    url: '/menu/edit/' + menuId,
                    success: function(response) {
                        $('#menuEditor').empty();
                        $('#menuEditor').append(response.modalContent);
                        $('#editMenu').modal('show');
                    },
                    error: function() {
                        // Handle error if needed
                    }
                });
            });
        });
    </script>
@endsection