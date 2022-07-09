@extends('layouts.admin')
@section('content')
@php
use \App\Http\Controllers\Controller;
@endphp
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Settings </h4>
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <div class="tab-content card mb-4" style="padding: 0; ">
                    <div class="tab-pane fade  show active" id="navs-pills-top-social" role="tabpanel">
                        <form action="{{ route("admin.update-settings") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h5 class="card-header">Site Information</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label ">Business logo</label>
                                                    <input type="hidden" name="businessLogo" value="Business logo">
                                                    <input type="file" class="form-control" id="businessLogo" name="businessLogo">              
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <img src="{{isset($settings['businessLogo'] ) && $settings['businessLogo']?url($settings['businessLogo']):url('businessLogo/businessLogo.png')}}" style="height:100px;width:200px;" alt="logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="businessName">Business Name</label>
                                        <input type="text" class="form-control" name="businessName" id="businessName" placeholder="Business Name" required value="{{isset($settings['businessName'])?$settings['businessName']:''}}">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="siteUrl">Site Url</label>
                                        <input type="text" class="form-control" name="siteUrl" id="siteUrl" placeholder="Site Url" required value="{{isset($settings['siteUrl'])?$settings['siteUrl']:''}}" >
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="country">Country</label>
                                        <input type="text" value="{{isset($settings['country'])?$settings['country']:''}}" class="form-control" name="country" id="country" placeholder="Country">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="state">State</label>
                                        <input type="text" value="{{isset($settings['state'])?$settings['state']:''}}" class="form-control" name="state" id="state" placeholder="State">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="city">City</label>
                                        <input type="text" value="{{isset($settings['city'])?$settings['city']:''}}" class="form-control" name="city" id="city" placeholder="City">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="postCode">Postcode</label>
                                        <input type="text" value="{{isset($settings['postCode'])?$settings['postCode']:''}}" class="form-control" name="postCode" id="postCode" placeholder="Postcode">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="helplineNumber">Helpline Number</label>
                                        <input type="text" name="helplineNumber" id="helplineNumber" placeholder="Helpline Number"  class="form-control"  value="{{isset($settings['helplineNumber'])?$settings['helplineNumber']:''}}">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email" placeholder="Email"  class="form-control" required value="{{isset($settings['email'])?$settings['email']:''}}">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" name="address" id="address" placeholder="Address"  class="form-control"  value="{{isset($settings['address'])?$settings['address']:''}}">
                                    </div>

                                </div>
                            </div>

                            <hr class="my-2">
                            <h5 class="card-header">Social Links</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="google">Google</label>
                                        <input type="text" value="{{isset($settings['google'])?$settings['google']:''}}" class="form-control" name="google" id="google" placeholder="Google">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="facebook">Facebook</label>
                                        <input type="text" value="{{isset($settings['facebook'])?$settings['facebook']:''}}" class="form-control" name="facebook" id="facebook" placeholder="Facebook">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="twitter">Twitter</label>
                                        <input type="text" value="{{isset($settings['twitter'])?$settings['twitter']:''}}" class="form-control" name="twitter" id="twitter" placeholder="Twitter">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="instagram">Instagram</label>
                                        <input type="text" value="{{isset($settings['instagram'])?$settings['instagram']:''}}" class="form-control" name="instagram" id="instagram" placeholder="Instagram">
                                    </div>
                                    <div class="col-6 col-md-6 mb-3">
                                        <label class="form-label" for="linkedin">Linkedin</label>
                                        <input type="text" value="{{isset($settings['linkedin'])?$settings['linkedin']:''}}" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
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
{{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> --}}

<!-- Initialize Quill editor -->
<script>
    $(document).ready(function() {
        
    });
</script>
@endsection