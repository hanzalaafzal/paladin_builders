@extends('panel.layout')

@push('firstcss')
<link rel="stylesheet" href="{{asset('assets/extra-libs/DataTables/datatables.min.css')}}">
@endpush

@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Customers</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customers</li>
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
      @if($errors->any())
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-body">
               <div class="alert alert-info">
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>

                   <ul>
                     @foreach($errors->all() as $err)
                       <li>{{$err}}</li>
                     @endforeach
                   </ul>
               </div>
             </div>
           </div>
         </div>
       </div>
       @endif
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-body">

                       <table class="table-bordered table-hover table" id="dTT">
                         <thead class="bg-inverse text-white">
                           <tr>
                             <th>Customer Name</th>
                             <th>CNIC</th>
                             <th>Mobile No</th>
                             <th>Joined On</th>
                             <th>Added By</th>
                             <th>Action</th>
                           </tr>
                         </thead>
                         <tbody>

                         </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
@endsection


@push('customjs')
<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script type="text/javascript">

$('#dTT').DataTable({
  serverSide:true,
  processing:true,
  lengthChange: true,
  ajax:{
    url: `{!! route('ajax.customers') !!}`,
  },
  columns:[
    {
      data:"customer_name",
      name:"customer_name"
    },
    {
      data:"customer_cnic",
      name:"customer_cnic"
    },
    {
        data:"customer_number",
        name:"customer_number"
    },
    {
        data:"created_at",
        name:"created_at"
    },
    {
      data:"name",
      name:"name"
    },
    {
      data:"name",
      name:"name",
      searchable:false,
      render:function(data,type,row,meta){
        return ``;
      }
    }
  ],
});
</script>
@endpush
