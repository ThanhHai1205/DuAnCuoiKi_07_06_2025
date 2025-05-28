@extends('shop_layout')
@section('content')

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(public/kidolshop/images/acc.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đổi mật khẩu</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{URL::to('/home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
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
                            <a class="active"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/ordered')}}"><i class="fa fa-shopping-cart"></i> Đơn Đặt Hàng</a>
                        </li>
                        <li>
                            <a href="{{URL::to('/show-voucher')}}"><i class="fa fa-ticket"></i> Kho voucher</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="tab-content my-account-tab mt-30" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-password">
                        <div class="my-account-address account-wrapper">
                            <div class="row">
                                <div class="col-md-12" style="border-bottom: solid 1px #efefef;">
                                    <h4 class="account-title" style="margin-bottom: 0;">Đổi Mật Khẩu</h4>
                                </div>
                                <form id="form-change-password">
                                    @csrf
                                    <div class="text-primary mt-2 alert-password"></div>
                                    <div class="col-md-12">
                                        <div class="account-address mt-30">
                                            <div class="form-group mb-30">
                                                <div class="input-group">
                                                    <input name="password" id="password" type="password" style="width: 170%" placeholder="Mật Khẩu Cũ">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                                                            <i class="fa fa-eye" id="eye-icon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-30">
                                                <div class="input-group">
                                                    <input name="newpassword" id="newpassword" type="password" style="width: 170%" placeholder="Mật Khẩu Mới">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary" id="toggle-newpassword">
                                                            <i class="fa fa-eye" id="eye-icon-newpassword"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-30">
                                                <div class="input-group">
                                                    <input name="renewpassword" id="renewpassword" type="password" style="width: 170%" placeholder="Nhập Lại Mật Khẩu">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary" id="toggle-renewpassword">
                                                            <i class="fa fa-eye" id="eye-icon-renewpassword"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="btn btn-primary change-password" type="submit" style="float: right;" value="Lưu">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--My Account End-->
<style>
    .input-group {
        position: relative;
    }

    #password {
        padding-right: 140px; 
    }

    #toggle-password {
        position: absolute;
        right: 10px; 
        top: 10%;
        transform: translateY(-50%);
        border: none;
        background: none;
        padding: 0;
        cursor: pointer;
        outline: none;
    }

    #toggle-newpassword {
        position: absolute;
        right: 10px; 
        top: 10%;
        transform: translateY(-50%);
        border: none;
        background: none;
        padding: 0;
        cursor: pointer;
        outline: none;
    }

    #toggle-renewpassword {
        position: absolute;
        right: 10px; 
        top: 10%;
        transform: translateY(-50%);
        border: none;
        background: none;
        padding: 0;
        cursor: pointer;
        outline: none;
    }
</style>
<script src="{{asset('public/kidolshop/js/jquery.validate.min.js')}}"></script>

<script>
    window.scrollBy(0, 300);

    $(document).ready(function() {
        $('.change-password').on('click', function() {
            $("#form-change-password").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    newpassword: {
                        required: true,
                        minlength: 8
                    },
                    renewpassword: {
                        required: true,
                        minlength: 8,
                        equalTo: "#newpassword"
                    }
                },

                messages: {
                    password: {
                        required: "Vui lòng nhập trường này",
                        minlength: "Nhập mật khẩu cũ tối thiểu 8 ký tự"
                    },
                    newpassword: {
                        required: "Vui lòng nhập trường này",
                        minlength: "Nhập mật khẩu mới tối thiểu 8 ký tự"
                    },
                    renewpassword: {
                        required: "Vui lòng nhập trường này",
                        minlength: "Nhập lại mật khẩu mới tối thiểu 8 ký tự",
                        equalTo: "Nhập lại mật khẩu không trùng khớp"
                    }
                },

                submitHandler: function(form) {
                    let formData = new FormData($('#form-change-password')[0]);

                    $.ajax({
                        url: APP_URL + '/submit-change-password',
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        cache: false,
                        data: formData,
                        success: function(data) {
                            Swal.fire({
                                title: 'Thay đổi mật khẩu thành công',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });

                            // Clear the input fields
                            $('#password').val("");
                            $('#newpassword').val("");
                            $('#renewpassword').val("");
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Thay đổi mật khẩu thất bại',
                                text: 'Đã xảy ra lỗi khi thay đổi mật khẩu. Vui lòng thử lại sau.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });

        $('#toggle-password').click(function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            var eyeIcon = $('#eye-icon');

            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#toggle-newpassword').click(function() {
            var repasswordField = $('#newpassword');
            var repasswordFieldType = repasswordField.attr('type');
            var eyeIconRepassword = $('#eye-icon-newpassword');

            if (repasswordFieldType === 'password') {
                repasswordField.attr('type', 'text');
                eyeIconRepassword.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                repasswordField.attr('type', 'password');
                eyeIconRepassword.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#toggle-renewpassword').click(function() {
            var repasswordField = $('#renewpassword');
            var repasswordFieldType = repasswordField.attr('type');
            var eyeIconRepassword = $('#eye-icon-renewpassword');

            if (repasswordFieldType === 'password') {
                repasswordField.attr('type', 'text');
                eyeIconRepassword.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                repasswordField.attr('type', 'password');
                eyeIconRepassword.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>


@endsection