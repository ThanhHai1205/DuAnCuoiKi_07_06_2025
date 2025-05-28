@extends('admin_layout')
@section('content_dash')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh sách ( Tổng: {{$list_bill->count()}} đơn hàng )</h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-tables table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Mã ĐH</th>
                                <th>Tên Tài Khoản</th>
                                <th>SĐT</th>
                                <th>Thanh Toán</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>NV Xác Nhận</th>
                                <th>Ngày Xác Nhận</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body" id="load-bill">
                            @foreach($list_bill as $key => $bill)
                            <tr>
                                <td>{{$bill->idBill}}</td>
                                <td>{{$bill->username}}</td>
                                <td>{{$bill->PhoneNumber}}</td>
                                <td>@if($bill->Payment == 'vnpay') VNPay
                                    @elseif($bill->Payment == 'momo') Momo
                                    @else Khi nhận hàng @endif
                                </td>
                                <td>{{$bill->created_at}}</td>
                                <td><div class=" align-items-center badge badge-warning">{{$bill->AdminName}}</div></td>
                                <td>{{$bill->TimeConfirm}}</td>

                                <td>
                                    <form action="{{URL::to('/confirm-bill/'.$bill->idBill)}}" method="POST"> @csrf
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem chi tiết" 
                                            href="{{URL::to('/bill-info/'.$bill->idBill)}}"><i class="ri-eye-line mr-0"></i>
                                        </a>
                                        <button class="badge badge-info mr-2 momo" style="border:none;" data-toggle="tooltip" data-placement="top" title="" 
                                            data-original-title="Xác nhận hoàn thành"><i class="fas fa-check-double mr-0"></i>
                                        </button>
                                        <input type="hidden" name="Status" value="2"> 
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

@endsection