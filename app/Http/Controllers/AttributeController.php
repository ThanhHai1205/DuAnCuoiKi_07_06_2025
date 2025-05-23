<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeController extends Controller
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

        // Chuyển đến trang quản lý nhóm phân loại
        public function manage_attribute(){
            $this->checkLogin();
            $this->checkPostion();
            $list_attribute = Attribute::get();
            $count_attribute = Attribute::count();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.product.product-attribute.attribute.manage-attribute")->with(compact('list_attribute', 'count_attribute','count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Chuyển đến trang thêm nhóm phân loại
        public function add_attribute(){
            $this->checkLogin();
            $this->checkPostion();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.product.product-attribute.attribute.add-attribute")->with(compact('count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Chuyển đến trang sửa nhóm phân loại
        public function edit_attribute($idAttribute){
            $this->checkLogin();
            $this->checkPostion();
            $select_attribute = Attribute::where('idAttribute', $idAttribute)->first();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.product.product-attribute.attribute.edit-attribute")->with(compact('select_attribute','count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Thêm nhóm phân loại
        public function submit_add_attribute(Request $request){
            $data = $request->all();
            $attribute = new Attribute();
            
            $select_attribute = Attribute::where('AttributeName', $data['AttributeName'])->first();

            if($select_attribute){
                return Redirect::to('add-attribute')->with('error', 'Tên nhóm phân loại này đã tồn tại');
            }else{
                $attribute->AttributeName = $data['AttributeName'];
                $attribute->save();
                return Redirect::to('add-attribute')->with('message', 'Thêm nhóm phân loại thành công');
            }
        }

        // Sửa nhóm phân loại
        public function submit_edit_attribute(Request $request, $idAttribute){
            $data = $request->all();
            $attribute = Attribute::find($idAttribute);
            
            $select_attribute = Attribute::where('AttributeName', $data['AttributeName'])->first();

            if($select_attribute){
                return redirect()->back()->with('error', 'Tên nhóm phân loại này đã tồn tại');
            }else{
                $attribute->AttributeName = $data['AttributeName'];
                $attribute->save();
                return redirect()->back()->with('message', 'Sửa nhóm phân loại thành công');
            }
        }

        // Xóa nhóm phân loại
        public function delete_attribute($idAttribute){
            Attribute::where('idAttribute', $idAttribute)->delete();
            return redirect()->back();
        }
        
        // Hiện checkbox chọn phân loại sản phẩm
        public function select_attribute(Request $request){
            $data = $request->all();

            if($data['action']){
                $output = '';
                if($data['action'] == "attribute"){
                    $list_attribute_val = AttributeValue::where('idAttribute',$data['idAttribute'])->get();
                    foreach($list_attribute_val as $key => $attribute_val){
                        $output .= '<label for="chk-attr-'.$attribute_val->idAttrValue.'" class="d-block col-lg-3 p-0 m-0"><div id="attr-name-'.$attribute_val->idAttrValue.'" class="select-attr text-center mr-2 mt-2">'.$attribute_val->AttrValName.'</div></label>
                        <input type="checkbox" class="checkstatus d-none chk_attr" id="chk-attr-'.$attribute_val->idAttrValue.'" data-id = "'.$attribute_val->idAttrValue.'" data-name = "'.$attribute_val->AttrValName.'" name="chk_attr[]" value="'.$attribute_val->idAttrValue.'">';
                    }
                }
            }
            echo $output;
        }

    /* ---------- End Admin ---------- */

    /* ---------- Shop ---------- */
    /* ---------- End Shop ---------- */
}
