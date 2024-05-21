@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.Login')
@endsection
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-4 col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="text-center mt-2">
                                <a href="{{ url('index') }}" class="mb-3 d-block auth-logo">
                                    <img src="{{ URL::asset('/assets/images/unand.png') }}" alt="" height="75" class="logo logo-dark">
                                </a>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{ route('loginAction') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <!-- <label class="form-label" for="nim">NIM/Username</label> -->
                                        <input type="text" class="form-control" name="nim" placeholder="NIM/Username">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label class="form-label" for="userpassword">Password</label> -->
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
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
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm" type="submit" style="background-color: #28a745;">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>©<script>
                            document.write(new Date().getFullYear())
                            </script> Universitas Andalas</p>
                    </div>
                </div>
            </div>
            <!-- end row --->
        </div>
        <!-- end container -->
    </div>

@endsection
