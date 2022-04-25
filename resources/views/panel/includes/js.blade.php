  <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/js/app.init.horizontal.js')}}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script type="text/javascript">
      Swal.fire("Success", `{!! session('success') !!}`, "success")
    </script>
    @endif

    @if(session('error'))
    <script type="text/javascript">
      Swal.fire("Sorry", `{!! session('error') !!}`, "error")
    </script>

    @endif
