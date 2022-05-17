

<header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
						   class="ti-menu ti-close"></i></a>

                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b class="logo-icon">


							<img src="https://risalaagrofarms.com/img/logo.png" alt="homepage" class="dark-logo" style="height:60px"/>

							<img src="https://risalaagrofarms.com/img/logo.png" alt="homepage" class="light-logo" style="height:60px" />
						</b>


                    </a>

                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
						   class="ti-more"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav float-left mr-auto">

                    </ul>

                    <ul class="navbar-nav float-right">
                      <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                            </a>

                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class=""><img src="{{asset('assets/images/users/1.jpg')}}" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">{{auth()->user()->adm_name}}</h4>
                                        <p class=" m-b-0">{{auth()->user()->email}}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="#"><i class="ti-user m-r-5 m-l-5"></i>
									                          </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#"><i  class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
