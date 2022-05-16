@extends('layouts.app')

@section('content')
<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('login.post') }}">
        @csrf
        @if (session('error')) <div class="alert alert-danger alert-dismissible show">
            {{ session('error') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span> </button> </div>
        @endif
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid  @error('email') is-invalid @enderror " id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong  >{{ $message }}</strong>
            </span>
            @enderror

            <span id="validError" style="color:red"></span>
        </div>

        <div class="fv-row mb-10">

            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                @endif
            </div>
            <input class="form-control form-control-lg form-control-solid  @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off" />
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5" id="save">
                <span class="indicator-label">Continue</span>
            </button>
        </div>

    </form>

</div>
@endsection