@extends('shop_layout')
@section('content')

<?php use App\Http\Controllers\ProductController; ?>
<!--Slider Start-->
<div class="slider-area">
    <div class="swiper-container slider-active">
        <div class="swiper-wrapper">
            <!--Single Slider Start-->
            <div class="single-slider swiper-slide animation-style-01" 
                style="background-image: url('public/kidolshop/images/slider/bn-1.jpg'); height: 750px;">
                <div class="container">
                    <div class="slider-content">
                        <h2 class="main-title">Chào mừng bạn đến với chúng tôi</h2>
                        <ul class="slider-btn">
                            <li><a href="{{URL::to('/store')}}" class="btn btn-round btn-primary">Bắt đầu mua sắm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Single Slider End-->

            <!--Single Slider Start-->
            <div class="single-slider swiper-slide animation-style-01" 
                style="background-image: url('public/kidolshop/images/slider/bn-2.jpg'); height: 750px;">
                <div class="container" style="text-align:right;">
                    <div class="slider-content">
                        <h2 class="main-title" style="color: white;">Ưu đãi hấp dẫn</h2>
                        <ul class="slider-btn">
                            <li><a href="{{URL::to('/store')}}" class="btn btn-round btn-primary">Bắt đầu mua sắm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Single Slider End-->
        </div>
        <!--Swiper Wrapper End-->

        <!-- Add Arrows -->
        <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
        <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>

    </div>
    <!--Swiper Container End-->
</div>
<!--Slider End-->

<!--Shipping Start-->
<div class="shipping-area section-padding-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="public/kidolshop/images/shipping-icon/Free-Delivery.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Miễn Phí Vận Chuyển</h5>
                        <p style="font-family: 'Coiny', sans-serif;">Đơn từ <span style="color: red;">1 triệu</span> hoặc mua từ <span style="color: red;">2 sản phẩm</span> trở lên</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="public/kidolshop/images/shipping-icon/Online-Order.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Đặt Hàng Online</h5>
                        <p style="font-family: 'Coiny', sans-serif;">Lựa chọn các sản phẩm ưng ý và đặt hàng nhanh chóng</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="public/kidolshop/images/shipping-icon/Freshness.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Hiện Đại</h5>
                        <p style="font-family: 'Coiny', sans-serif;">Luôn cập nhật các sản phẩm mới nhất</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="public/kidolshop/images/shipping-icon/Made-By-Artists.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Hỗ Trợ 24/7</h5>
                        <p style="font-family: 'Coiny', sans-serif;">Tư vấn hỗ trợ mọi lúc</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shipping End-->

<!--About Start-->
<div class="about-area section-padding-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="public/kidolshop/images/banner/shoe.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <h2 class="title">Mua sắm thả ga với những ưu đãi hấp dẫn.</h2>
                    <p>Các mã giảm giá hiện có trên cửa hàng:</p>
                    <ul>
                        <li> <span style="color: red;">freeship</span> : Giảm phí vận chuyển tối đa 30K cho đơn từ 0Đ (Có hạn). </li>
                        <li> <span style="color: red;">giamgia20k</span> : Giảm 20K trên tổng giá trị đơn hàng (Có hạn). </li>
                    </ul>
                    <div class="about-btn">
                        <a href="{{URL::to('/show-voucher')}}" class="btn btn-primary btn-round">Xem Voucher</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--About End-->

