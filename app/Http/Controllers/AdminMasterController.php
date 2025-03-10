<?php

namespace App\Http\Controllers;

use App\Models\master_awc;
use App\Models\master_district;
use App\Models\master_project;
use App\Models\master_sector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminMasterController extends Controller
{
    public function get_project(Request $request)
    {
        $dist_id = (@$request->dist_id && $request->dist_id) ? $request->dist_id : 0;
        $result = null;
        if ($request->ajax() && $dist_id) {
            $result = DB::select("SELECT * FROM `ila_pariyojna` WHERE D_Code= ?", [$dist_id]);
        }
        return response()->json($result);
    }

    public function get_sector(Request $request)
    {
        $pro_id = (@$request->pro_id && $request->pro_id) ? $request->pro_id : 0;
        $result = null;
        if ($request->ajax() && $pro_id) {
            $result = DB::select("SELECT * FROM `ila_sectors` WHERE Project_Code= ?", [$pro_id]);
        }
        return response()->json($result);
    }

    public function get_awc(Request $request)
    {
        $pro_id = (@$request->pro_id && $request->pro_id) ? $request->pro_id : 0;
        $dist_id = (@$request->dist_id && $request->dist_id) ? $request->dist_id : 0;

        $result = null;
        if ($request->ajax() && $pro_id) {
            $result = DB::select("SELECT * FROM `final_cg_awc_tbl` WHERE Project_Code_7_Digit= ? and District_LGD_Code =?", [$pro_id,$dist_id]);
        }
        return response()->json($result);
    }

    public function add_district(Request $request, $id = 0)
    {
        // if ($id) {
        // 	$data['editItem'] = $this->db->get_where('district_master', array('md5(District_Code_LGD)' => $id))->row_array();
        // } else {
        // 	$data['editItem'] = array();
        // }

        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required',
            ];

            $valid = $request->validate($rules);

            DB::beginTransaction();
            try {

                if ($request->input('button_clicked') == 'update') {
                } else {

                    $district_data = new master_district();

                    $district_data->name = $request['name'];
                    $district_data->Created_By = session()->get('sess_id');
                    $district_data->IP_Address = $request->ip();
                    $district_data->Created_On = now();
                    $district_data_status = $district_data->save();
                }

                if ($district_data_status) {

                    DB::commit();
                    return response()->json(['message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।", 'status' => 'success']);
                } else {

                    DB::rollBack();
                    return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
                }
            } catch (\Throwable $th) {

                print('An error occurred: ' . $th->getMessage());
                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } else {
            $district = DB::table('district_master')
                ->orderBy('District_Code_LGD', 'desc')
                ->get();

            return view('admin/add_district', compact('district'));
        }
    }

    public function add_project(Request $request, $id = 0)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'district' => 'required',
                'p_code' => 'required',
                'p_name' => 'required',

            ];

            $valid = $request->validate($rules);

            DB::beginTransaction();
            try {

                if ($request->input('button_clicked') == 'update') {
                } else {

                    $project_data = new master_project();

                    $project_data->Project_Name = $request['p_name'];
                    $project_data->Project_Code = $request['p_code'];
                    $project_data->D_Code = $request['district'];
                    $project_data_status = $project_data->save();
                }

                if ($project_data_status) {

                    DB::commit();
                    return response()->json(['message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।", 'status' => 'success']);
                } else {

                    DB::rollBack();
                    return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
                }
            } catch (\Throwable $th) {

                print('An error occurred: ' . $th->getMessage());
                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } else {
            $projects = DB::table('ila_pariyojna')
                ->leftJoin('district_master', 'ila_pariyojna.D_Code', '=', 'district_master.District_Code_LGD')
                ->get();

            return view('admin/add_project', compact('projects'));
        }
    }

    public function add_sector(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'district' => 'required',
                's_code' => 'required',
                's_name' => 'required',
                'project' => 'required',

            ];

            $valid = $request->validate($rules);

            DB::beginTransaction();
            try {

                if ($request->input('button_clicked') == 'update') {
                } else {

                    $sector_data = new master_sector();

                    $sector_data->Sec_Name = $request['s_name'];
                    $sector_data->Sector_Code = $request['s_code'];
                    $sector_data->Project_Code = $request['project'];
                    $sector_data->D_Code = $request['district'];
                    $sector_data_status = $sector_data->save();
                }

                if ($sector_data_status) {

                    DB::commit();
                    return response()->json(['message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।", 'status' => 'success']);
                } else {

                    DB::rollBack();
                    return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
                }
            } catch (\Throwable $th) {

                print('An error occurred: ' . $th->getMessage());
                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } else {
            $sectors = DB::table('ila_sectors')
                ->leftJoin('district_master', 'ila_sectors.D_Code', '=', 'district_master.District_Code_LGD')
                ->leftJoin('ila_pariyojna', 'ila_sectors.Project_Code', '=', 'ila_pariyojna.Project_Code')
                ->get();

            return view('admin/add_sector', compact('sectors'));
        }
    }

    public function add_awc(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'district' => 'required',
                'a_code' => 'required',
                'a_name' => 'required',
                's_code' => 'required',
                'project' => 'required',

            ];

            $valid = $request->validate($rules);

            DB::beginTransaction();
            try {

                if ($request->input('button_clicked') == 'update') {
                } else {

                    $awc_data = new master_awc();

                    $awc_data->District_LGD_Code = $request['district'];
                    $awc_data->Project_Code_7_Digit = $request['project'];
                    $awc_data->Sector_Code_9_Digit = $request['s_code'];
                    $awc_data->AWC_Code_11_Digit = $request['a_code'];
                    $awc_data->AWC_Name = $request['a_name'];
                    $awc_data_status = $awc_data->save();
                }

                if ($awc_data_status) {

                    DB::commit();
                    return response()->json(['message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।", 'status' => 'success']);
                } else {

                    DB::rollBack();
                    return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
                }
            } catch (\Throwable $th) {

                print('An error occurred: ' . $th->getMessage());
                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } else {
            $aganbaadi_list = DB::table('final_cg_awc_tbl')
                ->leftJoin('district_master', 'final_cg_awc_tbl.District_LGD_Code', '=', 'district_master.District_Code_LGD')
                ->leftJoin('ila_pariyojna', 'final_cg_awc_tbl.Project_Code_7_Digit', '=', 'ila_pariyojna.Project_Code')
                ->leftJoin('ila_sectors', 'final_cg_awc_tbl.Sector_Code_9_Digit', '=', 'ila_sectors.Sector_Code')
                ->get();

            return view('admin/add_awc', compact('aganbaadi_list'));
        }
    }
}
