@extends('layouts.admin_layout')
@section('title', 'Inspection Appointment')
@section('content')

<div class="col-md-2"></div>
<div class="col-md-9" style="margin-top:2%; margin-left:5%;">
{{-- {{$datas}} --}}
    <div class="row">
        @if (session('status'))
            {{ session('status') }}
        @endif
        <div class="col-12">
            <h3 class="title">ข้อมูลนัดตรวจรถ</h3>
        </div>
        <hr noshade>
        <div class="col-12">

            @foreach($datas as $data)

            {{-- <form action="" method='POST'> --}}

            <form action="{{ route('appointment.update',$data->id) }}" method='POST'>
                @method('PATCH')
                @csrf
                <div class="form-title">ข้อมูลลูกค้า</div>
                <div class="col-12 pt-lg-3 box-form">
                    <div class="form-group row">
                        <label class="col-lg-1" for="nameTitle">คำนำหน้า</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" name="nametitle" id="nameTitle" disabled>
                            <option>---  กรุณาเลือก  ---</option>
                            <option value="นาย" {{($data->nametitle ==='นาย') ? 'selected' : ''}}>นาย</option>
                            <option value="นาง" {{($data->nametitle ==='นาง') ? 'selected' : ''}}>นาง</option>
                            <option value="นางสาว" {{($data->nametitle ==='นางสาว') ? 'selected' : ''}}>นางสาว</option>
                            <option value="บริษัท" {{($data->nametitle ==='บริษัท') ? 'selected' : ''}}>บริษัท</option>
                            <option value="เต๊นท์" {{($data->nametitle ==='เต๊นท์') ? 'selected' : ''}}>เต็นท์</option>
                        </select>

                        <label class="col-lg-1" for="firstname">ชื่อ</label>
                        <input class="col-lg-3 form-control form-control-sm form-border" type="text" name="firstname" id="firstname" value="{{$data->firstname}}" disabled >

                        <label class="col-lg-1" for="lastname">นามสกุล</label>
                        <input class="col-lg-3 form-control form-control-sm form-border" type="text" name="lastname" id="lastname" value="{{$data->lastname}}" disabled>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-1" for="address">ที่อยู่</label>
                        <input class="col-lg-6 form-control form-control-sm form-border" type="text" name="address" id="address" value="{{$data->address}}" disabled>

                        <label class="col-lg-1" for="province">จังหวัด</label>
                        <select class="col-lg-3 form-control form-control-sm form-border" name="province" id="province" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->name_th }}</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="district">เขต/อำเภอ</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" type="text" name="district" id="district" value="{{$data->district}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->name_am }}</option>
                        </select>

                        <label class="col-lg-2" for="subDistrict">แขวง/ตำบล</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" type="text" name="subdistrict" id="subDistrict" value="{{$data->subdistrict}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->name_dis }}</option>
                        </select>

                        <label class="col-lg-2" for="postalCode">รหัสไปรษณีย์</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="postalcode" id="postalCode" value="{{$data->postalcode}}" disabled>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="idCard">เลขประจำตัวประชาชน</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="idcard" id="idCard" value="{{$data->idcard}}" disabled>

                        <label class="col-lg-2" for="tel">เบอร์โทรศัพท์</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="tel" id="tel" value="{{$data->tel}}" disabled>

                        <label class="col-lg-2" for="customerType">ประเภทสมาชิก</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" name="customertype" id="customerType" disabled>
                            <option>---  กรุณาเลือก  ---</option>
                            <option value="สมาชิกทั่วไป" {{($data->customertype ==='สมาชิกทั่วไป') ? 'selected' : ''}}>สมาชิกทั่วไป</option>
                            <option value="สมาชิกรูปแบบเต๊นท์" {{($data->customertype ==='สมาชิกรูปแบบเต๊นท์') ? 'selected' : ''}}>สมาชิกรูปแบบเต็นท์</option>
                        </select>
                    </div>
                </div>

                <div class="form-title mt-3 mt-lg-0">ข้อมูลรถ</div>
                <div class="col-12 pt-lg-3 box-form">
                    <div class="form-group row">
                        <label class="col-lg-1" for="carBrand">ยี่ห้อ</label>
                        <select class="col-lg-3 form-control form-control-sm form-border" name="carbrand" id="carBrand" value="{{$data->carbrand}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->name_brand }}</option>
                        </select>

                        <label class="col-lg-1" for="carModel">รุ่น</label>
                        <select class="col-lg-3 form-control form-control-sm form-border" type="text" name="carmodel" id="carModel" value="{{$data->carmodel}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->name_model }}</option>
                        </select>

                        <label class="col-lg-1" for="subModel">รุ่นย่อย</label>
                        <select class="col-lg-3 form-control form-control-sm form-border" type="text" name="submodel" id="subModel" value="{{$data->submodel}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->sub_model }}</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-1" for="oldColor">สีเดิม</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" name="oldcolor" id="oldColor" value="{{$data->oldcolor}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->color_b }}</option>
                        </select>

                        <label class="col-lg-1" for="newColor">สีปัจจุบัน</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" type="text" name="newcolor" id="newColor" value="{{$data->newcolor}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->color_n }}</option>
                        </select>

                        <label class="col-lg-1" for="year">ปี</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="year" id="year" value="{{$data->year}}" disabled>

                        <label class="col-lg-1 pr-0" for="seatNum">จำนวนที่นั่ง</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" type="text" name="seatnum" id="seatNum" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option value="2" {{($data->seatnum ==='2') ? 'selected' : ''}}>2</option>
                            <option value="4" {{($data->seatnum ==='4') ? 'selected' : ''}}>4</option>
                            <option value="5" {{($data->seatnum ==='5') ? 'selected' : ''}}>5</option>
                            <option value="5" {{($data->seatnum ==='6') ? 'selected' : ''}}>6</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="place">สถานที่ตรวจเช็ครถ</label>
                        <select class="col-lg-3 form-control form-control-sm form-border" name="place" id="place" value="{{$data->place}}" disabled>
                            <option value="ดับเบิ้ลยู สมาร์ท">ดับเบิ้ลยู สมาร์ท</option>
                        </select>

                        <label class="col-lg-2 pl-lg-5" for="registerType">ประเภทจดทะเบียน</label>
                        <div class="col-lg-4 btnCustom">
                            <input type="radio" name="registertype" id="registerType1" value="0" {{ $data->geartype == '0' ? 'checked' : ''}} disabled>
                            <label for="registerType1">รถยนต์ส่วนบุคคล</label>

                            <input type="radio" name="registertype" id="registerType2" value="1" {{ $data->geartype == '1' ? 'checked' : ''}} disabled>
                            <label for="registerType2">จดในนามบริษัท</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="carRegNum">ทะเบียนรถ</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="carregnum" id="carRegNum" value="{{$data->carregnum}}" disabled>

                        <label class="col-lg-2 pl-lg-5" for="mileage">เลขไมล์ปัจจุบัน</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="mileage" id="mileage" value="{{$data->mileage}}" disabled>

                        <label class="col-lg-2 pl-lg-5" for="dateRegister">วันที่จดทะเบียนรถ</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="date" name="dateregister" id="dateRegister" value="{{$data->dateregister}}" disabled>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="numOwners">จำนวนเจ้าของเดิม</label>
                        <input class="col-lg-1 form-control form-control-sm form-border" type="text" name="numowners" id="numOwners" value="{{$data->numowners}}" disabled>

                        <label class="col-lg-2" for="cc">ความจุเครื่องยนต์ (CC)</label>
                        <input class="col-lg-1 form-control form-control-sm form-border" type="text" name="cc" id="cc" value="{{$data->cc}}" disabled>

                        <label class="col-lg-1 pr-lg-1" for="gearType">ระบบเกียร์</label>
                        <div class="col-lg-4 btnCustom">
                            <input class="form-control" type="radio" name="geartype" id="gearType1" value="0" {{ $data->geartype == '0' ? 'checked' : ''}} disabled>
                            <label for="gearType1">เกียร์ธรรมดา</label>

                            <input type="radio" name="geartype" id="gearType2" value="1" {{ $data->geartype == '1' ? 'checked' : ''}} disabled>
                            <label for="gearType2">เกียร์อัตโนมัติ</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="engine">หมายเลขเครื่องยนต์</label>
                        <input class="col-lg-3 form-control form-control-sm form-border" type="text" name="engine" id="engine" value="{{$data->engine}}" disabled>

                        <label class="col-lg-2 pl-lg-5" for="vin">หมายเลขตัวถัง</label>
                        <input class="col-lg-3 form-control form-control-sm form-border" type="text" name="vin" id="vin" value="{{$data->vin}}" disabled>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="fuelType">ประเภทเชื้อเพลิง</label>
                        <div class="col-lg-10 btnCustom">
                            <input type="checkbox" name="benzine" id="benzine" value="1" {{ $data->benzine == '1' ? 'checked' : ''}} disabled>
                            <label for="benzine">เบนซิน</label>
                            <input type="checkbox" name="diesel" id="diesel" value="1" {{ $data->diesel == '1' ? 'checked' : ''}} disabled>
                            <label for="diesel">ดีเซล</label>
                            <input type="checkbox" name="hybrid" id="hybrid" value="1" {{ $data->hybrid == '1' ? 'checked' : ''}} disabled>
                            <label for="hybrid">ไฮบริด</label>
                            <input type="checkbox" name="electric" id="electric" value="1" {{ $data->electric == '1' ? 'checked' : ''}} disabled>
                            <label for="electric">ไฟฟ้า</label>
                            <input type="checkbox" name="lpg" id="lpg" value="1" {{ $data->lpg == '1' ? 'checked' : ''}} disabled>
                            <label for="lpg">LPG</label>
                            <input type="checkbox" name="ngv" id="ngv" value="1" {{ $data->ngv == '1' ? 'checked' : ''}} disabled>
                            <label for="ngv">NGV</label>
                            <input type="checkbox" name="cng" id="cng" value="1" {{ $data->cng == '1' ? 'checked' : ''}} disabled>
                            <label for="cng">CNG</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2" for="carInsurance">รถมีประกันหรือไม่</label>
                        <div class="col-lg-2 btnCustom">
                            <input type="radio" name="carinsurance" id="carInsurance1" value="0" {{ $data->carinsurance == '0' ? 'checked' : ''}} disabled>
                            <label for="carInsurance1">มี</label>
                            <input type="radio" name="carinsurance" id="carInsurance2" value="1" {{ $data->carinsurance == '1' ? 'checked' : ''}} disabled>
                            <label for="carInsurance2">ไม่มี</label>
                        </div>

                        <label class="col-lg-2" for="expInsurance">วันหมดอายุประกันภัย</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="date" name="expinsurance" id="expInsurance"  value="{{$data->expinsurance}}" disabled>

                        <label class="col-lg-2 pl-lg-5" for="insurance">บริษัทประกันภัย</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="insurance" id="insurance"  value="{{$data->insurance}}" disabled>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-1" for="tent">รถเต็นท์</label>
                        <div class="col-lg-2 btnCustom">
                            <input type="radio" name="tent" id="tent1" value="0" {{ $data->tent == '0' ? 'checked' : ''}} disabled>
                            <label for="tent1">ใช่</label>
                            <input type="radio" name="tent" id="tent2" value="1" {{ $data->tent == '0' ? 'checked' : ''}} disabled>
                            <label for="tent2">ไม่ใช่</label>
                        </div>

                        <label class="col-lg-1 pl-lg-0" for="fromTent">รถจากเต็นท์</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" name="fromtent" id="fromTent" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->dealer_name }}</option>
                        </select>

                        <label class="col-lg-1" for="price">ราคา</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="price" id="price"  value="{{$data->price}}" disabled>

                        <label class="col-lg-1 pr-lg-0" for="payment">ผ่อนงวดละ</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="text" name="payment" id="payment" value="{{$data->payment}}" disabled>
                    </div>
                </div>

                <div class="form-title mt-3 mt-lg-0">วันนัดตรวจรถ</div>
                <div class="col-12 pt-lg-3 box-form">
                    <div class="form-group row">
                        <label class="col-lg-2" for="inspectionType">ประเภทการตรวจสภาพ</label>
                        <select class="col-lg-2 form-control form-control-sm form-border" name="inspectiontype" id="inspectionType" disabled>
                            <option>---  กรุณาเลือก  ---</option>
                            <option value="0" {{($data->inspectiontype ==='0') ? 'selected' : ''}}>Full Inspection</option>
                            <option value="1" {{($data->inspectiontype ==='1') ? 'selected' : ''}}>Warranty</option>
                        </select>

                        <label class="col-lg-2 pl-lg-5" for="inspector">ช่างที่ไปตรวจรถ</label>
                        <select class="col-lg-3 form-control form-control-sm form-border" name="inspector" id="inspector" value="{{$data->inspector}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->name_tech }}</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2" for="inspectionDate">วันที่นัดตรวจรถ</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="date" name="inspectiondate" id="inspectionDate" value="{{$data->inspectiondate}}" disabled>

                        <label class="col-lg-2 pl-lg-5" for="inspectionTime">เวลาที่นัดตรวจรถ</label>
                        <input class="col-lg-2 form-control form-control-sm form-border" type="time" name="inspectiontime" id="inspectionTime" value="{{$data->inspectiontime}}" disabled>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-1" for="package">แพคเกจ</label>
                        <select class="col-lg-3 form-control form-control-sm form-border" name="package" id="package" value="{{$data->package}}" disabled>
                            {{-- <option>---  กรุณาเลือก  ---</option> --}}
                            <option>{{ $data->package_name }}</option>
                        </select>

                        <label class="col-lg-2 pl-lg-5" for="remark">Remark</label>
                        <textarea class="col-lg-5 form-control form-control-sm form-border" name="remark" id="remark" onKeyPress class="form-control" disabled>
                            {{$data->remark}}
                        </textarea>
                    </div>
                </div>

                <div class="col-12 pt-2 pt-lg-4 text-center">
                    <a href="{{ route('appointment.index')}}"> <button class="btn btn-danger" type="button"><i class="fa fa-times" aria-hidden="true"></i> ยกเลิก</button></a>
                </div>
            </form>

            @endforeach

            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
</div>
</div>
@endsection
