@extends('layouts.dahboard_layout')

@section('styles')
<style>
    label {
        font-size: 13px;
    }
</style>
@endsection

@section('body-page')
<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="row">
                <div class="col-md-3 grid-margin stretch-card" style="padding: 0px !important;">
                    <button style="width: 100%; border-radius :15px;" id="post-btn" type="button" class="btn btn-success btn-sm btn-icon-text add-app-btn">
                        Post Selection
                    </button>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="padding: 0px !important;">
                    <button  id="personal-details-btn" style="width: 100%; border-radius : 15px;" type="button" class="btn btn-primary btn-sm btn-icon-text add-app-btn">
                        व्यक्तिगत जानकारी
                    </button>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="padding: 0px !important;">
                    <button  id="edu-info-btn" style="width: 100%; border-radius :15px;" type="button" class="btn btn-primary btn-sm btn-icon-text add-app-btn">
                        शैक्षणिक योग्यता
                    </button>
                </div>
                <div class="col-md-3 grid-margin stretch-card" style="padding: 0px !important;">
                    <button  id="exp-info-btn" style="width: 100%; border-radius :15px;" type="button" class="btn btn-primary btn-sm btn-icon-text add-app-btn">
                        अनुभव एवं अन्य जानकारी
                    </button>
                </div>
            </div><br>

            <div class="card" id="tab1">
                <div class="row container">
                    <form id="myForm1" role="form" action="route('application_submit')" method="post" enctype="multipart/form-data" name="f1">
                        <?php foreach ($data['schemeid'] as $key) {
                            $aid = $key->Advertisement_ID;
                        } ?>
                        <input type="hidden" value="<?= $aid ?>" name="schemeid">

                        <div class="row">
                            <div class="col-md-4" style="font-size: 12px;"><br>
                                <label style="color:red"><b>Important Note:</b></label><br>
                                <label><i class="bi bi-arrow-right"></i> आवेदन करने से पूर्व विज्ञप्ति को ध्यान पूर्वक पढ़ें |</label>
                                <label><i class="bi bi-arrow-right"></i> राज्य स्तरीय एवं जिला स्तरीय संविदा पदों के लिए पृथक पृथक ऑनलाइन आवेदन करने होंगे |</label>
                                <label><i class="bi bi-arrow-right"></i> आवेदन फॉर्म को 4 भागो में भरा जाना है Post Selection, व्यक्तिगत जानकारी, शैक्षणिक योग्यता, अनुभव एवं अन्य जानकारी | प्रत्येक भाग को भरने के पश्चात Next बटन क्लिक करना है |</label>
                                <label><i class="bi bi-arrow-right"></i> <label style="color:red">*</label> मार्क किये हुए जानकारी को भरना अनिवार्य है |</label>
                                <label><i class="bi bi-arrow-right"></i> आवेदन करते समय स्कैन किये हुए फोटो एवं हस्ताक्षर JPG/PNG फॉर्मेट में अपलोड करना होगा एवं उनका साइज़ 50 KB से अधिक नहीं होना चाहिए |</label>
                                <label><i class="bi bi-arrow-right"></i> एक बार आवेदन करने के पश्चात् नियुक्ति की प्रक्रिया के किसी भी स्तर में पृथक से अन्य कोई दस्तावेज स्वीकृत नहीं किये जायेंगे एवं दस्तावेजों की हार्ड कॉपी आवेदन फॉर्म के प्रिंट के साथ विज्ञप्ति में उल्लेखित कार्यालय में जमा करना होगा |</label>
                                <label><i class="bi bi-arrow-right"></i> आवेदन करते समय अपने सारे दस्तावेज (10th,12th,UG,PG Marksheets एवं Experience Certificates ) अपने पास रखें ताकि फॉर्म भरते समय कोई जानकारी के लिए आपको असुविधा ना हो |</label>
                            </div>
                            <div class="col-md-4"><br>
                                <label for="postname">पद सेलेक्ट करें</label>
                                <select class="form-select" name="postname" id="postname" onchange="select_district()">
                                    <?php foreach ($data['recruitment'] as $value_rc) { ?>
                                        <option value="<?php echo $value_rc->post_id . '|' . $value_rc->cat_id; ?>"><?= $value_rc->title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4" style="margin-top: 6px;"><br>
                                <label for="city" style="display: none" id="labelcity">जिले का चयन करें </label>
                                <select id="city" class="form-select" name="pref_city" style="display: none">
                                    <option value="0">--Select Any District--</option>
                                    <option value="1">Koriya</option>
                                    <option value="2">Surguja</option>
                                    <option value="3">Jashpur</option>
                                    <option value="4">Raigarh</option>
                                    <option value="5">Korba</option>
                                    <option value="6">Janjgir-Champa</option>
                                    <option value="7">Bilaspur</option>
                                    <option value="8">Kabeerdhaam</option>
                                    <option value="9">Rajnandgaon</option>
                                    <option value="10">Durg</option>
                                    <option value="11">Raipur</option>
                                    <option value="12">Mahasamund</option>
                                    <option value="13">Dhamtari</option>
                                    <option value="14">Kanker</option>
                                    <option value="15">Bastar</option>
                                    <option value="16">Narayanpur</option>
                                    <option value="17">Dantewada</option>
                                    <option value="18">Bijapur</option>
                                    <option value="19">Balod</option>
                                    <option value="20">Balodabazar</option>
                                    <option value="21">Balrampur</option>
                                    <option value="22">Bemetara</option>
                                    <option value="23">Gariaband</option>
                                    <option value="24">Kondagaon</option>
                                    <option value="25">Mungeli</option>
                                    <option value="26">Sukma</option>
                                    <option value="27">Surajpur</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button style="float: right;" class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="save-next-btn1">Next</button>
                            </div>
                        </div><br>
                    </form>
                </div>
            </div>

            <div class="card" id="tab2" style="display: none;">
                <div class="row container"><br>
                    <form id="myForm" role="form" action="('application_submit')" method="post" enctype="multipart/form-data" name="f1">
                        <div class="row">
                            <div class="col-md-4 col-xs-12 text-left"><br>
                                <label for="fname">आवेदक का प्रथम नाम/First Name</label><label style="color:red">*</label>
                                <input type="text" id="fname" class="form-control" name="First_Name" placeholder="आवेदक का प्रथम नाम दर्ज करें" required>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left"><br>
                                <label for="mname">मध्य नाम/Middle Name </label>
                                <input type="text" id="mname" class="form-control" name="Middle_Name" placeholder="आवेदक का मध्य नाम दर्ज करें">
                            </div>
                            <div class="col-md-4 col-xs-12 text-left"><br>
                                <label for="lname">अंतिम नाम/Last Name</label>
                                <input type="text" id="lname" class="form-control" name="Last_Name" placeholder="आवेदक का अंतिम नाम दर्ज करें">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="mothername">माता का नाम/Mother's Name</label><label style="color:red">*</label>
                                <input type="text" id="mothername" class="form-control" name="mothername" placeholder="माता का नाम दर्ज करें">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="fathername">पिता/पति का नाम/Father/Husband Name </label><label style="color:red">*</label>
                                <input type="text" id="fathername" class="form-control" name="fathername" placeholder="पिता/पति का नाम दर्ज करें">
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
                                    <option value="{{ $district->District_Code_LGD }}">{{ $district->name }}</option>
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
                                <textarea rows="5" id="caddr" class="form-control" name="corr_addr" style="resize: none;" placeholder="वर्तमान पता दर्ज करें"></textarea>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="cities">मूल निवासी जिला/ Domicile District </label><label style="color:red">*</label>
                                <select class="form-select" name="cur_domicile_district" id="cur_domicile_district">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    @if(!empty($data['cities']))
                                    @foreach ($data['cities'] as $district)
                                    <option value="{{ $district->District_Code_LGD }}">{{ $district->name }}</option>
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
                                <input type="number" class="form-control" id="cpincode" name="pincode" placeholder="वर्तमान पिन कोड दर्ज करें">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
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
                                <textarea rows="5" id="paddr" class="form-control" name="perm_addr" style="resize: none;" placeholder="स्थायी पता दर्ज करें" required></textarea>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 text-left">
                                <label for="cities">स्थायी निवासी जिला/Permanent District </label><label style="color:red">*</label>
                                <select class="form-select" name="per_domicile_district" id="per_domicile_district">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    @if(!empty($data['cities']))
                                    @foreach ($data['cities'] as $district)
                                    <option value="{{ $district->District_Code_LGD }}">{{ $district->name }}</option>
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
                                <input type="number" class="form-control" id="ppincode" name="ppincode" placeholder="स्थायी पिन कोड दर्ज करें">
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
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="nationality">राष्ट्रीयता/Nationality </label><label style="color:red">*</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="Indian" required readonly>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="dob">जन्मतिथि/Date of Birth </label><label style="color:red">*</label>
                                <input type="date" id="dob" class="form-control" name="dob">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="mobile">मोबाइल नंबर/Mobile Number</label><label style="color:red">*</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="मोबाइल नंबर दर्ज करें">
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 text-left">
                                <label for="email">ई-मेल आई. डी./Email ID</label>
                                <input type="text" id="email" class="form-control" name="email" placeholder="ई-मेल आई.डी. दर्ज करें">
                            </div>
                        </div>

                        <div class="row" style="margin-top: 15px">
                            <div class="col-md-3">
                                <label for="gender">लिंग/Gender </label><label style="color:red">*</label>&nbsp;
                                <select id="gender" class="form-select" name="gender">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    <option value="male">पुरुष (Male)</option>
                                    <option value="female">महिला (Female)</option>
                                    <option value="other">अन्य (Other)</option>
                                </select>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                            <div class="col-md-3  text-left">
                                <label for="caste">वर्ग/Category</label><label style="color:red">*</label>&nbsp;
                                <select id="caste" class="form-select" name="caste">
                                    <option selected disabled value="undefined">-- Select --</option>
                                    <option value="UR">UR</option>
                                    <option value="OBC">OBC</option>
                                    <option value="SC">SC</option>
                                    <option value="ST">ST</option>
                                </select>
                                <div id="error" class="invalid-feedback">
                                    This field is required<br>
                                </div>
                            </div>
                        </div><br>
                        <button style="float: right;" class="btn btn-primary nextBtn btn-lg pull-right" type="submit" id="save-next-btn2">Next</button>
                    </form>
                </div><br>
            </div>

            <div class="card" id="tab3" style="display: none;">
                <div class="row"><br>
                    <form role="form" action="('application_submit')" method="post" enctype="multipart/form-data" name="f1">
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
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select></td>
                                        <td><input type="number" name="marks_obtained_ssc" class="form-control" required></td>
                                        <td><input type="number" name="marks_total_ssc" class="form-control" onchange="calc_ssc_perc()" required></td>
                                        <td><input type="text" name="perc_ssc" class="form-control"></td>
                                        <td><input type="text" name="school_ssc" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" name="inter" class="form-control" value="12th" readonly></td>
                                        <td>
                                            <select class="form-select" name="inter_subject">
                                                <option value="PCM">PCM</option>
                                                <option value="PCB">PCB</option>
                                                <option value="Commerce">Commerce</option>
                                                <option value="Arts">Arts</option>
                                            </select>
                                        <td>
                                            <select name="year_passing_inter" class="form-select">
                                                <?php
                                                for ($i = 1988; $i <= 2018; $i++) {
                                                ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td><input type="number" name="marks_obtained_inter" class="form-control" required></td>
                                        <td><input type="number" name="marks_total_inter" class="form-control" onchange="calc_inter_perc()" required></td>
                                        <td><input type="text" name="perc_inter" class="form-control" required></td>
                                        <td><input type="text" name="school_inter" class="form-control" required></td>
                                    </tr>
                                    <tr id="ug">
                                        <td>3</td>
                                        <td><input type="text" name="ug" class="form-control" value="UG (स्नातक)" readonly></td>
                                        <td>
                                            <select class="form-select" name="ug_subject" id="ug">
                                                <option value="101">समाज विज्ञान</option>
                                                <option value="102">समाजकार्य</option>
                                                <option value="103">ग्रामीण प्रबंधन</option>
                                                <option value="104">सांख्यिकी</option>
                                                <option value="105">अन्य</option>

                                            </select>
                                        </td>
                                        <td>
                                            <select name="year_passing_ug" class="form-select">
                                                <?php
                                                for ($i = 1988; $i <= 2018; $i++) {
                                                ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td><input type="number" name="marks_obtained_ug" class="form-control" required></td>
                                        <td><input type="number" name="marks_total_ug" class="form-control" onchange="calc_ug_perc()" required></td>
                                        <td><input type="text" name="perc_ug" class="form-control" required></td>
                                        <td><input type="text" name="univ_ug" class="form-control" required></td>
                                    </tr>
                                    <tr id="pg">
                                        <td>4</td>
                                        <td><input type="text" name="pg" class="form-control" value="PG (स्नातकोत्तर)" readonly></td>
                                        <td>
                                            <select class="form-select" name="pg_subject">
                                                <option value="101">समाज विज्ञान</option>
                                                <option value="102">जीवन विज्ञान</option>
                                                <option value="103">पोषण</option>
                                                <option value="104">चिकित्सा</option>
                                                <option value="105">स्वास्थ्य</option>
                                                <option value="106">प्रबंधन</option>
                                                <option value="107">समाजकार्य</option>
                                                <option value="108">ग्रामीण प्रबंधन</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="year_passing_pg" class="form-select">
                                                <?php
                                                for ($i = 1988; $i <= 2018; $i++) {
                                                ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="number" name="marks_obtained_pg" class="form-control" id="pg1" required></td>
                                        <td><input type="number" name="marks_total_pg" class="form-control" onchange="calc_pg_perc()" id="pg2" required></td>
                                        <td><input type="text" name="perc_pg" class="form-control" id="pg3" required></td>
                                        <td><input type="text" name="univ_pg" class="form-control" id="pg4" required></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <button style="float: right;margin-right: 10px;" class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="save-next-btn3">Next</button>
                            </div>
                        </div>
                    </form>
                </div><br>
            </div>

            <div class="card" id="tab4" style="display: none;">
                <div class="row container"><br>
                    <form role="form" action="('application_submit')" method="post" enctype="multipart/form-data" name="f1">
                        <div class="col-md-12"><br>
                            <div class="field_wrapper" id="inputFieldsContainer">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <label for="orgname">संस्था का नाम व पूरा पता<font color="red">*</font></label>
                                            <input type="text" id="orgname" class="form-control" name="org_name[]" placeholder="" required>
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="orgtype">संस्था शासकीय है अथवा अशासकीय<font color="red">*</font></label>
                                            <select id="orgtype" class="form-select" name="org_type[]" required>
                                                <option value="Govt">शासकीय</option>
                                                <option value="NGO">गैरशासकीय(NGO)</option>
                                                <option value="SemiGovt">अर्धशासकीय</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <label for="ngono">यदि संस्था अशासकीय है तो भारत शासन के NGO पोर्टल में पंजीयन क्र.</label>
                                            <input type="text" id="ngono" class="form-control" name="ngo_no[]" placeholder="">
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="desgname">पदनाम</label><label style="color:red">*</label>
                                            <input type="text" id="desgname" class="form-control" name="desg_name[]" placeholder="" required>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="nature">अनुभव का कार्यक्षेत्र</label><label style="color:red">*</label>
                                            <input id="nature" type="text" class="form-control" name="nature_work[]" placeholder="" required>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="dfrom">कब से</label><label style="color:red">*</label>
                                            <input type="date" id="dfrom" class="form-control" name="date_from[]" required>
                                        </div>
                                        <div class="col-md-3" text-left">
                                            <label for="dto">कब तक</label><label style="color:red">*</label>
                                            <input type="date" id="dto" class="form-control" name="date_to[]" required>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="col-md-6 col-xs-12 text-left">
                                    <label for="marital">क्या आप विवाहित हैं ? / Marital Status </label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" id="marital" name="marital" value="married" required>Married
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" id="marital" name="marital" value="unmarried" required>UnMarried
                                    </label>
                                </div>
                                <div class="col-md-6 col-xs-12 text-left">
                                    <label for="isdisable">क्या आप विकलांग हैं ? / With Disability</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" id="isdisable" name="isdisable" value="Yes" required>Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" id="isdisable" name="isdisable" value="No" required>No
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
                                    <label for="domicile">क्या आप छत्तीसगढ़ राज्य के मूल निवासी है ? / CG State Domicile</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" id="prof" name="domicile" value="Yes" required>&nbsp;Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" id="prof" name="domicile" value="No" required>&nbsp;No
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
                                    <label for="prof">भाषा जानकारी / Proficient In</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="checkbox" id="prof" name="lang[]" value="Hindi">&nbsp;Hindi
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="checkbox" id="prof" name="lang[]" value="English">&nbsp;English
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="checkbox" id="prof" name="lang[]" value="Chhattisgarhi">&nbsp;Chhattisgarhi
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
                                    <label for="msoffice">एम एस ऑफिस एवं ई-मेल में कार्य करने में दक्षता ? / Knowledge of Ms-Office & E-mail</label><label style="color:red">*</label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 30px;">
                                        <input type="radio" id="msoffice" name="msoffice" value="Yes" required>&nbsp;Yes
                                    </label>
                                    <label class="radio-inline" style="margin-top: -10px; margin-left: 20px;">
                                        <input type="radio" id="msoffice" name="msoffice" value="No" required>&nbsp;No
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
                                    <textarea name="special" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 col-xw-12'>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-xs-12 text-left">
                                    <label for="photo">पासपोर्ट साइज़ फोटो अपलोड करें / Upload Photo <font color="red">*</font></label>
                                    <input id="photo" type="file" class="form-control" name="document_photo" required>
                                </div>
                                <div class="col-md-4 col-xs-12 text-left">
                                    <label for="sign">हस्ताक्षर अपलोड करें / Upload Signature <font color="red">*</font></label>
                                    <input type="file" id="sign" class="form-control" name="document_sign" required>
                                </div>
                            </div><br>
                            <button class="btn btn-primary btn-lg pull-right" type="submit">Save</button>
                        </div>
                    </form>
                </div><br>
            </div>
        </div>
    </div>
</main><!-- End #main -->
@endsection
@section('scripts')
<script>
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

    document.getElementById("save-next-btn1").addEventListener("click", function() {
        hideAllDivs();
        document.getElementById("tab2").style.display = "block";
        // Set focus to the "Tender Details" button
        // document.getElementById("personal-details-btn").focus();

        // Enable the "Tender Details" button
        document.getElementById("personal-details-btn").removeAttribute("disabled");
        removeGreenBackground(); // Remove green background from all buttons

        // Change the color of the "Tender Details" button
        document.getElementById("personal-details-btn").style.backgroundColor = "#157347";
    });

    // document.getElementById("save-next-btn2").addEventListener("click", function() {
    //     hideAllDivs();
    //     document.getElementById("tab3").style.display = "block";
    //     document.getElementById("edu-info-btn").focus();

    //     document.getElementById("edu-info-btn").removeAttribute("disabled");
    //     removeGreenBackground(); // Remove green background from all buttons

    //     document.getElementById("edu-info-btn").style.backgroundColor = "#21bf06";
    // });

    document.getElementById("save-next-btn3").addEventListener("click", function() {
        hideAllDivs();
        document.getElementById("tab4").style.display = "block";
        document.getElementById("exp-info-btn").focus();

        document.getElementById("exp-info-btn").removeAttribute("disabled");
        removeGreenBackground(); // Remove green background from all buttons

        document.getElementById("exp-info-btn").style.backgroundColor = "#21bf06";
    });

    function hideAllDivs() {
        document.getElementById("tab1").style.display = "none";
        document.getElementById("tab2").style.display = "none";
        document.getElementById("tab3").style.display = "none";
        document.getElementById("tab4").style.display = "none";
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
            var ccities = $('#cities').val();

            $('#paddr').val(caddr).attr('readonly', true);
            $('#ppincode').val(cpincode).attr('readonly', true);
            $('#pcities option[value="' + ccities + '"]').attr("selected", "selected");
        } else {
            $('#paddr').val('').attr('readonly', false);
            $('#ppincode').val('').attr('readonly', false);
            $('#pcities option[value="' + ccities + '"]').removeAttr("selected");
            // $('#pcities option[value="#"]').attr("selected","selected");
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

            if (elementName != "post" && elementName != "pehchan" && elementName != "samiti_name" && elementName != "panjiyan_no" && elementName != "total_member" && elementName != "house_no" && elementName != "demand" && elementName != "pond_name" && elementName != "khasra_no" && elementName != "rakba" && elementName != "amount")
                if (element.length) {
                    // Remove the is-invalid class from input elements
                    element.removeClass('was-validated');
                    element.addClass('is-invalid');
                }
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

    document.getElementById("save-next-btn2").addEventListener("click", function(e) {

        e.preventDefault(); // Prevent form from submitting normally
        // var form = new FormData(this);
        var form = new FormData($('#myForm')[0]);
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
                    Swal.fire({
                        icon: 'success',
                        title: data['message'],
                        // text: 'आवेदन की स्थिति को ट्रैक करने के लिए इस आईडी का उपयोग करें',
                        allowOutsideClick: false
                    }).then((data) => {
                        window.location.href = '/admin/add-district';
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
                    $('#error').html("This feild is required");
                }
            }
        });
    });
</script>
@endsection