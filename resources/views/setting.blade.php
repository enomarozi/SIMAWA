@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            SIMAWA
        @endslot
        @slot('title')
            Setting
        @endslot
        
    @endcomponent
        <form method="POST" action="{{ route('settingAction') }}">
            @csrf
            <!-- <input type="hidden" name="nim" value="{{ session()->get('username') }}"> -->
            <div class="mb-3">
                <!-- <label class="form-label" for="userpassword">Password</label> -->
                <input type="password" class="form-control" name="recentPassword" placeholder="Password Sekarang">
            </div>
            <div class="mb-3">
                <!-- <label class="form-label" for="userpassword">Password</label> -->
                <input type="password" class="form-control" name="newPassword" placeholder="Password Baru">
            </div>
            <div class="mb-3">
                <!-- <label class="form-label" for="userpassword">Confirm Password</label> -->
                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password">
            </div>
            <div class="mt-3 text-end">
                <button class="btn btn-primary w-sm" type="submit" style="background-color: #28a745;">Change</button>
            </div>
        </form>
        <br>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection