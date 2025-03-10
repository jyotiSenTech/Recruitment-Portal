@extends('layouts.dahboard_layout')
@section('styles')
<style>
    .myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

    label {
        font-size: 14px;
    }
</style>
@endsection
@section('body-page')
<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="row">
                <div class="col-md-2 grid-margin stretch-card" style="padding: 0px !important;">
                    <button style="width: 100%; border-radius :15px;" id="post-btn" type="button" class="btn btn-success btn-sm btn-icon-text add-app-btn">
                        Post Selection
                    </button>
                </div>
                <div class="col-md-2 grid-margin stretch-card" style="padding: 0px !important;">
                    <button <?php echo (isset($data['applicant_details'])) ? '' : 'disabled'; ?> id="personal-details-btn" style="width: 100%; border-radius : 15px;" type="button" class="btn btn-primary btn-sm btn-icon-text add-app-btn">
                        व्यक्तिगत जानकारी
                    </button>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="padding: 0px !important;">
                    <button <?php echo (isset($data['applicant_details'])) ? '' : 'disabled'; ?> id="edu-info-btn" style="width: 100%; border-radius :15px;" type="button" class="btn btn-primary btn-sm btn-icon-text add-app-btn">
                        शैक्षणिक योग्यता
                    </button>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="padding: 0px !important;">
                    <button <?php echo (isset($data['applicant_details'])) ? '' : 'disabled'; ?> id="exp-info-btn" style="width: 100%; border-radius :15px;" type="button" class="btn btn-primary btn-sm btn-icon-text add-app-btn">
                        अनुभव एवं अन्य जानकारी
                    </button>
                </div>
                <div class="col-md-2 grid-margiaidn stretch-card" style="padding: 0px !important;">
                    <button <?php echo (isset($data['applicant_details'])) ? '' : 'disabled'; ?> id="attachmnet-btn" style="width: 100%; border-radius :15px;" type="button" class="btn btn-primary btn-sm btn-icon-text add-app-btn">
                        दस्तावेज अपलोड
                    </button>
                </div>
            </div><br>

            <div class="card" id="tab1">
                <div class="row container">
                    <form id="myForm1" action="{{ url('/candidate/save-post') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="app_id" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->ID : '' }}" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12"><br>
                                    <label style="color:red"><b>Important Note:</b></label><br>
                                    <label><i class="bi bi-arrow-right"></i> आवेदन करने से पूर्व विज्ञप्ति को ध्यान पूर्वक पढ़ें |</label>
                                    <label><i class="bi bi-arrow-right"></i> आवेदन फॉर्म को 5 भागो में भरा जाना है Post Selection, व्यक्तिगत जानकारी, शैक्षणिक योग्यता, अनुभव एवं अन्य जानकारी, दस्तावेज अपलोड | प्रत्येक भाग को भरने के पश्चात Next बटन क्लिक करना है |</label>
                                    <label><i class="bi bi-arrow-right"></i> <label style="color:red">*</label> मार्क किये हुए जानकारी को भरना अनिवार्य है |</label>
                                    <label><i class="bi bi-arrow-right"></i> आवेदन करते समय स्कैन किये हुए फोटो एवं हस्ताक्षर JPG/PNG फॉर्मेट में अपलोड करना होगा एवं उनका साइज़ 50 KB से अधिक नहीं होना चाहिए |</label>
                                    <label><i class="bi bi-arrow-right"></i> एक बार आवेदन करने के पश्चात् नियुक्ति की प्रक्रिया के किसी भी स्तर में पृथक से अन्य कोई दस्तावेज स्वीकृत नहीं किये जायेंगे एवं दस्तावेजों की हार्ड कॉपी आवेदन फॉर्म के प्रिंट के साथ विज्ञप्ति में उल्लेखित कार्यालय में जमा करना होगा |</label>
                                    <label><i class="bi bi-arrow-right"></i> आवेदन करते समय अपने सारे दस्तावेज (10th,12th,UG,PG Marksheets एवं Experience Certificates ) अपने पास रखें ताकि फॉर्म भरते समय कोई जानकारी के लिए आपको असुविधा ना हो |</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6"><br>
                                        <label for="postname">पद सेलेक्ट करें </label><label style="color:red">*</label>
                                        <select class="form-select" name="postname" id="postname" onchange="select_district()">
                                            <option selected disabled value="undefined">--चुनें--</option>
                                            <?php foreach ($data['recruitment'] as $value_rc) { ?>
                                                <option value="{{ $value_rc->post_id }}" {{ !empty($data['applicant_details']) && $data['applicant_details']->Post_ID == $value_rc->post_id ? 'selected' : '' }}>
                                                    {{ $value_rc->title }}
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="city" id="labelcity">जिले का चयन करें </label><label style="color:red">*</label>
                                        <select class="form-select" name="district" id="district">
                                            <option selected disabled value="undefined">-- Select --</option>
                                            @if(!empty($data['cities']))
                                            @foreach ($data['cities'] as $district)
                                            <option value="{{ $district->District_Code_LGD }}" {{ !empty($data['applicant_details']) && $data['applicant_details']->Pref_Districts == $district->District_Code_LGD ? 'selected' : '' }}>{{ $district->name }}</option>
                                            @endforeach
                                            @else
                                            <option> डेटा उपलब्ध नहीं है</option>
                                            @endif
                                        </select>
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="city" id="labelcity">परियोजना / Project </label>
                                        <select class="form-select" id="project" name="project">
                                            <option selected disabled value="undefined">--चुनें--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6"><br>
                                        <label for="city" id="labelcity">आंगनबाड़ी केंद्र / AWC </label>
                                        <select id="awc" class="form-select" name="awc">
                                            <option selected disabled value="undefined">--चुनें--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button style="float: right;" class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Save & Next</button>
                            </div>
                        </div><br>
                    </form>
                </div>
            </div>

            <div class="card" id="tab2" style="display: none;">
                <div class="row container"><br>
                    <form id="myForm2" action="{{url('/candidate/save-applicant-detail')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applicant_id" id="applicant_id">
                        <input type="hidden" name="app_id" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->ID : '' }}" />
                        <div class="row">
                            <div class="col-md-4 col-xs-12 text-left"><br>
                                <label for="fname">आवेदक का प्रथम नाम/First Name</label><label style="color:red">*</label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->First_Name : '' }}" id="fname" class="form-control" name="First_Name" placeholder="आवेदक का प्रथम नाम दर्ज करें">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left"><br>
                                <label for="mname">मध्य नाम/Middle Name </label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Middle_Name : '' }}" id="mname" class="form-control" name="Middle_Name" placeholder="आवेदक का मध्य नाम दर्ज करें">
                            </div>
                            <div class="col-md-4 col-xs-12 text-left"><br>
                                <label for="lname">अंतिम नाम/Last Name</label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Last_Name : '' }}" id="lname" class="form-control" name="Last_Name" placeholder="आवेदक का अंतिम नाम दर्ज करें">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="mothername">माता का नाम/Mother's Name</label><label style="color:red">*</label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->MotherName : '' }}" id="mothername" class="form-control" name="mothername" placeholder="माता का नाम दर्ज करें">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="fathername">पिता/पति का नाम/Father/Husband Name </label><label style="color:red">*</label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->FatherName : '' }}" id="fathername" class="form-control" name="fathername" placeholder="पिता/पति का नाम दर्ज करें">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="cities">मूल निवासी जिला/ Domicile District </label><label style="color:red">*</label>
                                <select class="form-select" name="domicile_district" id="domicile_district">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    @if(!empty($data['cities']))
                                    @foreach ($data['cities'] as $district)
                                    <option value="{{ $district->District_Code_LGD }}" {{ !empty($data['applicant_details']) && $data['applicant_details']->Domicile_District_lgd == $district->District_Code_LGD ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                    @else
                                    <option> डेटा उपलब्ध नहीं है</option>
                                    @endif
                                </select>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="paddr">वर्तमान पता/Current Address </label><label style="color:red">*</label>
                                <textarea rows="5" id="caddr" class="form-control" name="corr_addr" style="resize: none;" placeholder="वर्तमान पता दर्ज करें">{{ isset($data['applicant_details']) ? $data['applicant_details']->Corr_Address : '' }}</textarea>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="cities">वर्तमान निवासी जिला/Current District </label><label style="color:red">*</label>
                                <select class="form-select" name="cur_district" id="cur_district">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    @if(!empty($data['cities']))
                                    @foreach ($data['cities'] as $district)
                                    <option value="{{ $district->District_Code_LGD }}" {{ !empty($data['applicant_details']) && $data['applicant_details']->Corr_District_lgd == $district->District_Code_LGD ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                    @else
                                    <option> डेटा उपलब्ध नहीं है</option>
                                    @endif
                                </select>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="pincode">वर्तमान पिन कोड/Current Pincode</label><label style="color:red">*</label>
                                <input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Corr_pincode : '' }}" class="form-control" id="cpincode" name="pincode" maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="वर्तमान पिन कोड दर्ज करें">
                                <div id="pincode-error" class="invalid-feedback">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group formField">
                                <div class="col-md-4 col-xs-12 text-left">
                                    <br>
                                    <!-- <input type="checkbox" id="same" onchange="address()" name="same"> <strong>स्थायी पता व वर्तमान पता एक है</strong> -->
                                    <input type="checkbox" id="same" name="same"> <strong>स्थायी पता व वर्तमान पता एक है?</strong>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="paddr">स्थायी पता/Permanent Address </label><label style="color:red">*</label>
                                <textarea rows="5" id="paddr" class="form-control" name="perm_addr" style="resize: none;" placeholder="स्थायी पता दर्ज करें">{{ isset($data['applicant_details']) ? $data['applicant_details']->Perm_Address : '' }}</textarea>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="cities">स्थायी निवासी जिला/Permanent District </label><label style="color:red">*</label>
                                <select class="form-select" name="per_district" id="per_district">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    @if(!empty($data['cities']))
                                    @foreach ($data['cities'] as $district)
                                    <option value="{{ $district->District_Code_LGD }}" {{ !empty($data['applicant_details']) && $data['applicant_details']->Perm_District_lgd == $district->District_Code_LGD ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                    @else
                                    <option> डेटा उपलब्ध नहीं है</option>
                                    @endif
                                </select>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="pincode">स्थायी पिन कोड/Pincode</label><label style="color:red">*</label>
                                <input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Perm_pincode : '' }}" class="form-control" id="ppincode" name="ppincode" maxlength="6" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="स्थायी पिन कोड दर्ज करें">
                                <div id="ppincode-error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-12 col-xw-12'>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="nationality">राष्ट्रीयता/Nationality </label><label style="color:red">*</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="Indian" required readonly>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="dob">जन्मतिथि/Date of Birth </label><label style="color:red">*</label>
                                <input type="date" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->DOB : '' }}" id="dob" class="form-control" name="dob">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="mobile">मोबाइल नंबर/Mobile Number</label><label style="color:red">*</label>
                                <input type="number"  class="form-control" value="{{session()->get('sess_mobile')}}" id="mobile" name="mobile" placeholder="मोबाइल नंबर दर्ज करें" readonly>
                                <div id="mobile-error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="email">ई-मेल आई. डी./Email ID</label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Email : '' }}" id="email" class="form-control" name="email" placeholder="ई-मेल आई.डी. दर्ज करें">
                                <div id="email-error" class="invalid-feedback">
                                    Enter Valid Email ID <br>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-3">
                                <label for="gender">लिंग/Gender </label><label style="color:red">*</label>&nbsp;
                                <select id="gender" class="form-select" name="gender">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    <option value="male" {{ isset($data['applicant_details']) && $data['applicant_details']->Gender == 'male' ? 'selected' : '' }}>पुरुष (Male)</option>
                                    <option value="female" {{ isset($data['applicant_details']) && $data['applicant_details']->Gender == 'female' ? 'selected' : '' }}>महिला (Female)</option>
                                    <option value="other" {{ isset($data['applicant_details']) && $data['applicant_details']->Gender == 'other' ? 'selected' : '' }}>अन्य (Other)</option>
                                </select>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3  text-left">
                                <label for="caste">वर्ग/Category</label><label style="color:red">*</label>&nbsp;
                                <select id="caste" class="form-select" name="caste">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    <option value="UR" {{ isset($data['applicant_details']) && $data['applicant_details']->Caste == 'UR' ? 'selected' : '' }}>UR</option>
                                    <option value="OBC" {{ isset($data['applicant_details']) && $data['applicant_details']->Caste == 'OBC' ? 'selected' : '' }}>OBC</option>
                                    <option value="SC" {{ isset($data['applicant_details']) && $data['applicant_details']->Caste == 'SC' ? 'selected' : '' }}>SC</option>
                                    <option value="ST" {{ isset($data['applicant_details']) && $data['applicant_details']->Caste == 'ST' ? 'selected' : '' }}>ST</option>
                                </select>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="mobile">आधार नंबर/AADHAR Number</label><label style="color:red">*</label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->aadharno : '' }}" class="form-control" id="adhaar" name="adhaar" maxlength="12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="आधार नंबर दर्ज करें">
                                <div id="adhaar-error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="mobile">इपिक नंबर/EPIC Number</label><label style="color:red">*</label>
                                <input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->epicno : '' }}" class="form-control" id="epic" name="epic" placeholder="इपिक नंबर दर्ज करें">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                        </div><br>
                        <button style="float: right;" type="submit" class="btn btn-primary nextBtn btn-lg pull-right">Save & Next</button>
                    </form>
                </div><br>
            </div>

            <div class="card" id="tab3" style="display: none;">
                <div class="row"><br>
                    <form id="myForm3" action="{{url('/candidate/save-education-detail')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applicant_id_tab3" id="applicant_id_tab3">
                        <input type="hidden" name="app_id" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->ID : '' }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive table-bordered">
                                    <tr>
                                        <th>क्र.</th>
                                        <th style="width: 15%;">उत्तीर्ण परीक्षा</th>
                                        <th style="width: 17%;">विषय<label style="color:red">*</label></th>
                                        <th style="width: 12%;">वर्ष<label style="color:red">*</label></th>
                                        <th>प्राप्तांक<label style="color:red">*</label></th>
                                        <th>पूर्णांक<label style="color:red">*</label></th>
                                        <th>प्रतिशत</th>
                                        <th>बोर्ड/विश्वविद्यालय का नाम<label style="color:red">*</label></th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" name="ssc" class="form-control" value="10th" readonly></td>
                                        <td>
                                            <select class="form-select" name="ssc_subject">
                                                <option value="Common">Common</option>
                                            </select>
                                        </td>
                                        <td><select name="year_passing_ssc" class="form-select">
                                                <?php
                                                for ($i = 1988; $i <= 2018; $i++) {
                                                ?>
                                                    <option value="<?= $i ?>" {{ !empty($data['applicant_details']) && $data['applicant_details']->Year_Passing_SSC == $i ? 'selected' : '' }}><?= $i ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select></td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Marks_Obtained_10th : '' }}" name="marks_obtained_ssc" id="marks_obtained_ssc" class="form-control" oninput="calc_ssc_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Marks_Total_10th : '' }}" name="marks_total_ssc" id="marks_total_ssc" class="form-control" oninput="calc_ssc_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Perc_SSC : '' }}" name="perc_ssc" id="ssc_percentage" class="form-control" readonly>
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->School_Board_Name_10th : '' }}" name="school_ssc" class="form-control">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" name="inter" class="form-control" value="12th" readonly></td>
                                        <td>
                                            <select class="form-select" name="inter_subject">
                                                <option value="PCM" {{ !empty($data['applicant_details']) && $data['applicant_details']->Inter_Subject == "PCM" ? 'selected' : '' }}>PCM</option>
                                                <option value="PCB" {{ !empty($data['applicant_details']) && $data['applicant_details']->Inter_Subject == "PCB" ? 'selected' : '' }}>PCB</option>
                                                <option value="Commerce" {{ !empty($data['applicant_details']) && $data['applicant_details']->Inter_Subject == "Commerce" ? 'selected' : '' }}>Commerce</option>
                                                <option value="Arts" {{ !empty($data['applicant_details']) && $data['applicant_details']->Inter_Subject == "Arts" ? 'selected' : '' }}>Arts</option>
                                            </select>
                                        <td>
                                            <select name="year_passing_inter" class="form-select">
                                                <?php
                                                for ($i = 1988; $i <= 2018; $i++) {
                                                ?>
                                                    <option value="<?= $i ?>" {{ !empty($data['applicant_details']) && $data['applicant_details']->Year_Passing_Inter == $i ? 'selected' : '' }}><?= $i ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Marks_Obtained_12th : '' }}" name="marks_obtained_inter" id="marks_obtained_inter" class="form-control" oninput="calc_inter_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Marks_Total_12th : '' }}" name="marks_total_inter" id="marks_total_inter" class="form-control" oninput="calc_inter_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Perc_Inter : '' }}" name="perc_inter" id="perc_inter" class="form-control" readonly>
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->School_Board_Name_12th : '' }}" name="school_inter" class="form-control">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="ug">
                                        <td>3</td>
                                        <td><input type="text" name="ug" class="form-control" value="UG (स्नातक)" readonly></td>
                                        <td>
                                            <select class="form-select" name="ug_subject" id="ug">
                                                <option value="101" {{ !empty($data['applicant_details']) && $data['applicant_details']->UG_Subject == "101" ? 'selected' : '' }}>समाज विज्ञान</option>
                                                <option value="102" {{ !empty($data['applicant_details']) && $data['applicant_details']->UG_Subject == "102" ? 'selected' : '' }}>समाजकार्य</option>
                                                <option value="103" {{ !empty($data['applicant_details']) && $data['applicant_details']->UG_Subject == "103" ? 'selected' : '' }}>ग्रामीण प्रबंधन</option>
                                                <option value="104" {{ !empty($data['applicant_details']) && $data['applicant_details']->UG_Subject == "104" ? 'selected' : '' }}>सांख्यिकी</option>
                                                <option value="105" {{ !empty($data['applicant_details']) && $data['applicant_details']->UG_Subject == "105" ? 'selected' : '' }}>अन्य</option>

                                            </select>
                                        </td>
                                        <td>
                                            <select name="year_passing_ug" class="form-select">
                                                <?php
                                                for ($i = 1988; $i <= 2018; $i++) {
                                                ?>
                                                    <option value="<?= $i ?>" {{ !empty($data['applicant_details']) && $data['applicant_details']->Year_Passing_UG == $i ? 'selected' : '' }}><?= $i ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Graduation_Obtained_Marks : '' }}" name="marks_obtained_ug" id="marks_obtained_ug" class="form-control" oninput="calc_ug_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Graduation_Total_Marks : '' }}" name="marks_total_ug" id="marks_total_ug" class="form-control" oninput="calc_ug_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Perc_UG : '' }}" name="perc_ug" id="perc_ug" class="form-control" readonly>
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Graduation_University : '' }}" name="univ_ug" class="form-control">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="pg">
                                        <td>4</td>
                                        <td><input type="text" name="pg" class="form-control" value="PG (स्नातकोत्तर)" readonly></td>
                                        <td>
                                            <select class="form-select" name="pg_subject">
                                                <option value="101" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "101" ? 'selected' : '' }}>समाज विज्ञान</option>
                                                <option value="102" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "102" ? 'selected' : '' }}>जीवन विज्ञान</option>
                                                <option value="103" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "103" ? 'selected' : '' }}>पोषण</option>
                                                <option value="104" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "104" ? 'selected' : '' }}>चिकित्सा</option>
                                                <option value="105" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "105" ? 'selected' : '' }}>स्वास्थ्य</option>
                                                <option value="106" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "106" ? 'selected' : '' }}>प्रबंधन</option>
                                                <option value="107" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "107" ? 'selected' : '' }}>समाजकार्य</option>
                                                <option value="108" {{ !empty($data['applicant_details']) && $data['applicant_details']->PG_Subject == "108" ? 'selected' : '' }}>ग्रामीण प्रबंधन</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="year_passing_pg" class="form-select">
                                                <?php
                                                for ($i = 1988; $i <= 2018; $i++) {
                                                ?>
                                                    <option value="<?= $i ?>" {{ !empty($data['applicant_details']) && $data['applicant_details']->Year_Passing_PG == $i ? 'selected' : '' }}><?= $i ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->PG_Obtained_Marks : '' }}" name="marks_obtained_pg" id="marks_obtained_pg" class="form-control" oninput="calc_pg_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="number" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->PG_Total_Marks : '' }}" name="marks_total_pg" id="marks_total_pg" class="form-control" oninput="calc_pg_perc()">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->Perc_PG : '' }}" name="perc_pg" id="perc_pg" class="form-control" readonly>
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                        <td><input type="text" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->PG_University : '' }}" name="univ_pg" class="form-control" id="pg4">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <button style="float: right;margin-right: 10px;" class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Save & Next</button>
                            </div>
                        </div>
                    </form>
                </div><br>
            </div>

            <div class="card" id="tab4" style="display: none;">
                <div class="row container"><br>
                    <form id="myForm4" action="{{url('/candidate/save-experience-detail')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applicant_id_tab4" id="applicant_id_tab4">
                        <input type="hidden" name="app_id" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->ID : '' }}" />
                        <div class="col-md-12"><br>
                            <div class="field_wrapper" id="inputFieldsContainer">
                                @if(isset($data['applicant_details']))
                                @if($data['applicant_details']->experience_details)
                                @foreach($data['applicant_details']->experience_details as $experience_details)
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <label for="orgname">संस्था का नाम व पूरा पता<font color="red">*</font></label>
                                            <input type="text" value="{{$experience_details->Organization_Name}}" id="orgname" class="form-control" name="org_name[]" placeholder="संस्था का नाम/पता दर्ज करें" required>
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="orgtype">संस्था शासकीय है अथवा अशासकीय<font color="red">*</font></label>
                                            <select id="orgtype" class="form-select" name="org_type[]">
                                                <option {{$experience_details->Organization_Type =="Govt" ? 'selected' : '' }} value="Govt">शासकीय</option>
                                                <option {{$experience_details->Organization_Type =="NGO" ? 'selected' : '' }} value="NGO">गैरशासकीय(NGO)</option>
                                                <option {{$experience_details->Organization_Type =="SemiGovt" ? 'selected' : '' }} value="SemiGovt">अर्धशासकीय</option>
                                            </select>
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <label for="ngono">यदि संस्था अशासकीय है तो भारत शासन के NGO पोर्टल में पंजीयन क्र.</label>
                                            <input value="{{$experience_details->NGO_No}}" type="text" id="ngono" class="form-control" name="ngo_no[]" placeholder=" NGO पोर्टल में पंजीयन क्र दर्ज करें">
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="desgname">पदनाम</label><label style="color:red">*</label>
                                            <input value="{{$experience_details->Designation}}" type="text" id="desgname" class="form-control" name="desg_name[]" placeholder="पदनाम दर्ज करें">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="nature">अनुभव का कार्यक्षेत्र</label><label style="color:red">*</label>
                                            <input value="{{$experience_details->Nature_Of_Work}}" id="nature" type="text" class="form-control" name="nature_work[]" placeholder="अनुभव कार्यक्षेत्र दर्ज करें">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="dfrom">कब से</label><label style="color:red">*</label>
                                            <input value="{{$experience_details->Date_From}}" type="date" id="dfrom" class="form-control" name="date_from[]">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="dto">कब तक</label><label style="color:red">*</label>
                                            <input value="{{$experience_details->Date_To}}" type="date" id="dto" class="form-control" name="date_to[]">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @else
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <label for="orgname">संस्था का नाम व पूरा पता<font color="red">*</font></label>
                                            <input type="text" id="orgname" class="form-control" name="org_name[]" placeholder="संस्था का नाम/पता दर्ज करें">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="orgtype">संस्था शासकीय है अथवा अशासकीय<font color="red">*</font></label>
                                            <select id="orgtype" class="form-select" name="org_type[]">
                                                <option value="Govt">शासकीय</option>
                                                <option value="NGO">गैरशासकीय(NGO)</option>
                                                <option value="SemiGovt">अर्धशासकीय</option>
                                            </select>
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <label for="ngono">यदि संस्था अशासकीय है तो भारत शासन के NGO पोर्टल में पंजीयन क्र.</label>
                                            <input type="text" id="ngono" class="form-control" name="ngo_no[]" placeholder=" NGO पोर्टल में पंजीयन क्र दर्ज करें">
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="desgname">पदनाम</label><label style="color:red">*</label>
                                            <input type="text" id="desgname" class="form-control" name="desg_name[]" placeholder="पदनाम दर्ज करें">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="nature">अनुभव का कार्यक्षेत्र</label><label style="color:red">*</label>
                                            <input id="nature" type="text" class="form-control" name="nature_work[]" placeholder="अनुभव कार्यक्षेत्र दर्ज करें">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="dfrom">कब से</label><label style="color:red">*</label>
                                            <input type="date" id="dfrom" class="form-control" name="date_from[]">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="dto">कब तक</label><label style="color:red">*</label>
                                            <input type="date" id="dto" class="form-control" name="date_to[]">
                                            <div id="error" class="invalid-feedback">
                                                This field is required<br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4"><br>
                                <div class="d-flex">
                                    <button type="button" id="addmoreBtn" class="btn btn-info">Add More</button>&nbsp;&nbsp;&nbsp;
                                    <button style="display: none;" type="button" class="btn btn-danger removeBtn">Remove</button>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-left">
                                    <label for="marital">क्या आप विवाहित हैं ? / Marital Status </label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->Marital_Status == "married" ? 'checked' : '' }} id="marital" name="marital" value="married">Married
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->Marital_Status == "married" ? 'checked' : '' }} id="marital" name="marital" value="married">UnMarried
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->Marital_Status == "divorced" ? 'checked' : '' }} id="marital" name="marital" value="divorced">Divorced
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->Marital_Status == "widow" ? 'checked' : '' }} id="marital" name="marital" value="widow">Widow
                                    </label>
                                    <div id="error" class="invalid-feedback">
                                        This field is required<br>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-left">
                                    <label for="domicile">क्या आप छत्तीसगढ़ राज्य के मूल निवासी है ? / CG State Domicile</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input class="pntr" {{ !empty($data['applicant_details']) && $data['applicant_details']->domicile == "Yes" ? 'checked' : '' }} type="radio" id="prof" name="domicile" value="Yes" class="pntr @error('domicile') is-invalid @enderror">&nbsp;Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input class="pntr" {{ !empty($data['applicant_details']) && $data['applicant_details']->domicile == "No" ? 'checked' : '' }} type="radio" id="prof" name="domicile" value="No" class="pntr @error('domicile') is-invalid @enderror">&nbsp;No
                                    </label>
                                    <div id="error1" style="display: none;color:red;">
                                        This field is required
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-left">
                                    <label for="girlchild">क्या आप केवल एक या दो बच्चियों की माता है एवं आपने नसबंदी करवा लिया हैं ?/ Are you Mother of one or two girl child & have you done family planning?</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->girlchild == "Yes" ? 'checked' : '' }} id="girlchild" name="girlchild" value="Yes">&nbsp;Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->girlchild == "No" ? 'checked' : '' }} id="girlchild" name="girlchild" value="No">&nbsp;No
                                    </label>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-left">
                                    <label for="below_pl">क्या आप बी पी एल परिवार के अंतर्गत आते है ?/ Does your family belongs under Below poverty line?</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->belowpl == "Yes" ? 'checked' : '' }} id="below_pl" name="below_pl" value="Yes">&nbsp;Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->belowpl == "No" ? 'checked' : '' }} id="below_pl" name="below_pl" value="No">&nbsp;No
                                    </label>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-left">
                                    <label for="ecci">क्या आपके पास ईसीसीई/ न्युट्रिशन/ मनोविज्ञान में डिग्री/डिप्लोमा है?/ Do you have Degree/Diploma in ECCI/Nutrition/Psychology?</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->ecci == "Yes" ? 'checked' : '' }} id="ecci" name="ecci" value="Yes">&nbsp;Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->ecci == "No" ? 'checked' : '' }} id="ecci" name="ecci" value="No">&nbsp;No
                                    </label>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-xs-12 text-left">
                                    <label for="ncc">क्या आपके पास NCC/NSS/Scout Guide की सर्टिफिकेट है ?/ Do you have certificate of NCC/NSS/Scout Guide?</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->ncc == "Yes" ? 'checked' : '' }} id="ncc" name="ncc" value="Yes">&nbsp;Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" {{ !empty($data['applicant_details']) && $data['applicant_details']->ncc == "No" ? 'checked' : '' }} id="ncc" name="ncc" value="No">&nbsp;No
                                    </label>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 col-xs-12 text-left">
                                    <label for="special">विशेष योग्यता</label>
                                    <textarea name="special" class="form-control" placeholder="विशेष योग्यता दर्ज करें">{{isset($data['applicant_details']) ? $data['applicant_details']->speciality : ''}}</textarea>
                                </div>
                            </div><br>

                            <button style="float: right;" class="btn btn-primary btn-lg pull-right" type="submit">Save & Next</button>
                        </div>
                    </form>
                </div><br>
            </div>

            <div class="card" id="tab5" style="display: none;">
                <div class="row container"><br>
                    <form id="myForm5" action="{{url('/candidate/save-documents')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applicant_id_tab5" id="applicant_id_tab5">
                        <input type="hidden" name="app_id" value="{{ isset($data['applicant_details']) ? $data['applicant_details']->ID : '' }}" />
                        <div class="col-md-12"><br>
                            <div class="field_wrapper" id="inputFieldsContainer">
                                <div class="row">
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="photo">पासपोर्ट साइज़ फोटो अपलोड करें / Upload Photo <font color="red">*</font></label>
                                        <input id="photo" type="file" class="form-control" name="document_photo">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Photo)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Photo)}}" id="view_file" target="_blank">View File</a>
                                        <input type="hidden" name="exist_document_photo" value="{{ $data['applicant_details']->Document_Photo}}">
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="sign">हस्ताक्षर अपलोड करें / Upload Signature <font color="red">*</font></label>
                                        <input type="file" id="document_sign" class="form-control" name="document_sign">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Sign)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Sign)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="sign">आधार अपलोड करें / Upload AADHAAR <font color="red">*</font></label>
                                        <input type="file" id="document_adhaar" class="form-control" name="document_adhaar">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Aadhar)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Aadhar)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="photo">जाति प्रमाण पत्र अपलोड करें / Upload Caste Certificate <font color="red">*</font></label>
                                        <input id="photo" type="file" class="form-control" name="caste_certificate">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Caste)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Caste)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="sign">मूल निवासी प्रमाण पत्र अपलोड करें / Upload Domicile<font color="red">*</font></label>
                                        <input type="file" class="form-control" name="domicile">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Domicile)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Domicile)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="sign">10th प्रमाण पत्र अपलोड करें / Upload 10th Marksheet <font color="red">*</font></label>
                                        <input type="file" id="ssc_marksheet" class="form-control" name="ssc_marksheet">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_SSC)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_SSC)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="photo">12th प्रमाण पत्र अपलोड करें / Upload 12th Marksheet <font color="red">*</font></label>
                                        <input id="photo" type="file" class="form-control" name="inter_marksheet">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Inter)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Inter)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="sign">UG प्रमाण पत्र अपलोड करें / Upload UG Marksheet <font color="red">*</font></label>
                                        <input type="file" class="form-control" name="ug_marksheet">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_UG)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_UG)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="sign">BPL प्रमाण पत्र अपलोड करें / Upload BPL Certificate</label>
                                        <input type="file" class="form-control" name="bpl_marksheet">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_BPL)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_BPL)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="photo">विधवा/तलाकशुदा का प्रमाण पत्र अपलोड करें / Upload Widow/Divorced Certificate </label>
                                        <input id="photo" type="file" class="form-control" name="widow_certificate">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Widow)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Widow)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 text-left">
                                        <label for="sign">अनुभव प्रमाण पत्र अपलोड करें / Upload Experience Certificate<font color="red">*</font></label>
                                        <input type="file" id="sign" class="form-control" name="exp_document">
                                        @if( isset($data['applicant_details']) && $data['applicant_details']->Document_Exp)
                                        <a class="myImg" href="{{url('assets/user/applicant/doc/' . $data['applicant_details']->Applicant_ID . '/' .$data['applicant_details']->Document_Exp)}}" id="view_file" target="_blank">View File</a>
                                        @endif
                                        <div id="error" class="invalid-feedback">
                                            This field is required<br>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                            <button style="float: right;" class="btn btn-primary btn-lg pull-right" type="submit">Submit</button>
                        </div>
                    </form>
                </div><br>
            </div>
        </div>
    </div>
