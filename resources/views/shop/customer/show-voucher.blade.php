@extends('shop_layout')
@section('content')

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/kidolshop/images/acc.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Kho voucher</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kho voucher</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--My Account Start-->
<div class="register-page section-padding-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <div class="my-account-menu mt-30">
                    <ul class="nav account-menu-list flex-column">
                        <li>
                            <a href="{{URL::to('/account')}}"><i class="fa fa-user"></i> Hồ Sơ</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/change-password')}}"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/ordered')}}"><i class="fa fa-shopping-cart"></i> Đơn Đặt Hàng</a>
                        </li>
                        <li>
                            <a class="active"><i class="fa fa-ticket"></i> Kho voucher</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="tab-content my-account-tab mt-30" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-account">
                        <div class="tab-content my-account-tab" id="pills-tabContent">
                            <div class="tab-pane fade active show">
                                <div class="my-account-address account-wrapper">
                                    <div class="row">
                                        <div class="col-md-12" style="border-bottom: solid 1px #efefef;">
                                            <h4 class="account-title" style="margin-bottom: 0;">Voucher hiện có</h4>
                                        </div>
                                        @if(count($list_voucher) > 0)
                                            @foreach($list_voucher as $voucher)
                                            <div class="col-md-6">
                                                <article class="card mt-3">
                                                    <section class="date">
                                                        <span style="color: black;">Nhập mã: </span></br>
                                                        <span style="color: red;">{{ $voucher->VoucherCode }}</span>
                                                        @if($voucher->VoucherCode == 'CHAOMUNG' && $hasBought)  
                                                            <div class="voucher-status">
                                                                <div class="status-circle">Đã hết lượt sử dụng</div>
                                                            </div>
                                                        @elseif(\Carbon\Carbon::parse($voucher->VoucherEnd)->isPast())
                                                            <div class="voucher-status">
                                                                <div class="status-circle">Đã hết hạn sử dụng</div>
                                                            </div>
                                                        @endif
                                                    </section>
                                                    <section class="card-cont">
                                                        <p style="color: #f379a7;">{{ $voucher->VoucherName }}</p>
                                                        <p>Giảm tối đa {{number_format($voucher->VoucherNumber,0,',','.')}}đ</p>
                                                        <p>HSD: {{ \Carbon\Carbon::parse($voucher->VoucherEnd)->format('d-m-Y') }}</p>
                                                    </section>
                                                </article>
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12 mt-3">
                                                <div class="alert alert-warning" role="alert">
                                                    Không có voucher nào hiện tại.
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css?family=Oswald');
    * {
        margin: 0;
        padding: 0;
        border: 0;
        box-sizing: border-box;
    }

    .fl-left {
        float: left;
    }

    .row {
        overflow: hidden;
    }

    .card {
        display: block;
        width: 100%;
        height: 120px;
        background-color: #fff;
        color: #989898;
        margin-bottom: 10px;
        font-family: 'Coiny', sans-serif;
        border-radius: 0px;
        position: relative;
    }

    .date {
        display: table-cell;
        width: 40%;
        height: 120px;
        position: relative;
        background-color: #00bfa5;
        text-align: center;
        border-right: 2px dashed #dadde6;
        vertical-align: middle; 
        padding: 10px; 
    }

    .card-cont {
        display: table-cell;
        width: 75%;
        font-size: 85%;
        vertical-align: middle; 
        padding: 20px;
    }

    .row:last-child .card:last-of-type .card-cont h3 {
        text-decoration: line-through;
    }

    .card-cont>div {
        display: table-row;
    }

    .card-cont p {
        margin: 0;
    }

    @media screen and (max-width: 860px) {
        .card {
            display: block;
            float: none;
            width: 100%;
            margin-bottom: 10px;
        }
        .card+.card {
            margin-left: 0;
        }
        .card-cont .even-date,
        .card-cont .even-info {
            font-size: 75%;
        }
    }
    
    .voucher-status {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        transform: rotate(-30deg);
        border: 5px solid #32BDEA;
        border-radius: 5px;
        right: -5%;
        color: black;
        bottom: 30px;
        font-size: 13px;
    }
</style>
@endsection