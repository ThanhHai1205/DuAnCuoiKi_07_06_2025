<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  use Illuminate\Support\Facades\Session;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>King Shoes - ADMIN</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- Morris Chart CSS -->
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('public/kidoldash/images/duongstore.png')}}" />
      <link rel="stylesheet" href="{{asset('public/kidoldash/css/backend-plugin.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/kidoldash/css/backend.css?v=1.0.0')}}">
      <link rel="stylesheet" href="{{asset('public/kidoldash/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/kidoldash/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/kidoldash/vendor/remixicon/fonts/remixicon.css')}}">
      
      <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
      <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a href="{{URL::to('/dashboard')}}" class="header-logo">
                <img src="{{asset('public/kidoldash/images/duongstore.png')}}" class="img-fluid rounded-normal light-logo" alt="logo">
                  <h5 class="logo-title light-logo ml-2">King Shoes</h5>
              </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu" style="cursor:pointer;"></i>
              </div>
          </div>

          <?php
            $position = Session::get('Position');
            $avatar = Session::get('Avatar');
            
            if($position != 'Nhân Viên'){
          ?>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                          <a href="{{URL::to('/dashboard')}}" class="svg-icon">                        
                              <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Thống Kê Doanh Thu</span>
                          </a>
                        </li>
                        <li class=" ">
                          <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash5" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                  <line x1="1" y1="10" x2="23" y2="10"></line>
                              </svg>
                              <span class="ml-4">Quản Lý Đơn Hàng</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('list-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/list-bill')}}">
                                        <i class="las la-minus"></i><span>Danh Sách Đơn Hàng</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('waiting-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/waiting-bill')}}">
                                        <i class="las la-minus"></i><span style="color: #FF9770;">Chờ Xác Nhận ({{$count_waiting_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('confirmed-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/confirmed-bill')}}">
                                        <i class="las la-minus"></i><span style="color: red;">Đã Xác Nhận ({{$count_confirmed_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipping-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipping-bill')}}">
                                        <i class="las la-minus"></i><span style="color: #7EE2FF;">Đang Giao Hàng ({{$count_shipping_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipped-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipped-bill')}}">
                                        <i class="las la-minus"></i><span style="color: #78C091;">Đã Hoàn Tất ({{$count_shipped_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('cancelled-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/cancelled-bill')}}">
                                        <i class="las la-minus"></i><span style="color: gray;">Đã Hủy ({{$count_cancelled_bill}})</span>
                                    </a>
                                </li>
                          </ul>
                        </li>
                        <li class=" ">
                          <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash2" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Sản Phẩm</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                              <li class="{{ Request::is('manage-products') ? 'active' : '' }}">
                                  <a href="{{URL::to('/manage-products')}}">
                                      <i class="las la-minus"></i><span>Danh Sách Sản Phẩm</span>
                                  </a>
                              </li>
                          </ul>
                        </li>
                        <li class="">
                                <a href="#discount" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" id="promo-management" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 3h18v18H3V3z"></path>
                                        <path d="M7 7l10 10"></path>
                                        <path d="M7 7h0.01"></path>
                                        <path d="M17 17h0.01"></path>
                                        <path d="M8 4a4 4 0 0 1 8 0"></path>
                                    </svg>
                                    <span class="ml-4"> Quản Lý Khuyến Mãi</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="discount" class="iq-submenu collapse" data-parent="#product">
                                    <li class="{{ Request::is('manage-sale') ? 'active' : '' }}">
                                        <a href="{{URL::to('/manage-sale')}}">
                                            <i class="las la-minus"></i><span>Danh Sách Khuyến Mãi</span>
                                        </a>
                                    </li>
                                </ul>
                        </li>
                        <li class="">
                                <a href="#voucher" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" id="coupon-management" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 8V7a2 2 0 0 0-2-2h-3l-2-2h-4l-2 2H5a2 2 0 0 0-2 2v1a3 3 0 0 1 0 6v1a2 2 0 0 0 2 2h3l2 2h4l2-2h3a2 2 0 0 0 2-2v-1a3 3 0 0 1 0-6z"></path>
                                        <line x1="9" y1="12" x2="15" y2="12"></line>
                                    </svg>
                                    <span class="ml-4"> Quản Lý Mã Giảm Giá</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="voucher" class="iq-submenu collapse" data-parent="#product">
                                    <li class="{{ Request::is('manage-voucher') ? 'active' : '' }}">
                                        <a href="{{URL::to('/manage-voucher')}}">
                                            <i class="las la-minus"></i><span>Danh Sách Mã</span>
                                        </a>
                                    </li>
                                </ul>
                        </li>
                        <li class="">
                                <a href="#attribute" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                    <svg class="svg-icon" id="category-management" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                                        <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                                        <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                                        <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                                    </svg>
                                    <span class="ml-4">Quản Lý Phân Loại</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="attribute" class="iq-submenu collapse" data-parent="#product">
                                    <li class="{{ Request::is('manage-attribute') ? 'active' : '' }}">
                                        <a href="{{URL::to('/manage-attribute')}}">
                                            <i class="las la-minus"></i><span>Nhóm Phân Loại</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::is('manage-attr-value') ? 'active' : '' }}">
                                        <a href="{{URL::to('/manage-attr-value')}}">
                                            <i class="las la-minus"></i><span>Phân Loại</span>
                                        </a>
                                    </li>
                                </ul>
                        </li>
                        <li class=" ">
                          <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="category-management" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 7V19a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-7l-2-2H5a2 2 0 0 0-2 2z"></path>
                                <path d="M3 7h18"></path>
                            </svg>
                              <span class="ml-4">Quản Lý Danh Mục</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('manage-category') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-category')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Danh Mục</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                        </li><li class=" ">
                          <a href="#brand" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="brand-management" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h17l-2 9H4l2-9zm0 0v18"></path>
                                <path d="M4 21h12"></path>
                            </svg>
                              <span class="ml-4">Quản Lý Thương Hiệu</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="brand" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('manage-brand') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-brand')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Thương Hiệu</span>
                                          </a>
                                  </li>
                          </ul>
                        </li>
                        <li class=" ">
                          <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Người Dùng</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="people" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('manage-customers') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-customers')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Khách Hàng</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('manage-staffs') ? 'active' : '' }}">
                                          <a href="{{URL::to('/manage-staffs')}}">
                                              <i class="las la-minus"></i><span>Danh Sách Nhân Viên</span>
                                          </a>
                                  </li>
                          </ul>
                        </li>
                        <li class=" ">
                          <a href="#myaccount" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="account-management" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M5.5 20.5C5.5 16.91 8.41 14 12 14s6.5 2.91 6.5 6.5"></path>
                            </svg>
                              <span class="ml-4">Quản Lý Tài Khoản</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="myaccount" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('my-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/my-adprofile')}}">
                                              <i class="las la-minus"></i><span>Hồ Sơ Của Tôi</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('edit-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/edit-adprofile')}}">
                                              <i class="las la-minus"></i><span>Sửa Thông Tin</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('change-adpassword') ? 'active' : '' }}">
                                          <a href="{{URL::to('/change-adpassword')}}">
                                              <i class="las la-minus"></i><span>Đổi Mật Khẩu</span>
                                          </a>
                                  </li>
                          </ul>
                        </li>
                        <li class=" ">
                          <a href="#otherpage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Tin Tức</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('manage-blog') ? 'active' : '' }}">
                                    <a href="{{URL::to('/manage-blog')}}">
                                        <i class="las la-minus"></i><span>Danh sách tin tức</span>
                                    </a>
                                </li>
                          </ul>
                        </li>
                  </ul>
              </nav>
              <div id="sidebar-bottom" class="position-relative sidebar-bottom">
                  <div class="card border-none">
                      <div class="card-body p-0">
                          <div class="sidebarbottom-content">
                              <div class="image"><img src="{{asset('public/kidoldash/images/layouts/side-bkg.png')}}" class="img-fluid" alt="side-bkg"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="p-3"></div>
          </div>
          <?php
            }else{
          ?>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                      <li class=" ">
                          <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash5" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                  <line x1="1" y1="10" x2="23" y2="10"></line>
                              </svg>
                              <span class="ml-4">Quản Lý Đơn Hàng</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('list-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/list-bill')}}">
                                        <i class="las la-minus"></i><span>Danh Sách Đơn Hàng</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('waiting-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/waiting-bill')}}">
                                        <i class="las la-minus"></i><span style="color: #FF9770;">Chờ Xác Nhận ({{$count_waiting_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('confirmed-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/confirmed-bill')}}">
                                        <i class="las la-minus"></i><span style="color: red;">Đã Xác Nhận ({{$count_confirmed_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipping-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipping-bill')}}">
                                        <i class="las la-minus"></i><span style="color: #7EE2FF;">Đang Giao Hàng ({{$count_shipping_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('shipped-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/shipped-bill')}}">
                                        <i class="las la-minus"></i><span style="color: #78C091;">Đã Hoàn Tất ({{$count_shipped_bill}})</span>
                                    </a>
                                </li>
                                <li class="{{ Request::is('cancelled-bill') ? 'active' : '' }}">
                                    <a href="{{URL::to('/cancelled-bill')}}">
                                        <i class="las la-minus"></i><span style="color: gray;">Đã Hủy ({{$count_cancelled_bill}})</span>
                                    </a>
                                </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#myaccount" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Tài Khoản</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="myaccount" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="{{ Request::is('my-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/my-adprofile')}}">
                                              <i class="las la-minus"></i><span>Hồ Sơ Của Tôi</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('edit-adprofile') ? 'active' : '' }}">
                                          <a href="{{URL::to('/edit-adprofile')}}">
                                              <i class="las la-minus"></i><span>Sửa Thông Tin</span>
                                          </a>
                                  </li>
                                  <li class="{{ Request::is('change-adpassword') ? 'active' : '' }}">
                                          <a href="{{URL::to('/change-adpassword')}}">
                                              <i class="las la-minus"></i><span>Đổi Mật Khẩu</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#otherpage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Quản Lý Tin Tức</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="{{ Request::is('manage-blog') ? 'active' : '' }}">
                                    <a href="{{URL::to('/manage-blog')}}">
                                        <i class="las la-minus"></i><span>Danh sách tin tức</span>
                                    </a>
                                </li>
                          </ul>
                      </li>
                  </ul>
              </nav>
              <div id="sidebar-bottom" class="position-relative sidebar-bottom">
                  <div class="card border-none">
                      <div class="card-body p-0">
                          <div class="sidebarbottom-content">
                              <div class="image"><img src="{{asset('public/kidoldash/images/layouts/side-bkg.png')}}" class="img-fluid" alt="side-bkg"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="p-3"></div>
          </div>
          <?php
            }
          ?>
          </div>      <div class="iq-top-navbar">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                      <i class="ri-menu-line wrapper-menu"></i>
                  </div>
                  <div class="iq-search-bar device-search">
                      
                  </div>
                  <div class="d-flex align-items-center">
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-label="Toggle navigation">
                          <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                              <li class="nav-item nav-icon search-content">
                                  
                              </li>

                              <!-- Thông báo nhận hàng -->
                              <?php 
                                    $billController = new \App\Http\Controllers\BillController();

                                    $receivedOrders = $billController->getReceivedOrders();
                                    $count_received_orders = $receivedOrders->count();
                                ?>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Thông báo nhận hàng">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-mail">
                                          <path
                                              d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                          </path>
                                          <polyline points="22,6 12,13 2,6"></polyline>
                                      </svg>
                                      @if($count_received_orders > 0)
                                        <span class="item-count">{{ $count_received_orders }}</span>
                                      @endif
                                      <span class="bg-primary"></span>
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">Thông báo nhận hàng</h5>
                                                      <a class="badge badge-primary badge-card" href="#">{{ $count_received_orders }}</a>
                                                  </div>
                                              </div>
                                              <div class="notification-list px-3 pt-0 pb-0 sub-card">
                                                @foreach($receivedOrders as $order)
                                                    <div class="px-3 pt-0 pb-0 sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                @if($order->Avatar)
                                                                <img class="avatar-50 rounded-small"
                                                                        src="{{ asset('public/storage/kidoldash/images/customer/' . $order->Avatar) }}" 
                                                                        alt="profile">
                                                                @else
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="{{ asset('public/kidolshop/images/customer/1.png') }}" 
                                                                        alt="profile">
                                                                @endif
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">{{ $order->username }}</h6>
                                                                    <small class="text-dark"><b>{{ $order->updated_at->format('H:i d/m/y') }}</b></small>
                                                                </div>
                                                                <small class="mb-0">Đã nhận được đơn: <span style="color: red;">#{{ $order->idBill }} </span></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>

                              <!-- Thông báo hủy hàng -->
                              <?php 
                                    $billController = new \App\Http\Controllers\BillController();

                                    $cancelledOrders = $billController->getCancelledOrders();
                                    $count_cancelled_orders = $cancelledOrders->count();
                                ?>
                              <li class="nav-item nav-icon dropdown">
                                <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton3"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Thông báo hủy đơn hàng">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-x-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                      @if($count_cancelled_orders > 0)
                                        <span class="item-count">{{ $count_cancelled_orders }}</span>
                                      @endif
                                      <span class="bg-primary"></span>
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">Thông báo hủy đơn hàng</h5>
                                                      <a class="badge badge-primary badge-card" href="#">{{ $count_cancelled_orders }}</a>
                                                  </div>
                                              </div>
                                              <div class="notification-list px-3 pt-0 pb-0 sub-card">
                                                @foreach($cancelledOrders as $order)
                                                    <div class="px-3 pt-0 pb-0 sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                @if($order->Avatar)
                                                                <img class="avatar-50 rounded-small"
                                                                        src="{{ asset('public/storage/kidoldash/images/customer/' . $order->Avatar) }}" 
                                                                        alt="profile">
                                                                @else
                                                                    <img class="avatar-50 rounded-small"
                                                                        src="{{ asset('public/kidolshop/images/customer/1.png') }}" 
                                                                        alt="profile">
                                                                @endif
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">{{ $order->username }}</h6>
                                                                    <small class="text-dark"><b>{{ $order->updated_at->format('H:i d/m/y') }}</b></small>
                                                                </div>
                                                                <small class="mb-0">Đã hủy đơn hàng: <span style="color: red;">#{{ $order->idBill }} </span></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>

                              <!-- Thông báo đặt hàng -->
                              <?php 
                                    $billController = new \App\Http\Controllers\BillController();

                                    $new_orders = $billController->getNewOrdersData();
                                    $count_new_orders = $new_orders->count();
                                ?>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Thông báo đặt hàng">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-bell">
                                          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                      </svg>
                                    @if($count_new_orders > 0)
                                        <span class="item-count">{{ $count_new_orders }}</span>
                                    @endif
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">Thông báo đặt hàng</h5>
                                                      <a class="badge badge-primary badge-card" href="#">{{ $count_new_orders }}</a>
                                                  </div>
                                              </div>
                                              <div class="notification-list px-3 pt-0 pb-0 sub-card">
                                                @foreach($new_orders as $order)
                                                    <div class="px-3 pt-0 pb-0 sub-card">
                                                        @php
                                                            $url = '#';
                                                            if ($order->Payment == 'cash') {
                                                                $url = url('/waiting-bill');
                                                            } else {
                                                                $url = url('/shipping-bill');
                                                            }
                                                        @endphp
                                                            <div class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="">
                                                                        @if($order->Avatar)
                                                                            <img class="avatar-50 rounded-small"
                                                                                src="{{ asset('public/storage/kidoldash/images/customer/' . $order->Avatar) }}" 
                                                                                alt="profile">
                                                                        @else
                                                                            <img class="avatar-50 rounded-small"
                                                                                src="{{ asset('public/kidolshop/images/customer/1.png') }}" 
                                                                                alt="profile">
                                                                        @endif
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <h6 class="mb-0">{{ $order->username }}</h6>
                                                                            <small class="text-dark"><b>{{ $order->created_at->format('H:i d/m/y') }}</b></small>
                                                                        </div>
                                                                        @if($order->Payment == 'vnpay')
                                                                            <small class="mb-0">Đã thanh toán đơn: <span style="color: red;">#{{ $order->idBill }} </span></small>
                                                                        @elseif($order->Payment == 'momo')
                                                                            <small class="mb-0">Đã thanh toán đơn: <span style="color: red;">#{{ $order->idBill }} </span></small>
                                                                        @else
                                                                            <small class="mb-0">Vừa đặt đơn: <span style="color: red;">#{{ $order->idBill }} </span></small>
                                                                        @endif
                                                                        <br> 
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <small class="mb-0">Hình thức: 
                                                                                @if($order->Payment == 'cash' ) <span style="color: red;">COD </span>
                                                                                @elseif($order->Payment == 'vnpay') <span style="color: red;">VNPay </span>
                                                                                @else <span style="color: red;">Momo </span>
                                                                                @endif
                                                                            </small>
                                                                            <small class="mb-0" >
                                                                                <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem trạng thái" 
                                                                                    href="{{$url}}"><i class="ri-search-line mr-0"></i>
                                                                                </a>
                                                                                <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem chi tiết" 
                                                                                    href="{{URL::to('/bill-info/'.$order->idBill)}}"><i class="ri-eye-line mr-0"></i>
                                                                                </a>
                                                                            </small>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                @endforeach
                                              </div>
                                              @if($count_new_orders > 0)
                                                <a class="right-ic btn btn-primary btn-block position-relative p-2" href="{{ url('/waiting-bill') }}"
                                                    role="button">
                                                    Xem tất cả
                                                </a>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </li>

                              <li class="nav-item nav-icon dropdown caption-content">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       @if($avatar != '')
                                        <img src="{{asset('public/storage/kidoldash/images/user/'.$avatar)}}" class="img-fluid rounded" alt="user">
                                       @else
                                        <img src="{{asset('public/kidoldash/images/user/12.jpg')}}" class="img-fluid rounded" alt="user">
                                       @endif
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 text-center">
                                              <div class="media-body profile-detail text-center">
                                                  <img src="{{asset('public/kidoldash/images/page-img/28.jpg')}}" alt="profile-bg"
                                                      class="rounded-top img-fluid mb-4" style="width: 350px; height: 200px;">
                                                  @if($avatar != null)
                                                  <img src="{{asset('public/storage/kidoldash/images/user/'.$avatar)}}" alt="profile-img"
                                                      class="rounded profile-img img-fluid avatar-70">
                                                  @else
                                                  <img src="{{asset('public/kidoldash/images/user/12.jpg')}}" alt="profile-img"
                                                      class="rounded profile-img img-fluid avatar-70">
                                                  @endif
                                              </div>
                                              <div class="p-3">
                                                  <h5 class="mb-1"><?php echo Session::get('AdminName'); ?></h5>
                                                  <div class="d-flex align-items-center justify-content-center mt-3">
                                                        <a href="{{URL::to('/my-adprofile')}}" class="btn border mr-2">Hồ sơ</a>
                                                        <a href="{{URL::to('/admin-logout')}}" class="btn border">Đăng Xuất</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </nav>
          </div>
      </div>

      @yield('content_dash')

    </div>
    <!-- Wrapper End-->

    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="#">TRANG QUẢN LÝ ADMIN</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">King Shoes</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!-- Backend Bundle JavaScript -->
<script src="{{asset('public/kidoldash/js/backend-bundle.min.js')}}"></script>

<!-- Table Treeview JavaScript -->
<script src="{{asset('public/kidoldash/js/table-treeview.js')}}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{asset('public/kidoldash/js/customizer.js')}}"></script>

<!-- Chart Custom JavaScript -->
<script async src="{{asset('public/kidoldash/js/chart-custom.js')}}"></script>

<!-- app JavaScript -->
<script src="{{asset('public/kidoldash/js/app.js')}}"></script>

<script src="{{asset('public/kidoldash/js/ckeditor/ckeditor.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{asset('public/kidoldash/datetimepicker-master/jquery.datetimepicker.css')}}">
<script src="{{asset('public/kidoldash/datetimepicker-master/jquery.js')}}"></script>
<script src="{{asset('public/kidoldash/datetimepicker-master/build/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('public/kidoldash/js/moment.js')}}"></script>
<script src="{{asset('public/kidoldash/js/form-validate.js')}}"></script>

<script type="text/javascript">
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = $('.slug').val();
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            $('#convert_slug').val(slug);
        }
</script>
<style>
    .item-count {
        position: absolute;
        top: 15px;
        right: 1px;
        width: 20px;
        height: 20px;
        line-height: 20px;
        background: #f379a7;
        border-radius: 100%;
        text-align: center;
        font-weight: 400;
        font-size: 12px;
        color: #ffffff;
        display: inline-block;
    }
    .notification-list {
        max-height: 400px; /* Giới hạn chiều cao của danh sách thông báo */
        overflow-y: auto; /* Thêm thanh cuộn dọc */
    }
</style>
</body>
</html>

