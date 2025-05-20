<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $contract->name }} Contract Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>
<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  data-sidebar="dark">
    @include('loader.loader')

<!-- Begin page -->
<div id="layout-wrapper">

@include('includes.header')
@include('includes.sidebar')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                                <div class="row">
<!--                     <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">CONTRACT OF EMPLOYMENT</h4>
                                <p class="card-title-desc">Parsley is a javascript form validation library. It helps
                                    you provide your users with feedback on their form submission before sending it
                                    to your server.</p>



                            </div>
                        </div>
                    </div> -->
                    <!-- end col -->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <img src="/company/images/{{ $contract->image }}" alt="" class="img-fluid rounded-4 d-block" style="width: 100px"><br>
                                <h4 class="card-title" style="text-transform: uppercase;">{{ $contract->employee->name }} CONTRACT OF EMPLOYMENT</h4><hr><br><br>
                                <p><b>THIS CONTRACT OF EMPLOYMENT,</b> dated on the 2nd day of January in the year 2024 is made <b style="text-transform: uppercase;">{{ $contract->name }}</b> registered office at <b style="text-transform: uppercase;">{{ $contract->address }}</b>, in the Republic of Zambia (“Company’’) of the one part AND <b style="text-transform: uppercase;">{{ $contract->employee->name }}</b> a Citizen of the Republic of Zambia of Gender Male of age <b>27 years</b> National Registration Card Number <b style="text-transform: uppercase;">{{ $contract->employee->nrc_number }}</b> and Social Security Number <b style="text-transform: uppercase;">{{ $contract->employee->security_number }}</b>  and having their <b style="text-transform: uppercase;">{{ $contract->employee->address }} Province of Zambia</b> (“the Employee”) of the other part.

                                    <br><br>WHEREAS the Company has offered the Employee a Fixed Term Contract in the capacity of Software Developer for the Company and the Employee has accepted to serve as such on the terms and conditions hereinafter set out as follows:</p>


                                 <!-- ---------DEFINITIONS AND INTERPRETATIONS---------- -->
                                    <ul >
                                        <li style="list-style-type: none;"><b>1.0 DEFINITIONS AND INTERPRETATIONS</b></li>
                                        <li style="list-style-type: none;">Definitions In this Contract unless the context otherwise requires-</li><br>

                                        <!-- ------listing------- -->
                                        <ul><li style="list-style-type: none;"><b>“Gross monthly salary”</b> means total remuneration, before statutory deductions (Taxes & Social Security), inclusive of applicable perks agreed thereof.</li></ul><br>

                                        <ul><li style="list-style-type: none;"><b>“Commencement Date” </b> means the date of this Contract;</li></ul><br>


                                        <ul><li style="list-style-type: none;"><b>“Confidential Information”</b> means all and any information or data in whatever form (including oral, written, electronic and visual form) relating to the Company, which by its nature or content Is identifiable as, or could reasonably be expected to be, confidential and/or proprietary to the Company;</li></ul><br>

                                        <ul><li style="list-style-type: none;"><b>“Contract”</b> means this Contract of Employment;</li></ul><br>

                                        <ul><li style="list-style-type: none;"><b>“Duties”</b> means the tasks to be performed by the Employee as provided in their job description;</li></ul><br>

                                        <ul><li style="list-style-type: none;"><b>“Policy”</b> means the Company’s applicable policies as may be amended from time to time;</li></ul><br>


                                        <ul><li style="list-style-type: none;"><b>“Parties”</b> mmeans the Company and the Employee; and</li></ul><br>

                                        <ul><li style="list-style-type: none;"><b>“Terms and Conditions”</b> means the Company’s Terms and Conditions of Service as amended from time to time.</li></ul>
                                    </ul><br>



                                    <!-- ---------DEFINITIONS AND INTERPRETATIONS---------- -->
                                    <ul >
                                        <li style="list-style-type: none;"><b>2.0 ENGAGEMENT OF EMPLOYEE</b></li><br>
                                        <p style="list-style-type: none;">2.1 The Company engages the Employee in the capacity of <b style="text-transform: uppercase;">{{ $contract->position }}</b> and the Employeea grees to faithfully and to the best of their ability carryout the duties and responsibilities set forth for the duration of the Employment until otherwise advised. The employee shall comply with all company policies, regulations and procedures at all times and agrees that his or her performance will be subject to an annual review in accordance with the existing performance management and assessment system provisions.</p><br>
                                    </ul>



                                    <!-- ---------3.0 COMMENCEMENT AND DURATION OF EMPLOYMENT---------- -->
                                    <ul >
                                        <li style="list-style-type: none;"><b>3.0 COMMENCEMENT AND DURATION OF EMPLOYMENT</b></li><br>
                                        <p style="list-style-type: none;">The Employee shall be in the employment of the Company on fixed term contract for a period of two years (02) commencing the period of 2nd January 2024 to 2nd January 2026.</p><br>
                                    </ul>


                                  <!-- ---------4.0 PLACE OF EMPLOYMENT---------- -->
                                    <ul >
                                        <li style="list-style-type: none;"><b>4.0 PLACE OF EMPLOYMENT</b></li><br>
                                        <p style="list-style-type: none;">4.1 The Employee’s place of employment shall be {{ $contract->employee->address }}</p>
                                      <p style="list-style-type: none;">4.2 Despite clause 4.1, the Company may request the Employee to work from other places as the Company may from time to time direct.</p><br>

                                    </ul>


                                    <!-- ---------5.0 EMPLOYEE’S DUTIES---------- -->
                                    <ul >
                                        <li style="list-style-type: none;"><b>5.0 EMPLOYEE’S DUTIES</b></li><br>
                                        {{-- @foreach($duties as $index => $dutyItem)
                                        <p style="list-style-type: none;">5.{{ $index + 1 }} <i>{!! $dutyItem->duties !!}</i></p>
                                      @endforeach --}}

                                      <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Duty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($duties as $index => $dutyItem)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td> <!-- Increment the index for numbering -->
                                                    <td>{{ $dutyItem }}</td>    <!-- Display the duty -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </ul>

                                    <!-- ---------6.0 REMUNERATION AND PAY DAY---------- -->
                                    <ul >
                                        <li style="list-style-type: none;"><b>6.0 REMUNERATION AND PAY DAY</b></li><br>
                                        <p style="list-style-type: none;">66.1 Subject to review by the Board, the Company shall pay the employee a monthly gross salary of <b>{{ number_format( $contract->basic_salary, 0) }}</b> being the aggregate of the following:</p>

                                    <div class="table-responsive">
                                    <table class="table table-bordered mb-0">

                                        <thead>
                                            <tr>

                                                <th>Allowances</th>
                                                <th>Amount</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                <td><b>Basic salary</b></td>
                                                <td><b>{{ number_format( $contract->employee->salary->basic_salary, 0) }}</b></td>
                                            </tr> --}}
                                            {{-- <tr>
                                                <td><b>Housing Allowance</b></td>
                                                <td>{{ number_format( $contract->housing_allowance, 0) }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Transport allowance</b></td>
                                                <td>{{ $contract->transport_allowance  }}</td>
                                            </tr>
                                             <tr>
                                                <td><b>Monthly gross earnings</b></td>
                                                <td><b>{{ number_format( $contract->transport_allowance + $contract->housing_allowance ) }}</b></td>

                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div><br><br>

                               <div class="table-responsive">
                               <p style="list-style-type: none;"><b>LESS</b></p>
                                    {{-- <table class="table table-bordered mb-0">

                                        <thead>
                                            <tr>

                                                <th>Firm Contribution</th>
                                                <th>Amount</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contributions as $item)


                                            <tr>
                                                <td><b>{{ $item->name }}</b></td>
                                                <td><b>{{ $item->amount}}</b></td>
                                            </tr>
                                            @endforeach
                                             <tr>
                                                <td><b>Monthly net earnings</b></td>
                                                <td><b>hh</b></td>
                                            </tr>
                                        </tbody>
                                    </table> --}}
                                </div><br><br>

                             <p style="list-style-type: none;">6.2 The Company’s official pay day shall be on the twenty-fifth (25th) day of each month or the twenty- four where the twenty - fifth day is a non-working day.</p><br>

                            <p style="list-style-type: none;">6.3 Such Gross salary shall be paid by equal monthly instalments in arrears on the twenty- fifth day of the month or any other designated day and shall accrue from day to day.</p>

                                    </ul><br><br>



                                    <!-- ---------DEFINITIONS AND INTERPRETATIONS---------- -->
                                    <ul >
                                        <li style="list-style-type: none;"><b>7.0 TERMS AND CONDITIONS OF SERVICE</b></li><br>
                                        <p style="list-style-type: none;">7.1 The Company’s terms and conditions as may be amended from time to time are incorporated into this Contract and shall be read as one with this Contract.</p><br>
                                        <p style="list-style-type: none;">7.2 Where this Contract is silent on any matter, the Terms and Conditions will apply and where the Terms and Conditions are silent on the matter, the Laws of Zambia will apply.</p><br>
                                        <p style="list-style-type: none;">7.3 Leave entitlement</p>
                                        <p style="list-style-type: none;">An employee who remains in continuous employment with the Company for a period of 12 consecutive months shall be granted, during each subsequent period of 12 months, while the employee remains in continuous employment, annual leave on full pay per month at a rate of two leave days per month.</p>

                                        <p style="list-style-type: none;">Paternity leave</p>
                                        <p style="list-style-type: none;">A male employee who remains in continuous employment with the Company for a period of 12 months immediately preceding the beginning of paternity leave shall be entitled to 5 continuous working days as paternity leave, if — The employee is the father of the child; The employee has submitted to the company birth record of the child; and The leave is taken within 7 days of the birth of a child.</p><br>

                                        <p style="list-style-type: none;">Compassionate leave</p>
                                        <p style="list-style-type: none;">An employee is entitled to compassionate leave with full pay for a period of 12 days in a calendar year where that employee has: Lost a spouse, parent, child or dependant; or A justifiable compassionate ground.</p><br>

                                        <p style="list-style-type: none;">Family Responsibility Leave</p>
                                        <p style="list-style-type: none;">An employee who has worked for a period of 6 months or more, shall be granted leave of absence with pay for a period not exceeding 7 days in a calendar year to enable the employee to nurse a sick spouse, child or dependant, except that the Company may, before granting that leave, require the employee to produce a certificate from a medical doctor certifying that the spouse, child or dependant is sick and requires special attention.An employee is also entitled to 3 paid leave days per year to cover responsibilities related to the care, health or education for that employee’s child, spouse or dependant.The days taken as family responsibility leave shall not be cumulative or deducted from the employee’s accrued leave days.</p><br>

                                        <p style="list-style-type: none;">7.4 Gratuity</p>
                                        <p style="list-style-type: none;">Upon successful completion of a fixed term contract, an employee shall be paid gratuity at 25% of the employee’s Basic Pay earned during the contract period. Where an employee’s fixed term Contract is terminated, the employee shall be paid gratuity prorated in accordance with the period of employment.</p><br>


                                        <p style="list-style-type: none;"><b>8.0 DISCIPLINARY CODE OF CONDUCT AND GRIEVANCE PROCEDURE CODE</b></p>
                                        <p style="list-style-type: none;">The Company’s Disciplinary Code of Conduct and Grievance Procedure Code as amended from time to time shall apply to the Employee in so far matters relating to discipline or a grievance, respectively.</p><br>


                                        <p style="list-style-type: none;"><b>9.0 CONFIDENTIALITY</b></p>
                                        <p style="list-style-type: none;">9.1 The Employee shall at all times maintain confidentiality in the discharge of their duties.</p>

                                        <p style="list-style-type: none;">9.2 The Employees shall in the discharge all the Employee’s duties be subject to the Confidentiality Agreement, provided hereto.</p>
                                        <br>


                                        <p style="list-style-type: none;"><b>10.0 TERMINATION OF EMPLOYMENT</b></p>
                                        <p style="list-style-type: none;">10.1 The employment may be terminated by the-
                                        (a) Company giving the Employee three (3) months’ notice in writing or payment of three (3) months’ salary in lieu of notice; or (b) Employee giving the Company one (1) months’ notice in writing or payment of One (1) months’ salary in lieu of notice.</p>
                                        <br>
                                        <p style="list-style-type: none;">10.2 The Employee shall not after the termination of employment hereunder wrongfully represent themselves as being employed by or connected with the Company.</p>
                                        <br>

                                        <p style="list-style-type: none;">10.3 The Employee shall return all Company property at the time of termination.</p>
                                        <br>

                                        <p style="list-style-type: none;"><b>11.0 NOTICES</b></p>
                                        <p style="list-style-type: none;">11.1 A notice in writing to be served hereunder may be given personally to the Employee or may be posted to the Company at its registered office for the time being or to the Employee either at the Employee’s address or last known address.</p>

                                        <p style="list-style-type: none;">11.2 A notice sent by post shall be deemed to have been duly served seventy-two hours after it is posted and in providing such service it shall be sufficient to prove that the notice was properly addressed and put in the post.</p>
                                        <br>

                                        <p style="list-style-type: none;"><b>12.0 VARIATION OR AMENDMENT</b></p>
                                        <p style="list-style-type: none;">12.1 A variation or amendment of the terms of this Contract shall be in writing and signed by the Parties hereto.</p>

                                        <p style="list-style-type: none;">12.2 A variation or amendment that is not made in accordance with this clause shall be invalid.</p>
                                        <br>



                                        <p style="list-style-type: none;"><b>13.0 SEVERABILITY</b></p>
                                        <p style="list-style-type: none;">13.1 This Contract shall not be rendered invalid by reason only that a provision(s) of this Contract (or any document referred to, herein) is or at any time becomes illegal, invalid or unenforceable in any respect.</p>

                                        <p style="list-style-type: none;">13.2 A provision(s) of this Contract, which is or becomes invalid, illegal or unenforceable is invalid to the extent of the inconsistency.</p>
                                        <br>


                                        <p style="list-style-type: none;"><b>14.0 DISPUTE SETTLEMENT</b></p>
                                        <p style="list-style-type: none;">Either Party may, where a claim or dispute arises relating to this Contract, which cannot be amicably resolved, seek redress through the Courts of Law.</p>


                                        <p style="list-style-type: none;"><b>15.0 GOVERNING LAW</b></p>
                                        <p style="list-style-type: none;">This contract is governed by the Laws of Zambia.</p><br><br><br><br><br><br><br><br><br><br><br><br>
                                        <p style="list-style-type: none;"><b>IN WITNESS,</b> the Parties herein have affixed their signatures in the year and date set-forth below</p><br>

                                        <p style="list-style-type: none;"><b>SIGNED for and on Behalf of .......................................................................................................... LIMITED</b> the Parties herein have affixed their signatures in the year and date set-forth below</p>

                                        <p style="list-style-type: none;"><b>NAME: .................................................<br>DESIGNATION: DIRECTOR<br>DATE ....................................................<br>In the presence of:</p>

                                        <p style="list-style-type: none;"><b>WITNESS<br> Name: ....................................................</b> <br>Signature...............................................<br>Date: ......................................................</p>


                                        <p style="list-style-type: none;"><b>SIGNED BY EMPLOYEE<br> Name: ....................................................</b> <br>Signature:..............................................<br>Date: ......................................................</p>


                                    </ul>











                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                                                <div class="d-print-none">
                                                    <div class="float-end">
                                                        <a href="javascript:window.print()"
                                                            class="btn btn-success waves-effect waves-light">Export in PDF</a>
                                                        <a href="#"
                                                            class="btn btn-primary waves-effect waves-light">Send</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

@include('includes.taskbar')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Demo</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="/assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="/assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="/assets/css/bootstrap-dark.min.css" data-appStyle="/assets/css/app-dark.min.css" />
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="/assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="/assets/css/app-rtl.min.css" />
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <h6 class="mt-4">Select Custom Colors</h6>
            <div class="d-flex">

            <ul class="list-unstyled mb-0">
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                    <label class="form-check-label" for="theme-default">Default</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-orange" value="orange" onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                    <label class="form-check-label" for="theme-orange">Orange</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                    <label class="form-check-label" for="theme-teal">Teal</label>
                </li>
            </ul>

            <ul class="list-unstyled mb-0 ms-4">
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-purple" value="purple" onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                    <label class="form-check-label" for="theme-purple">Purple</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                    <label class="form-check-label" for="theme-green">Green</label>
                </li>
                <li class="form-check">
                    <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                    <label class="form-check-label" for="theme-red">Red</label>
                </li>
            </ul>

            </div>
            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                <label class="form-check-label" for="theme-default">Default</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                <label class="form-check-label" for="theme-teal">Teal</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-orange" value="orange" onchange="document.documentElement.setAttribute('data-theme-mode', 'orange')">
                <label class="form-check-label" for="theme-orange">Orange</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-purple" value="purple" onchange="document.documentElement.setAttribute('data-theme-mode', 'purple')">
                <label class="form-check-label" for="theme-purple">Purple</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-green" value="green" onchange="document.documentElement.setAttribute('data-theme-mode', 'green')">
                <label class="form-check-label" for="theme-green">Green</label>
            </div> -->

            <!-- <div class="form-check form-check-inline">
                <input class="form-check-input theme-color" type="radio" name="theme-mode"
                    id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                <label class="form-check-label" for="theme-red">Red</label>
            </div> -->
        </div>

    </div>
    <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>

<script src="/assets/js/app.js"></script>

</body>

</html>
