@extends('layouts.admin')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        @if (session('success'))
                            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('img/logo.png') }}" alt="logo" width="280px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger border-left-danger" role="alert">
                                            <ul class="pl-4 my-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('register') }}" class="user">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="{{ __('Name') }}" value="{{ old('name') }}" required
                                                autofocus>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email"
                                                placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <select id="roles" class="form-control" name="role" placeholder="Role"
                                                value="{{ old('role') }}" required>

                                                <?php $roles = DB::table('roles')
                                                    ->where('name', '!=', 'Admin')
                                                    ->get(); ?>

                                                <option selected disabled>Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $role->id == old('role') ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="{{ __('Password') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="{{ __('Confirm Password') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </form>

                                    <hr>

                                    {{-- <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">
                                            {{ __('Already have an account? Login!') }}
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
