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
                            <h4 class="card-title">Chỉnh Sửa Phân Loại</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-attr-value/'.$select_attr_value->idAttrValue)}}" method="POST" data-toggle="validator">
                            @csrf
                            <div class="row">          
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="idAttribute">Nhóm phân loại *</label>
                                        <select id="idAttribute" name="idAttribute" class="selectpicker form-control" data-style="py-0" required>
                                            <option value="{{$select_attr_value->idAttribute}}">{{$select_attr_value->AttributeName}}</option>
                                            @foreach($list_attribute as $key => $attribute)
                                            <option value="{{$attribute->idAttribute}}">{{$attribute->AttributeName}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>          
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên phân loại</label>
                                        <input type="text" name="AttrValName" class="form-control" value="{{$select_attr_value->AttrValName}}" placeholder="Nhập tên phân loại" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>    
                            </div>                             
                            <input type="submit" class="btn btn-primary mr-2" value="Sửa phân loại">
                            <a href="{{URL::to('/manage-attr-value')}}" class="btn btn-light mr-2">Trở về</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page end  -->
<script>
    @if(Session::has('message'))
        Swal.fire({
            title: '{{ Session::get('message') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location = "{{ url('manage-attr-value') }}";
        });
    @endif
</script>

@endsection