</main>
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>
<script>
    var modal = document.getElementById("myModal");

    // Get all anchor elements with the class "myImg"
    var anchors = document.querySelectorAll(".myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    // Loop through each anchor element and add an event listener
    anchors.forEach(function(anchor) {
        anchor.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the default behavior of the anchor
            modal.style.display = "block";
            modalImg.src = this.href; // Use the href attribute as the source
            captionText.innerHTML = this.textContent; // Use the link text as the caption
        });
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    document.getElementById('dfrom').addEventListener('change', function() {
        document.getElementById('dto').value = "";
        var issuedDate = new Date(this.value);
        issuedDate.setDate(issuedDate.getDate() + 1); // Increment the date by one day
        var formattedDate = issuedDate.toISOString().split('T')[0]; // Format the date to YYYY-MM-DD
        document.getElementById('dto').setAttribute('min', formattedDate);
    });

    // Initialize min value on page load if issued_date has a value
    window.addEventListener('load', function() {
        var issuedDateValue = document.getElementById('dfrom').value;
        if (issuedDateValue) {
            var issuedDate = new Date(issuedDateValue);
            issuedDate.setDate(issuedDate.getDate() + 1); // Increment the date by one day
            var formattedDate = issuedDate.toISOString().split('T')[0]; // Format the date to YYYY-MM-DD
            document.getElementById('dto').setAttribute('min', formattedDate);
        }
    });


    $(document).ready(function() {

        //to add and remove class from input feild
        $('form input').keyup(function() {
            if (this.value) {
                var element = $(this);

                // Remove the is-invalid class from input elements
                element.removeClass('is-invalid');
                element.addClass('was-validated');
            } else {
                var element = $(this);
                var elementName = element.attr('name');

                if (elementName != "Middle_Name" && elementName != "Last_Name" && elementName != "email" && elementName != "perc_ssc" && elementName != "perc_inter" && elementName != "perc_pg" && elementName != "perc_ug" && elementName != "pond_name" && elementName != "khasra_no" && elementName != "rakba" && elementName != "amount")
                    if (element.length) {
                        // Remove the is-invalid class from input elements
                        element.removeClass('was-validated');
                        element.addClass('is-invalid');
                    }
            }
        });

        //to add and remove class from textarea
        $('form textarea').keyup(function() {
            if (this.value) {
                var element = $(this);
                if (element.length) {
                    // Remove the is-invalid class from input elements
                    element.removeClass('is-invalid');
                    element.addClass('was-validated');
                }
            } else {
                var element = $(this);
                if (element.length) {
                    // Remove the is-invalid class from input elements
                    element.removeClass('was-validated');
                    element.addClass('is-invalid');
                }
            }
        });

        $('form input[type="date"]').change(function() {
            var element = $(this);
            if (element.val()) {
                // Remove the is-invalid class and add the was-validated class
                element.removeClass('is-invalid');
                element.addClass('was-validated');
            } else {
                // Remove the was-validated class and add the is-invalid class
                element.removeClass('was-validated');
                element.addClass('is-invalid');
            }
        });

        $('form input[type="file"]').change(function() {
            var element = $(this);
            if (element.val()) {
                // Remove the is-invalid class and add the was-validated class
                element.removeClass('is-invalid');
                element.addClass('was-validated');
            } else {
                // Remove the was-validated class and add the is-invalid class
                element.removeClass('was-validated');
                element.addClass('is-invalid');
            }
        });

        //to add and remove class from dropdown
        $('form select').change(function() {
            if (this.value) {
                var element = $(this);
                if (element.length) {
                    // Remove the is-invalid class from input elements
                    element.removeClass('is-invalid');
                    element.addClass('was-validated');
                }
            } else {
                var element = $(this);
                if (element.length) {
                    // Remove the is-invalid class from input elements
                    element.removeClass('was-validated');
                    element.addClass('is-invalid');
                }
            }
        });

        $('#myForm1').submit(function(e) {
            e.preventDefault(); // Prevent form from submitting normally
            var form = new FormData(this);
            var url = $(this).attr('action'); // Get the form action URL
            var csrf_token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value
            form.append('_token', '{{ csrf_token() }}');

            // Submit the form using AJAX
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                context: this,
                success: function(data) {
                    // Handle the response from the server
                    // console.log(data);
                    if (data.status == 'success') {

                        var applicant_id = data.applicant_id;
                        document.getElementById("applicant_id").value = applicant_id;

                        // Swal.fire({
                        //     icon: 'success',
                        //     title: data['message'],
                        //     // text: 'आवेदन की स्थिति को ट्रैक करने के लिए इस आईडी का उपयोग करें',
                        //     allowOutsideClick: false
                        // }).then((result) => {
                        hideAllDivs();
                        document.getElementById("tab2").style.display = "block";
                        document.getElementById("personal-details-btn").focus();

                        document.getElementById("personal-details-btn").removeAttribute("disabled");
                        removeGreenBackground(); // Remove green background from all buttons

                        document.getElementById("personal-details-btn").style.backgroundColor = "#21bf06";
                        // });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data['title'],
                            text: data['message'],
                            allowOutsideClick: false
                        })
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'warning',
                        title: 'कृपया सभी आवश्यक फ़ील्ड भरें ! <br> (Please Fill All Required Field) ',
                        text: 'Please see fields marked in red....',
                        allowOutsideClick: false
                    });

                    var response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        var errors = response.errors;
                        var errorMessages = '';

                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '<br>';
                            var element = $('[name="' + key + '"]');
                            if (element.length) {
                                element.addClass('is-invalid');
                            }
                        });
                        $('#error').html("This field is required");
                    }
                }
            });
        });

        $('#myForm2').submit(function(e) {
            e.preventDefault(); // Prevent form from submitting normally
            var form = new FormData(this);
            var url = $(this).attr('action'); // Get the form action URL
            var csrf_token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value
            form.append('_token', '{{ csrf_token() }}');

            // Submit the form using AJAX
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                context: this,
                success: function(data) {
                    // Handle the response from the server
                    console.log(data);
                    if (data.status == 'success') {

                        var applicant_id = data.applicant_id;
                        document.getElementById("applicant_id_tab3").value = applicant_id;

                        hideAllDivs();
                        document.getElementById("tab3").style.display = "block";
                        document.getElementById("edu-info-btn").focus();

                        document.getElementById("edu-info-btn").removeAttribute("disabled");
                        removeGreenBackground(); // Remove green background from all buttons

                        document.getElementById("edu-info-btn").style.backgroundColor = "#21bf06";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data['title'],
                            text: data['message'],
                            allowOutsideClick: false
                        })
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'warning',
                        title: 'कृपया सभी आवश्यक फ़ील्ड भरें ! <br> (Please Fill All Required Field) ',
                        text: 'Please see fields marked in red....',
                        allowOutsideClick: false
                    });

                    var response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        var errors = response.errors;
                        var errorMessages = '';

                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '<br>';
                            var element = $('[name="' + key + '"]');
                            if (element.length) {
                                element.addClass('is-invalid');
                            }
                        });
                        $('#error').html("This field is required");
                        $('#email-error').html("Enter Valid Email ID");
                        $('#ppincode-error').html("Enter Valid 6 Digit Pincode");
                        $('#pincode-error').html("Enter Valid 6 Digit Pincode");
                        $('#mobile-error').html("Enter Valid 10 Digit Mobile No.");
                        $('#adhaar-error').html("Enter Valid 12 Digit Adhaar No.");

                    }
                }
            });
        });

        $('#myForm3').submit(function(e) {
            e.preventDefault(); // Prevent form from submitting normally
            var form = new FormData(this);
            var url = $(this).attr('action'); // Get the form action URL
            var csrf_token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value
            form.append('_token', '{{ csrf_token() }}');

            // Submit the form using AJAX
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                context: this,
                success: function(data) {
                    // Handle the response from the server
                    console.log(data);
                    if (data.status == 'success') {

                        var applicant_id = data.applicant_id;
                        document.getElementById("applicant_id_tab4").value = applicant_id;

                        hideAllDivs();
                        document.getElementById("tab4").style.display = "block";
                        document.getElementById("exp-info-btn").focus();

                        document.getElementById("exp-info-btn").removeAttribute("disabled");
                        removeGreenBackground(); // Remove green background from all buttons

                        document.getElementById("exp-info-btn").style.backgroundColor = "#21bf06";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data['title'],
                            text: data['message'],
                            allowOutsideClick: false
                        })
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'warning',
                        title: 'कृपया सभी आवश्यक फ़ील्ड भरें ! <br> (Please Fill All Required Field) ',
                        text: 'Please see fields marked in red....',
                        allowOutsideClick: false
                    });

                    var response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        var errors = response.errors;
                        var errorMessages = '';

                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '<br>';
                            var element = $('[name="' + key + '"]');
                            if (element.length) {
                                element.addClass('is-invalid');
                            }
                        });
                        $('#error').html("This field is required");
                    }
                }
            });
        });

        $('#myForm4').submit(function(e) {
            e.preventDefault(); // Prevent form from submitting normally
            var form = new FormData(this);
            var url = $(this).attr('action'); // Get the form action URL
            var csrf_token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value
            form.append('_token', '{{ csrf_token() }}');

            // Submit the form using AJAX
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                context: this,
                success: function(data) {

                    // Handle the response from the server
                    console.log(data);
                    if (data.status == 'success') {

                        var applicant_id = data.applicant_id;
                        document.getElementById("applicant_id_tab5").value = applicant_id;


                        hideAllDivs();
                        document.getElementById("tab5").style.display = "block";
                        document.getElementById("attachmnet-btn").focus();

                        document.getElementById("attachmnet-btn").removeAttribute("disabled");
                        removeGreenBackground(); // Remove green background from all buttons

                        document.getElementById("attachmnet-btn").style.backgroundColor = "#21bf06";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data['title'],
                            text: data['message'],
                            allowOutsideClick: false
                        })
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'warning',
                        title: 'कृपया सभी आवश्यक फ़ील्ड भरें ! <br> (Please Fill All Required Field) ',
                        html: 'Please see fields marked <span style="color:red">*</span> ....',
                        allowOutsideClick: false
                    });

                    var response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        var errors = response.errors;
                        var errorMessages = '';

                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '<br>';
                            var element = $('[name="' + key + '"]');
                            if (element.length) {
                                element.addClass('is-invalid');
                                element.closest('.form-group').find('.invalid-feedback').html(value[0]);
                            }

                            //  if(key === 'domicile') {
                            //     document.getElementById("error1").style.display = "block";
                            //  }


                        });
                        $('#error').html("This field is required");

                        // $('input[name="domicile"]').on('change', function() {
                        //     $('#error').hide();
                        //     $('input[name="domicile"]').removeClass('is-invalid');
                        // });
                    }
                }
            });
        });

        $('#myForm5').submit(function(e) {
            e.preventDefault(); // Prevent form from submitting normally
            var form = new FormData(this);
            var url = $(this).attr('action'); // Get the form action URL
            var csrf_token = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token value
            form.append('_token', '{{ csrf_token() }}');

            // Submit the form using AJAX
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                context: this,
                success: function(data) {
                    // Handle the response from the server
                    // console.log(data);
                    if (data.status == 'success') {

                        var applicant_id = data.applicant_id;
                        document.getElementById("applicant_id").value = applicant_id;

                        Swal.fire({
                            icon: 'success',
                            title: data['message'],
                            // text: 'आवेदन की स्थिति को ट्रैक करने के लिए इस आईडी का उपयोग करें',
                            allowOutsideClick: false
                        }).then((result) => {
                            window.location.href = '/admin/view-application-detail/' + md5(applicant_id);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data['title'],
                            text: data['message'],
                            allowOutsideClick: false
                        })
                    }
                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'warning',
                        title: 'कृपया सभी आवश्यक फ़ील्ड भरें ! <br> (Please Fill All Required Field) ',
                        text: 'Please see fields marked in red....',
                        allowOutsideClick: false
                    });

                    var response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        var errors = response.errors;
                        var errorMessages = '';

                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '<br>';
                            var element = $('[name="' + key + '"]');
                            if (element.length) {
                                element.addClass('is-invalid');
                            }
                        });
                        $('#error').html("This field is required");
                    }
                }
            });
        });
    });

    // Function to remove green background from all buttons
    function removeGreenBackground() {
        var buttons = document.getElementsByClassName("add-app-btn");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].style.backgroundColor = "#0d6efd";
        }
    }

    // Add click event listeners to all buttons
    var buttons = document.getElementsByClassName("add-app-btn");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function() {
            removeGreenBackground(); // Remove green background from all buttons
            this.style.backgroundColor = "#157347"; // Set green background only on the clicked button
        });
    }

    document.getElementById("post-btn").addEventListener("click", function() {
        hideAllDivs();
        document.getElementById("tab1").style.display = "block";
    });

    document.getElementById("personal-details-btn").addEventListener("click", function() {
        hideAllDivs();
        document.getElementById("tab2").style.display = "block";
    });

    document.getElementById("edu-info-btn").addEventListener("click", function() {
        hideAllDivs();
        document.getElementById("tab3").style.display = "block";
    });

    document.getElementById("exp-info-btn").addEventListener("click", function() {
        hideAllDivs();
        document.getElementById("tab4").style.display = "block";
    });

    document.getElementById("attachmnet-btn").addEventListener("click", function() {
        hideAllDivs();
        document.getElementById("tab5").style.display = "block";
    });

    // document.getElementById("save-next-btn1").addEventListener("click", function() {
    //     hideAllDivs();
    //     document.getElementById("tab2").style.display = "block";
    //     document.getElementById("personal-details-btn").removeAttribute("disabled");
    //     removeGreenBackground(); // Remove green background from all buttons

    //     // Change the color of the "Tender Details" button
    //     document.getElementById("personal-details-btn").style.backgroundColor = "#157347";
    // });

    // document.getElementById("save-next-btn2").addEventListener("click", function() {
    //     hideAllDivs();
    //     document.getElementById("tab3").style.display = "block";
    //     document.getElementById("edu-info-btn").focus();

    //     document.getElementById("edu-info-btn").removeAttribute("disabled");
    //     removeGreenBackground(); // Remove green background from all buttons

    //     document.getElementById("edu-info-btn").style.backgroundColor = "#21bf06";
    // });

    function hideAllDivs() {
        document.getElementById("tab1").style.display = "none";
        document.getElementById("tab2").style.display = "none";
        document.getElementById("tab3").style.display = "none";
        document.getElementById("tab4").style.display = "none";
        document.getElementById("tab5").style.display = "none";
    }

    function select_district() {
        var postname = document.getElementById("postname").value;
        var catid = postname.split("|");


        var rows = $('table.quali tr');
        var ug = rows.filter('#ug');
        var pg = rows.filter('#pg');


        if ((catid[1] == "1")) {
            // state level post(s)
            document.getElementById("city").style.display = "none";
            document.getElementById("labelcity").style.display = "none";
            //document.getElementById("pg").style.display="inline";
            pg.show();
        } else if ((catid[1] == "2")) {
            // district level post(s)
            document.getElementById("city").style.display = "block";
            document.getElementById("labelcity").style.display = "block";
            //document.getElementById("pg").style.display="none";

            pg.hide();
            $("#pg1").prop('required', false);
            $("#pg2").prop('required', false);
            $("#pg3").prop('required', false);
            $("#pg4").prop('required', false);
        }
    }

    $(document).on('change', '#same', function() {
        if ($(this).prop('checked')) {
            var caddr = $('#caddr').val();
            var cpincode = $('#cpincode').val();
            var ccities = $('#cur_district').val();

            $('#paddr').val(caddr).attr('readonly', true);
            $('#ppincode').val(cpincode).attr('readonly', true);
            $('#per_district option[value="' + ccities + '"]').attr("selected", "selected");
        } else {
            $('#paddr').val('').attr('readonly', false);
            $('#ppincode').val('').attr('readonly', false);
            $('#per_district option[value="' + ccities + '"]').removeAttr("selected");
        }
    });

    $('#addmoreBtn').click(function() {
        var newInputFields = '<div class="input-fields"><div class="row">' +
            '<div class="col-md-3 text-left"><br>' +
            '<label for="orgname">संस्था का नाम व पूरा पता<font color="red">*</font></label>' +
            '<input type="text" id="orgname" class="form-control" name="org_name[]" placeholder="" required>' +
            '</div>' +
            '<div class="col-md-3 text-left"><br>' +
            '<label for="orgtype">संस्था शासकीय है अथवा अशासकीय<font color="red">*</font></label>' +
            '<select id="orgtype" class="form-select" name="org_type[]" required>' +
            '<option value="Govt">शासकीय</option>' +
            '<option value="NGO">गैरशासकीय(NGO)</option>' +
            '<option value="SemiGovt">अर्धशासकीय</option>' +
            '</select>' +
            '</div>' +
            '<div class="col-md-6 text-left"><br>' +
            '<label for="ngono">यदि संस्था अशासकीय है तो भारत शासन के NGO पोर्टल में पंजीयन क्र.</label>' +
            '<input type="text" id="ngono" class="form-control" name="ngo_no[]" placeholder="">' +
            '</div>' +
            '<div class="col-md-3 text-left">' +
            '<label for="desgname">पदनाम</label><label style="color:red">*</label>' +
            '<input type="text" class="form-control" name="desg_name[]" placeholder="" required>' +
            '</div>' +
            '<div class="col-md-3 text-left">' +
            '<label for="nature">अनुभव का कार्यक्षेत्र</label><label style="color:red">*</label>' +
            '<input type="text" class="form-control" name="nature_work[]" placeholder="" required>' +
            '</div>' +
            '<div class="col-md-3 text-left">' +
            '<label for="dfrom">कब से</label><label style="color:red">*</label>' +
            '<input type="date" class="form-control" name="date_from[]" required>' +
            '</div>' +
            '<div class="col-md-3 text-left">' +
            '<label for="dto">कब तक</label><label style="color:red">*</label>' +
            '<input type="date" class="form-control" name="date_to[]" required>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('.removeBtn').css('display', 'block');
        $('#inputFieldsContainer').append(newInputFields);
    });

    $(document).on('click', '.removeBtn', function() {
        // $(this).closest('.input-fields').remove();
        $('.input-fields:last').remove();
        if ($('.input-fields').length <= 0) {
            $('.removeBtn').hide();
        }
    });

    $('select[name=district]').change(function() {
        let dist_id = $("#district").val();
        $.ajax({

            url: '/admin/get-project',
            type: "POST",
            data: {
                dist_id: dist_id,
                '_token': '{{csrf_token()}}'
            },
            cache: false,
            success: function(response) {
                let option = '<option selected disabled value="undefined">--चुनें--</option>';
                $.each(response, function(index, value) {
                    option += '<option  value="' + value.Project_Code + '">' + value
                        .Project_Name + '</option>';
                });
                $('#project').html(option);
            },
            error: function(xhr) {
                $('#project').empty();
                $('#project').append('<option [selected]="true" hidden value=""> --Select-- </option>');
                $('#project').append('<option value="">No Data Found</option>');
            }
        });
    });

    function updateprojectOptions(district, selectedproject = null) {
        // let dist_id = $("#district").val();
        $.ajax({

            url: '/admin/get-project',
            type: "POST",
            data: {
                dist_id: district,
                '_token': '{{csrf_token()}}'
            },
            cache: false,
            success: function(response) {

                let option = '<option selected disabled value="undefined">--चुनें--</option>';
                $.each(response, function(index, value) {
                    if (selectedproject && value.Project_Code == selectedproject) {
                        option += '<option value="' + value.Project_Code + '" selected>' + value.Project_Name + '</option>';
                    } else {
                        option += '<option value="' + value.Project_Code + '">' + value.Project_Name + '</option>';
                    }
                });
                $('#project').html(option);
            },
            error: function(xhr) {
                $('#project').empty();
                $('#project').append('<option [selected]="true" hidden value=""> --Select-- </option>');
                $('#project').append('<option value="">No Data Found</option>');
            }
        });
    }

    function updateawcOptions(district, selectedproject = null, selectedawc = null) {
        let dist_id = $("#district").val();
        let pro_id = $("#project").val() ?? selectedproject;
        $.ajax({

            url: '/admin/get-awc',
            type: "POST",
            data: {
                dist_id: dist_id,
                pro_id: pro_id,
                '_token': '{{csrf_token()}}'
            },
            cache: false,
            success: function(response) {
                console.log(response);
                let option = '<option selected disabled value="undefined">--चुनें--</option>';
                $.each(response, function(index, value) {
                    if (selectedawc && value.AWC_Code_11_Digit == selectedawc) {
                        option += '<option value="' + value.AWC_Code_11_Digit + '" selected>' + value.AWC_Name + '</option>';
                    } else {
                        option += '<option value="' + value.AWC_Code_11_Digit + '">' + value.AWC_Name + '</option>';
                    }
                });
                $('#awc').html(option);
            },
            error: function(xhr) {
                $('#awc').empty();
                $('#awc').append('<option [selected]="true" hidden value=""> --Select-- </option>');
                $('#awc').append('<option value="">No Data Found</option>');
            }
        });
    }

    // On change event
    $("select[name='district']").change(function() {
        let district = $(this).val();
        updateprojectOptions(district);
    });

    // On change event
    $("select[name='project']").change(function() {

        let dist_id = $("#district").val();
        let project = $(this).val();

        updateawcOptions(district,project);
    });

    // On page load, if there's a district value
    let initialDistrict = $('#district').val();
    var selectedproject = "{{ $data['applicant_details']->project ?? '' }}";
    var selectedawc = "{{ $data['applicant_details']->awc ?? '' }}";


    if (initialDistrict) {
        updateprojectOptions(initialDistrict, selectedproject);
    }

    if (selectedproject) {
        updateawcOptions(initialDistrict, selectedproject, selectedawc);
    }

    function calc_ssc_perc() {
        // Get the values from the input fields
        var marksObtained = parseFloat(document.getElementById('marks_obtained_ssc').value);
        var marksTotal = parseFloat(document.getElementById('marks_total_ssc').value);

        // Check if both fields have valid numbers
        if (!isNaN(marksObtained) && !isNaN(marksTotal) && marksTotal > 0) {
            // Calculate the percentage
            var percentage = (marksObtained / marksTotal) * 100;

            // Update the percentage field
            document.getElementById('ssc_percentage').value = percentage.toFixed(2) + '%';
        } else {
            // If the input is invalid, clear the percentage field
            document.getElementById('ssc_percentage').value = '';
        }
    }

    function calc_inter_perc() {
        // Get the values from the input fields
        var marksObtained = parseFloat(document.getElementById('marks_obtained_inter').value);
        var marksTotal = parseFloat(document.getElementById('marks_total_inter').value);

        // Check if both fields have valid numbers
        if (!isNaN(marksObtained) && !isNaN(marksTotal) && marksTotal > 0) {
            // Calculate the percentage
            var percentage = (marksObtained / marksTotal) * 100;

            // Update the percentage field
            document.getElementById('perc_inter').value = percentage.toFixed(2) + '%';
        } else {
            // If the input is invalid, clear the percentage field
            document.getElementById('perc_inter').value = '';
        }
    }

    function calc_ug_perc() {
        // Get the values from the input fields
        var marksObtained = parseFloat(document.getElementById('marks_obtained_ug').value);
        var marksTotal = parseFloat(document.getElementById('marks_total_ug').value);

        // Check if both fields have valid numbers
        if (!isNaN(marksObtained) && !isNaN(marksTotal) && marksTotal > 0) {
            // Calculate the percentage
            var percentage = (marksObtained / marksTotal) * 100;

            // Update the percentage field
            document.getElementById('perc_ug').value = percentage.toFixed(2) + '%';
        } else {
            // If the input is invalid, clear the percentage field
            document.getElementById('perc_ug').value = '';
        }
    }

    function calc_pg_perc() {
        // Get the values from the input fields
        var marksObtained = parseFloat(document.getElementById('marks_obtained_pg').value);
        var marksTotal = parseFloat(document.getElementById('marks_total_pg').value);

        // Check if both fields have valid numbers
        if (!isNaN(marksObtained) && !isNaN(marksTotal) && marksTotal > 0) {
            // Calculate the percentage
            var percentage = (marksObtained / marksTotal) * 100;

            // Update the percentage field
            document.getElementById('perc_pg').value = percentage.toFixed(2) + '%';
        } else {
            // If the input is invalid, clear the percentage field
            document.getElementById('perc_pg').value = '';
        }
    }
</script>
@endsection