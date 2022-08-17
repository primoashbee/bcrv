@extends('layouts.master')

@section('title')
    Admin | Request - Response
@endsection

@section('content')
    @foreach ($students->where('alternate_id', $requests->student_id) as $student)
    <div class="row">
        <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            You are about to respond to a request from 
            <u><span class="text-info text-lg"><strong> {{ $student->name }}</strong></span></u>
            with the requested file <u><span class="text-success text-lg"><strong> {{ $requests->document->filename }}</strong></span></u>
            <a href="/show_requests" type="button" class="btn btn-info bg-info float-right" style="text-decoration: none;">
                <i class="fa fa-arrow-left" style="padding: 10px;"></i> Return
            </a>
            <div class="modal-body">
                <form action="/respond_to_request/{{ $requests->id }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    {{ csrf_field() }} 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="exampleSelectBorder">Processing Officer</label>
                                  
                                  <select name="processing_officer_name" class="custom-select form-control-border" id="processing_officer">
                                    <option value=""> Please select </option>
                                      @foreach ($users as $user)
                                          <option value="{{ $user->first_name }}">{{ $user->first_name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                                        <input style="cursor: pointer;" type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" hidden>
                            <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Student ID</label>
                                <input type="text" name="student_id" class="form-control" value="{{ $student->alternate_id }}">
                            </div>
                            </div>
                        </div>
                        <div class="row" hidden>
                            <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Request Date</label>
                                <input type="text" name="request_date" class="form-control" value="{{ $requests->date_of_request }}">
                            </div>
                            </div>
                        </div>
                        <div class="row" hidden>
                            <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Release Date</label>
                                <input type="text" name="release_date" class="form-control" value="{{ $requests->release_date }}">
                            </div>
                            </div>
                        </div>
                        <div class="row" hidden>
                            <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Processing Officer</label>
                                <input type="text" name="processing_officer" class="form-control" value="{{ $requests->processing_officer }}">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-warning float-right">Respond</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div><!-- /.row -->
    @endforeach
@endsection
    
@section('scripts')
<!-- Select2 -->
<script src="{{ asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('admin_assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('admin_assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('admin_assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('admin_assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('admin_assets/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('admin_assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
<script>
    // $(function () {
    //   //Initialize Select2 Elements
    //   $('.select2').select2()
  
    //   //Initialize Select2 Elements
    //   $('.select2bs4').select2({
    //     theme: 'bootstrap4'
    //   })
  
    //   //Datemask dd/mm/yyyy
    //   $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //   //Datemask2 mm/dd/yyyy
    //   $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //   //Money Euro
    //   $('[data-mask]').inputmask()
  
    //   //Date picker
    //   $('#reservationdate').datetimepicker({
    //       format: 'L'
    //   });
  
    //   //Date and time picker
    //   $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
  
    //   //Date range picker
    //   $('#reservation').daterangepicker()
    //   //Date range picker with time picker
    //   $('#reservationtime').daterangepicker({
    //     timePicker: true,
    //     timePickerIncrement: 30,
    //     locale: {
    //       format: 'MM/DD/YYYY hh:mm A'
    //     }
    //   })
    //   //Date range as a button
    //   $('#daterange-btn').daterangepicker(
    //     {
    //       ranges   : {
    //         'Today'       : [moment(), moment()],
    //         'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //         'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //         'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    //         'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //       },
    //       startDate: moment().subtract(29, 'days'),
    //       endDate  : moment()
    //     },
    //     function (start, end) {
    //       $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    //     }
    //   )
  
    //   //Timepicker
    //   $('#timepicker').datetimepicker({
    //     format: 'LT'
    //   })
  
    //   //Bootstrap Duallistbox
    //   $('.duallistbox').bootstrapDualListbox()
  
    //   //Colorpicker
    //   $('.my-colorpicker1').colorpicker()
    //   //color picker with addon
    //   $('.my-colorpicker2').colorpicker()
  
    //   $('.my-colorpicker2').on('colorpickerChange', function(event) {
    //     $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    //   })
  
    //   $("input[data-bootstrap-switch]").each(function(){
    //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
    //   })
  
    // })
    // // BS-Stepper Init
    // document.addEventListener('DOMContentLoaded', function () {
    //   window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    // })
  
    // // DropzoneJS Demo Code Start
    // Dropzone.autoDiscover = false
  
    // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    // var previewNode = document.querySelector("#template")
    // previewNode.id = ""
    // var previewTemplate = previewNode.parentNode.innerHTML
    // previewNode.parentNode.removeChild(previewNode)
  
    // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    //   url: "/target-url", // Set the url
    //   thumbnailWidth: 80,
    //   thumbnailHeight: 80,
    //   parallelUploads: 20,
    //   previewTemplate: previewTemplate,
    //   autoQueue: false, // Make sure the files aren't queued until manually added
    //   previewsContainer: "#previews", // Define the container to display the previews
    //   clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    // })
  
    // myDropzone.on("addedfile", function(file) {
    //   // Hookup the start button
    //   file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    // })
  
    // // Update the total progress bar
    // myDropzone.on("totaluploadprogress", function(progress) {
    //   document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    // })
  
    // myDropzone.on("sending", function(file) {
    //   // Show the total progress bar when upload starts
    //   document.querySelector("#total-progress").style.opacity = "1"
    //   // And disable the start button
    //   file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    // })
  
    // // Hide the total progress bar when nothing's uploading anymore
    // myDropzone.on("queuecomplete", function(progress) {
    //   document.querySelector("#total-progress").style.opacity = "0"
    // })
  
    // // Setup the buttons for all transfers
    // // The "add files" button doesn't need to be setup because the config
    // // `clickable` has already been specified.
    // document.querySelector("#actions .start").onclick = function() {
    //   myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    // }
    // document.querySelector("#actions .cancel").onclick = function() {
    //   myDropzone.removeAllFiles(true)
    // }
    // // DropzoneJS Demo Code End
  </script>
<script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('admin_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->
<script>
    $(function () {
      $('#push-menu-hamburger').click(function(e){
        const el = $('body'); 
        if(el.hasClass('sidebar-collapse')){
          el.removeClass('sidebar-collapse')
        }else{
          el.addClass('sidebar-collapse')

        }
      })
      // bsCustomFileInput.init();
    });
</script>
@endsection