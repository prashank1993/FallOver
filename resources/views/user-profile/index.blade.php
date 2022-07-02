@extends('layouts.admin')
@section('content')
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
                    <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-portfolio" aria-controls="navs-pills-top-messages" aria-selected="true">
                        <i class='bx bx-slideshow'></i> Portfolio
                    </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-social" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-link-alt'></i> Social Links
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-packages" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-layer-plus' ></i> Packages
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-orders" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-cart-alt'></i> Orders
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-earning" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-dollar-circle' ></i> Earning
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="true">
                            <i class='bx bx-chat'></i> Messages
                        </button>
                    </li>
                </ul>
                <div class="tab-content card mb-4" style="padding: 0; ">
                    <div class="tab-pane fade show active" id="navs-pills-top-profile" role="tabpanel">
                        <h5 class="card-header">Profile Details</h5>
                        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
                            <!-- Account -->
                            @csrf
                            <input type="hidden" name="roles" value="{{($user->roles[0]->id)??''}}">
                            <input type="hidden" name="user_id" value="{{($user->id)??''}}">
                            <input type="hidden" name="profile_details" value="profile_details">
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ ($user->profile_photo)?url('userPhotos/'.$user->id.'/'.$user->profile_photo):url('userPhotos/demo.jpeg') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
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
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input class="form-control @error('firstName') is-invalid @enderror" type="text" id="firstName" name="firstName" value="{{($user->first_name)??''}}" autofocus="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input class="form-control @error('lastName') is-invalid @enderror" type="text" name="lastName" id="lastName" value="{{($user->last_name)??''}}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{($user->email)??''}}" placeholder="john.doe@example.com">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="organization" class="form-label">Organization</label>
                                        <input type="text" class="form-control" id="organization" name="organization" value="{{($user->meta->organization)??''}}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        {{-- <div class="input-group input-group-merge"> --}}
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            {{-- <span class="input-group-text">US (+1)</span> --}}
                                            <input type="text" id="phoneNumber" name="phoneNumber" value="{{($user->phone)??''}}" class="form-control" placeholder="202 555 0111">
                                        {{-- </div> --}}
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" value="{{($user->meta->address)??''}}" name="address" placeholder="Address">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="country">Country</label>
                                        <select id="country" name="country" class="select2 form-select">
                                            <option value="">Select</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country['shortname']}}" {{($country['shortname'] == $user->meta->country)?'selected':''}}>{{$country['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="state" class="form-label">State</label>
                                        <select id="state" name="state" class="select2 form-select">
                                            <option value="">Select</option>
                                            @isset($states)
                                            @foreach ($states as $state)
                                            <option value="{{$state['id']}}" {{($state['id'] == $user->meta->state)?'selected':''}}>{{$state['name']}}</option>
                                            @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{($user->meta->city)??''}}" placeholder="City">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zipCode" name="zipCode" value="{{($user->meta->zipCode)??''}}" placeholder="231465" maxlength="6">
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
                        <h5 class="card-header">Portfolio</h5>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-social" role="tabpanel">
                        <h5 class="card-header">Social Links</h5>
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
                        <h5 class="card-header">Packages</h5>
                        <!-- Account -->
                        <div class="card-body">
                            
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                            
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-orders" role="tabpanel">
                        <h5 class="card-header">Profile Details</h5>
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
                    <div class="tab-pane fade" id="navs-pills-top-earning" role="tabpanel">
                        <h5 class="card-header">Total Earning</h5>
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

@section('scripts')
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>

<script>
    $(document).ready(function() {
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
    });
</script>
@endsection