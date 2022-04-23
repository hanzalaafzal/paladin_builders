@extends('panel.layout')

@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Dashboard Classic </h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
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
      <h5>dashboard welcome</h5>
    </div>
</div>
@endsection