<!--New Product Start-->
<div class="features-product-area section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản Phẩm Của Chúng Tôi</h2>
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="product-tab-menu">
                <ul class="nav justify-content-center" role="tablist">
                    <li>
                        <a class="active" data-toggle="tab" href="#tab3" role="tab">Bán chạy</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab1" role="tab">Đang Sale</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab2" role="tab">Chính sách đổi trả</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content product-items-tab">
                <div class="tab-pane fade show active" id="tab3" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            @foreach($list_bestsellers_pd as $key => $bestsellers_pd)
                            <div class="swiper-slide">
                                <div class="single-product">
                                    <div class="product-image">
                                        <?php $image = json_decode($bestsellers_pd->ImageName)[0];?>
                                        <a href="{{URL::to('/shop-single/'.$bestsellers_pd->ProductSlug)}}">
                                            <img src="{{asset('public/storage/kidoldash/images/product/'.$image)}}" alt="">
                                        </a>

                                        <?php
                                            $SalePrice = $bestsellers_pd->Price;  
                                            $get_time_sale = ProductController::get_sale_pd($bestsellers_pd->idProduct); 
                                        ?>

                                        @if($get_time_sale)
                                            <?php $SalePrice = $bestsellers_pd->Price - ($bestsellers_pd->Price/100) * $get_time_sale->Percent; ?>
                                            <div class="product-countdown">
                                                <div data-countdown="{{$get_time_sale->SaleEnd}}"></div>
                                            </div>
                                            @if($bestsellers_pd->QuantityTotal == '0') <span class="sticker-new soldout-title">Hết hàng</span>
                                            @else <span class="sticker-new label-sale">-{{$get_time_sale->Percent}}%</span>
                                            @endif
                                        @elseif($bestsellers_pd->QuantityTotal == '0') <span class="sticker-new soldout-title">Hết hàng</span>;
                                        @endif

                                        <div class="action-links">
                                            <ul>
                                                <li><a class="add-to-compare" data-idcat="{{$bestsellers_pd->idCategory}}" id="{{$bestsellers_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="So sánh"><i class="icon-sliders"></i></a></li>
                                                <li><a class="add-to-wishlist" data-id="{{$bestsellers_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                                <li><a class="quick-view-pd" data-id="{{$bestsellers_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <h4 class="product-name"><a href="{{URL::to('/shop-single/'.$bestsellers_pd->ProductSlug)}}">{{$bestsellers_pd->ProductName}}</a></h4>
                                        <div class="price-box">
                                            @if($SalePrice < $bestsellers_pd->Price)
                                                <span class="old-price">{{number_format($bestsellers_pd->Price,0,',','.')}}đ</span>
                                                <span class="current-price">{{number_format(round($SalePrice,-3),0,',','.')}}đ</span>
                                            @else
                                                <span class="current-price">{{number_format($bestsellers_pd->Price,0,',','.')}}đ</span>
                                            @endif
                                        </div>
                                        <div class="">
                                            Đã bán {{$bestsellers_pd->Sold}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
                        <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab1" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            @php
                                $hasSaleProducts = false;
                            @endphp
                            
                            @foreach($list_featured_pd as $key => $featured_pd)
                                <?php
                                    $SalePrice = $featured_pd->Price;  
                                    $get_time_sale = ProductController::get_sale_pd($featured_pd->idProduct); 
                                ?>
                                @if($get_time_sale)
                                    @php
                                        $hasSaleProducts = true;
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="single-product">
                                            <div class="product-image">
                                                <?php $image = json_decode($featured_pd->ImageName)[0]; ?>
                                                <a href="{{URL::to('/shop-single/'.$featured_pd->ProductSlug)}}">
                                                    <img src="{{asset('public/storage/kidoldash/images/product/'.$image)}}" alt="">
                                                </a>
                                                <?php $SalePrice = $featured_pd->Price - ($featured_pd->Price / 100) * $get_time_sale->Percent; ?>
                                                <div class="product-countdown">
                                                    <div data-countdown="{{$get_time_sale->SaleEnd}}"></div>
                                                </div>
                                                @if($featured_pd->QuantityTotal == '0') 
                                                    <span class="sticker-new soldout-title">Hết hàng</span>
                                                @else 
                                                    <span class="sticker-new label-sale">-{{$get_time_sale->Percent}}%</span>
                                                @endif
                                                <div class="action-links">
                                                    <ul>
                                                        <li><a class="add-to-compare" data-idcat="{{$featured_pd->idCategory}}" id="{{$featured_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="So sánh"><i class="icon-sliders"></i></a></li>
                                                        <li><a class="add-to-wishlist" data-id="{{$featured_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                                        <li><a class="quick-view-pd" data-id="{{$featured_pd->idProduct}}" data-tooltip="tooltip" data-placement="left" title="Xem nhanh"><i class="icon-eye"></i></a></li> 
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content text-center">
                                                <h4 class="product-name"><a href="{{URL::to('/shop-single/'.$featured_pd->ProductSlug)}}">{{$featured_pd->ProductName}}</a></h4>
                                                <div class="price-box">
                                                    @if($SalePrice < $featured_pd->Price)
                                                        <span class="old-price">{{number_format($featured_pd->Price, 0, ',', '.')}}đ</span>
                                                        <span class="current-price">{{number_format(round($SalePrice, -3), 0, ',', '.')}}đ</span>
                                                    @else
                                                        <span class="current-price">{{number_format($featured_pd->Price, 0, ',', '.')}}đ</span>
                                                    @endif
                                                </div>
                                                <div class="">
                                                    Đã bán {{$featured_pd->Sold}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            
                            @if(!$hasSaleProducts)
                                <span style="display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            height: 250px;
                                            width: 100%;
                                            text-align: center;
                                            color: red;">
                                    Hiện tại chưa có đợt sale nào
                                </span>
                            @endif
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
                        <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            <span style="display: flex; justify-content: center; align-items: center;
                                            height: 250px; width: 100%; text-align: center; ">
                                🔹 Chính sách đổi trả Duong Store 🔹</br>
                                - Miễn phí đổi hàng cho khách mua ở Duong Store trong trường hợp bị lỗi từ nhà sản xuất, 
                                giao nhầm hàng, nhầm size. </br>
                                - Quay video mở sản phẩm khi nhận hàng, nếu không có video unbox, 
                                khi phát hiện lỗi phải báo ngay cho Duong Store trong 1 ngày tính từ ngày giao hàng thành công. 
                                Qua 1 ngày chúng mình không giải quyết khi không có video unbox. </br>
                                - Sản phẩm đổi trong thời gian 3 ngày kể từ ngày nhận hàng. </br>
                                - Sản phẩm còn mới nguyên tem, tags, sản phẩm không dơ bẩn, 
                                hư hỏng bởi những tác nhân bên ngoài cửa hàng sau khi mua hàng. </br>
                                - Khi đổi trả vui lòng liên hệ qua chat tư vấn. </br>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--New Product End-->

<!--Blog Start-->
<div class="blog-area blog-bg section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Bài Viết Của Chúng Tôi</h2>
                </div>
            </div>
        </div>
        <div class="blog-wrapper mt-30">
            <div class="swiper-container blog-active">
                <div class="swiper-wrapper">
                    @foreach($list_blog as $key => $blog)
                    <div class="swiper-slide">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a href="{{URL::to('/blog/'.$blog->BlogSlug)}}">
                                    <img src="{{asset('public/storage/kidoldash/images/blog/'.$blog->BlogImage)}}" 
                                        alt="" style="wight: 500px; height: 250px;">
                                </a>
                            </div>
                            <div class="blog-content">
                                <h4 class="title"><a href="{{URL::to('/blog/'.$blog->BlogSlug)}}">{{$blog->BlogTitle}}</a></h4>
                                <div class="articles-date">
                                    <p><span>{{$blog->created_at}}</span></p>
                                </div>
                                <div class="four-line mb-4">{!!$blog->BlogDesc!!}</div>

                                <div class="blog-footer">
                                    <a class="more" href="{{URL::to('/blog/'.$blog->BlogSlug)}}">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
                <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
            </div>
        </div>
    </div>
</div>
<!--Blog End-->

<!--Brand Start-->
<div class="brand-area">
    <div class="container">
        <div class="brand-active swiper-container">
            <div class="swiper-wrapper">
                <div class="single-brand swiper-slide">
                    <a href="{{URL::to('/store?show=all&brand=7&sort_by=new')}}">
                        <img src="{{asset('public/kidolshop/images/brand/adidas.jpg')}}" 
                            alt="" style="height: 80px; wight: 100px;">
                    </a>
                </div>
                <div class="single-brand swiper-slide">
                    <a href="{{URL::to('/store?show=all&brand=8&sort_by=new')}}">
                        <img src="{{asset('public/kidolshop/images/brand/nike.jpg')}}" 
                            alt="" style="height: 80px; wight: 100px;">
                    </a>
                </div>
                <div class="single-brand swiper-slide">
                    <a href="{{URL::to('/store?show=all&brand=6&sort_by=new')}}">
                        <img src="{{asset('public/kidolshop/images/brand/converse.png')}}" 
                            alt="" style="height: 80px; wight: 100px;">
                    </a>
                </div>
                <div class="single-brand swiper-slide">
                    <a href="{{URL::to('/store?show=all&brand=5&sort_by=new')}}">
                        <img src="{{asset('public/kidolshop/images/brand/vans.png')}}" 
                            alt="" style="height: 80px; wight: 100px;">
                    </a>
                </div>
                <div class="single-brand swiper-slide">
                    <a href="">
                        <img src="{{asset('public/kidolshop/images/brand/puma.png')}}" 
                            alt="" style="height: 80px; wight: 100px;">
                    </a>
                </div>
                <div class="single-brand swiper-slide">
                    <a href="">
                        <img src="{{asset('public/kidolshop/images/brand/new-balance.png')}}" 
                            alt="" style="height: 80px; wight: 100px;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Brand End-->

@if(session('message'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Thông báo',
            text: '{{ session('message') }}',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '{{ route('login') }}';
        });
    </script>
@endif


@endsection