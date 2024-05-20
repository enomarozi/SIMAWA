@extends('layouts.master-without-nav')
@section('title')
    Registration
@endsection
@section('content')
    <div class="account-pages my-5 pt-sm-5 registration">
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
                                <form method="POST" action="{{ route('registrationAction') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <!-- <label class="form-label" for="nim">Nama Lengkap</label> -->
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label class="form-label" for="nim">Username</label> -->
                                        <input type="text" class="form-control" name="nim" placeholder="Username">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label class="form-label" for="email">Email</label> -->
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label class="form-label" for="userpassword">Password</label> -->
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <label class="form-label" for="userpassword">Confirm Password</label> -->
                                        <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm" type="submit" style="background-color: #28a745;">Registration</button>
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
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
