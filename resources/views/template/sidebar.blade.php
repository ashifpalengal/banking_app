<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>

        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        @if (isset(Auth::user()->photo))
                        <a href="#"><img src="{{ asset(Auth::user()->photo) }}" width="38" height="38" class="rounded-circle" alt=""></a>
                        @else
                        <a href="#"><img src="{{ $path }}global_assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                        @endif
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            {{ Auth::user()->email }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="/" class="nav-link ">
                        <i class="icon-arrow-right13"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.viewDeposit') }}" class="nav-link ">
                        <i class="icon-arrow-right13"></i>
                        <span>
                            Deposit
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.viewWithdraw') }}" class="nav-link ">
                        <i class="icon-arrow-right13"></i>
                        <span>
                            Withdraw
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.viewTransfer') }}" class="nav-link ">
                        <i class="icon-arrow-right13"></i>
                        <span>
                            Transfer
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.viewStatements') }}" class="nav-link ">
                        <i class="icon-arrow-right13"></i>
                        <span>
                            Statement
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
