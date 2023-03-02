@extends('template.master')
@section('title')
Dashboard
@endsection
@section('content')

<div class="row">

    <div class="col-md-3">
        <div class="card">
            <div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url(../../../../global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
                <div class="card-img-actions d-inline-block mb-3">
                    @if (Auth::user()->photo)
                    <img class="img-fluid rounded-circle" src="{{ asset(Auth::user()->photo) }}" width="170" height="170" alt="">
                    @else
                    <img class="img-fluid rounded-circle" src="{{ asset('/') }}global_assets/images/placeholders/placeholder.jpg" width="170" height="170" alt="">
                    @endif
                </div>

                <h6 class="font-weight-semibold mb-0">{{ Auth::user()->name }}</h6>
                <span class="d-block opacity-75">{{ Auth::user()->email }}</span>
            </div>

            <div class="card-body p-0">
                <ul class="nav nav-sidebar mb-2">
                    <li class="nav-item-header">More</li>
                    <li class="nav-item">
                        <a href="{{ route('user.editProfile') }}" class="nav-link" >
                            <i class="icon-user"></i>
                             Edit profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header header-elements-sm-inline">
                <h4 class="card-title">Account Details</h4>
                <div class="header-elements">
                    <span><i class="icon-history mr-2 text-success"></i></span>
                    <div class="list-icons ml-3">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Account Number :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ Auth::user()->account->account_number }}" disabled readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Account Type :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ Auth::user()->account->account_type }}" disabled readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Balance :</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" value="{{ Auth::user()->account->balance }}" disabled readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Status :</label>
                    <div class="col-lg-9">
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
