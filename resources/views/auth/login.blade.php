@extends('layouts.admin-auth')
@section('content')

<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo" style="width: 100%;">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" style="float: left; width:100%;" alt="FallOvers" class="brand-logo-dash">
                  </span>
                  {{-- <span class="app-brand-text demo text-body fw-bolder">Sneat</span> --}}
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to {{ trans('panel.site_title') }}</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>
                @if(\Session::has('message'))
                    <p class="alert alert-info">
                        {{ \Session::get('message') }}
                    </p>
                @endif
              <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                    id="email"
                    required
                    placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}"
                    autofocus
                  />
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="{{ route('password.request') }}">
                      <small>{{ trans('global.forgot_password') }}?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    
                    <input
                      type="password"
                      id="password"
                      class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" name="remember" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me">{{ trans('global.remember_me') }}</label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">{{ trans('global.login') }}</button>
                </div>
              </form>

              {{-- <p class="text-center">
                <span>New on our platform?</span>
                <a href="#">
                  <span>Create an account</span>
                </a>
              </p> --}}
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
@endsection
