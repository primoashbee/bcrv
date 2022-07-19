@extends('layouts.master')

@section('title')
    Admin | User - Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            You are about to edit a user
            <a href="/show_users" type="button" class="btn btn-info bg-info float-right" style="text-decoration: none;">
                <i class="fa fa-arrow-left" style="padding: 10px;"></i> Return
            </a>
            <div class="modal-body">
                <form action="/edit_user/{{ $users->id }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                    <div class="card-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control select2" style="width: 100%; height: 100%;">
                                <option value="" disabled selected>Select Role</option>>
                                @foreach ($data['roles'] as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="exampleSelectBorder">Status</label>
                            <select name="status" class="custom-select form-control-border" id="exampleSelectBorder">
                            <option selected value="{{ $users->status }}">{{ $users->status }}</option>
                            <option value="1">1 - Active</option>
                            <option value="0">0 - Inactive</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-info float-right">Edit Student</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div><!-- /.row -->
@endsection
    
@section('scripts')
@endsection