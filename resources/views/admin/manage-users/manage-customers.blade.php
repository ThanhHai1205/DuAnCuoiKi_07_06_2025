@extends('admin_layout')
@section('content_dash')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh sách ( Tổng: {{$count_customer}} khách hàng )</h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-tables table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Avatar</th>
                                <th>Tên Tài Khoản</th>
                                <th>Họ Và Tên</th>
                                <th>Số Điện Thoại</th>
                                <th>Địa chỉ</th>
                                <th> Trạng Thái </th>
                                <th> Thao tác </th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach($list_customer as $key => $customer)
                            <tr>
                                @if($customer->Avatar)
                                <td class="text-center"><img class="rounded img-fluid avatar-40"
                                        src="public/storage/kidoldash/images/customer/{{$customer->Avatar}}" alt="profile"></td>
                                @else
                                <td class="text-center"><img class="rounded img-fluid avatar-40"
                                        src="public/kidolshop/images/customer/1.png" alt="profile"></td>
                                @endif
                                <td>{{$customer->username}}</td>
                                <td>
                                    @if($customer->CustomerName == '') <span style="color: red;">Chưa thiết lập</span>
                                    @else {{$customer->CustomerName}}
                                    @endif
                                </td>
                                <td>
                                    @if($customer->PhoneNumber == '') <span style="color: red;">Chưa thiết lập</span>
                                    @else {{$customer->PhoneNumber}}
                                    @endif
                                </td>
                                <td>
                                    @if($customer->Address == '') <span style="color: red;">Chưa thiết lập</span>
                                    @else {{$customer->Address}}
                                    @endif
                                </td>
                                @if($customer->Status == 1) 
                                    <td>
                                        <strong style="color: green;">Đang hoạt động</strong>
                                    </td>
                                    @else 
                                    <td>
                                        <strong style="color: red;">Đã khóa</strong>
                                    </td> 
                                @endif
                                <td>
                                    <form> @csrf
                                        <div class="d-flex align-items-center list-action">
                                            @if($customer->Status == 0)
                                            <button type="button" class="badge badge-dark mr-2 btn-Status" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mở khóa"
                                                style="border:none;" data-id="{{$customer->idCustomer}}" data-status="1"><i class="fa fa-eye-slash"></i></i></button>
                                            @else
                                            <button type="button" class="badge badge-primary mr-2 btn-Status" data-toggle="tooltip" data-placement="top" title="" data-original-title="Khóa"
                                                style="border:none;" data-id="{{$customer->idCustomer}}" data-status="0"><i class="fa fa-eye"></i></i></button>
                                            @endif
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page end  -->

<script>
    $(document).ready(function() {  
        APP_URL = '{{url('/')}}';

        // Sử dụng .on để gắn sự kiện click vào các phần tử được tạo động
        $(document).on('click', '.btn-Status', function() {
            var idCustomer = $(this).data("id");
            var Status = $(this).data("status");
            var _token = $('input[name="_token"]').val();
            var action = Status == 1 ? "mở khóa" : "khóa";

            Swal.fire({
                title: '<span style="color: red;">Xác nhận</span>',
                text: "Bạn có muốn " + action + " tài khoản này không?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: APP_URL + '/change-status-customer/' + idCustomer,
                        method: 'POST',
                        data: {Status: Status, _token: _token},
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            });
        });
    });
</script>

@endsection