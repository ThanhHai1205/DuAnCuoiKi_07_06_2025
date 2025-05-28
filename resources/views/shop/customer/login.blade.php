@extends('shop_layout')
@section('content')

<?php use Illuminate\Support\Facades\Session; ?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/kidolshop/images/oso.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đăng Nhập</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đăng Nhập</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Login Start-->
<div class="login-page section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-register-content">
                    <h4 class="title">Đăng Nhập Tài Khoản</h4>

                    <div class="login-register-form">
                        <form method="POST" action="{{URL::to('/submit-login')}}" id="form-login">
                            @csrf
                            <div class="form-group mt-15">
                                <label for="username">Tên tài khoản</label>
                                <input id="username" type="text" name="username">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group mt-15">
                                <label for="passsword">Mật khẩu</label>
                                <div class="input-group">
                                    <input id="password" type="password" name="password" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                                            <i class="fa fa-eye" id="eye-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group mt-15">
                                <input type="submit" class="btn btn-primary btn-block" value="Đăng nhập"/>
                            </div>
                            <div class="form-group mt-15">
                                <label>Bạn chưa có tài khoản?</label>
                                <a href="{{URL::to('/register')}}" class="btn btn-dark btn-block">Đăng ký ngay</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Login End-->
<style>
    .input-group {
        position: relative;
    }

    #password {
        padding-right: 40px; 
    }

    #toggle-password {
        position: absolute;
        right: 10px; 
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        padding: 0;
        cursor: pointer;
        outline: none;
    }
</style>
<!-- Validate form đăng nhập -->
<script>
    $(document).ready(function(){  
        Validator({
            form: "#form-login",
            errorSelector: ".text-danger",
            parentSelector: ".form-group",
            rules:[
            Validator.isRequired("#username"),
            Validator.isRequired("#password")
            ]
        });

        $('#toggle-password').click(function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            var eyeIcon = $('#eye-icon');
            
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
<script>
    @if (session('message'))
        Swal.fire({
            icon: 'error',
            title: '<span style="color: red;">Đăng nhập thất bại</span>',
            text: '{{ session('message') }}',
        });
    @endif
</script>

@endsection