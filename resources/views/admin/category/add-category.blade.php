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
                        <h4 class="card-title">Thêm Danh Mục</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{URL::to('/submit-add-category')}}" method="POST" data-toggle="validator">
                        @csrf
                        <div class="row"> 
                            <div class="col-md-12">                  
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" name="CategoryName" class="form-control slug" onkeyup="ChangeToSlug()" placeholder="Nhập tên danh mục" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" name="CategorySlug" class="form-control" id="convert_slug">
                            </div>    
                        </div>                             
                        <input type="submit" name="addcategory" class="btn btn-primary mr-2" value="Thêm danh mục">
                        <a href="{{URL::to('/manage-category')}}" class="btn btn-light mr-2">Trở Về</a>
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
            window.location = "{{ url('manage-category') }}";
        });
    @endif
</script>
@endsection