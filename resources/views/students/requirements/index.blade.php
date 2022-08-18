@extends('layouts.master_student')

@section('title')
    Student | Requirements
@endsection

@section('content')
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-m">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="modal_title">Add New Requirement</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form action="{{route('requirements.store')}}" method="POST" class="form-horizontal" id="formSubmit">
          {{ csrf_field() }}
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="exampleInputFile">Name</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input style="cursor: pointer;" type="text" name="name" class="form-control" id="name" required>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Description</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <input type="textarea" class="form-control" name="description" id="description" required>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputFile">Education Level</label>
                          <div class="input-group">
                            <div class="custom-file">
                              {{-- <input type="file" name="fileupload[]" class="custom-file-input" id="exampleInputFile"> --}}
                              <select
                                name="education_level"
                                class="form-control"
                                id="education_level"
                              >
                                <option></option>
                                <option value="High School"> High School Graduate</option>
                                <option value="College"> College Graduate</option>
                              </select>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-inline">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="mandatory" name="mandatory">
                              <label class="custom-control-label" for="mandatory"> Mandatory</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-inline">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="active" name="active">
                              <label class="custom-control-label" for="active"> Active</label>
                            </div>
                          </div>
                        </div>
                      </div>


                     
                  </div>
              </div>

          </div>
          <div class="card-footer">
          <button type="submit" class="btn btn-block btn-info float-right">Submit</button>
          </div>
          </form>
      </div>
  </div>
  </div>
</div>
<div class="modal fade" id="document_guidelines">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="modal_title">Document Guidelines</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <h5> <b>Scanned Document Guidelines: </b> </h5>
        <ul>
        <li> Documents must be colour scans of the original. </li>
        <li> Academic transcripts or copy of grades must be must be colour scans of the official transcript (digital e-records are not accepted). </li>
        <li> Scans from a photocopy or a faxed copy are not accepted. </li>
        <li> Documents must be scanned at the original size. </li>
        <li> Trainees must ensure no part or pages of the document are missing. </li>
        <li> Where a document has stamps, seals or text on both sides of the page then both sides must be scanned. </li>
        <li> Scanned documents must be in one of the following formats: pdf, jpg, jpeg, or png. </li>
        <li> Documents saved in the following file types will not be accepted: dot, gif, ppt or zip. </li>
        
        </ul>
        <hr>
        <span><i> Alternatively, you may use a mobile device to take a digital photograph of your documents. </i> </span> <br> <br>
        <h5> <b>Photographed Document Guidelines: </b> </h5>
        <li> Documents must be photographed from the original and in colour. </li>
        <li> Documents must be placed on a flat background when photographed. </li>
        <li> Documents must be placed on a plain background when photographed. </li>
        <li> Information in the photograph must be clear and legible. </li>
        <li> Information in the photograph must not be obstructed (for example, by your fingers or a shadow). </li>
        <li> Trainees must ensure no part or pages of the document are missing. </li>
        <li> Where a document has stamps, seals or text on both sides of the page then both sides must be photographed. </li>
        <li> Photographed documents must be in one of the following formats: pdf, jpg, jpeg, png. </li>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
  </div>
  </div>
</div>
<div class="">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Requirements - {{$level}}</h3>
          <br>
          <span><i> <span style="color:red">*</span> is required </i> </span><br>
          <span><i> <b>IMPORTANT</b>: To avoid rejection, please make sure that the scanned copy of your document is clear and legible." (Click <a href="#" id="linkToGuidelines"> Here </a> about document guidelines)  </i> </span>
        </div>
        <div class="card-body">
            <form action ="{{route('requirements.student.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                @foreach($list as $item)
                {{-- <li class="list-group-item">  --}}
                <div class="form-group">
                    <label> {{$item->requirement->name  }}
                        @if($item->requirement->mandatory)<span style="color:red">*</span> @endif  
                        
                    </label>
                    @if($item->hasUploaded())
                      <a href="{{route('requirements.view', $item->id)}}" target="_blank" class="badge badge-success"><i class="fa fa-eye"></i></a>
                      <a href="{{route('requirements.download', $item->id)}}"  class="badge badge-success"><i class="fa fa-download"></i></a>
                      <span> Submitted on: {{$item->updated_at->diffForHumans()}}</span>                    
                    @endif

                    <div class="custom-file">

                        <input type="file" class="custom-file-input {{$item->html['class']}}"  name="requirement[{{$item->requirement_id}}]" id="requirement[{{$item->requirement_id}}]"  @if($item->status == 2) readonly @endif>
              
                    
                        <label class="custom-file-label" for="requirement[{{$item->requirement_id}}]" required> Choose File</label>
                        <div class="{{$item->html['feedback_class']}}">
                          {{$item->html['message']}}
                        </div>

                    </div>
                </div>
                {{-- </li> --}}
                @endforeach
                <input type="submit" class="btn btn-success">
            </form>
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
<script>
  $(function () {
    $('.custom-file-input').on('change', function(){
        const fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $(document).ready(function() {
      $('.custom-file-input').on('change',function(){
              //get the file name
              var fileName = $(this).val();
              //replace the "Choose a file" label
              $(this).next('.custom-file-label').html(fileName);
        })
        $('#push-menu-hamburger').click(function(e){
          const el = $('body'); 
          if(el.hasClass('sidebar-collapse')){
            el.removeClass('sidebar-collapse')
          }else{
            el.addClass('sidebar-collapse')

          }
        })
      $("#linkToGuidelines").click(function(){
        $('#document_guidelines').modal('show')
      });
    })

    //   $('#addButton').click(function(){
    //     $('#formSubmit').attr('action','{{route('requirements.store')}}')
    //     $('#name').val('')
    //     $('#description').val('')
    //     $('#education_level').val('')
    //     $('#mandatory').prop('checked', false)
    //     $('#active').prop('checked', false)

    //     $('#modal_title').html('Add New Requirement')
    //   })
    //   $('.showUpdate').click(function(){
    //     const data = JSON.parse($(this).attr('data'))
    //     console.log(data)
    //     $('#modal_title').html('Update Requirement')
    //     const URL =  `/requirements/update/${data.id}`
    //     $('#formSubmit').attr('action',URL)
    //     $('#name').val(data.name)
    //     $('#description').val(data.description)
    //     $('#education_level').val(data.education_level)
    //     $('#mandatory').prop('checked',data.mandatory)
    //     $('#active').prop('checked',data.active)
    //     // console.log(JSON.parse($(this).attr('data'))
    //     $('#modal-lg').modal('show')
    //   })
    //   $('#example1').DataTable();
    //   $('#example1').on('click', '.deletbtn', function() {
    //       $tr = $(this).closest('tr');
  
    //       var data = $tr.children("td").map(function() {
    //         return $(this).text();
    //       }).get(); 
  
    //       // console.log(data);
  
    //       $('#get_course_id').val(data[0]);
    //       $('#deleteModalForm').attr('action', '/delete_course/'+data[0]);
    //       $('#deleteModalPop').modal('show');
    //   });


    // });
  </script>
@endsection