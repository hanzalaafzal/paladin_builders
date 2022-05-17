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
                <h4 class="page-title">Tickets</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tickets</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="col-md-12 row">
                  <div class="col-md-12">
                    <button type="button" class="btn btn-primary m-t-25 float-right" data-toggle="modal" data-target="#responsive-modal"  style="padding:5px">Add Ticket</button>

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
                             <th>Ticket Number</th>
                             <th>Customer </th>
                             <th>Quantity</th>
                             <th>Amount</th>
                             <th>Paid Through</th>
                             <th>Attachment</th>
                             <th>Saleman</th>
                             <th>Sold on</th>
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

<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <form action="{{route('customer.post')}}" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                  @csrf
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
                        <label for="message-text" class="control-label">Tickets:</label>
                        <select class="form-control" name="quantity">
                          @for($i=1;$i<101;$i++)
                          <option value="{{$i}}">{{$i}} -/ {{$i*1000}} Rs</option>
                          @endfor
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Add Customer</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection


@push('customjs')
<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script type="text/javascript">

var url=`{!! asset('receipts/:new') !!}`
var url_update=`{!! route('update.ticket',[':new',':new2']) !!}`
$('#dTT').DataTable({
  serverSide:true,
  processing:true,
  lengthChange: true,
  ajax:{
    url: `{!! route('ajax.tickets') !!}`,
  },
  columns:[
    {
      data:"ticket_number",
      name:"ticket_number"
    },
    {
      data:"customer_name",
      name:"customers.customer_name"
    },
    {
        data:"quantity",
        name:"quantity",
        searchable:false,
    },
    {
        data:"amount",
        name:"payments.amount",
        searchable:false,
    },
    {
        data:"payment_method",
        name:"payments.payment_method",
        searchable:false,
    },
    {
        data:"ticket_receipt",
        name:"ticket_receipt",
        searchable:false,
        render:function(data,type,row,meta){
          if(row.ticket_receipt != '' && row.ticket_receipt != null){
            return `<a href="`+url.replace(':new',row.ticket_receipt)+`" target="_blank">Attachment</a>`

          }else{
            return ` `;
          }
        }
    },
    {
        data:"fk_saleman",
        name:"fk_saleman",
        render:function(data,type,row,meta){
          if(row.fk_saleman != '' && row.fk_saleman != null){
            return row.name;
          }else{
            return ` `;
          }
        }
    },
    {
      data:"created_at",
      name:"created_at"
    },
    {
      data:"created_at",
      name:"created_at",
      searchable:false,
      render:function(data,type,row,meta){
        if(row.payment_status==0){
          let newUrl=url_update.replace(':new',row.ticket_number)
          newUrl=newUrl.replace(':new2',1);

          let newUrl2=url_update.replace(':new',row.ticket_number);
          newUrl2=newUrl2.replace(':new2',3);
          return `<a href="`+newUrl+`" class="btn btn-sm primary">Verify Payment</a> <br> <br> <a href="`+newUrl2+`">Reject Payment</a>`
        }
        else if(row.payment_status==1){
          return `Payment Verified`;
        }else{
          return `Payment Rejected`;
        }
      }
    }
  ],
  'rowCallback':function(row,data,index){
    if(data.payment_status==1){
      $(row).addClass('table-success');
    }else{
      $(row).addClass('table-danger');
    }
  }
});
</script>
@endpush
