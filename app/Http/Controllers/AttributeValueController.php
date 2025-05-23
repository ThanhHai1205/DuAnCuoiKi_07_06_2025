<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
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

        // Chuyển đến trang quản lý phân loại
        public function manage_attr_value(){
            $this->checkLogin();
            $this->checkPostion();
            $list_attr_value = AttributeValue::join('attribute','attribute.idAttribute','=','attribute_value.idAttribute')->get();
            $count_attr_value = AttributeValue::count();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.product.product-attribute.attribute-value.manage-attr-value")->with(compact('list_attr_value', 'count_attr_value','count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Chuyển đến trang thêm phân loại
        public function add_attr_value(){
            $list_attribute = Attribute::get();
            $this->checkLogin();
            $this->checkPostion();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.product.product-attribute.attribute-value.add-attr-value")->with(compact('list_attribute','count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Chuyển đến trang sửa phân loại
        public function edit_attr_value($idAttrValue){
            $this->checkLogin();
            $this->checkPostion();
            $list_attribute = Attribute::get();
            $select_attr_value = AttributeValue::join('attribute','attribute.idAttribute','=','attribute_value.idAttribute')
                ->where('idAttrValue', $idAttrValue)->first();

            $count_waiting_bill = Bill::where('Status', '0')->count();
            $count_confirmed_bill = Bill::where('Status', '!=', '0')
                            ->where('Status', '!=', '99')
                            ->count();
            $count_shipping_bill = Bill::where('Status', '1')->count();
            $count_shipped_bill = Bill::where('Status', '2')->count();
            $count_cancelled_bill = Bill::where('Status', '99')->count();
            return view("admin.product.product-attribute.attribute-value.edit-attr-value")->with(compact('select_attr_value','list_attribute','count_waiting_bill', 'count_confirmed_bill', 'count_shipping_bill', 'count_shipped_bill', 'count_cancelled_bill'));
        }

        // Thêm phân loại
        public function submit_add_attr_value(Request $request){
            $data = $request->all();
            $attr_value = new AttributeValue();
            
            $select_attr_value = AttributeValue::where('idAttribute', $data['idAttribute'])
                ->where('AttrValName', $data['AttrValName'])->first();

            if($select_attr_value){
                return redirect()->back()->with('error', 'Tên phân loại này đã tồn tại');
            }else{
                $attr_value->AttrValName = $data['AttrValName'];
                $attr_value->idAttribute = $data['idAttribute'];
                $attr_value->save();
                return redirect()->back()->with('message', 'Thêm phân loại thành công');
            }
        }

        // Sửa phân loại
        public function submit_edit_attr_value(Request $request, $idAttrValue){
            $data = $request->all();
            $attr_value = AttributeValue::find($idAttrValue);
            
            $select_attr_value = AttributeValue::where('idAttribute', $data['idAttribute'])
                ->where('AttrValName', $data['AttrValName'])->first();

            if($select_attr_value){
                return redirect()->back()->with('error', 'Tên phân loại này đã tồn tại');
            }else{
                $attr_value->AttrValName = $data['AttrValName'];
                $attr_value->idAttribute = $data['idAttribute'];
                $attr_value->save();
                return redirect()->back()->with('message', 'Sửa phân loại thành công');
            }
        }

        // Xóa phân loại
        public function delete_attr_value($idAttrValue){
            AttributeValue::where('idAttrValue', $idAttrValue)->delete();
            return redirect()->back();
        }

    /* ---------- End Admin ---------- */

    /* ---------- Shop ---------- */
    /* ---------- End Shop ---------- */
}
