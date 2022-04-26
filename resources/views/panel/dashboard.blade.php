@extends('panel.layout')


@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Revenue Statistics</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <div class="m-r-10">
                        <div class="lastmonth"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
      <div class="row">
    <!-- column -->
          <div class="col-lg-4">
              <div class="card bg-pink text-white  card-hover">
                  <div class="card-body">
                      <h4 class="card-title">Monthly Sale</h4>
                      <div class="d-flex align-items-center m-t-30">
                          <div class="" id="ravenue"></div>
                          <div class="ml-auto">
                              <h3 class="font-medium white-text m-b-0">{{$thisMontSales}} PKR</h3><span class="white-text op-5">{{date('M')}}</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- column -->
          <div class="col-lg-4">
              <div class="card bg-purple text-white  card-hover">
                  <div class="card-body">
                      <h4 class="card-title">Tickets Sold</h4>
                      <h3 class="white-text m-b-0"><i class="ti-arrow-up"></i> {{$tickets}}</h3>
                  </div>
                  <div class="m-t-20" id="views"></div>
              </div>
          </div>
          <!-- column -->
          <div class="col-lg-4">
              <div class="card  card-hover">
                  <div class="card-body">
                      <h4 class="card-title">Bounce Rate</h4>
                      <div class="d-flex no-block align-items-center m-t-30">
                          <div class="">
                              <h3 class="font-medium m-b-0">56.33%</h3><span class="">Total Bounce</span>
                          </div>
                          <div class="ml-auto">
                              <div style="max-width:150px; height:60px;" class="m-b-40">
                                  <canvas id="bouncerate"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@push('customjs')
<script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!--c3 charts -->
<script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
<!--chartjs -->
<script src="{{asset('assets/libs/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('assets/js/pages/dashboards/dashboard-clasic.js')}}"></script>
@endpush
