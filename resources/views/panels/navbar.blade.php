@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
        data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="brand-logo">
                          </span>
                        <h2 class="brand-text mb-0">HIG</h2>
                    </a>
                </li>
            </ul>
        </div>
    @else
        <nav
            class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }}">
@endif
<div class="navbar-container d-flex content">
    <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav">
            
        </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ml-auto">
        <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);"
                data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span
                    class="badge badge-pill badge-danger badge-up">2</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                    <div class="dropdown-header d-flex">
                        <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                        <div class="badge badge-pill badge-light-primary">2 New</div>
                    </div>
                </li>
                <li class="scrollable-container media-list">

                    <div class="media d-flex align-items-center">
                        <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                    </div><a class="d-flex" href="javascript:void(0)">
                        <div class="media d-flex align-items-start">
                            <div class="media-left">
                                <div class="avatar bg-light-success">
                                    <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="media-heading"><span class="font-weight-bolder">Server is
                                        up</span>&nbsp;registered</p><small class="notification-text"> Frankfurt FRA1
                                    Server is up and its health is OK</small>
                            </div>
                        </div>
                    </a><a class="d-flex" href="javascript:void(0)">
                        <div class="media d-flex align-items-start">
                            <div class="media-left">
                                <div class="avatar bg-light-danger">
                                    <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="media-heading"><span class="font-weight-bolder">Server is
                                        down</span>&nbsp;registered</p><small class="notification-text"> Frankfurt FRA1
                                    Server is down and its health is BAD</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all
                        notifications</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown dropdown-user">
            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-nav d-sm-flex d-none">
                    <span class="user-name font-weight-bolder">Hi, {{Cookie::get('user_name')}}</span>
                    <span class="user-status">Landlord</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                <a class="dropdown-item" href="{{ url('/auth/signoff') }}">
                    <i class="mr-50" data-feather="power"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</div>
</nav>

{{-- Search Start Here --}}
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center">
        <a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{ asset('images/icons/xls.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p>
                    <small class="text-muted">Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;17kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{ asset('images/icons/jpg.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p>
                    <small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;11kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{ asset('images/icons/pdf.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p>
                    <small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;150kb</small>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
            <div class="d-flex">
                <div class="mr-75">
                    <img src="{{ asset('images/icons/doc.png') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p>
                    <small class="text-muted">Web Designer</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;256kb</small>
        </a>
    </li>
    <li class="d-flex align-items-center">
        <a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Members</h6>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75">
                    <img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Admin</p>
                    <small class="text-muted">UI designer</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75">
                    <img src="{{ asset('images/portrait/small/avatar-s-1.jpg') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p>
                    <small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75">
                    <img src="{{ asset('images/portrait/small/avatar-s-14.jpg') }}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p>
                    <small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
        </a>
    </li>
    <li class="auto-suggestion">
        <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
            <div class="d-flex align-items-center">
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p>
                    <small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a>
    </li>
</ul>

{{-- if main search not found! --}}
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between">
        <a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start">
                <span class="mr-75" data-feather="alert-circle"></span>
                <span>No results found.</span>
            </div>
        </a>
    </li>
</ul>
{{-- Search Ends --}}
<!-- END: Header-->
