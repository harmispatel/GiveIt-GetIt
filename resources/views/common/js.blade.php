 <script src="{{ asset ('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset ('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
 <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script> 
 <!-- JQVMap -->
 <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script> 
 <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('js/adminlte.js')}}"></script>

{{-- me aa link comment ma muki che avu lage to kadhi nakhvi --}}
{{-- <script src="{{ asset ('js/adminlte.min.js')}}"></script> --}}

<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset ('js/demo.js')}}"></script>   --}}

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset ('js/pages/dashboard.js')}}"></script>
<!-- jquery-validation -->
<script src="{{ asset ('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset ('plugins/jquery-validation/additional-methods.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset ('js/adminlte.min.js')}}"></script>
{{-- <script src="{{ asset ('js/dashboard.js')}}"></script> --}}

<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('js/demo.js')}}"></script>

{{-- alert --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>




<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

{{-- jQuery Validation CDN --}}
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

     @yield('js')