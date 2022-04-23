@php
  $cart=\App\Models\Cart::where('fk_user_id',auth()->user()->id)->get()->toArray();
  $credits=DB::table('user_credits')->where('fk_user_id',auth()->user()->id)->sum('current_credits');
@endphp

<header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
						   class="ti-menu ti-close"></i></a>

                    <a class="navbar-brand" href="{{route('home','en')}}">
                        <!-- Logo icon -->
                        <b class="logo-icon">


							<img src="{{asset('assets/logo-adson.png')}}" alt="homepage" class="dark-logo" style="height:60px"/>

							<img src="{{asset('assets/logo-adson-w.png')}}" alt="homepage" class="light-logo" style="height:60px" />
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
                              @if(session('lang')=='en')
                              <i class="flag-icon flag-icon-us"></i>
                              @else
                              <i class="flag-icon flag-icon-{{session('lang')}}"></i>
                              @endif

                            </a>
                            <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="{{route('dashboard.lang','en')}}"><i class="flag-icon flag-icon-us"></i> English</a>
                                <a class="dropdown-item" href="{{route('dashboard.lang','fr')}}"><i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="{{route('dashboard.lang','nl')}}"><i class="flag-icon flag-icon-nl"></i> Dutch</a>
                            </div>
                        </li>
                        @if(!empty($cart))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="{{route('checkout.get')}}"  aria-expanded="false"> <i class="rounded-circle fas fa-cart-plus" style="color:white;font-size:25px;padding-top:20px"></i> </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class=""><img src="{{asset('assets/images/users/1.jpg')}}" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h4>
                                        <p class=" m-b-0">{{auth()->user()->email}}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{route('profile.view')}}"><i class="ti-user m-r-5 m-l-5"></i>
									                          {{__('dashboard.my_profile')}}</a>
                              @if(auth()->user()->role==0)
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>
									                      {{__('dashboard.my_credits')}}: {{$credits}}</a>
                              @endif
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{route('logout')}}"><i  class="fa fa-power-off m-r-5 m-l-5"></i> {{__('dashboard.logout')}}</a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
