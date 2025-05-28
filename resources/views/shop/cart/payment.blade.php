@extends('shop_layout')
@section('content')

<?php use Illuminate\Support\Facades\Session; ?>

<form method="POST" action="{{URL::to('/submit-payment')}}" id="payment-form">
    @csrf
<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/kidolshop/images/banner/ch.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Thanh toán</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Cart Start-->
<div class="cart-page section-padding-5">
    <div class="container">
        <div class="container__address">
            <div class="container__address-css"></div>
            <div class="container__address-content">
                <div class="container__address-content-hd justify-content-between">
                    <div><i class="container__address-content-hd-icon fa fa-map-marker"></i>Địa Chỉ Nhận Hàng</div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddressModal">+ Thêm Địa Chỉ</button>
                </div>
                <ul class="shipping-list list-address">
                    
                </ul>
            </div>
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
                    <?php 
                        $Total = 0; 
                        $ship = 0; 
                        $total_bill = 0; 
                        $unique_products = []; // Mảng để lưu trữ các sản phẩm khác nhau
                        $total_quantity = 0; // Tổng số lượng sản phẩm trong giỏ hàng
                    ?>
                    @foreach($list_pd_cart as $key => $pd_cart)
                        <?php 
                            // Tính tổng thành tiền giỏ hàng
                            $Total += ($pd_cart->PriceNew * $pd_cart->QuantityBuy);

                            // Đếm số lượng 1 sản phẩm trong giỏ hàng
                            $total_quantity += $pd_cart->QuantityBuy;

                            // Thêm sản phẩm vào mảng unique_products
                            if (!in_array($pd_cart->idProduct, $unique_products)) {
                                $unique_products[] = $pd_cart->idProduct;
                            } 
                        ?>
                    <tr class="product-item">
                        <?php $image = json_decode($pd_cart->ImageName)[0]; ?>
                        <td class="image">
                            <a href="{{URL::to('/shop-single/'.$pd_cart->ProductSlug)}}"><img src="{{asset('public/storage/kidoldash/images/product/'.$image)}}" alt=""></a>
                        </td>
                        <td class="product">
                            <a href="{{URL::to('/shop-single/'.$pd_cart->ProductSlug)}}">{{$pd_cart->ProductName}}</a>
                            <span>Mã sản phẩm: {{$pd_cart->idProduct}}</span>
                            <span>{{$pd_cart->AttributeProduct}}</span>
                            <span class="text-primary">Còn Lại: {{$pd_cart->Quantity}}</span>
                            <?php $replace = [" ",":"]; ?>
                            <input type="hidden" class="Quantity" id="<?php echo 'Quantity-'.$pd_cart->idProduct.'-'.str_replace($replace,"",$pd_cart->AttributeProduct);?>" value="{{$pd_cart->Quantity}}">
                        </td>
                        <td class="price">{{number_format($pd_cart->PriceNew,0,',','.')}}đ</td>
                        <td class="quantity">{{$pd_cart->QuantityBuy}}</td>
                        <td class="total">{{number_format($pd_cart->Total,0,',','.')}}đ</td>
                        <input type="hidden" name="idProAttr" value="{{$pd_cart->idProAttr}}">
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-6 container__address-content">
                <div class="container__address-content-hd">
                    <i class="container__address-content-hd-icon fa fa-tags"></i>
                    <div>Mã giảm giá</div>
                </div>
                <div class="cart-form mt-25 d-flex">
                    <div class="single-form flex-fill mr-30">
                        <input type="text" id="VoucherCode" placeholder="Nhập mã giảm giá (chỉ áp dụng 1 mã)">
                    </div>
                    <div class="cart-form-btn d-flex">
                        <button type="button" style="width:97px;" class="btn btn-primary pl-2 pr-2 check-voucher">Áp dụng</button>
                    </div>
                </div>
                <div class="text-primary alert-voucher"></div>
            </div>
            <div class="col-lg-6 container__address-content">
                <div class="container__address-content-hd">
                    <i class="container__address-content-hd-icon fa fa-money"></i>
                    <div>Phương thức thanh toán</div>
                </div>
                <ul class="shipping-list checkout-payment">
                    <li class="cus-radio">
                        <input type="radio" name="checkout" value="cash" id="cash" checked>
                        <label for="cash">
                            <span>
                                <img src="{{asset('public/kidolshop/images/payment-icon/cod.jpg')}}" alt=""
                                    style="wight:25px; height: 25px;">
                                Thanh toán khi nhận hàng (COD)
                            </span>
                        </label>
                    </li>
                    <li class="cus-radio payment-radio">
                        <input type="radio" name="checkout" value="vnpay" id="vnpay" >
                        <label for="vnpay">
                            <span>
                                <img src="{{asset('public/kidolshop/images/payment-icon/vnpay.png')}}" alt=""
                                    style="wight:35px; height: 35px;">
                                Thanh toán trực tuyến VNPay
                            </span>
                        </label>
                    </li>
                    <li class="cus-radio payment-radio">
                        <input type="radio" name="checkout" value="momo" id="momo">
                        <label for="momo">
                            <span>
                                <img src="{{asset('public/kidolshop/images/payment-icon/momo.png')}}" alt=""
                                    style="wight:30px; height: 30px;">
                                Thanh toán trực tuyến Momo
                            </span>
                        </label>
                    </li>
                </ul>                   
            </div>
            <div class="col-lg-12">
                <div class="cart-totals shop-single-content">
                    <div class="container__address-content-hd">
                        <i class="container__address-content-hd-icon fa fa-shopping-cart"></i>
                        <div>Tổng giỏ hàng</div>
                    </div>
                    <div class="cart-total-table mt-25">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td class="text-right">{{ number_format($Total, 0, ',', '.') }}đ</td>
                                </tr>
                                @php
                                    if ($Total < 1000000) {
                                        if (count($unique_products) < 2 && $total_quantity < 2) {
                                            $ship = 30000;
                                        } else {
                                            $ship = 0;
                                        }
                                        $total_bill = $Total + $ship;
                                    } else {
                                        $ship = 0;
                                        $total_bill = $Total;
                                    }
                                @endphp
                                <tr class="shipping">
                                    <td>Phí vận chuyển (Miễn phí vận chuyển cho đơn hàng trên 1.000.000đ)</td>
                                    <td class="text-right">
                                        @if($ship > 0)
                                            {{ number_format($ship, 0, ',', '.') }}đ
                                        @else
                                            Miễn phí
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70%">Thành tiền</td>
                                    <td class="text-right totalBill" style="color: red;">{{ number_format($total_bill, 0, ',', '.') }}đ</td>
                                </tr>

                                <input type="hidden" class="subtotal" value="{{$Total}}">
                                <input type="hidden" name="TotalBill" class="totalBillVal" value="{{$total_bill}}">    
                                <input type="hidden" name="Voucher" class="Voucher" value="">    
                                <input type="hidden" name="idVoucher" class="idVoucher" value="0">                                
                            </tbody>
                        </table>
                    </div>
                    <div class="dynamic-checkout-button disabled ">
                        <div class="checkout-checkbox">
                            <input type="checkbox" id="disabled">
                            <label for="disabled"><span></span> Tôi đồng ý với các điều khoản và điều kiện </label>
                        </div>    
                        <div class="cart-total-btn checkout-btn">
                            <button type="submit" name="redirect" class="btn btn-primary btn-block btnorder" style="max-width:100%;">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cart End-->
