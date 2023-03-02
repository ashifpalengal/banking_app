@extends('template.master')
@section('title')
Profile
@endsection
@section('content')
<div class="row">

    <div class="col-md-2">
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-elements-sm-inline">
                <h4 class="card-title">Profile</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('user.updateProfile') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" id="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email :</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="email" id="email">
                        </div>
                    </div>

                    @if (Auth::user()->photo)
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Current Photo :</label>
                        <div class="col-lg-9">
                            <img src="{{ asset(Auth::user()->photo) }}" style="width:5vw;object-fit:cover; " />
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Photo :</label>
                        <div class="col-lg-9">
                            <input type="file" class="form-input-styled" data-fouc name="photo" accept=".png,.jpg,.jpeg">
                            <span class="form-text text-muted">Accepted formats: png, jpg, jpeg. Max file size 2Mb</span>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Update Profile </button>
                    </div>
                    @csrf
                </form>

                <legend class="font-weight-semibold text-uppercase font-size-sm"></legend>

                <form action="{{ route('user.updatePassword') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Current Password :</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">New Password :</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Confirm Password :</label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Change Password </button>
                    </div>
                    @csrf
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>

</div>

@endsection
