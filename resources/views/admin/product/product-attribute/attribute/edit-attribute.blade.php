@extends('admin_layout')
@section('content_dash')

<?php use Illuminate\Support\Facades\Session; ?>

<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Chỉnh Sửa Nhóm Phân Loại</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{URL::to('/submit-edit-attribute/'.$select_attribute->idAttribute)}}" method="POST" data-toggle="validator">
                        @csrf
                        <div class="row"> 
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên nhóm phân loại</label>
                                    <input type="text" name="AttributeName" class="form-control" value="{{$select_attribute->AttributeName}}" placeholder="Nhập tên nhóm phân loại" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>    
                        </div>                             
                        <input type="submit" class="btn btn-primary mr-2" value="Sửa nhóm phân loại">
                        <a href="{{URL::to('/manage-attribute')}}" class="btn btn-light mr-2">Trở về</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
</div>
<script>
    @if(Session::has('message'))
        Swal.fire({
            title: '{{ Session::get('message') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location = "{{ url('manage-attribute') }}";
        });
    @endif
</script>

@endsection