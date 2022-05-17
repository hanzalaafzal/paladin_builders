@extends('panel.layout')

@push('firstcss')
<link rel="stylesheet" href="{{asset('assets/extra-libs/DataTables/datatables.min.css')}}">
@endpush

@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
    @if($errors->any())
     <div class="row">
       <div class="col-12">
         <div class="card">
           <div class="card-body">
             <div class="alert alert-info">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                 <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Error</h3>
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
            <div class="col-5 align-self-center">
                <h4 class="page-title">SalesMan</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sales Person</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="col-md-12 row">
                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary m-t-25 float-right" data-toggle="modal" data-target="#responsive-modal"  style="padding:5px">Add Saleman</button>

                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-body">

                       <table class="table-bordered table-hover table" id="dTT">
                         <thead class="bg-inverse text-white">
                           <tr>
                             <th>Name</th>
                             <th>CNIC</th>
                             <th>Number</th>
                             <th>Email</th>
                             <th>Joined On</th>
                             <th>Action</th>
                           </tr>
                         </thead>
                         <tbody>
                           @foreach($data as $dat)
                           <tr @if($dat->mac_address=='DISABLED') class="table-danger" @endif>
                             <td>{{$dat->name}}</td>
                             <td>{{$dat->cnic}}</td>
                             <td>{{$dat->number}}</td>
                             <td>{{$dat->email}}</td>
                             <td>{{$dat->created_at}}</td>
                             <td> @if($dat->mac_address=='DISABLED')
                               <a href="{{route('update.salesman',[$dat->id,1])}}" class="btn waves-effect waves-light btn-primary">Enable</a>
                               @else
                               <a href="{{route('update.salesman',[$dat->id,0])}}" class="btn waves-effect waves-light btn-warning">Disable</a>
                                @endif</td>
                           </tr>
                           @endforeach
                         </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <form action="{{route('post.salesman')}}" method="post">
    
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Salesman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                  @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="control-label"> Name:</label>
                        <input type="text" class="form-control" id="recipient-name" name="name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label"> Email:</label>
                          <input type="email" class="form-control" name="email" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label"> Cnic:</label>
                          <input type="text" class="form-control" name="cnic" placeholder="3223x-xxxxxxx-x" pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label"> Password:</label>
                          <input type="text" class="form-control" name="password"  required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label"> Number:</label>
                          <input type="text" class="form-control" name="number" placeholder="0342xxxxxxxx" pattern="^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label"> Network:</label>
                        <select class="form-control" name="network">
                          <option value="">Select Network</option>
                          <option value="Jazz">Jazz</option>
                          <option value="Telenor">Telenor</option>
                          <option value="Ufone">Ufone</option>
                          <option value="Warid">Warid</option>
                          <option value="Zong">Zong</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Add</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection


@push('customjs')
<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script type="text/javascript">

$('#dTT').DataTable();
</script>
@endpush
