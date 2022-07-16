@extends('layouts.admin')
@section('content')
@php
use \App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
@endphp
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Account /</span> Account </h4>
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    
                    <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
                        <i class="bx bx-user me-1"></i> Profile Details
                    </button>
                    </li>
                    @php 
                        $disabled = '';
                        if(!isset($user)){
                            $disabled = 'disabled';
                        }
                    @endphp
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" {{$disabled}} data-bs-toggle="tab" data-bs-target="#navs-pills-top-portfolio" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-slideshow'></i> Portfolio
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" {{$disabled}} data-bs-toggle="tab" data-bs-target="#navs-pills-top-social" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-link-alt'></i> Social Links
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" {{$disabled}} data-bs-toggle="tab" data-bs-target="#navs-pills-top-packages" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-layer-plus' ></i> Packages
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" {{$disabled}} data-bs-toggle="tab" data-bs-target="#navs-pills-top-orders" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-cart-alt'></i> Orders
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" {{$disabled}} data-bs-toggle="tab" data-bs-target="#navs-pills-top-earning" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-dollar-circle' ></i> Earning
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" {{$disabled}} data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-chat'></i> Messages
                        </button>
                    </li>
                </ul>
                <div class="tab-content card mb-4" style="padding: 0; ">
                    <div class="tab-pane fade show active" id="navs-pills-top-profile" role="tabpanel">
                        <h5 class="card-header">Profile Details</h5>
                        <hr class="my-0">
                        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
                            <!-- Account -->
                            @csrf
                            <input type="hidden" name="user_id" value="{{($user->id)??''}}">
                            <input type="hidden" name="profile_details" value="profile_details">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ (isset($user) && $user->profile_photo)?Storage::url($user->profile_photo):url('userPhotos/demo.jpeg') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="profile_photo" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                                    </label>
                                    {{-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                    </button> --}}
                                    <p class="text-muted">Allowed JPG, GIF or PNG</p>
                                    @error('profile_photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="full_name" class="form-label">Full Name</label>
                                        <input class="form-control @error('full_name') is-invalid @enderror" type="text" id="full_name" placeholder="Full Name" name="full_name" value="{{($user->full_name)??''}}">
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input class="form-control @error('lastName') is-invalid @enderror" type="text" name="lastName" placeholder="Last Name" id="lastName" value="{{($user->last_name)??''}}">
                                    </div> --}}
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{($user->email)??''}}" placeholder="Email">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Passwors</label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" value="" placeholder="&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;">
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="organization" class="form-label">Organization</label>
                                        <input type="text" class="form-control" id="organization" placeholder="Organization" name="organization" value="{{($user->meta->organization)??''}}">
                                    </div> --}}
                                    <div class="mb-3 col-md-6">
                                        {{-- <div class="input-group input-group-merge"> --}}
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            {{-- <span class="input-group-text">US (+1)</span> --}}
                                            <input type="text" id="phoneNumber" name="phoneNumber"  value="{{($user->phone)??''}}" class="form-control" placeholder="Phone Number">
                                        {{-- </div> --}}
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="whatsapp">WhatsApp Number</label>
                                        <input type="text" id="whatsapp" name="whatsapp"  value="{{($user->meta->whatsapp)??''}}" class="form-control" placeholder="WhatsApp Number">
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" value="{{($user->meta->address)??''}}" name="address" placeholder="Address">
                                    </div> --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="country">Country</label>
                                        <select id="country" name="country" class="select2 form-select">
                                            <option value="">Select</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country['shortname']}}" {{(isset($user) && $country['shortname'] == $user->meta->country)?'selected':''}}>{{$country['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="state" class="form-label">State</label>
                                        <select id="state" name="state" class="select2 form-select">
                                            <option value="">Select</option>
                                            @isset($states)
                                            @foreach ($states as $state)
                                            <option value="{{$state['id']}}" {{(isset($user) && $state['id'] == $user->meta->state)?'selected':''}}>{{$state['name']}}</option>
                                            @endforeach
                                            @endisset
                                        </select>
                                    </div> --}}
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{($user->meta->city)??''}}" placeholder="City">
                                    </div> --}}
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zipCode" name="zipCode" value="{{($user->meta->zipCode)??''}}" placeholder="Zip Code" maxlength="6">
                                    </div> --}}
                                    @can('role_access')
                                    <div class="mb-3 col-md-6">
                                        <label for="roles" class="form-label">Select Role</label>
                                        <select id="roles" name="roles[]" class="select2 form-select" multiple="multiple" required>
                                            @isset($roles)
                                            @foreach($roles as $id => $roles)
                                                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                            @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    @endcan

                                    <div class="mb-3 col-md-6">
                                        <label for="language" class="form-label">Language</label>
                                        <input type="text" class="form-control" id="language" name="language" value="{{($user->language)??''}}" placeholder="Language">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="brief_desc" class="form-label">Brief Description</label>
                                        <textarea class="form-control" name="brief_desc" required id="brief_desc" rows="4">{{($user->meta->brief_desc)??''}}</textarea>
                                        {{-- <input type="text" class="form-control" id="language" name="language" value="{{($user->meta->language)??''}}" placeholder="Brief Description"> --}}
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                            <!-- /Account -->
                        </form>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-portfolio" role="tabpanel">
                        <h5 class="card-header">Portfolio <button type="button" style="float: right;" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPortfolio">Add New</button></h5>
                        <hr class="my-0">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Tags</th>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(isset($user->portfolio) && count($user->portfolio) > 0)
                                    @foreach ($user->portfolio as $portfolio)
                                    <tr>
                                        <td>{{ucFirst($portfolio->id)}}</td>
                                        <td>{{ucFirst($portfolio->title)}}</td>
                                        <td>{{ucFirst($portfolio->tags)}}</td>
                                        <td style="text-align: center; width: 125px;">
                                            @if($portfolio->type == 'image')
                                            <img src="{{ asset($portfolio->url) }}" style="height:100px; object-fit: cover; width: 110px;" alt="Avatar" class="">
                                            @else 
                                            <img src="{{ asset('assets/img/others/player.png') }}" style="height:100px; object-fit: cover; width: 110px;" alt="Avatar" class="">
                                            @endif
                                            
                                        </td>
                                        <td>{{ucFirst($portfolio->type)}}</td>
                                        <td>{{$portfolio->created_at->format('d/M/Y')}}</td>
                                        <td>
                                            @if($portfolio->status)
                                            <span class="badge bg-label-primary me-1">Active</span></td>
                                            @else 
                                            <span class="badge bg-label-danger me-1">In Active</span></td>
                                            @endif
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                              </table>
                            </div>
                        </div>
                        <div class="modal fade" id="modalPortfolio" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{ route("admin.add-portfolio") }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ isset($user->id)?$user->id:'' }}">
                                        <input type="hidden" name="portfolio_id" value="">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Add Portfolio</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-3" id="videoLink">
                                                    <label for="title" class="form-label">Portfolio Title</label>
                                                    <input type="text" id="title" name="title" class="form-control" value="" placeholder="Portfolio Title" required>
                                                </div>
                                                <div class="col-12 mb-3" id="videoLink">
                                                    <label for="tags" class="form-label">Tags</label>
                                                    <input type="text" id="tags" name="tags" class="form-control" value="" placeholder="Tags" required>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="fileType" class="form-label">Type</label>
                                                    <select id="fileType" name="filetype" class="select2 form-select">
                                                        <option value="image">Image</option>
                                                        <option value="video">Video</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="imageType">
                                                <div class="col mb-3">
                                                    <label for="formFile" class="form-label">Portfolio Image</label>
                                                    <input class="form-control" type="file" name="portfolioImage" id="formFile">
                                                </div>
                                            </div>
                                            <div class="row g-2" id="videoType">
                                                <div class="col-12 mb-3">
                                                    <label for="video_Type" class="form-label">Video Type</label>
                                                    <select id="video_Type" name="videotype" class="select2 form-select">
                                                        <option value="youtube">Youtube Video</option>
                                                        <option value="manual">Video</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3" id="videoLink">
                                                    <label for="video_link" class="form-label">Youtube Video</label>
                                                    <input type="text" id="video_link" name="video_link" class="form-control" value="https://www.youtube.com/watch?v=MJGzd1_mGao" placeholder="www.youtube.com/watch?v=video-url">
                                                </div>
                                                <div class="col-12 mb-3" id="videoFile">
                                                    <label for="video_File" class="form-label">Video</label>
                                                    <input class="form-control" type="file" name="video_File" id="video_File">
                                                </div>
                                            </div>
                                            <div class="row imageType">
                                                <div class="col mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select id="status" name="status" class="select2 form-select">
                                                        <option value="1">Active</option>
                                                        <option value="0">In Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                          </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-social" role="tabpanel">
                        <h5 class="card-header">Social Links</h5>
                        <hr class="my-0">
                        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{($user->id)??''}}">
                            <input type="hidden" name="social_link" value="social_link">
                            @php 
                                if(isset($user->meta->socialLinks)) {
                                    $socialLinks = json_decode($user->meta->socialLinks);
                                }
                            @endphp
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="google">Google</label>
                                    <input type="text" value="{{isset($socialLinks)?$socialLinks->google:''}}" class="form-control" name="google" id="google" placeholder="Google">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="facebook">Facebook</label>
                                    <input type="text" value="{{isset($socialLinks)?$socialLinks->facebook:''}}" class="form-control" name="facebook" id="facebook" placeholder="Facebook">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="twitter">Twitter</label>
                                    <input type="text" value="{{isset($socialLinks)?$socialLinks->twitter:''}}" class="form-control" name="twitter" id="twitter" placeholder="Twitter">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="instagram">Instagram</label>
                                    <input type="text" value="{{isset($socialLinks)?$socialLinks->instagram:''}}" class="form-control" name="instagram" id="instagram" placeholder="Instagram">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="linkedin">Linkedin</label>
                                    <input type="text" value="{{isset($socialLinks)?$socialLinks->linkedin:''}}" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-packages" role="tabpanel">
                        <h5 class="card-header">Packages <button type="button" style="float: right;" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#largeModalPackages">Add New</button></h5>
                        <hr class="my-0">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                            @if(isset($user->packages))
                                @foreach($user->packages as $package)
                                <div class="col">
                                    <div class="card">
                                        <img class="card-img-top" style="height: 250px; object-fit: cover;" src="{{ (isset($package->image) && $package->image != "")?asset($package->image):asset('packages/packages-plan.jpeg') }}" alt="Card image cap">
                                        <div class="card-body">
                                        <h5 class="card-title">{{$package->name}} <strong style="float: right;">${{$package->cost}}</strong></h5>
                                        <p class="card-text">
                                           {{ Controller::shortString($package->description, 120) }}
                                        </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else 
                                <p>No Packages</p>
                            @endif
                            </div>
                        </div>
                        <div class="modal fade" id="largeModalPackages" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <form action="{{ route("admin.add-package")}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ isset($user->id)?$user->id:'' }}">
                                    <input type="hidden" name="package_id" value="">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Add Package</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 mb-3" id="">
                                                <label for="package_name" class="form-label">Package Name</label>
                                                <input type="text" id="package_name" name="package_name" class="form-control" required value="" placeholder="Package Name">
                                            </div>
                                        </div>
                                        <div class="row" id="">
                                            <div class="col mb-3">
                                                <label for="package_desc" class="form-label">Package Description</label>
                                                <textarea class="form-control" name="package_desc" required id="package_desc" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col mb-3">
                                                <label for="package_type" class="form-label">Package Type</label>
                                                <select id="package_type" name="package_type" class="select2 form-select">
                                                    <option value="basic">Basic</option>
                                                    <option value="prime">Prime</option>
                                                    <option value="custom">Custom</option>
                                                </select>
                                            </div>

                                            <div class="col mb-3">
                                                <label for="package_cost" class="form-label">Package Cost</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" id="package_cost" required name="package_cost" class="form-control" value="" placeholder="Package Cost">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col mb-3">
                                                <label class="form-label" for="time_duration">Time Duration</label>
                                                <select id="time_duration" name="time_duration" class="select2 form-select">
                                                    <option value="hour">Hours</option>
                                                    <option value="day">Days</option>
                                                    <option value="week">Weeks</option>
                                                    <option value="month">Months</option>
                                                    <option value="year">Years</option>
                                                </select>
                                            </div>
                                            <div class="col mb-3">
                                              <label for="time_duration_time" class="form-label">&nbsp;</label>
                                              <input id="time_duration_time" min="0" max="15" name="time_duration_time" type="number" required value="" class="form-control" placeholder="3">
                                            </div>
                                        </div>
                                        <div class="row" id="package_image">
                                            <div class="col mb-3">
                                                <label for="package_image" class="form-label">Feature Image</label>
                                                <input class="form-control" type="file" name="package_image" id="package_image">
                                            </div>
                                        </div>
                                        <div class="row" id="">
                                            <div class="col mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select id="status" name="status" class="select2 form-select">
                                                    <option value="1">Publish</option>
                                                    <option value="0">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-orders" role="tabpanel">
                        <h5 class="card-header">Order Details</h5>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered"  id="order_table">
                                  <thead>
                                    <tr>
                                      <th>Order ID</th>
                                      <th>Package</th>
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
                                        <td>$300</td>
                                        <td> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
                                        <td>New Order</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Package Video Editing</td>
                                        <td>$220</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(3)->format('d/m/Y') }}</td>
                                        <td>In Progress</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Wordpress Website Design</td>
                                        <td>$200</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(8)->format('d/m/Y') }}</td>
                                        <td>Completed</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>UI/Design</td>
                                        <td>$120</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(19)->format('d/m/Y') }}</td>
                                        <td>Completed</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Laravel Package Development </td>
                                        <td>$520</td>
                                        <td> {{ \Carbon\Carbon::now()->subDays(26)->format('d/m/Y') }}</td>
                                        <td>In Progress</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="btn btn-outline-danger btn-sm" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                            {{--  --}}
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-earning" role="tabpanel">
                        <h5 class="card-header">Total Earning</h5>
                        <!-- Account -->
                        <hr class="my-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-3 mb-3">
                                  <div class="card">
                                    <div class="card-body">
                                      <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                          <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
                                        </div>
                                        {{-- <div class="dropdown">
                                          <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                          </div>
                                        </div> --}}
                                      </div>
                                      <span class="fw-semibold d-block mb-1">Total Earning</span>
                                      <h3 class="card-title mb-2">$12,628</h3>
                                      <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-12 col-3 mb-3">
                                  <div class="card">
                                    <div class="card-body">
                                      <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                          <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded">
                                        </div>
                                        {{-- <div class="dropdown">
                                          <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                          </div>
                                        </div> --}}
                                      </div>
                                      <span>Pending Amount</span>
                                      <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                      <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-12 col-3 mb-3">
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                          <div class="avatar flex-shrink-0">
                                            <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
                                          </div>
                                          {{-- <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                              <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                              <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                          </div> --}}
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Completed</span>
                                        <h3 class="card-title mb-2">$1,228</h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12 col-3 mb-3">
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                          <div class="avatar flex-shrink-0">
                                            <img src="{{asset('assets/img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded">
                                          </div>
                                            {{-- <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <span>Withdrawal</span>
                                        <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        <h5 class="card-header">Transactions</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12 mb-12">
                                    <!-- Transactions -->
                                    
                                    <div class="col-md-12 col-lg-12 order-12 mb-12">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-bordered"  id="order_table">
                                                <thead>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Earning From Package Demo</td>
                                                    <td>$300</td>
                                                    <td> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
                                                    <td>Pending</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Earning From Package Video Editing</td>
                                                    <td>$220</td>
                                                    <td> {{ \Carbon\Carbon::now()->subDays(3)->format('d/m/Y') }}</td>
                                                    <td>Pending</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Earning From Wordpress Website Design</td>
                                                    <td>$200</td>
                                                    <td> {{ \Carbon\Carbon::now()->subDays(8)->format('d/m/Y') }}</td>
                                                    <td>Completed</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Earning From UI/Design</td>
                                                    <td>$120</td>
                                                    <td> {{ \Carbon\Carbon::now()->subDays(19)->format('d/m/Y') }}</td>
                                                    <td>Completed</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Withdrawal of Amount</td>
                                                    <td>$520</td>
                                                    <td> {{ \Carbon\Carbon::now()->subDays(26)->format('d/m/Y') }}</td>
                                                    <td>Withdrawal</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                            {{--  --}}
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <h5 class="card-header">Messages</h5>
                        <!-- Account -->
                        <div class="card-body">
                           
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                            {{--  --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    #videoType, #videoFile {
        display: none;
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
{{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> --}}

<!-- Initialize Quill editor -->
<script>

    $(document).ready(function() {
        CKEDITOR.replace( 'package_desc' );

        $('#fileType').change(function(){
            if($(this).val() == 'image') {
                $('#imageType').show();
                $('#videoType').hide();
            } else {
                $('#imageType').hide();
                $('#videoType').show();
            }
        });

        $('#video_Type').change(function(){
            if($(this).val() == 'youtube') {
                $('#videoLink').show();
                $('#videoFile').hide();
            } else {
                $('#videoLink').hide();
                $('#videoFile').show();
            }
        });
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#country').change(function(){
            var country_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{route("get-states")}}',
                data: {
                    country_id: country_id,
                },
                success:function(response) {
                    if(response.status) {
                        $('#state').html(response.html);
                    }
                }
            });
        });

        $('#order_table').DataTable();
    });
</script>
@endsection