<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Banking App</title>
    @php
    $path = asset('/');
    @endphp
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ $path }}global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{ $path }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ $path }}assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="{{ $path }}assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="{{ $path }}assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="{{ $path }}assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ $path }}global_assets/js/main/jquery.min.js"></script>
    <script src="{{ $path }}global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="{{ $path }}global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ $path }}global_assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script src="{{ $path }}assets/js/app.js"></script>
    <script src="{{ $path }}global_assets/js/demo_pages/login.js"></script>
    <!-- /theme JS files -->

</head>

<body>

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Registration form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Create account</h5>
                            </div>

                            <div class="form-group text-center text-muted content-divider">
                                <span class="px-2">Your credentials</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" placeholder="Your email" name="email" required>
                                <div class="form-control-feedback">
                                    <i class="icon-mention text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" placeholder="Full Name" name="name" required>
                                <div class="form-control-feedback">
                                    <i class="icon-user-lock text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" class="form-control" placeholder="Your Password" name="password" required minlength="8">
                                <div class="form-control-feedback">
                                    <i class="icon-mention text-muted"></i>
                                </div>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" class="form-control" placeholder="Repeat password" name="password_confirmation" required minlength="8">
                                <div class="form-control-feedback">
                                    <i class="icon-mention text-muted"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-teal-400 btn-block">Register <i class="icon-circle-right2 ml-2"></i></button>
                        </div>
                    </div>
                </form>
                <!-- /registration form -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</body>

</html>
