<?php

namespace App\Http\Controllers;

use App\Models\tbl_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod("post")) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function validate_user(Request $request)
    {
        $status = 'failed';
        $redirct_url = "";
        $errors = null;
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required',
                'captcha' => 'required|captcha'
            ],
        );
        if ($validator->fails()) {
            $errors = $validator->errors();
            $msg = 'Validation error';
        }

        if ($errors == null) {

            $password = hash('sha256', $request->password);
            $userCheck = User::where('Mobile_Number', $request->username)
                ->where('Password', $password)
                ->get();
            // dd($userCheck);
            if ($userCheck->count() > 0) {

                // Session::start();

                $request->session()->put([
                    'sess_id' => $userCheck[0]->ID,
                    'uid' => $userCheck[0]->ID,
                    'sess_fname' => $userCheck[0]->Full_Name,
                    'sess_mobile' => $userCheck[0]->Mobile_Number,
                    'sess_role' => $userCheck[0]->Role,
                    'admin_pic' => $userCheck[0]->admin_pic,
                    'district_id' => $userCheck[0]->admin_district_id,
                ]);

                Session::save();

                $redirct_url = $this->role_wise_redirection($request);
                $status = 'success';
                $msg = 'Logged in successfully';
            } else {
                $msg = 'कृपया सही यूजर आईडी एवं पासवर्ड दर्ज करें ';
            }
        }

        if ($status == 'failed') {
            $captcha = (new CaptchaServiceController)->reloadCaptcha();
        }

        return response()->json(array('status' => $status, 'msg' => @$msg, 'errors' => $errors, 'captcha' => @$captcha->original['captcha'], 'url' => @$redirct_url));
    }

    private function role_wise_redirection($request)
    {

        // dd(Session::get('sess_role'));
        if ($request->session()->get('sess_role') == 'Candidate') {
            return '/candidate/candidate-dashboard';
        } else if ($request->session()->get('sess_role') == 'Admin' || $request->session()->get('sess_role') == 'DPO' || $request->session()->get('sess_role') == 'CDPO') {
            return '/admin/admin-dashboard';
        } else {
            return '/logout';
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/');
    }

    public function privacy()
    {
        return view("login/terms");
    }
}
