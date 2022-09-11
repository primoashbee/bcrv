<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/learner-style.css')}}">
        <style>
            .button {
                    background-color: #4CAF50; /* Green */
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    float: right;
                    margin-top: 15px;
                }
            .required {
                color:red;  
            }
        </style>
    </head>
    <body >
        <div class="container margin-x-auto" id="app">
            <div class="header d-flex">
                <div class="w-10 box">
                    <img src="{{asset('tesda.png')}}" alt="" class="w-100">
                </div>
                <div class="w-80 text-center border-x box d-flex content-center">
                    <div class="margin-y-auto">
                        <p class="bold" style="font-size: 24px;">Technical Education and skills Development Authority</p>
                        <p style="font-size: 18px;">Pangasiwaan sa Edukasyong Teknikal at Pagpapaunalad ng Kasanayan</p>
                    </div>
                </div>
                <div class="w-10 box text-center margin-y-auto">
                    <p class="bold">MIS 03-01</p>
                    <p>
                        (ver. 2020)
                    </p>
                </div>
            </div>
            <div class="border-bottom border-x">
                <h1 class="bold font-xl text-center">Registration Form</h1>
            </div>
            <div class="profile-form d-flex border">
                <div class="w-80">
                    <h2 class="bold font-md text-center">LEARNERS PROFILE FORM</h2>
                </div>
                <div class="w-20">
                    <div class="border picture-wrapper d-flex">
                        <p class="margin-auto">I.D Picture</p>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <div class="content-wrapper border-x">
                    <p class="content-head bold">1. T2MIS Auto Generated</p>
                </div>
                <div class="content-wrapper d-flex border-bottom border-x">
                    <div class="w-20">
                        <p class="bold">1.1 Unique Learner Identifier</p>
                        <p class="bold">ULI Number:</p>
                    </div>
                    <div class="w-60 text-center">
                        <input type="text" class="w-100 py-5" v-model="learner_id">
                        {{-- <ul class="box-list">
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                            <li class="border"><input type="text" class="mini-box" maxlength="1"></li>
                        </ul> --}}
                    </div>
                    <div class="w-20">
                        <div class="bold date">
                        <span>1.2 Entry Date</span> <input type="date" placeholder="mm/dd/yy" class="w-50 h-80" v-model="entry_date"></div>
                    </div>
                </div>
                <div class="content-wrapper border-x">
                    <p class="content-head bold">2. Learner/Manpower Profile</p>
                </div>

                <div class="content-wrapper border-bottom border-x">
                    <div class="row d-flex">
                        <div class="w-20 d-flex">
                            <div class="bold date f-start">
                                <span>2.1 Name:</span>
                            </div>
                        </div>
                        <div class="w-80 d-flex p-5">
                            <div class="w-33 text-center">
                                <div class="w-100">
                                    <input type="text" class="w-100" v-model="lastname">
                                    <label class="bold">Last Name, Extension Name (Jr. Sr.)</label>
                                </div>
                            </div>
                            <div class="w-33 text-center px-20">
                                <input type="text" class="w-100" v-model="firstname">
                                <label class="bold">First</label>
                            </div>
                            <div class="w-33 text-center">
                                <input type="text" class="w-100" v-model="middlename">
                                <label class="bold" >Middle</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="w-20 d-flex">
                            <div class="bold date f-start">
                                <span>2.2</span> Complete Permanent Mailing Address:
                            </div>
                        </div>
                        <div class="w-80 p-5">
                            <div class="row d-flex">
                                <div class="w-33 text-center">
                                    <input type="text" class="w-100" v-model="street">
                                    <label class="bold">Number, Street</label>
                                </div>
                                <div class="w-33 text-center px-20">
                                    <input type="text" class="w-100" v-model="barangay">
                                    <label class="bold">Barangay</label>
                                </div>
                                <div class="w-33 text-center">
                                    <input type="text" class="w-100" v-model="district">
                                    <label class="bold">District</label>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="w-33 text-center">
                                    <input type="text" class="w-100" v-model="city">
                                    <label class="bold">City, Municipality</label>
                                </div>
                                <div class="w-33 text-center px-20">
                                    <input type="text" class="w-100" v-model="province">
                                    <label class="bold">Province</label>
                                </div>
                                <div class="w-33 text-center">
                                    <input type="text" class="w-100" v-model="region">
                                    <label class="bold">Region</label>
                                </div>
                            </div>
                            <div class="row d-flex">
                                <div class="w-33 text-center">
                                    <input type="text" class="w-100" v-model="email">
                                    <label class="bold">Email Address/Facebook Account</label>
                                </div>
                                <div class="w-33 text-center px-20">
                                    <input type="text" class="w-100" v-model="contact_number">
                                    <label class="bold">Contact No.</label>
                                </div>
                                <div class="w-33 text-center">
                                    <input type="text" class="w-100" v-model="nationality">
                                    <label class="bold">Nationality</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper border-x border-bottom">
                    <p class="content-head bold">3. Personal Information</p>
                </div>
                <div class="content-wrapper border-bottom border-x">
                    <div class="row d-flex border-bottom">
                        <div class="w-30 p-5">
                            <div class="row">
                                <div class="ml-30">
                                    <div class="bold date f-start">
                                        <span>3.1 Sex</span> 
                                    </div>
                                    <div class="d-flex cbox p-top-20">
                                        <input type="radio" v-model="gender" name="gender" value="Male">
                                        <label class="bold ml-10">Male</label>
                                    </div>
                                    <div class="d-flex cbox">
                                        <input type="radio" v-model="gender" name="gender" value="Female">
                                        <label class="bold ml-10">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-30 p-5 border-x">
                            <div class="row">
                                <div class="ml-30">
                                    <div class="bold date f-start">
                                        <span>3.2 Civil Status</span> 
                                    </div>
                                    <div class="d-flex cbox p-top-20">
                                        <input type="radio" v-model="civil_status" value="Single">
                                        <label class="bold ml-10">Single</label>
                                    </div>
                                    <div class="d-flex cbox" >
                                        <input type="radio" v-model="civil_status" value="Married">
                                        <label class="bold ml-10">Married</label>
                                    </div>
                                    <div class="d-flex cbox">
                                        <input type="radio" v-model="civil_status" value="Widowed">
                                        <label class="bold ml-10">Widowed</label>
                                    </div>
                                    <div class="d-flex cbox">
                                        <input type="radio" v-model="civil_status" value="Separated">
                                        <label class="bold ml-10">Separated</label>
                                    </div>
                                    <div class="d-flex cbox">
                                        <input type="radio" v-model="civil_status" value="Solo Parent">
                                        <label class="bold ml-10">Solo Parent</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-40 p-5">
                            <div class="row">
                                <div class="ml-30">
                                    <div class="bold date f-start">
                                        <span>3.3 Employment Status Before Training</span> 
                                    </div>
                                    <div class="d-flex cbox p-top-20">
                                        <input type="radio" name="employment_status" v-model="employment_status" value="Employed">
                                        <label class="bold ml-10">Employed</label>
                                    </div>
                                    <div class="d-flex cbox">
                                        <input type="radio" name="employment_status" v-model="employment_status" value="Unemployed">
                                        <label class="bold ml-10">Unemployed</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row d-flex border-bottom p-30">
                        <div class="w-20 px-20 p-top-20">
                            <div class="bold date f-start">
                                <span>3.4 Birthdate:</span>
                            </div>
                        </div>
                        <div class="w-20 px-20 p-top-20">
                            <div class="w-100 text-center">
                                <input type="date" class="w-100 py-5" v-model="birthday">
                                <label class="bold">Month of Birth</label>
                            </div>
                        </div>
                        {{-- <div class="w-20 px-20 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5">
                                <label class="bold">Day of Birth</label>
                            </div>
                        </div>
                        <div class="w-20 px-20 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5">
                                <label class="bold">Year of Birth</label>
                            </div>
                        </div> --}}
                        <div class="w-20 px-20 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5" v-model="age">
                                <label class="bold">Age</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex border-bottom p-30">
                        <div class="w-20 px-20 p-top-20">
                            <div class="bold date f-start p-top-20">
                                <span>3.5 Birthplace:</span>
                            </div>
                        </div>
                        <div class="w-30 ml-10 px-10 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5" v-model="birth_city">
                                <label class="bold">City/Municipality</label>
                            </div>
                        </div>
                        <div class="w-30 px-10 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5" v-model="birth_province">
                                <label class="bold">Province</label>
                            </div>
                        </div>
                        <div class="w-20 px-10 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5" v-model="birth_region">
                                <label class="bold">Region</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper border-x border-bottom">
                    <p class="content-head bold">3.6 Educational Attainment Before Training (Trainee)</p>
                </div>
                <div class="content-wrapper border-bottom border-x">
                    <div class="row d-flex border-bottom">
                        <div class="w-25 p-5">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="No Grade Completed">
                                        <label class="bold ml-10">No Grade Completed</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5 border-x">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="Pre-school (Nursery/KinderPrep)<">
                                        <label class="bold ml-10">Pre-school (Nursery/KinderPrep)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5 border-x">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="High School Undergraduate">
                                        <label class="bold ml-10">High School Undergraduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="High School graduate">
                                        <label class="bold ml-10">High School graduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                    <div class="row d-flex border-bottom">
                        <div class="w-25 p-5">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="Elementary Undergraduate">
                                        <label class="bold ml-10">Elementary Undergraduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5 border-x">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="Post Secondary Undergraduate">
                                        <label class="bold ml-10">Post Secondary Undergraduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5 border-x">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="College Undergraduate">
                                        <label class="bold ml-10">College Undergraduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="College graduate or higher">
                                        <label class="bold ml-10">College graduate or higher</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                    <div class="row d-flex border-bottom">
                        <div class="w-25 p-5">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="Elementary Graduate">
                                        <label class="bold ml-10">Elementary Graduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5 border-x">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="Post Secondary Graduate">
                                        <label class="bold ml-10">Post Secondary Graduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5 border-x">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="Junior High Graduate">
                                        <label class="bold ml-10">Junior High Graduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-25 p-5">
                            <div class="row">
                                <div class="ml-10">
                                    <div class="d-flex cbox p-top-10">
                                        <input type="radio" name="educational_attainment" v-model="educational_attainment" value="Senior High Graduate">
                                        <label class="bold ml-10">Senior High Graduate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
                    <div class="row d-flex border-bottom p-30">
                        <div class="w-20 px-20 p-top-20">
                            <div class="bold date f-start">
                                <span>3.7 Parent/Guardian:</span>
                            </div>
                        </div>
                        <div class="w-20 px-20 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5" v-model="parent_name">
                                <label class="bold">Name</label>
                            </div>
                        </div>
                        <div class="w-60 px-20 p-top-20">
                            <div class="w-100 text-center">
                                <input type="text" class="w-100 py-5"  v-model="parent_mailing_address">
                                <label class="bold">Complete Permanent Mailing Address</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-wrapper border-x border-bottom" style="font-size:1.5em;">
                <p class="content-head bold">4. Learner/Trainee/Student(Clients) Classification :</p>
            </div>
            <div class="content-wrapper border-bottom border-x">
                <div class="row d-flex border-bottom">
                <div class="w-33 p-5">
                    <div class="row">
                        <div class="ml-10">
                            <div class="d-flex cbox p-top-10">
                                <input type="radio" name="classification" v-model="classification" value="4PS Beneficiary">
                                <label class="bold ml-10">4PS Beneficiary</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-33 p-5 border-x">
                    <div class="row">
                        <div class="ml-10">
                            <div class="d-flex cbox p-top-10">
                                <input type="radio" name="classification" v-model="classification" value="Agrarian Reform Beneficiary">
                                <label class="bold ml-10">Agrarian Reform Beneficiary</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-33 p-5">
                    <div class="row">
                        <div class="ml-10">
                            <div class="d-flex cbox p-top-10">
                                <input type="radio" name="classification" v-model="classification" value="Balik Probinsya">
                                <label class="bold ml-10">Balik Probinsya</label>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Displaced Workers">
                                    <label class="bold ml-10">Displaced Workers</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Drug Dependents Surrenderers/Surrenderees">
                                    <label class="bold ml-10"> Drug Dependents Surrenderers/Surrenderees</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Family Members of AFP and PNP Killed in Action">
                                    <label class="bold ml-10"> Family Members of AFP and PNP Killed in Action</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Family Members of AFP and PNP Wounded in Action">
                                    <label class="bold ml-10"> Family Members of AFP and PNP Wounded in Action</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Farmers and Fishermen">
                                    <label class="bold ml-10"> Farmers and Fishermen</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Indigenous People & Cultural Communities">
                                    <label class="bold ml-10">Indigenous People & Cultural Communities</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Industry Workers">
                                    <label class="bold ml-10">Industry Workers</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Inmates and Detainees">
                                    <label class="bold ml-10">Inmates and Detainees</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="MILF Beneficiary">
                                    <label class="bold ml-10"> MILF Beneficiary</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Out-of-School-Youth">
                                    <label class="bold ml-10"> Out-of-School-Youth</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Overseas Filipino Workers (OFW) Dependents">
                                    <label class="bold ml-10"> Overseas Filipino Workers (OFW) Dependents</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="RCEF-RESP">
                                    <label class="bold ml-10">RCEF-RESP</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Rebel Returnees/Decommissioned">
                                    <label class="bold ml-10"> Rebel Returnees/Decommissioned</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Returning/Repatriated Overseas Filipino Workers (OFW)">
                                    <label class="bold ml-10">Returning/Repatriated Overseas Filipino Workers (OFW)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Student">
                                    <label class="bold ml-10">Student</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="TESDA Alumni">
                                    <label class="bold ml-10"> TESDA Alumni</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="TVET Trainees">
                                    <label class="bold ml-10">TVET Trainees</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Uniformed Personnel">
                                    <label class="bold ml-10">Uniformed Personnel</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Victim of Natural Disasters and Calamities">
                                    <label class="bold ml-10">Victim of Natural Disasters and Calamities</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Wounded in Action AFP and PNP Personnel">
                                    <label class="bold ml-10">Wounded in Action AFP and PNP Personnel</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="classification" v-model="classification" value="Others">
                                    <label class="bold ml-10"> Others: </label>
                                    <input type="text" style="margin-left:5px" v-model="others_classification" v-bind:disabled="otherEnabled">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="content-wrapper border-x border-bottom">
                <p class="content-head bold" style="font-size:1.5em;">
                   5. Type of Disability (For Persons with Disability Only:) <span class="to-be-filled"> To be filled by Tesda Personnel</span>
                </p>
            </div>
            <div class="content-wrapper border-bottom border-x">
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Mental/intellectual">
                                    <label class="bold ml-10">Mental/intellectual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10" >
                                    <input type="radio" v-model="disability_type" value="Visual Disability">
                                    <label class="bold ml-10">Visual Disability</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Orthopedic (Musculoskeletal) Disability">
                                    <label class="bold ml-10">Orthopedic (Musculoskeletal) Disability</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Hearing Disability">
                                    <label class="bold ml-10">Hearing Disability</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Speech Impairment">
                                    <label class="bold ml-10">Speech Impairment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Multiple Disabilities, specify">
                                    <label class="bold ml-10">Multiple Disabilities, specify</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Psychosocial Disability">
                                    <label class="bold ml-10"> Psychosocial Disability</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Disability Due to Chronic Illness">
                                    <label class="bold ml-10">Disability Due to Chronic Illness</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_type" value="Learning Disability">
                                    <label class="bold ml-10">Learning Disability</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper border-x border-bottom">
                <p class="content-head bold" style="font-size:1.5em;">
                   6. Causes of Disability (For Persons with Disability Only:) <span class="to-be-filled"> To be filled by Tesda Personnel</span>
                </p>
            </div>
            <div class="content-wrapper border-bottom border-x">
                <div class="row d-flex border-bottom">
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_cause" value="Congenital/Inborn">
                                    <label class="bold ml-10">Congenital/Inborn</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5 border-x">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_cause" value="Illness">
                                    <label class="bold ml-10">Illness</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-33 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" v-model="disability_cause" value="Injury">
                                    <label class="bold ml-10">Injury</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper border-x border-bottom">
                <p class="content-head bold" style="font-size:1.5em;">
                   7. Name of Course/Qualification <input type="text" class="w-100 py-5" v-model="course_qualification">
                </p>
                
            </div>
            <div class="content-wrapper border-x border-bottom">
                <p class="content-head bold" style="font-size:1.5em;">
                   8. If Scholar, What type of Scholarsip Package (TWSP,PESFA,STEP,others)? <input type="text" class="w-100 py-5" v-model="scholarship_package">
                </p>
            </div>
            <div class="content-wrapper border-x border-bottom">
                <p class="content-head bold" style="font-size:1.5em;">
                   9. Privacy Disclaimer
                </p>
            </div>
            <div class="content-wrapper border-bottom border-x">
                <div class="row d-flex">
                    <p class="disclaimer text-justify"> I hereby allow TESDA to use/post/share my contact details, name, email, cellphone/landline nos. and other information I
                        provided which may be used for processing of my scholarship application, for employment opportunities and for the survey
                        of TESDA programs.
                    </p>
                </div>
                <div class="row d-flex border-bottom">
                    <div class="w-50 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10 float-right">
                                    <input type="radio" name="agree" v-model="agree" value="true">
                                    <label class="bold ml-10" style="font-size: 18px;">Agree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-50 p-5">
                        <div class="row">
                            <div class="ml-10">
                                <div class="d-flex cbox p-top-10">
                                    <input type="radio" name="agree" v-model="agree"  value="false">
                                    <label class="bold ml-10" style="font-size: 18px;">Disagree</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper border-x border-bottom">
                <p class="content-head bold" style="font-size:1.5em;">
                  10. Applicants Signature
                </p>
            </div>
            <div class="content-wrapper border-x">
                <p class="p-top-20 text-center text-italic">This is to certify that the information stated above is true and correct </p>
                <div class="row d-flex">
                    <div class="w-40 p-5 h-100" style="margin: auto 0;">
                        <div class="row">
                            <div class="ml-10">
                                <p class="border-top text-large bold text-center p-top-10">APPLICANTS SIGNATURE OVER PRINTED NAME</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-20 p-5 h-100" style="margin: auto 0;">
                        <div class="row">
                            <div class="ml-10">
                                <p class="border-top text-large bold text-center p-top-10">DATE ACCOMPLISHED</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-40 p-5">
                        <div class="row">
                            <div class="upload-box relative">
                                <p class="absolute box-text text-center">1 x 1 picture taken the past 6 months</p>
                                <input type="file" class="w-100 h-100 hidden file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper border-bottom border-x">
                <p class="ml-20 bold">Noted By:</p>
                <div class="row d-flex border-bottom">
                    <div class="w-40 p-5 h-100" style="margin: auto 0;">
                        <div class="row">
                            <div class="ml-10">
                                <p class="border-top text-large bold text-center p-top-10">REGISTRAR/SCHOOL ADMINISTRATOR</p>
                                <p class="text-center"><span>(Signature Over Printed Name) </span></p>
                            </div>
                        </div>
                    </div>
                    <div class="w-20 p-5 h-100" style="margin: auto 0;">
                        <div class="row">
                            <div class="ml-10">
                                <p class="border-top text-large bold text-center p-top-10">DATE RECEIVED</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-40 p-5">
                        <div class="row">
                            <div class="upload-box relative">
                                <input type="file" class="w-100 h-100 hidden file">
                            </div>
                            <p class="text-center bold thumbmark">RIGHT THUMBMARK</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="button" v-on:click="submit">Submit</button>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
                var app = new Vue({
                    el: '#app',
                    data: {
                        agree: "false",
                        learner_id: "",
                        entry_date: "",
                        lastname: "",
                        firstname: "",
                        middlename: "",
                        ext_name: "",
                        street: "",
                        barangay:"",
                        district:"",
                        city:"",
                        province:"",
                        region:"",
                        email:"",
                        contact_number:"",
                        nationality:"",
                        gender:"",
                        civil_status:"",
                        employment_status:"",
                        birthday:"",
                        birth_city:"",
                        birth_province:"",
                        birth_region:"",
                        educational_attainment:"",
                        parent_name:"",
                        parent_mailing_address:"",
                        classification: "",
                        others_classification: "",
                        disability_type: "",
                        disability_cause: "",
                        course_qualification:"",
                        scholarship_package:"",
                        date_received:"",
                        
                        finished: false
                    },
                    async mounted(){
                        const alert = Swal.fire({
                            title: 'Loading',
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()

                            }
                            
                        })
                        const { data } = await axios.get('/learner/setup');
                        this.agree      = "false",
                        this.learner_id = data.profile.learner_id;
                        this.entry_date = data.profile.entry_date;
                        this.lastname   = data.profile.lastname;
                        this.firstname  = data.profile.firstname;
                        this.middlename = data.profile.middlename;
                        this.ext_name = data.profile.ext_name;
                        this.street = data.profile.street;
                        this.barangay = data.profile.barangay;
                        this.district = data.profile.district;
                        this.city = data.profile.city;
                        this.province = data.profile.province;
                        this.region = data.profile.region;
                        this.email = data.profile.email;
                        this.contact_number = data.profile.contact_number;
                        this.nationality = data.profile.nationality;
                        this.gender = data.profile.gender;
                        this.civil_status = data.profile.civil_status;
                        this.employment_status = data.profile.employment_status;
                        this.birthday = data.profile.birthday;
                        this.birth_city = data.profile.birth_city;
                        this.birth_province = data.profile.birth_province;
                        this.birth_region = data.profile.birth_region;
                        this.educational_attainment = data.profile.educational_attainment;
                        this.parent_name = data.profile.parent_name;
                        this.parent_mailing_address = data.profile.parent_mailing_address;
                        this.classification = data.profile.classification;
                        this.others_classification = data.profile.others_classification;
                        this.disability_type = data.profile.disability_type;
                        this.disability_cause = data.profile.disability_cause;
                        this.course_qualification = data.profile.course_qualification;
                        this.scholarship_package = data.profile.scholarship_package;
                        this.date_received = data.profile.date_received;
                        alert.close()
                    },
                    methods : {
                        async submit(){
                            const alert = Swal.fire({
                            title: 'Loading',
                            timerProgressBar: true,
                            didOpen: () => {
                                    Swal.showLoading()

                                }
                                
                            })
                            try{
                                
                                const {data} = await axios.post('/learner/profile', this.$data)
                                await Swal.fire(data.message, '', 'success');
                                location.href = "/show_dashboard_students"

                            } catch (e){
                                alert.close()
                                if(e.response.status == 422)
                                    {
                                        this.errors = e.response.data.errors
                                        Swal.fire('Please fill required fields', '', 'info');


                                    }
                            }
                            
                        }
                    },
                    computed:{
                        otherEnabled(){
                            return this.classification != 'Others'
                        },
                        age(){

                            var today = new Date();
                            var birthDate = new Date(this.birthday);
                            var age = today.getFullYear() - birthDate.getFullYear();
                            var m = today.getMonth() - birthDate.getMonth();
                            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            if(isNaN(age)){
                                return '';
                            }
                            return age;
                        }
                    }
                })
        </script>
    </body>
</html>