</form>

<!-- Modal thêm địa chỉ -->
<form id="form-insert-address">
    @csrf
    <div class="modal fade" id="AddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Địa Chỉ</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="CustomerName" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" name="CustomerName" id="CustomerName" value="{{$customer->CustomerName}}">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="PhoneNumber" class="col-form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="PhoneNumber" id="PhoneNumber" value="{{$customer->PhoneNumber}}">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-form-label">Địa chỉ:</label>
                        <textarea class="form-control" name="Address" id="Address"></textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <input type="submit" id="btn-insert-address" class="btn btn-primary" value="Thêm"> 
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal sửa địa chỉ -->
<form id="form-edit-address">
    @csrf
    <div class="modal fade" id="EditAddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa Địa Chỉ</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="CustomerName" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" name="CustomerName" id="CustomerName" value="aa">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="PhoneNumber" class="col-form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="PhoneNumber" id="PhoneNumber">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-form-label">Địa chỉ:</label>
                        <textarea class="form-control" name="Address" id="Address"></textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <input type="submit" id="btn-insert-address" class="btn btn-primary" value="Sửa"> 
                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{asset('public/kidolshop/js/jquery.validate.min.js')}}"></script>

<script>
    $(document).ready(function(){  
        APP_URL = '{{url('/')}}' ;
        fetch_address();
    
        // Ajax hiện danh sách địa chỉ nhận hàng
        function fetch_address(){
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/fetch-address')}}",
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                    $('.list-address').html(data);

                    // Ajax xóa địa chỉ nhận hàng
                    $('.dlt-address').on('click',function(){
                        var idAddress = $(this).data("id");
                        var _token = $('input[name="_token"]').val();
          
                        $.ajax({
                            url: APP_URL + '/delete-address/'+idAddress,
                            method: 'DELETE',
                            data: {idAddress:idAddress,_token:_token},
                            success:function(data){
                                fetch_address();
                            }
                        });
                    });

                    // Ajax validate form && sửa địa chỉ nhận hàng
                    $('.edit-address').on('click',function(){
                        $('#form-edit-address #CustomerName').val($(this).data("name"));
                        $('#form-edit-address #PhoneNumber').val($(this).data("phone"));
                        $('#form-edit-address #Address').val($(this).data("address"));
                        var idAddress = $(this).data("id");

                        $("#form-edit-address").validate({
                            rules: {
                                Address: {
                                    required: true,
                                    minlength: 20
                                },
                                CustomerName: {
                                    required: true,
                                    minlength: 5
                                },
                                PhoneNumber: {
                                    required: true,
                                    minlength: 10,
                                    maxlength: 12
                                }
                            },

                            messages: {
                                Address: {
                                    required: "Vui lòng nhập trường này",
                                    minlength: "Nhập địa chỉ tối thiểu 20 ký tự"
                                },
                                CustomerName: {
                                    required: "Vui lòng nhập trường này",
                                    minlength: "Nhập họ và tên tối thiểu 5 ký tự"
                                },
                                PhoneNumber: {
                                    required: "Vui lòng nhập trường này",
                                    minlength: "Nhập số điện thoại tối thiểu 10 chữ số",
                                    maxlength: "Nhập số điện thoại tối đa 12 chữ số"
                                }
                            },

                            submitHandler: function(form) {
                                var CustomerName = $('#form-edit-address #CustomerName').val();
                                var PhoneNumber = $('#form-edit-address #PhoneNumber').val();
                                var Address = $('#form-edit-address #Address').val();
                                var _token = $('input[name="_token"]').val();
                                $.ajax({
                                    url: APP_URL + '/edit-address/'+idAddress,
                                    method: 'POST',
                                    data: {idAddress:idAddress,CustomerName:CustomerName,PhoneNumber:PhoneNumber,Address:Address,_token:_token},
                                    success:function(data){
                                        $('#EditAddressModal').modal('hide');
                                        fetch_address();
                                    }
                                });
                            }
                        });
                    });
                }
            });
        }

        // Ajax validate form && insert địa chỉ nhận hàng
        $("#form-insert-address").validate({
            rules: {
                Address: {
                    required: true,
                    minlength: 20
                },
                CustomerName: {
                    required: true,
                    minlength: 5
                },
                PhoneNumber: {
                    required: true,
                    minlength: 10,
                    maxlength: 12
                }
            },

            messages: {
                Address: {
                    required: "Vui lòng nhập trường này",
                    minlength: "Nhập địa chỉ tối thiểu 20 ký tự"
                },
                CustomerName: {
                    required: "Vui lòng nhập trường này",
                    minlength: "Nhập họ và tên tối thiểu 5 ký tự"
                },
                PhoneNumber: {
                    required: "Vui lòng nhập trường này",
                    minlength: "Nhập số điện thoại tối thiểu 10 chữ số",
                    maxlength: "Nhập số điện thoại tối đa 12 chữ số"
                }
            },

            submitHandler: function(form) {
                var CustomerName = $('#CustomerName').val();
                var PhoneNumber = $('#PhoneNumber').val();
                var Address = $('#Address').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: APP_URL + '/insert-address',
                    method: 'POST',
                    data: {CustomerName:CustomerName,PhoneNumber:PhoneNumber,Address:Address,_token:_token},
                    success:function(data){
                        $('#AddressModal').modal('hide');
                        fetch_address();
                    }
                });
            }
        });

        $('.btnorder').click(function(e) {
            let selectedAddressValue = $('input[name="address_rdo"]:checked').val();
            let defaultAddressNotSet = $('#radioDefault').next('label').text().includes('Chưa có địa chỉ mặc định.');
            
            if (selectedAddressValue === 'default' && defaultAddressNotSet) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: '<span style="color: red;">Chưa có địa chỉ nhận hàng</span>',
                    text: 'Vui lòng thiết lập địa chỉ mặc định hoặc thêm địa chỉ nhận hàng trước khi đặt hàng!',
                    showCancelButton: true,
                    confirmButtonText: 'Thêm địa chỉ nhận hàng',
                    cancelButtonText: 'Hủy',
                    footer: '<button type="button" class="btn btn-primary" id="setupAddressBtn">Thiết lập địa chỉ mặc định</button>'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#AddressModal').modal('show');
                    }
                });

                $(document).on('click', '#setupAddressBtn', function() {
                    window.location.href = APP_URL + '/account';
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function(){  
        APP_URL = '{{url('/')}}';

        function format(n) {
            return n.toFixed(0).replace(/./g, function(c, i, a) {
                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
            });
        }

        $('#VoucherCode').on('focus', function(){
            $.ajax({
                url: APP_URL + '/get-vouchers',
                method: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(data){
                    $('#VoucherCode').autocomplete({
                        source: data.map(voucher => voucher.VoucherCode),
                        minLength: 0
                    }).autocomplete("search", "");
                }
            });
        });

        $('.check-voucher').on('click', function(){
            var VoucherCode = $('#VoucherCode').val();
            var _token = $('input[name="_token"]').val();
            var subtotal = parseInt($('.subtotal').val());
            var ship = parseInt($('.shipping').find('td.text-right').text().replace(/\D/g, '')); // Lấy giá trị của phí vận chuyển

            $.ajax({
                url: APP_URL + '/check-voucher',
                method: 'POST',
                data: {VoucherCode: VoucherCode, _token: _token, subtotal: subtotal, ship: ship},
                success:function(data){
                    if (data.startsWith('Success')) {
                        var array_data = data.split("-");
                        var subtotal = parseInt($('.subtotal').val());
                        var totalBill = parseInt($('.totalBillVal').val());

                        $('.alert-voucher').html("Áp dụng mã giảm giá thành công");
                        $('.check-voucher').before('<button type="button" class="unset-voucher btn btn-primary pl-2 pr-2">Hủy chọn</button>');
                        $('.check-voucher').css('display', 'none');

                        var condition = array_data[1];
                        var vouchernumber = parseInt(array_data[2]);

                        if (condition == '1') vouchernumber = (subtotal / 100) * vouchernumber;
                        if (vouchernumber > subtotal) vouchernumber = subtotal;

                        totalBill = totalBill - vouchernumber;

                        $('.shipping').after('<tr class="voucher-confirm"><td width="70%">Mã giảm giá</td><td class="text-right">- '+format(vouchernumber)+'đ</td></tr>');
                        $('.totalBill').html(format(totalBill) + 'đ');
                        $('.totalBillVal').val(totalBill);
                        $('.Voucher').val(array_data[3] + "-" + condition + "-" + array_data[2]);
                        $('.idVoucher').val(array_data[3]);
                        
                        $('.unset-voucher').on('click', function(){
                            $('.alert-voucher').html("");
                            $('.check-voucher').css('display', 'block');
                            $('.unset-voucher').remove();
                            $('.voucher-confirm').remove();
                            $('#VoucherCode').val("");
                            $('.totalBill').html(format(totalBill + vouchernumber) + 'đ');
                            $('.totalBillVal').val(totalBill + vouchernumber);
                            $('.Voucher').val("");
                            $('.idVoucher').val("0");
                        });
                    } else {
                        $('.alert-voucher').html(data); 
                    }
                }
            });
        });
    });
</script>

@endsection