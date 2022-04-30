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
                <div class="col-md-12 row">
                  <div class="col-md-5">
                    <button type="button" class="btn btn-primary m-t-25 float-right" data-toggle="modal" data-target="#responsive-modal"  style="padding:5px">Add Customer</button>

                  </div>
                  <div class="col-md-1">

                  </div>
                  <div class="col-md-6">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <div class="m-r-10">
                          <form class="m-t-25" action="{{route('upload.csv')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile04" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    <label class="custom-file-label" for="inputGroupFile04">Upload CSV</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                </div>
                            </div>

                          </form>
                        </div>
                    </div>
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

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Responsive model</h4>
        <!-- sample modal content -->
        <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Content is Responsive</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Customer Name:</label>
                                <input type="text" class="form-control" id="recipient-name" name="name" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Customer Cnic:</label>
                                  <input type="text" class="form-control" name="cnic" placeholder="3223x-xxxxxxx-x" pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Customer Number:</label>
                                  <input type="text" class="form-control" name="number" placeholder="0342xxxxxxxx" pattern="^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Customer Network:</label>
                                <select class="form-control" name="network">
                                  <option value="">Select Network</option>
                                  <option value="Jazz">Jazz</option>
                                  <option value="Telenor">Telenor</option>
                                  <option value="Ufone">Ufone</option>
                                  <option value="Warid">Warid</option>
                                  <option value="Zong">Zong</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Customer Number:</label>
                                <input type="text" class="form-control" name="number" placeholder="0342xxxxxxxx" pattern="^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tickets:</label>
                                <select class="form-control" name="quantity">
                                  <option value="">Select Network</option>
                                  <option value="Jazz">Jazz</option>
                                  <option value="Telenor">Telenor</option>
                                  <option value="Ufone">Ufone</option>
                                  <option value="Warid">Warid</option>
                                  <option value="Zong">Zong</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light">Add Customer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <img src="../assets/images/alert/model.png" alt="default" data-toggle="modal" data-target="#responsive-modal" class="model_img img-fluid" />
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
