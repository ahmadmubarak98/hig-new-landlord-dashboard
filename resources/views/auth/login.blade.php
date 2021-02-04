@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-v1 px-2">
        <div class="auth-inner py-2">
            <!-- Login v1 -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="javascript:void(0);" class="brand-logo">
                        <div style="width:100%;height:100%;">
                            <img src="{{ url('images/logo/logo.png') }}"
                                style="object-fit:contain;height:95%;width:100%;" />
                        </div>
                    </a>

                    <h4 class="card-title mb-1">Landlord Dashboard</h4>
                    <p class="card-text mb-2">Please sign-in to your account</p>

                    <section>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Error</h4>
                                <div class="alert-body">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </section>

                    <section>
                        @if ($login_failed = Session::has('login_failed'))
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Warning</h4>
                                <div class="alert-body">
                                    {{ Session::get('login_failed') }}
                                </div>
                            </div>
                        @endif
                    </section>

                    <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="login-identifier" class="form-label">Identifier</label>
                            <input type="text" class="form-control @error('identifier') is-invalid @enderror"
                                id="login-identifier" name="identifier" placeholder="name@example.com"
                                aria-describedby="login-identifier" tabindex="1" autofocus
                                value="{{ old('identifier') }}" />
                            @error('identifier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="login-password">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="login-password"
                                    name="password" tabindex="2"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="login-password" />
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="remember-me" name="remember-me"
                                    tabindex="3" {{ old('remember-me') ? 'checked' : '' }} />
                                <label class="custom-control-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                    </form>

                </div>
            </div>
            <!-- /Login v1 -->
        </div>
    </div>
@endsection
