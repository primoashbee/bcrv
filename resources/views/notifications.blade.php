@extends('layouts.master')

@section('title')
      Notifications
@endsection

@section('content')
<div class="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Notifications</h3>

          </a>
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach($notifications as $key=>$notification)
                <a href="{{route('notification.view',$notification->id)}}" class="list-group-item list-group-item-action flex-column align-items-start @if($notification->read_at == null) active @endif">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$notification->data['title']}}</h5>
                    <small>{{$notification->created_at->diffForHumans()}}</small>
                  </div>
                  <p class="mb-1">{{$notification->data['message']}}</p>
                </a>
                @endforeach

              </div>

        </div>

</div>
@endsection
@section('scripts')

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
@endsection