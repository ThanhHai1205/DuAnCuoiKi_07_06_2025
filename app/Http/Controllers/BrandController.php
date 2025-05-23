<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Brand;


class BrandController extends Controller
{
    /* ---------- Admin ---------- */

        // Kiểm tra đăng nhập
        public function checkLogin(){
            $idAdmin = Session::get('idAdmin');
            if($idAdmin == false) return Redirect::to('admin')->send();
        }

        // Kiểm tra chức vụ
        public function checkPostion(){
            $position = Session::get('Position');
            if($position === 'Nhân Viên') return Redirect::to('/my-adprofile')->send();
        }

        // Chuyển đến trang quản lý thương hiệu
        public function manage_brand(){
            $this->checkLogin();
            $this->checkPostion();
            $list_brand = Brand::get();
            $count_brand = Brand::count();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.brand.manage-brand")->with(compact('list_brand', 'count_brand','count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Chuyển đến trang thêm thương hiệu
        public function add_brand(){
            $this->checkLogin();
            $this->checkPostion();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.brand.add-brand")->with(compact('count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Chuyển đến trang sửa thương hiệu
        public function edit_brand($idBrand){
            $this->checkLogin();
            $this->checkPostion();
            $select_brand = Brand::where('idBrand', $idBrand)->first();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.brand.edit-brand")->with(compact('select_brand','count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Thêm thương hiệu
        public function submit_add_brand(Request $request){
            $data = $request->all();
            $brand = new Brand();
            
            $select_brand = Brand::where('BrandName', $data['BrandName'])->first();

            if($select_brand){
                return Redirect::to('add-brand')->with('error', 'Tên thương hiệu này đã tồn tại');
            }else{
                $brand->BrandName = $data['BrandName'];
                $brand->BrandSlug = $data['BrandSlug'];
                $brand->save();
                return Redirect::to('add-brand')->with('message', 'Thêm thương hiệu thành công');
            }
        }

        // Sửa thương hiệu
        public function submit_edit_brand(Request $request, $idBrand){
            $data = $request->all();
            $brand = Brand::find($idBrand);
            
            $select_brand = Brand::where('BrandName', $data['BrandName'])->whereNotIn('idBrand',[$idBrand])->first();

            if($select_brand){
                return redirect()->back()->with('error', 'Tên thương hiệu này đã tồn tại');
            }else{
                $brand->BrandName = $data['BrandName'];
                $brand->BrandSlug = $data['BrandSlug'];
                $brand->save();
                return redirect()->back()->with('message', 'Sửa thương hiệu thành công');
            }
        }

        // Xóa thương hiệu
        public function delete_brand($idBrand){
            Brand::where('idBrand', $idBrand)->delete();
            return redirect()->back();
        }


    /* ---------- End Admin ---------- */

    /* ---------- Shop ---------- */
    /* ---------- End Shop ---------- */

}
