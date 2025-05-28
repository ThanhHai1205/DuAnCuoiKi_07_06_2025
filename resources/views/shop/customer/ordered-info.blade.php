@extends('shop_layout')
@section('content')

<?php use Illuminate\Support\Facades\Session; ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(../public/kidolshop/images/banner/ch.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Chi Tiết Đơn Hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Cart Start-->
<div class="cart-page section-padding-5">
    <div class="container">
        <div class="container__address">
            @foreach($list_bill as $key => $bill)
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="">
                        @if($bill->Status == 1 || $bill->Status == 2)
                            Hãy kiểm tra cẩn thận tất cả các sản phẩm trong đơn hàng trước khi bấm 
                                "<span style="color: red;">Đã nhận hàng</span>".
                        @elseif($bill->Status == 0)
                            <span style="color: red;">Đang chờ xác nhận</span>
                        @elseif($bill->Status == 99)
                           <span style="color: red;">Đã hủy đơn hàng</span></br>
                           <span>lúc {{$address->updated_at->format('H:i d-m-Y')}}.</span>
                        @endif
                    </div>
                    @if($bill->Status == 1)
                        <form id="confirm-receipt-{{ $bill->idBill }}" action="{{ URL::to('/confirm-receipt/'.$bill->idBill) }}" method="POST">
                            @csrf
                            <input type="hidden" name="Status" value="2">
                            <button type="button" class="btn btn-primary" onclick="confirmReceipt('confirm-receipt-{{ $bill->idBill }}')">Đã nhận hàng</button>
                        </form>
                    @elseif($bill->Status == 2)
                        <button class="btn btn-received" disabled>Đã nhận hàng</button>
                    @endif
                </div>
            
                <br>
                <div class="container__address-css"></div>
                @if($bill->Status == 1 || $bill->Status == 2 || $bill->Status == 0)
                <div class="container__address-content">
                    <div class="d-flex justify-content-between align-items-start">
                        <!-- Phần bên trái -->
                        <div class="w-25" id="left-content">
                            <div class="container__address-content-hd" style="font-size:15px;">
                                <div><i class="container__address-content-hd-icon fa fa-shopping-cart"></i>Đơn Hàng</div>
                            </div>
                            <ul class="shipping-list list-address">
                                <li class="cus-radio align-items-center" style="font-size:15px;">
                                    <span class="mr-2">Mã đơn hàng: 
                                        <span style="color: green;">#{{$address->idBill}}</span>
                                    </span>
                                </li>
                                <li class="cus-radio align-items-center" style="font-size:15px;">
                                    <span class="mr-2">Ngày đặt hàng: {{$address->created_at->format('d-m-Y')}}</span>
                                </li>
                                @if ($bill->Status == 1)
                                    <li class="cus-radio align-items-center" style="font-size:20px;">
                                        <span class="badge" style="background-color: red; color: white;">Đang giao hàng</span>
                                    </li>
                                @elseif ($bill->Status == 2)
                                    <li class="cus-radio align-items-center" style="font-size:20px;">
                                        <span class="badge" style="background-color: #4b8c6c; color: white;">Hoàn tất</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        
                        <!-- Phần giữa -->
                        <div class="w-50">
                            <div class="container__address-content-hd" style="font-size:15px;">
                                <div><i class="container__address-content-hd-icon fa fa-map-marker"></i>Địa Chỉ Nhận Hàng</div>
                            </div>
                            <ul class="shipping-list list-address">
                                <li class="cus-radio align-items-center" style="font-size:15px;">
                                    <span class="mr-2">{{$address->CustomerName}}</span>
                                </li>
                                <li class="cus-radio align-items-center" style="font-size:15px;">
                                    <span class="mr-2">Điện thoại: {{$address->PhoneNumber}}</span>
                                </li>
                                <li class="cus-radio align-items-center" style="font-size:15px;">
                                    <span>{{$address->Address}}</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Phần bên phải -->
                        <div class="w-25">
                            <div class="container__address-content-hd" style="font-size:15px;">
                                <div><i class="container__address-content-hd-icon fa fa-money"></i>Phương thức thanh toán</div>
                            </div>
                            <ul class="shipping-list list-address">
                                <li class="cus-radio align-items-center" style="font-size:15px;">
                                    <span class="mr-2">
                                        @if($address->Payment == 'vnpay') Thanh toán trực tuyến VNPay
                                        @elseif($address->Payment == 'momo') Thanh toán trực tuyến Momo
                                        @else Thanh toán khi nhận hàng (COD) 
                                        @endif
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <div class="cart-table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="image">Hình Ảnh</th>
                        <th class="product">Sản Phẩm</th>
                        <th class="price">Giá</th>
                        <th class="quantity" style="width:10%">Số Lượng</th>
                        <th class="total">Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $Total = 0; $ship = 0; $total_bill = 0; $discount = 0; ?>
                    @foreach($list_bill_info as $key => $bill_info)
                        <?php $Total += ($bill_info->Price * $bill_info->QuantityBuy); ?>
                    <tr class="product-item">
                        <?php $image = json_decode($bill_info->ImageName)[0]; ?>
                        <td class="image">
                            <a href="{{URL::to('/shop-single/'.$bill_info->ProductSlug)}}"><img src="{{asset('public/storage/kidoldash/images/product/'.$image)}}" alt=""></a>
                        </td>
                        <td class="product">
                            <a href="{{URL::to('/shop-single/'.$bill_info->ProductSlug)}}">{{$bill_info->ProductName}}</a>
                            <span>Mã sản phẩm: {{$bill_info->idProduct}}</span>
                            <span>{{$bill_info->AttributeProduct}}</span>
                        </td>
                        <td class="price">{{number_format($bill_info->Price,0,',','.')}}đ</td>
                        <td class="quantity">{{$bill_info->QuantityBuy}}</td>
                        <td class="total" style="color: red;">{{number_format($bill_info->Price * $bill_info->QuantityBuy,0,',','.')}}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="cart-totals shop-single-content">
                    <div class="container__address-content-hd">
                        <i class="container__address-content-hd-icon fa fa-shopping-cart"></i>
                        <div>Tổng giỏ hàng</div>
                    </div>
                    <div class="cart-total-table mt-25" style="position:relative;">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td class="text-right">{{number_format($Total,0,',','.')}}đ</td>
                                </tr>
                                @php
                                    if ($Total < 1000000) {
                                        $ship = 30000;
                                        $total_bill = $Total + $ship;
                                    } else {
                                        $ship = 0;
                                        $total_bill = $Total;
                                    }
                                @endphp
                                <tr class="shipping">
                                    <td>Phí vận chuyển (Free ship đơn trên 1.000.000đ)</td>
                                    <td class="text-right">
                                        @if($ship > 0)
                                            {{ number_format($ship, 0, ',', '.') }}đ
                                        @else
                                            Miễn phí
                                        @endif
                                    </td>
                                </tr>

                                @if($address->Voucher != '') 
                                <tr>
                                    <td width="70%">Mã giảm giá</td>
                                    @php
                                        $Voucher = explode("-",$address->Voucher);
                                        $VoucherCondition = $Voucher[1];
                                        $VoucherNumber = $Voucher[2];
                                        if($VoucherCondition == 1) $discount = ($Total/100) * $VoucherNumber;
                                        else{
                                            $discount = $VoucherNumber;
                                            if($discount > $Total) $discount = $Total;
                                        } 

                                        $total_bill =  $total_bill - $discount;
                                        if($total_bill < 0) $total_bill = $ship;
                                    @endphp
                                    <td class="text-right totalBill">- {{number_format($discount,0,',','.')}}đ</td>
                                </tr>
                                @endif

                                <tr>
                                    <td width="70%">Thành tiền</td>
                                    <td class="text-right totalBill" style="color: red;">{{number_format($total_bill,0,',','.')}}đ</td>
                                </tr>

                                <input type="hidden" class="subtotal" value="{{$Total}}">
                                <input type="hidden" name="TotalBill" class="totalBillVal" value="{{$total_bill}}">    
                                <input type="hidden" name="idVoucher" class="idVoucher" value="0">                                
                            </tbody>
                        </table>
                        @if($address->Payment == 'vnpay' || $address->Payment == 'momo')
                        <div class="col-lg-3 paid_tag">
                            <div class="h3 p-3 mb-0 text-primary">Đã thanh toán</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cart End-->
<style>
    .btn-received {
        background-color: #f0f0f0; 
        border: 1px solid #dcdcdc;
        color: black;
        cursor: not-allowed;
    }
    .btn-received:focus, .btn-received:active {
        box-shadow: none;
    }
</style>
<script>
    function confirmReceipt(formId) {
        Swal.fire({
            title: '<span style="color: red;">Xác nhận hoàn tất</span>',
            text: "Bạn vui lòng kiểm tra và đảm bảo hài lòng với tình trạng của tất cả sản phẩm trước khi nhấn. Sau khi XÁC NHẬN, đơn hàng sẽ được hoàn tất.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'XÁC NHẬN',
            cancelButtonText: 'HỦY'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endsection