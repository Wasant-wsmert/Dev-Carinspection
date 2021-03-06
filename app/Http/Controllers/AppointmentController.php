<?php

namespace App\Http\Controllers;
use App\add_inspection_custo;
use App\add_inspection_car;
use App\add_inspection_date;
use App\appointment;
use App\Province;
use App\district;
use App\subdistrict;
use App\package;
use App\color;
use App\brand;
use App\dealer;
use App\technician;
use App\cc;
use DB;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        // $data = add_inspection_custo::all();

        $data = DB::table('add_inspection_custos')
        ->select('add_inspection_custos.*','add_inspection_cars.*','add_inspection_dates.*','brands.*','models.*')
        ->join('add_inspection_cars','add_inspection_custos.id','=','add_inspection_cars.id')
        ->join('add_inspection_dates','add_inspection_custos.id','=','add_inspection_dates.id')
        ->join('brands','add_inspection_cars.carbrand','=','brands.id_brand')
        ->join('models','add_inspection_cars.carmodel','=','models.id_model')
        ->paginate(20);

        return view('appointment', compact('data'));
    }

    public function search() {

        // Sets the parameters from the get request to the variables.
        // $search = Request::get('search');
        $query=request('search');

        // Perform the query using Query Builder
        $data = DB::table('add_inspection_custos')
        ->select('add_inspection_custos.*','add_inspection_cars.*','add_inspection_dates.*',
                 'brands.*','models.*')

        ->join('add_inspection_cars', 'add_inspection_custos.id', '=', 'add_inspection_cars.id')
        ->join('add_inspection_dates', 'add_inspection_custos.id', '=', 'add_inspection_dates.id')
        ->join('brands','add_inspection_cars.carbrand','=','brands.id_brand')
        ->join('models','add_inspection_cars.carmodel','=','models.id_model')
        ->where('firstname', 'like' ,'%' . $query . '%')
        ->orwhere('idcard', 'like' ,'%' . $query . '%')
        ->orwhere('tel', 'like' ,'%' . $query . '%')
        ->orwhere('name_brand', 'like' ,'%' . $query . '%')
        ->orwhere('name_model', 'like' ,'%' . $query . '%')
        ->orwhere('inspectiondate', 'like' ,'%' . $query . '%')
        ->paginate(20);
        // dd($data);
        return view('appointment', compact('data'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $datas = DB::table('add_inspection_custos')
        ->select('add_inspection_custos.*','add_inspection_cars.*','add_inspection_dates.*',
                 'provinces.name_th','amphures.name_th as name_am','districts.name_th as name_dis',
                 'brands.name_brand','models.name_model','n.car_color as color_n','ccs.cc',
                 'sub_models.sub_model','b.car_color as color_b','dealers.dealer_name','packages.package_name',
                 'technicians.name_tech')

        ->join('add_inspection_cars', 'add_inspection_custos.id', '=', 'add_inspection_cars.id')
        ->join('add_inspection_dates', 'add_inspection_custos.id', '=', 'add_inspection_dates.id')
        ->join('provinces', 'add_inspection_custos.province', '=', 'provinces.id')
        ->join('amphures', 'add_inspection_custos.district', '=', 'amphures.id')
        ->join('districts', 'add_inspection_custos.subdistrict', '=', 'districts.id')
        ->join('brands','add_inspection_cars.carbrand','=','brands.id_brand')
        ->join('models','add_inspection_cars.carmodel','=','models.id_model')
        ->join('sub_models','add_inspection_cars.submodel','=','sub_models.id_sub_model')
        ->join('colors as b','add_inspection_cars.oldcolor','=','b.id_color')
        ->join('colors as n','add_inspection_cars.newcolor','=','n.id_color')
        ->join('ccs','add_inspection_cars.cc','=','ccs.id_cc')
        ->join('dealers','add_inspection_cars.fromtent','=','dealers.id_dealer')
        ->join('packages','add_inspection_dates.package','=','packages.id_package')
        ->join('technicians','add_inspection_dates.inspector','=','technicians.id')

        ->where('add_inspection_custos.id', '=', $id)
        ->groupBy('add_inspection_custos.id')
        ->get();

      return view('views_ins', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
            // $data = add_inspection_custo::find($id);
            // return view('edit_ins', compact('data'));

            $datas = DB::table('add_inspection_custos')
            ->select('add_inspection_custos.*','add_inspection_cars.*','add_inspection_dates.*',
                     'provinces.name_th','amphures.name_th as name_am','districts.name_th as name_dis',
                     'provinces.id as id_pro','amphures.id as id_am','districts.id as id_dis',
                     'brands.*','models.*','ccs.cc','b.id_color as id_b','n.id_color as id_n','sub_models.*','packages.*',
                     'technicians.*','dealers.*','b.car_color as n_b','n.car_color as n_n')

            ->join('add_inspection_cars', 'add_inspection_custos.id', '=', 'add_inspection_cars.id')
            ->join('add_inspection_dates', 'add_inspection_custos.id', '=', 'add_inspection_dates.id')
            ->join('provinces', 'add_inspection_custos.province', '=', 'provinces.id')
            ->join('amphures', 'add_inspection_custos.district', '=', 'amphures.id')
            ->join('districts', 'add_inspection_custos.subdistrict', '=', 'districts.id')
            ->join('brands','add_inspection_cars.carbrand','=','brands.id_brand')
            ->join('models','add_inspection_cars.carmodel','=','models.id_model')
            ->join('sub_models','add_inspection_cars.submodel','=','sub_models.id_sub_model')
            ->join('colors as b','add_inspection_cars.oldcolor','=','b.id_color')
            ->join('colors as n','add_inspection_cars.newcolor','=','n.id_color')
            ->join('ccs','add_inspection_cars.cc','=','ccs.id_cc')
            ->join('dealers','add_inspection_cars.fromtent','=','dealers.id_dealer')
            ->join('packages','add_inspection_dates.package','=','packages.id_package')
            ->join('technicians','add_inspection_dates.inspector','=','technicians.id')
            ->where('add_inspection_custos.id', '=', $id)
            ->groupBy('add_inspection_custos.id')
            ->get();

        // data cc
        $tech = technician::all()->sortBy("name_tech");
        // data cc
        $cc = cc::all()->sortBy("cc");
        // data dealer
        $dealer = dealer::all()->sortBy("dealer_name");
        // data brand
        $brand = brand::all()->sortBy("name_brand");
        // data color
        $col = color::all()->sortBy("car_color");
        // data package
        $pac = package::all()->sortBy("package_name");
        // data province
        $province = Province::all()->sortBy("name_th");
        // show data to add-inspection-appointment
        return view('edit_ins',compact('datas','province','pac','col','brand','dealer','cc','tech'));

        // return view('edit_ins', compact('datas','province'));
    }
    public function getdistrictList(Request $request)
    {
        $states = DB::table("amphures")
        ->where("province_id",$request->province_id)
        ->pluck("name_th","id");
        return response()->json($states);
    }
    public function getCityList(Request $request)
    {
        $cities = DB::table("districts")
        ->where("amphure_id",$request->amphure_id)
        ->pluck("name_th","id");
        return response()->json($cities);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // data customer
        $data = add_inspection_custo::find($id);
        $data->nametitle = $request->get('nametitle');
        $data->firstname = $request->get('firstname');
        $data->lastname = $request->get('lastname');
        $data->address = $request->get('address');
        $data->province = $request->get('province');
        $data->district = $request->get('district');
        $data->subdistrict = $request->get('subdistrict');
        $data->postalcode = $request->get('postalcode');
        $data->idcard = $request->get('idcard');
        $data->tel = $request->get('tel');
        $data->customertype = $request->get('customertype');

        $data->save();

        // data car
        $data = add_inspection_car::find($id);
        $data->carbrand = $request->get('carbrand');
        $data->carmodel = $request->get('carmodel');
        $data->submodel = $request->get('submodel');
        $data->oldcolor = $request->get('oldcolor');
        $data->newcolor = $request->get('newcolor');
        $data->year = $request->get('year');
        $data->seatnum = $request->get('seatnum');
        $data->place = $request->get('place');
        $data->registertype = $request->get('registertype');
        $data->carregnum = $request->get('carregnum');
        $data->mileage = $request->get('mileage');
        $data->dateregister = $request->get('dateregister');
        $data->numowners = $request->get('numowners');
        $data->cc = $request->get('cc');
        $data->geartype = $request->get('geartype');
        $data->engine = $request->get('engine');
        $data->vin = $request->get('vin');
        $data->benzine = $request->get('benzine');
        $data->diesel = $request->get('diesel');
        $data->hybrid = $request->get('hybrid');
        $data->electric = $request->get('electric');
        $data->lpg = $request->get('lpg');
        $data->ngv = $request->get('ngv');
        $data->cng = $request->get('cng');
        $data->carinsurance = $request->get('carinsurance');
        $data->expinsurance = $request->get('expinsurance');
        $data->insurance = $request->get('insurance');
        $data->tent = $request->get('tent');
        $data->fromtent = $request->get('fromtent');
        $data->price = $request->get('price');
        $data->payment = $request->get('payment');

        $data->save();

        // data date ,remark
        $data = add_inspection_date::find($id);
        $data->inspectiontype = $request->get('inspectiontype');
        $data->inspector = $request->get('inspector');
        $data->inspectiondate = $request->get('inspectiondate');
        $data->inspectiontime = $request->get('inspectiontime');
        $data->package = $request->get('package');
        $data->remark = $request->get('remark');

        $data->save();

        return redirect('appointment')->with('success', 'ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = add_inspection_custo::find($id);
        $data->delete();
        $data = add_inspection_car::find($id);
        $data->delete();
        $data = add_inspection_date::find($id);
        $data->delete();

        return redirect('appointment')->with('success', 'ได้ทำการลบข้อมูล เรียบร้อยแล้ว');
        //  echo $id;
    }


}
