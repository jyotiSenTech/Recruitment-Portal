<?php

namespace App\Http\Controllers;

use App\Models\master_district;
use App\Models\user_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $username = Session::get('sess_fname');
        $admin_pic = Session::get('admin_pic');
        $role = Session::get('sess_role');
        $district_id = Session::get('district_id');

        if ($role === "Admin") {

            $news_num = DB::table('post_master')->sum('Number_Post');

            $application_list = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.is_final_submit', '1')
                ->get();

            $application_count = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.is_final_submit', '1')
                ->count();

            $verified_count = DB::table('user_detail')
                ->where('Application_Status', 'Verified')
                ->count();

            $rejected_count = DB::table('user_detail')
                ->where('Application_Status', 'Rejected')
                ->count();
        } elseif ($role === "DPO") {

            $application_list = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.Pref_Districts', '=', $district_id)
                ->where('user_detail.is_final_submit', '1')
                ->get();

            $application_count = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                // ->where('user_detail.Pref_Districts', '=', $district_id)
                ->where('user_detail.is_final_submit', '1')
                ->count();

            $verified_count = DB::table('user_detail')
                ->where('Application_Status', 'Verified')
                // ->where('Pref_Districts', $district_id)
                ->count();

            $rejected_count = DB::table('user_detail')
                ->where('Application_Status', 'Rejected')
                // ->where('Pref_Districts', $district_id)
                ->count();
        }

        $data['news_num'] = $news_num ?? 0;
        $data['application_list'] = $application_list ?? [];
        $data['application_count'] = $application_count ?? 0;
        $data['verified_count'] = $verified_count ?? 0;
        $data['rejected_count'] = $rejected_count ?? 0;

        return view('admin/dashboard', compact('data'));
    }

    public function application_list($pref_dist = null)
    {
        $role = Session::get('sess_role');
        $district_id = Session::get('district_id');

        if ($role === "Admin") {
            if ($pref_dist) {
                $application_lists = DB::table('user_detail')
                    ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_edu_qualification.*')
                    ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                    // ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                    ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                    ->where('user_detail.Pref_Districts', '=', $pref_dist)
                    ->where('user_detail.is_final_submit', '1')
                    ->get();
            } else {
                $application_lists = DB::table('user_detail')
                    ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_edu_qualification.*')
                    ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                    // ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                    ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                    ->where('user_detail.is_final_submit', '1')
                    ->get();
            }
        } elseif ($role === "DPO") {
            $application_lists = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.Pref_Districts', '=', $district_id)
                ->where('user_detail.is_final_submit', '1')
                ->get();
        }

        return view('admin/application_list', compact('application_lists'));
    }

    public function verified_list($pref_dist = null)
    {
        $district_id = session()->get("district_id");
        $role = session()->get("sess_role");

        if ($role === 'DPO') {

            $verified_lists = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                // ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.Pref_Districts', '=', $pref_dist)
                ->where('user_detail.Application_Status', 'Verified')
                ->get();
        } elseif ($role === 'Admin') {

            if($pref_dist){
                $verified_lists = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name',  'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                // ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.Pref_Districts', '=', $pref_dist)
                ->where('user_detail.Application_Status', 'Verified')
                ->get();
            }else{
                $verified_lists = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name',  'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                // ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                // ->where('user_detail.Pref_Districts', '=', $pref_dist)
                ->where('user_detail.Application_Status', 'Verified')
                ->get();
            }
         
        }

        return view('admin/verified_list', compact('verified_lists'));
    }

    public function rejected_list($pref_dist = null)
    {
        $district_id = session()->get("district_id");
        $role = session()->get("sess_role");

        if ($role == 'DPO') {

            $rejected_lists =  DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.Pref_Districts', '=', $district_id)
                ->where('user_detail.Application_Status', 'Rejected')
                ->get();
        } else if ($role = 'Admin') {

            if($pref_dist){
                $rejected_lists =  DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                // ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.Pref_Districts', '=', $pref_dist)
                ->where('user_detail.Application_Status', 'Rejected')
                ->get();
            }else{
                $rejected_lists =  DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                // ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                // ->where('user_detail.Pref_Districts', '=', $pref_dist)
                ->where('user_detail.Application_Status', 'Rejected')
                ->get();
            }

           
        }

        return view('admin/rejected_list', compact('rejected_lists'));
    }

    public function view_application_detail($applicant_id = 0)
    {
        
        $applicant_details = DB::table('user_detail')
            ->select('user_detail.ID AS RowID', 'post_master.title', 'user_detail.*', 'user_master.*', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
            ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
            ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
            ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
            ->join('post_master', 'user_detail.Post_ID', '=', 'post_master.post_id')
            ->whereRaw("MD5(user_detail.ID) = '$applicant_id'")
            ->first();
        return view('admin/view_app_detail', compact('applicant_details'));
    }

    public function view_docs($applicant_id = 0)
    {
        $applicant_details = DB::table('user_detail')
            ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
            ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
            ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
            ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
            ->whereRaw("MD5(user_detail.ID) = '$applicant_id'")
            ->first();

        return view('/admin/view_docs', compact('applicant_details'));
    }

    public function merit_list()
    {
        $district_id = session()->get("district_id");
        $role = session()->get("sess_role");

        if ($role == 'DPO') {

            $merit_lists = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->where('user_detail.Pref_Districts', $district_id)
                ->where('user_detail.is_final_submit', '1')
                ->orderByDesc('user_detail.Test_Marks')
                ->get();
        } else if ($role = 'Admin') {

            $merit_lists = DB::table('user_detail')
                ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                // ->where('user_detail.Pref_Districts', 0)
                ->where('user_detail.is_final_submit', '1')
                ->orderByDesc('user_detail.Test_Marks')
                ->get();
        }

        return view('/admin/merit_list', compact('merit_lists'));
    }

    public function marks_entry(Request $request, $id = 0)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'marks' => 'required|array',
                'marks.*' => 'required|integer|min:0|max:20',
            ];

            $valid = $request->validate($rules);

            DB::beginTransaction();
            try {

                foreach ($request->id as $index => $id) {
                    $marks_data = user_detail::find($id);
                    if ($marks_data) {
                        // $marks_data->Test_Marks = $request->marks[$index];
                        // $marks_data_status = $marks_data->save();
                        $marks_data_status =  DB::table('user_detail')
                            ->where('ID', $id) // Identify the record to update based on the ID
                            ->update(['Test_Marks' => $request->marks[$index]]);
                    }
                }

                if ($marks_data_status) {

                    DB::commit();
                    return response()->json(['message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।", 'status' => 'success']);
                } else {

                    DB::rollBack();
                    return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
                }
            } catch (\Throwable $th) {

                dd($th->getMessage());
                print('An error occurred: ' . $th->getMessage());
                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } else {
            $district_id = session()->get("district_id");
            $role = session()->get("sess_role");

            if ($role == 'DPO') {

                $application_lists = DB::table('user_detail')
                    ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                    ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                    ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                    ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                    ->where('user_detail.Pref_Districts', '=', $district_id)
                    ->where('user_detail.is_final_submit', '1')
                    ->get();
            } else if ($role = 'Admin') {

                $application_lists = DB::table('user_detail')
                    ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'user_detail.Pref_Districts AS pref_district_name', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
                    ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                    ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
                    ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                    // ->where('user_detail.Pref_Districts', '=', 0)
                    ->where('user_detail.Application_Status', 'Verified')
                    ->where('user_detail.is_final_submit', '1')
                    ->get();
            }
            return view('admin/marks_entry', compact('application_lists'));
        }
    }

    public function applicationApproveReject(REQUEST $request)
    {
        $data = user_detail::where('ID', '=', $request['user_id'])->get();

        $data_update = user_detail::find($data[0]->ID);

        if ($request['button_status'] == 'Approve') {

            $data_update_status =  DB::table('user_detail')
                ->where('ID', $request['user_id']) // Identify the record to update based on the ID
                ->update(['Application_Status' => 'Verified']);
        } else {

            $data_update_status = DB::table('user_detail')
                ->where('ID', $request['user_id']) // Identify the record to update based on the ID
                ->update([
                    'Application_Status' => 'Rejected',
                    'Reason_Rejection' => $request->input('remark') // Add another column to update here
                ]);
        }

        // $data_update->Last_Updated_By = session()->get('sess_id');
        // $data_update->Last_Updated_On = now();
        if ($data_update_status) {
            return response()->json(
                [
                    "status" => 'success',
                ]
            );
        } else {
            return response()->json(
                [
                    "status" => 'failed',
                ]
            );
        }
    }

    public function district_wise_applications()
    {
        $district_id = session()->get("district_id");
        $role = session()->get("sess_role");

        if ($role == 'DPO') {

            $results = DB::table('user_detail')
                ->select('Pref_Districts', 'Application_Status', DB::raw('COUNT(Application_Status) as Status_Count'))
                ->where('user_detail.Pref_Districts', $district_id)
                ->groupBy('Pref_Districts', 'Application_Status')
                ->get();
        } else if ($role = 'Admin') {

            $results = DB::table('user_detail')
                ->select(
                    'Pref_Districts',
                    'district_master.name',
                    DB::raw('SUM(CASE WHEN Application_Status = "Submitted" THEN 1 ELSE 0 END) as submitted_count'),
                    DB::raw('SUM(CASE WHEN Application_Status = "Rejected" THEN 1 ELSE 0 END) as rejected_count'),
                    DB::raw('SUM(CASE WHEN Application_Status = "Verified" THEN 1 ELSE 0 END) as approved_count')
                )
                ->join('district_master', 'user_detail.Pref_Districts', '=', 'district_master.District_Code_LGD')
                ->where('user_detail.is_final_submit', '1')
                ->groupBy('Pref_Districts', 'district_master.name')
                ->get();
        }


        return view('/admin/district_wise_report', compact('results'));
    }
}
