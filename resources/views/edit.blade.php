@extends('layouts.admin_layout')
@section('title', 'Edit Inspection Report')
@section('content')
<div class="col-md-3"></div>
<div class="col-md-8" style="margin-top:2%;">

    <div class="row">
        @if (session('status'))
            {{ session('status') }}
        @endif
        <div class="col-lg-12">
            <h1 class="title">Edit Inspection Report</h1>
        </div>
        <hr noshade>
    </div>

    <div class="row">
        <div class="col-lg-12 mt-3 table-responsive">
            <table class="table table-hover table-sm bg-white">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อลูกค้า</th>
                        <th>เบอร์โทร</th>
                        <th>ยี่ห้อ</th>
                        <th>รุ่น</th>
                        <th>ประเภทการตรวจ</th>
                        <th>วันนัดตรวจรถ</th>
                        <th>เวลานัดตรวจรถ</th>
                        <th>Remark</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php  $TypeCh=array('0'=>'Full Inspection','1'=>'Warranty'); ?>

                    @foreach($data as $datas)
                    <tr>
                        <td>{{$datas->id}}</td>
                        <td>{{$datas->firstname}}</td>
                        <td>{{$datas->tel}}</td>
                        <td>{{$datas->name_brand}}</td>
                        <td>{{$datas->name_model}}</td>
                        <td>{{$TypeCh[$datas->inspectiontype]}}</td>
                        <td>{{date('d-m-Y', strtotime($datas->inspectiondate))}}</td>
                        <td>{{$datas->inspectiontime}}</td>
                        <td width="150px">{{$datas->remark}}</td>
                        <td width="40px" style="text-align: center; vertical-align: middle;">
                            <a href="{{route('report.show', $datas->id)}}" title="เพิ่มข้อมูลตรวจสภาพรถ"><button class="btn btn-success py-0 px-1"><i class="fa fa-plus"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">{{ $data->onEachSide(1)->links() }}</div>
        <div class="col-4"></div>
    </div>

</div>


@endsection
