<?php

namespace App\Http\Controllers;

use App\Models\education_detail;
use App\Models\experience_detail;
use App\Models\User;
use App\Models\user_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{
    public function dashboard()
    {

        $username = Session::get('sess_fname');
        $admin_pic = Session::get('admin_pic');
        $role = Session::get('sess_role');
        $district_id = Session::get('district_id');
        $appid = Session::get('sess_id');

        $application_list = DB::select("
        SELECT user_detail.Applicant_ID AS aid,
               user_detail.ID AS RowID,
               user_detail.*,
               user_master.*
            -- applicant_experience_details.*,
            --  applicant_edu_qualification.*
        FROM user_detail
         JOIN user_master ON user_master.ID=user_detail.Applicant_ID
         -- JOIN applicant_experience_details ON user_detail.ID=applicant_experience_details.Applicant_ID
         -- JOIN applicant_edu_qualification ON user_detail.ID=applicant_edu_qualification.Applicant_ID
        WHERE user_detail.Applicant_ID=?
    ", [$appid]);


        $application_count = count($application_list);

        $submitted_application = DB::select("
            SELECT COUNT(*) AS count
            FROM user_detail
            WHERE Applicant_ID = ? AND Application_Status = 'Submitted'", [$appid]);

        $verified_count = $submitted_application[0]->count;

        $ver_reject_application = DB::select("
            SELECT COUNT(*) AS count
            FROM user_detail
            WHERE Applicant_ID = ? AND (Application_Status = 'Verified' or Application_Status = 'Rejected')", [$appid]);


        $rejected_count = $ver_reject_application[0]->count;

        $data['application_list'] = $application_list ?? [];
        $data['application_count'] = $application_count ?? 0;
        $data['verified_count'] = $verified_count ?? 0;
        $data['rejected_count'] = $rejected_count ?? 0;

        return view('candidate/dashboard', compact('data'));
    }

    public function submitted_application_list()
    {

        $appid = Session::get('sess_id');

        $application_lists = DB::select("
        SELECT user_detail.Applicant_ID AS aid,
               user_detail.ID AS RowID,
               user_detail.*,
               user_master.*,
             --  applicant_experience_details.*,
               applicant_edu_qualification.*
        FROM user_detail
       JOIN user_master ON user_master.ID=user_detail.Applicant_ID
     --  JOIN applicant_experience_details ON user_detail.ID=applicant_experience_details.Applicant_ID
       JOIN applicant_edu_qualification ON user_detail.ID=applicant_edu_qualification.Applicant_ID
        WHERE user_master.ID=?
    ", [$appid]);

        return view('candidate/submitted_application_list', compact('application_lists'));
    }

    public function final_submit()
    {
        // Update query for final submit now not editable
        $sess = Session::get('sess_id');
        $RowID = $_POST['RowID'];
        $data['RowID'] = $RowID;

        // Update the status in the database
        DB::table('user_detail')
            ->where('ID', $RowID)
            ->update(['is_final_submit' => '1']);

        // Return a JSON response
        return response()->json(['message' => 'Data updated successfully']);
    }

    public function print_application($RowID)
    {
        $applicant_details = DB::table('user_detail')
            ->select('user_detail.ID AS RowID', 'user_detail.*', 'user_master.*', 'applicant_experience_details.*', 'applicant_edu_qualification.*')
            ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
            ->join('applicant_experience_details', 'user_detail.ID', '=', 'applicant_experience_details.Applicant_ID')
            ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
            ->whereRaw("user_detail.ID = '$RowID'")
            ->first();


        return view('candidate/application_print', compact('applicant_details'));
    }

    public function recruitment_list()
    {
        $schemes = DB::table('advertisement_master')->get();
        return view('candidate/recruitment_list', compact('schemes'));
    }

    public function user_register(Request $request, $appID)
    {
        if ($request->isMethod('post')) {
        } else {
            $data['eligibility'] =  DB::table('eligibility_criteria')
                ->whereRaw("md5(Advertisement_ID) = ?", [$appID])
                ->get();

            $data['valuation'] = DB::table('valuation_parameters')
                ->whereRaw("md5(Advertisement_ID) = ?", [$appID])
                ->get();

            $data['qualification'] = DB::table('qualification_master')
                ->select('qualification_master.Quali_ID', 'qualification_master.Quali_Name')
                ->join('eligibility_criteria', 'eligibility_criteria.Min_Qualification_ID', '=', 'qualification_master.Quali_ID')
                ->whereRaw("MD5(eligibility_criteria.Advertisement_ID) = ?", [$appID])
                ->get();

            $data['recruitment'] = DB::table('post_master')
                ->whereRaw("md5(Advertisement_ID) = ?", [$appID])
                ->get();

            $data['schemeid'] = DB::table('advertisement_master')
                ->select('Advertisement_ID')
                ->whereRaw("MD5(Advertisement_ID) = ?", [$appID])
                ->get();

            $data['cities'] = DB::select("SELECT District_Code_LGD, name FROM district_master");

            return view('candidate/user_application_form', compact('data'));
        }
    }

    public function user_register_awc(Request $request, $appID, $is_update = null)
    {
        $data['eligibility'] =  DB::table('eligibility_criteria')
            ->whereRaw("md5(Advertisement_ID) = ?", [$appID])
            ->get();

        $data['valuation'] = DB::table('valuation_parameters')
            ->whereRaw("md5(Advertisement_ID) = ?", [$appID])
            ->get();

        $data['qualification'] = DB::table('qualification_master')
            ->select('qualification_master.Quali_ID', 'qualification_master.Quali_Name')
            ->join('eligibility_criteria', 'eligibility_criteria.Min_Qualification_ID', '=', 'qualification_master.Quali_ID')
            ->whereRaw("MD5(eligibility_criteria.Advertisement_ID) = ?", [$appID])
            ->get();

        $data['recruitment'] = DB::table('post_master')
            ->whereRaw("md5(Advertisement_ID) = ?", [$appID])
            ->where('status', '=', 'Active')
            ->get();

        $data['schemeid'] = DB::table('advertisement_master')
            ->select('Advertisement_ID')
            ->whereRaw("MD5(Advertisement_ID) = ?", [$appID])
            ->get();

        $data['cities'] = DB::select("SELECT District_Code_LGD, name FROM district_master");

        if ($is_update == "update") {

            $data['applicant_details'] = DB::table('user_detail')
                ->select('ila_pariyojna.Project_Name', 'user_detail.ID AS RowID', 'post_master.title', 'user_detail.*', 'user_master.*', 'applicant_edu_qualification.*')
                ->join('user_master', 'user_master.ID', '=', 'user_detail.Applicant_ID')
                ->join('applicant_edu_qualification', 'user_detail.ID', '=', 'applicant_edu_qualification.Applicant_ID')
                ->join('post_master', 'user_detail.Post_ID', '=', 'post_master.post_id')
                ->leftJoin('ila_pariyojna', 'user_detail.project', '=', 'ila_pariyojna.Project_Code')
                ->leftJoin('final_cg_awc_tbl', 'user_detail.awc', '=', 'final_cg_awc_tbl.AWC_Code_11_Digit')
                ->whereRaw("user_detail.ID = '$appID'")
                ->first();

            $applicant_experience_details = DB::table('applicant_experience_details')
                ->where('Applicant_ID', $appID)
                ->get();

            // Step 3: Combine the Results
            $data['applicant_details']->experience_details = $applicant_experience_details;

            $data['recruitment'] = DB::table('post_master')
                ->whereRaw("Advertisement_ID = ?", [3])
                ->where('status', '=', 'Active')
                ->get();
        }

        return view('candidate/user_application_form_awc', compact('data'));
    }

    public function savePost(Request $request)
    {
        $rules = [
            'postname' => 'required',
            'district' => 'required',
        ];

        $valid = $request->validate($rules);

        if ($request['app_id']) {

            $checkApplicantDetail = user_detail::where('Contact_Number', session()->get('sess_mobile'))
                ->where('Post_ID', $request->input('postname'))
                ->first();

            if ($checkApplicantDetail && $checkApplicantDetail->ID != $request['app_id']) {
                return response()->json([
                    'message' => 'आप इस पद के लिए पहले ही आवेदन कर चुके हैं।',
                    'status' => 'error'
                ]);
            }
        } else {

            $checkApplicantDetail = user_detail::where('Contact_Number', session()->get('sess_mobile'))
                ->where('Post_ID', $request->input('postname'))
                ->first();

            // Check if a matching record is found
            if ($checkApplicantDetail) {
                // If a record is found, return a JSON response indicating that the user has already applied
                return response()->json([
                    'message' => 'आप इस पद के लिए पहले ही आवेदन कर चुके हैं।',
                    'status' => 'error'
                ]);
            }
        }

        DB::beginTransaction();
        try {

            if ($request['app_id']) {
                $applicant_data = user_detail::where('ID', $request['app_id'])->first();
                $applicant_data->Last_Updated_By = session()->get('uid');
                $applicant_data->Last_Updated_On = now();
            } else {
                $applicant_data = new user_detail();
                $applicant_data->Created_By = session()->get('uid');
                $applicant_data->Created_On = now();
            }

            $applicant_data->Post_ID = $request['postname'];
            $applicant_data->Applicant_ID = session()->get('sess_id');
            $applicant_data->Contact_Number = session()->get('sess_mobile');
            $applicant_data->Pref_Districts = $request['district'];
            $applicant_data->project = $request['project'];
            // $applicant_data->sector = $request['project_type'];
            $applicant_data->awc = $request['awc'];
            $applicant_data->IP_Address = $request->ip();
            $applicant_data_status = $applicant_data->save();
            if ($applicant_data_status) {

                DB::commit();
                return response()->json([
                    'message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।",
                    'status' => 'success',
                    'applicant_id' => $applicant_data->ID, // Assuming 'id' is the primary key of your project table
                ]);
            } else {

                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } catch (\Throwable $th) {

            print('An error occurred: ' . $th->getMessage());
            DB::rollBack();
            return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
        }
    }

    public function  saveAppDetail(Request $request)
    {

        $rules = [
            'First_Name' => 'required',
            'mothername' => 'required',
            'fathername' => 'required',
            'domicile_district' => 'required',
            'corr_addr' => 'required',
            'cur_district' => 'required',
            'pincode' => 'required|numeric|digits:6',
            'perm_addr' => 'required',
            'per_district' => 'required',
            'ppincode' => 'required|numeric|digits:6',
            'nationality' => 'required',
            'dob' => 'required',
            'mobile' => 'required|numeric|digits:10|regex:/^(\+1)?[2-9]\d{2}[2-9](?!11)\d{6}$/',
            'gender' => 'required',
            'caste' => 'required',
            'epic' => 'required',
        ];

        if ($request->input('email')) {
            $rules['email'] = 'email';
        }

        if ($request['app_id']) {
            $rules['adhaar'] = 'required|min:12';
        } else {
            $rules['adhaar'] = 'required|numeric|digits:12';
        }

        $valid = $request->validate($rules);

        DB::beginTransaction();
        try {

            if ($request['app_id']) {
                $applicantDetail = user_detail::where('ID', $request['app_id'])->first();
                $applicantDetail->Last_Updated_By = session()->get('uid');
                $applicantDetail->Last_Updated_On = now();
            } else {
                $applicantDetail = user_detail::where('ID', $request['applicant_id'])->first();
                $applicantDetail->Created_By = session()->get('uid');
                $applicantDetail->Created_On = now();
            }

            $masked_adhaar = substr_replace($request['adhaar'], str_repeat("X", 8), 0, 8);

            $applicantDetail->First_Name = $request['First_Name'];
            $applicantDetail->Middle_Name = $request['Middle_Name'];
            $applicantDetail->Last_Name = $request['Last_Name'];
            $applicantDetail->FatherName = $request['fathername'];
            $applicantDetail->MotherName = $request['mothername'];
            $applicantDetail->DOB = $request['dob'];
            $applicantDetail->Gender = $request['gender'];
            $applicantDetail->Contact_Number = $request['mobile'];
            $applicantDetail->Email = $request['email'];
            $applicantDetail->aadharno = $masked_adhaar;
            $applicantDetail->epicno = $request['epic'];
            $applicantDetail->Domicile_District_lgd = $request['domicile_district'];
            $applicantDetail->Corr_Address = $request['corr_addr'];
            $applicantDetail->Corr_District_lgd = $request['cur_district'];
            $applicantDetail->Corr_pincode = $request['pincode'];
            $applicantDetail->Perm_Address = $request['perm_addr'];
            $applicantDetail->Perm_District_lgd = $request['per_district'];
            $applicantDetail->Perm_pincode = $request['ppincode'];
            $applicantDetail->Caste = $request['caste'];
            $applicantDetail->Nationality = $request['nationality'];
            $applicantDetail->IP_Address = $request->ip();
            $applicantDetail_status = $applicantDetail->save();

            if ($applicantDetail_status) {

                DB::commit();
                return response()->json([
                    'message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।",
                    'status' => 'success',
                    'applicant_id' => $request['applicant_id'], // Assuming 'id' is the primary key of your project table
                ]);
            } else {

                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } catch (\Throwable $th) {

            print('An error occurred: ' . $th->getMessage());
            DB::rollBack();
            return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
        }
    }

    public function saveEducationDetail(Request $request)
    {
        $rules = [
            'year_passing_ssc' => 'required',
            'marks_obtained_ssc' => 'required',
            'marks_total_ssc' => 'required',
            'perc_ssc' => 'required',
            'school_ssc' => 'required',
            'inter_subject' => 'required',
            'year_passing_inter' => 'required',
            'marks_obtained_inter' => 'required',
            'marks_total_inter' => 'required',
            'perc_inter' => 'required',
            'school_inter' => 'required',
            'ug_subject' => 'required',
            'year_passing_ug' => 'required',
            'marks_obtained_ug' => 'required',
            'marks_total_ug' => 'required',
            'perc_ug' => 'required',
            'univ_ug' => 'required',
            'pg_subject' => 'required',
            'year_passing_pg' => 'required',
            'marks_obtained_pg' => 'required',
            'marks_total_pg' => 'required',
            'perc_pg' => 'required',
            'univ_pg' => 'required',

        ];

        $valid = $request->validate($rules);

        DB::beginTransaction();
        try {

            if ($request['app_id']) {
                $educationDetail = education_detail::where('Applicant_ID', $request['app_id'])->first();
                $educationDetail->Applicant_ID =  $request['app_id'];
                $educationDetail->Last_Updated_By = session()->get('uid');
                $educationDetail->Last_Updated_On = now();
            } else {
                $educationDetail = new education_detail();
                $educationDetail->Applicant_ID =  $request['applicant_id_tab3'];
                $educationDetail->Created_By = session()->get('uid');
                $educationDetail->Created_On = now();
            }

            $educationDetail->SSC = $request['ssc'];
            $educationDetail->School_Board_Name_10th = $request['school_ssc'];
            $educationDetail->SSC_Subject = $request['ssc_subject'];
            $educationDetail->Year_Passing_SSC = $request['year_passing_ssc'];
            $educationDetail->Marks_Obtained_10th = $request['marks_obtained_ssc'];
            $educationDetail->Marks_Total_10th = $request['marks_total_ssc'];
            $educationDetail->Perc_SSC = $request['perc_ssc'];
            $educationDetail->Inter = $request['inter'];
            $educationDetail->School_Board_Name_12th = $request['school_inter'];
            $educationDetail->Inter_Subject = $request['inter_subject'];
            $educationDetail->Year_Passing_Inter = $request['year_passing_inter'];
            $educationDetail->Marks_Obtained_12th = $request['marks_obtained_inter'];
            $educationDetail->Marks_Total_12th = $request['marks_total_inter'];
            $educationDetail->Perc_Inter = $request['perc_inter'];
            $educationDetail->UG = $request['ug'];
            $educationDetail->Year_Passing_UG =  $request['year_passing_ug'];
            $educationDetail->Graduation_University = $request['univ_ug'];
            $educationDetail->UG_Subject = $request['ug_subject'];
            $educationDetail->Graduation_Obtained_Marks = $request['marks_obtained_ug'];
            $educationDetail->Graduation_Total_Marks = $request['marks_total_ug'];
            $educationDetail->Perc_UG = $request['perc_ug'];
            $educationDetail->PG = $request['pg'];
            $educationDetail->PG_University = $request['univ_pg'];
            $educationDetail->PG_Subject = $request['pg_subject'];
            $educationDetail->Year_Passing_PG = $request['year_passing_pg'];
            $educationDetail->PG_Obtained_Marks = $request['marks_obtained_pg'];
            $educationDetail->PG_Total_Marks = $request['marks_total_pg'];
            $educationDetail->Perc_PG = $request['perc_pg'];
            $educationDetail->IP_Address = $request->ip();
            $educationDetail_status = $educationDetail->save();

            if ($educationDetail_status) {

                DB::commit();
                return response()->json([
                    'message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।",
                    'status' => 'success',
                    'applicant_id' => $request['applicant_id_tab3'], // Assuming 'id' is the primary key of your project table
                ]);
            } else {

                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } catch (\Throwable $th) {

            print('An error occurred: ' . $th->getMessage());
            DB::rollBack();
            return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
        }
    }

    public function saveExperienceDetail(Request $request)
    {

        $rules = [
            'marital' => 'required',
            'domicile' => 'required',
            'girlchild' => 'required',
            'below_pl' => 'required',
            'ecci' => 'required',
            'ncc' => 'required',
            // 'org_name' => 'required|array',
            'org_name.*' => 'required',
            'org_type' => 'required|array',
            'org_type.*' => 'required|string|in:Govt,NGO,SemiGovt',
            'desg_name' => 'required|array',
            'desg_name.*' => 'required|string',
            'nature_work' => 'required|array',
            'nature_work.*' => 'required|string',
            'date_from' => 'required|array',
            'date_from.*' => 'required|date',
            'date_to' => 'required|array',
            'date_to.*' => 'required|date|after_or_equal:date_from.*',
        ];

        $valid = $request->validate($rules);

        DB::beginTransaction();
        try {

            if ($request['app_id']) {
                $experienceDetail = user_detail::where('ID', $request['app_id'])->first();
                $experienceDetail->Last_Updated_By = session()->get('uid');
                $experienceDetail->Last_Updated_On = now();
            } else {

                $experienceDetail = user_detail::where('ID', $request['applicant_id_tab4'])->first();
                $experienceDetail->Created_By = session()->get('uid');
                $experienceDetail->Created_On = now();
            }

            $experienceDetail->Marital_Status = $request['marital'];
            $experienceDetail->domicile = $request['domicile'];
            $experienceDetail->girlchild = $request['girlchild'];
            $experienceDetail->belowpl = $request['below_pl'];
            $experienceDetail->ecci = $request['ecci'];
            $experienceDetail->ncc = $request['ncc'];
            $experienceDetail->speciality = $request['special'];
            $experienceDetail->IP_Address = $request->ip();
            $experienceDetail_status = $experienceDetail->save();

            if ($experienceDetail_status) {
                $entries = [];
                foreach ($request['org_name'] as $index => $orgName) {
                    $entries[] = [
                        'Applicant_ID' =>  $request['applicant_id_tab4'] ?? $request['app_id'],
                        'Organization_Name' => $request['org_name'][$index],
                        'Organization_Type' => $request['org_type'][$index] ?? null,
                        'NGO_No' => $request['ngo_no'][$index],
                        'Designation' => $request['desg_name'][$index],
                        'Date_From' => $request['date_from'][$index],
                        'Date_To' => $request['date_to'][$index],
                        'Nature_Of_Work' => $request['nature_work'][$index],
                        'Created_On' => now(),
                        'IP_Address' =>  $request->ip(),
                        'Created_By' => session()->get('uid'),

                    ];
                }

                $experienceDetail_appID = experience_detail::where('Applicant_ID', $request['app_id'])
                    ->get();

                foreach ($entries as $index => $entry) {

                    if (count($experienceDetail_appID) > 0) {
                        $experienceDetail = experience_detail::find($experienceDetail_appID[$index]->ID);
                        $experienceDetail_status1 = $experienceDetail->update($entry);
                    } else {

                        $experienceDetail_status1 = experience_detail::create($entry); // Use create instead of insert for mass assignment protection
                    }
                }
                if ($experienceDetail_status1) {

                    DB::commit();
                    return response()->json([
                        'message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।",
                        'status' => 'success',
                        'applicant_id' => $request['applicant_id_tab4'] // Assuming 'id' is the primary key of your project table
                    ]);
                } else {

                    DB::rollBack();
                    return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
                }
            }
        } catch (\Throwable $th) {

            print('An error occurred: ' . $th->getMessage());
            DB::rollBack();
            return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
        }
    }

    public function saveDocuments(Request $request)
    {

        if ($request['app_id']) {

            $applicantID = $request['app_id'];
            $applicantDetail = user_detail::where('ID', $request['app_id'])->first();
            $applicantDetail->Last_Updated_By = session()->get('uid');
            $applicantDetail->Last_Updated_On = now();
        } else {
            $applicantDetail = user_detail::where('ID', $request['applicant_id_tab5'])->first();
            $applicantID = $request['applicant_id_tab5'];

            $rules = [
                'document_photo' => 'required',
                'document_sign' => 'required',
                'document_adhaar' => 'required',
                'caste_certificate' => 'required',
                'domicile' => 'required',
                'ssc_marksheet' => 'required',
                'inter_marksheet' => 'required',
                'ug_marksheet' => 'required',
                'exp_document' => 'required',
            ];

            if ($applicantDetail->belowpl == "Yes") {
                $rules['bpl_marksheet'] = 'required';
            }

            if ($applicantDetail->Marital_Status == "divorced" || $applicantDetail->Marital_Status == "widow") {
                $rules['widow_certificate'] = 'required';
            }


            $valid = $request->validate($rules);
        }

        DB::beginTransaction();
        try {

            if (!empty($request->file('document_photo'))) {

                $file = $request->file('document_photo');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('document_photo')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Photo =  $uploadedfileName;
            }

            if (!empty($request->file('document_sign'))) {

                $file = $request->file('document_sign');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('document_sign')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Sign =  $uploadedfileName;
            }

            if (!empty($request->file('document_adhaar'))) {

                $file = $request->file('document_adhaar');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('document_adhaar')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Aadhar =  $uploadedfileName;
            }

            if (!empty($request->file('caste_certificate'))) {

                $file = $request->file('caste_certificate');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('caste_certificate')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' . $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Caste =  $uploadedfileName;
            }

            if (!empty($request->file('domicile'))) {

                $file = $request->file('domicile');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('domicile')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Domicile =  $uploadedfileName;
            }

            if (!empty($request->file('ssc_marksheet'))) {

                $file = $request->file('ssc_marksheet');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('ssc_marksheet')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_SSC =  $uploadedfileName;
            }

            if (!empty($request->file('inter_marksheet'))) {

                $file = $request->file('inter_marksheet');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('inter_marksheet')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Inter =  $uploadedfileName;
            }

            if (!empty($request->file('ug_marksheet'))) {

                $file = $request->file('ug_marksheet');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('ug_marksheet')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_UG =  $uploadedfileName;
            }

            if (!empty($request->file('bpl_marksheet'))) {

                $file = $request->file('bpl_marksheet');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('bpl_marksheet')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_BPL =  $uploadedfileName;
            }

            if (!empty($request->file('widow_certificate'))) {

                $file = $request->file('widow_certificate');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('widow_certificate')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' . $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Widow =  $uploadedfileName;
            }

            if (!empty($request->file('exp_document'))) {

                $file = $request->file('exp_document');

                // generate unique file name
                $uploadedfileName = 'file-' . time() . '.' . $request->file('exp_document')->getClientOriginalExtension();

                // Save the file to the storage directory and get the file path
                $file->move(public_path('/assets/user/applicant/doc/' .  $applicantID),  $uploadedfileName);

                // $projectDetail->admin_file_link = $filename;
                $applicantDetail->Document_Widow =  $uploadedfileName;
            }


            $applicantDetail_status = $applicantDetail->save();

            if ($applicantDetail_status) {

                DB::commit();
                return response()->json([
                    'message' => "डेटा सफलतापूर्वक दर्ज कर लिया गया हैं ।",
                    'status' => 'success',
                    'applicant_id' =>  $applicantID, // Assuming 'id' is the primary key of your project table
                ]);
            } else {

                DB::rollBack();
                return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
            }
        } catch (\Throwable $th) {

            print('An error occurred: ' . $th->getMessage());
            DB::rollBack();
            return response()->json(['message' => "कुछ त्रुटि हुई है।", 'status' => 'error']);
        }
    }

    public function add_user(Request $request, $id = 0)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required',
                'mob' => 'required',
                'dob' => 'required',

            ];

            $valid = $request->validate($rules);

            $checkMobile = User::where('Mobile_Number', $request['mob'])
                ->first();

            // Check if a matching record is found
            if ($checkMobile) {
                // If a record is found, return a JSON response indicating that the user has already applied
                return response()->json([
                    'message' => 'दर्ज किया गया मोबाइल नंबर पहले से मौजूद है |',
                    'status' => 'error'
                ]);
            }

            DB::beginTransaction();
            try {

                if ($request->input('button_clicked') == 'update') {
                } else {

                    $user_data = new User();

                    list($year, $month, $day) = explode('-', $request['dob']);

                    // Concatenate day, month, and year to create the password string
                    $password = $day . $month . $year;

                    // Hash the password using SHA-256 algorithm
                    $hashedPassword = hash('sha256',  $password);

                    $user_data->Role = 'Candidate';
                    $user_data->Applicant_ID = "";
                    $user_data->admin_district_id = "";
                    $user_data->project_id = "";
                    $user_data->sector_id = "";
                    $user_data->admin_pic = "";
                    $user_data->Created_By = "";
                    $user_data->Last_Updated_By = "";

                    $user_data->Full_Name = $request['name'];
                    $user_data->Mobile_Number = $request['mob'];
                    $user_data->Date_Of_Birth = $request['dob'];
                    $user_data->Password = $hashedPassword;
                    $user_data->IP_Address = $request->ip();
                    $user_data->Created_On = now();
                    $user_data_status = $user_data->save();
                }

                if ($user_data_status) {

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
            return view('user/add_user');
        }
    }
}
