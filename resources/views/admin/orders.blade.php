@extends('layouts.admin')
@section('content')
@php
use \App\Http\Controllers\Controller;
@endphp
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> <span class="text-muted fw-light">Orders /</span> {{ ($title)?$title.' Orders' : 'Orders' }} </h4>
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <div class="tab-content card mb-4" style="padding: 0; ">
                    <div class="tab-pane fade  show active" id="navs-pills-top-social" role="tabpanel">
                        <h5 class="card-header">Order Details</h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered"  id="order_table">
                                  <thead>
                                    <tr>
                                      <th>#ID</th>
                                      <th>Package</th>
                                      <th>Influencer</th>
                                      <th>Brand</th>
                                      <th>Price</th>
                                      <th>Date</th>
                                      <th>Status</th>
                                      <th>Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Package Demo</td>
                                        <td>Rahul Bhadala</td>
                                        <td>Brand</td>
                                        <td>$300</td>
                                        <td> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
                                        <td>{{$title}}</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Package Video Editing</td>
                                        <td>Rahul Bhadala</td>
                                        <td>Brand</td>
                                        <td>$220</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(3)->format('d/m/Y') }}</td>
                                        <td>{{$title}}</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Wordpress Website Design</td>
                                        <td>Rahul Bhadala</td>
                                        <td>Brand</td>
                                        <td>$200</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(8)->format('d/m/Y') }}</td>
                                        <td>{{$title}}</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>UI/Design</td>
                                        <td>Rahul Bhadala</td>
                                        <td>Brand</td>
                                        <td>$120</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(19)->format('d/m/Y') }}</td>
                                        <td>{{$title}}</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Laravel Package Development </td>
                                        <td>Rahul Bhadala</td>
                                        <td>Brand</td>
                                        <td>$520</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(26)->format('d/m/Y') }}</td>
                                        <td>{{$title}}</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')

@endsection

@section('scripts')
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>

<!-- Initialize Quill editor -->
<script>
    $(document).ready(function() {
    });
</script>
@endsection