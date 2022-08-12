@extends('layouts.master')

@section('title')
    Admin | Reports
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form action="{{url()->current()}}" method="GET" id="formFilter">
                <div class="row">
                    <div class="col-12">
                        <h3> Filter Report </h3>
                    </div>
                    <div class="col-3 form-group">
                        <label for="">Batch</label>
                        <select name="batch" id="batch" class="form-control">
                            <option value="">Please Select</option>
                            @foreach($batches as $batch)
                            <option value="{{$batch->batch}}"> {{$batch->batch}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="">Course</label>
                        <select name="course" id="course" class="form-control">
                            <option value="">Please Select</option>
                            @foreach($courses as $courses)
                            <option value="{{$courses->course_name}}"> {{$courses->course_name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="">School Year</label>
                        <select name="school_year" id="school_year" class="form-control">
                            <option value="">Please Select</option>
                            @foreach($school_year as $year)
                            <option value="{{$year->school_year}}"> {{$year->school_year}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Please Select</option>
                            <option value="pending">Pending</option>
                            <option value="sent">Sent</option>
                        </select>
                    </div>
                    <div class="col-2 form-group">
                        <label for="">Action</label>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Filter"/>
                        <button type="button" class="btn btn-" id="btnClear"> Clear </button>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Request by course reports</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>No. of Requests</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pending</td>
                            <td>{{ $countpending }}</td>
                        </tr>
                        <tr>
                            <td>Ongoing</td>
                            <td>{{ $countongoing }}</td>
                        </tr>
                        <tr>
                            <td>Received</td>
                            <td>{{ $countreceived }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>No. of Requests</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Request by course chart</h3>
            </div>
            <div class="card-body">
                <!-- DONUT CHART -->
                <div class="card card-info">
                    <div class="card-header">
                    <h3 class="card-title">Pie Chart</h3>
    
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    
@section('scripts')
<!-- jQuery -->
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
{{-- <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script> --}}
<script>
    $(function () {
        const batch = @json(request()->batch);
        const course = @json(request()->course);
        const school_year = @json(request()->school_year);
        const status = @json(request()->status);

        $('#batch').val(batch)
        $('#course').val(course)
        $('#school_year').val(school_year)
        $('#status').val(status)

        console.log(batch, course, school_year, status)

        $('#btnClear').click(function(){
            $('#batch').val('')
            $('#course').val('')
            $('#school_year').val('')
            $('#status').val('')

        });
      //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var countpending = {{ $countpending }};
      var countongoing = {{ $countongoing }};
      var countreceived = {{ $countreceived }};
      var donutData        = {
        labels: [
            'Pending',
            'Ongoing',
            'Received',
        ],
        datasets: [
          {
            data: [countpending, countongoing, countreceived],
            backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
          }
        ]
      }
      var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(donutChartCanvas, {
        type: 'pie',
        data: donutData,
        options: donutOptions
      })

      $("#formFilter").submit(function(e){
        e.preventDefault();
        const batch = $("#batch").val();
        const school_year = $("#school_year").val();
        const course = $("#course").val();
        const status = $("#status").val();

        const sURL = new URL(@json(url()->current()))

        if(batch != "" && batch != undefined){
            sURL.searchParams.append('batch', batch);
        }        

        if(school_year != "" && school_year != undefined){
            sURL.searchParams.append('school_year', school_year);
        }        
        if(course != "" && course != undefined){
            sURL.searchParams.append('course', course);
        }        
        if(status != "" && status != undefined){
            sURL.searchParams.append('status', status);
        }        
        window.location.href = sURL
      })
    })
</script>
@endsection