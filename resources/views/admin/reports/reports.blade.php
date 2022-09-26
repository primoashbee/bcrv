@extends('layouts.master')

@section('title')
    Admin | Reports
@endsection
@section('content')
<div class="row" id="content">
    <div class="col-12" id="div-filter">
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
                        <button type="button" class="btn btn-default" id="btnPrint"> Print </button>
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
                        {{-- <tr>
                            <td>Ongoing</td>
                            <td>{{ $countongoing }}</td>
                        </tr> --}}
                        <tr>
                            <td>Sent</td>
                            <td>{{ $countsent }}</td>
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
    <div class="col-12" style="">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Students Chart</h3>
            </div>
            <div class="card-body">
                <!-- DONUT CHART -->
                <div class="card card-info">
                    <div class="card-header">
                    <h3 class="card-title"></h3>
    
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" >
                        <div  style="height:300px !important">
                            <h4 class="text-center"> Number of students per batch ({{request()->has('school_year') ? request()->school_year : now()->format('Y')}}) </h4>
                            <canvas id="studentPerBatchChart" ></canvas>

                        </div>
                        <table class="table table-striped mt-4">
                            <thead>
                            <tr>
                                <th scope="col">Course</th>
                                @foreach($batch_count as $batch)
                                <th scope="col">Batch {{$batch}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses_report->datasets as $key=>$item)
                                <tr>
                                    <td>
                                        {{$item->course->course_name}}
                                    </td>
                                    @foreach($item->values as $batch_value)
                                        <td> {{$batch_value}}</td>
                                    @endforeach
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

 
                    </div>
                    <div class="clearfix"></div>
                   
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body mb-4" >
                        <div  style="height:300px !important" >
                            <h4 class="text-center"> Number of students per year ({{request()->has('school_year') ? request()->school_year : now()->format('Y')}}) </h4>
                            <canvas id="studentPerYearChart" ></canvas>

                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    
@section('scripts')
<!-- jQuery -->
{{-- <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script> --}}
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

        $('#btnPrint').click(async function(){
            const fileName = String(new Date().valueOf());
            const element = document.getElementById('content');
            const regionCanvas = element.getBoundingClientRect();
            $('#div-filter').hide();
            const alert = Swal.fire({
                title: 'Generating File',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                  
                }
                
            })
            html2canvas(element, { scale: 3 }).then(async canvas => {
                alert.close()
                $('#div-filter').show();

                const pdf = new jsPDF('p', 'mm', 'a4');
                // const pdf = new jsPDF({
                //     orientation: "portrait",
                //     unit: "in",
                //     format: [4, 2]
                // });
                // pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 3, 0, 205, (205 / regionCanvas.width) * regionCanvas.height);
                // pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 10, 10, 205, (205 / regionCanvas.width) * regionCanvas.height);
                pdf.addImage(canvas.toDataURL('image/png'), 'JPEG', 10, 10, 180, (205 / regionCanvas.width) * regionCanvas.height)

                await pdf.save(fileName, { returnPromise: true });
                window.open(pdf.output('bloburl', { filename: fileName }), '_blank');
                // window.open().document.write('<img src="' + canvas.toDataURL() + '" />');
                
            });
        })

        $('#batch').val(batch)
        $('#course').val(course)
        $('#school_year').val(school_year)
        $('#status').val(status)


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
 
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
        const studentPerBatchCanvas = $('#studentPerBatchChart').get(0).getContext('2d');
        const studentPerYearChart = $('#studentPerYearChart').get(0).getContext('2d');
        const chart2_label = school_year == null ? new Date().getFullYear() : school_year
        const myChart = new Chart(studentPerBatchCanvas, {
            type: 'bar',
            data: {
                labels: @json($courses_report->labels),
                datasets: [
                    @foreach($courses_report->datasets as $key=>$item)
                    {
                        label: @json($item->label),
                        data : @json($item->values),
                        backgroundColor: @json($item->bg_color),
                        borderColor: @json($item->border_color),
                        borderWidth: 1
                    },
                    @endforeach
                ]
                   
            },
            options: {
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            min: 0
                        }
                    }],
                    x: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio : false,
                responsive : true
        }
        });


        const myChart2 = new Chart(studentPerYearChart, {
            type: 'bar',
            data: {
                labels: @json($courses_report_year->labels),
                datasets: [
                    @foreach($courses_report_year->datasets as $item)
                    {
                        label: @json($item->label),
                        data: @json($item->values),
                        backgroundColor: @json($item->bg_color),
                        borderColor: @json($item->border_color),
                        borderWidth: 1
                    },
                    @endforeach
                ]
                   
            },
            options: {
                scales: {
                    yAxes: [
                        { 
                            stacked: true 
                        }
                    ],
                    xAxes: [
                        {
                            stacked: true,
                        }
                    ]
                },
                maintainAspectRatio : false,
                responsive : true
            }
        });

        
      var countpending = @json($countpending);
      var countsent = @json($countsent);
      var donutData = {
        labels: [
            'Pending',
            'Received',
        ],
        datasets: [
          {
            data: [countpending, countsent],
            backgroundColor : ['#f56954', '#f39c12'],
          }
        ]
      }

      console.log(donutData)
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