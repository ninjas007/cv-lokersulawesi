@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ url('/saveData') }}" method="POST">
                        @csrf
                        <div class="form-control mb-3">
                            <label for="">JOBSTREET_PREFIX</label>
                            <input type="text" value="{{ isset($settings['JOBSTREET_PREFIX']) ? $settings['JOBSTREET_PREFIX']->value : '' }}" class="form-control" name="JOBSTREET_PREFIX" style="font-weight: bold" required>
                        </div>

                        {{-- <div class="form-control mb-3">
                            <label for="">LINKEDIN_CLIENT_SECRET (optional)</label>
                            <input type="text" value="{{ isset($settings['LINKEDIN_CLIENT_SECRET']) ? $settings['LINKEDIN_CLIENT_SECRET']->value : '' }}" class="form-control" name="LINKEDIN_CLIENT_SECRET" style="font-weight: bold">
                        </div> --}}

                        <div class="form-control mb-3">
                            <label for="">LINKEDIN_ACCESS_TOKEN</label>
                            <input type="text" value="{{ isset($settings['LINKEDIN_ACCESS_TOKEN']) ? $settings['LINKEDIN_ACCESS_TOKEN']->value : '' }}" class="form-control" name="LINKEDIN_ACCESS_TOKEN" style="font-weight: bold" required>
                        </div>

                        {{-- <div class="form-control mb-3">
                            <label for="">FACEBOOK_CLIENT_ID</label>
                            <input type="text" value="{{ isset($settings['FACEBOOK_CLIENT_ID']) ? $settings['FACEBOOK_CLIENT_ID']->value : '' }}" class="form-control" name="FACEBOOK_CLIENT_ID" style="font-weight: bold">
                        </div>

                        <div class="form-control mb-3">
                            <label for="">FACEBOOK_CLIENT_SECRET</label>
                            <input type="text" value="{{ isset($settings['FACEBOOK_CLIENT_SECRET']) ? $settings['FACEBOOK_CLIENT_SECRET']->value : '' }}" class="form-control" name="FACEBOOK_CLIENT_SECRET" style="font-weight: bold" >
                        </div> --}}

                        <div class="form-control mb-3">
                            <label for="">FACEBOOK_ACCESS_TOKEN_LONGTIME</label>
                            <input type="text" value="{{ isset($settings['FACEBOOK_ACCESS_TOKEN_LONGTIME']) ? $settings['FACEBOOK_ACCESS_TOKEN_LONGTIME']->value : '' }}" class="form-control" name="FACEBOOK_ACCESS_TOKEN_LONGTIME" style="font-weight: bold" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Simpan
                        </button>
                    </form>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger text-white btn-block mt-2">
                            <i class="fa fa-sign-out"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
