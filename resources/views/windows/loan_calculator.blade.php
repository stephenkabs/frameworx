<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Loans</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>
<style>
    .calculator {
        max-width: 400px;
        margin: 20px auto;
        padding: 10px;
        background: #2a2a2a;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        color: #fff;
    }

    .display {
        font-size: 2rem;
        background: #444;
        color: #fff;
        text-align: right;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .buttons {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }

    .button {
        background: #555;
        color: #fff;
        border: none;
        padding: 15px;
        font-size: 1.2rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .button:hover {
        background: #777;
    }

    .button.function {
        background: #6c757d;
    }

    .button.operator {
        background: #007bff;
    }

    .button.operator:hover {
        background: #0056b3;
    }

    .button:active {
        background: #333;
    }
</style>

<body style="background: radial-gradient(circle, rgb(13, 64, 84) 30%, rgb(6, 24, 57) 100%);"  data-sidebar="dark">
    @include('loader.loader')

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.header')

        @include('includes.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-6">
                            <div style="background-color: transparent" class="card">
                                <div  class="card-body">
                                    <div class="calculator">
                                        <div class="display" id="display">0</div>
                                        <div class="buttons">
                                            <button class="button function" onclick="calculateFunction('sin')">sin</button>
                                            <button class="button function" onclick="calculateFunction('cos')">cos</button>
                                            <button class="button function" onclick="calculateFunction('tan')">tan</button>
                                            <button class="button function" onclick="calculateFunction('log')">log</button>
                                            <button class="button function" onclick="calculateFunction('sqrt')">√</button>

                                            <button class="button" onclick="clearDisplay()">C</button>
                                            <button class="button operator" onclick="appendOperator('/')">/</button>
                                            <button class="button operator" onclick="appendOperator('*')">*</button>
                                            <button class="button operator" onclick="appendOperator('-')">-</button>
                                            <button class="button operator" onclick="appendOperator('+')">+</button>

                                            <button class="button" onclick="appendNumber(7)">7</button>
                                            <button class="button" onclick="appendNumber(8)">8</button>
                                            <button class="button" onclick="appendNumber(9)">9</button>
                                            <button class="button operator" onclick="appendOperator('^')">^</button>
                                            <button class="button" style="visibility: hidden;"></button>

                                            <button class="button" onclick="appendNumber(4)">4</button>
                                            <button class="button" onclick="appendNumber(5)">5</button>
                                            <button class="button" onclick="appendNumber(6)">6</button>
                                            <button class="button" onclick="calculateResult()">=</button>
                                            <button class="button" style="visibility: hidden;"></button>

                                            <button class="button" onclick="appendNumber(1)">1</button>
                                            <button class="button" onclick="appendNumber(2)">2</button>
                                            <button class="button" onclick="appendNumber(3)">3</button>
                                            <button class="button" onclick="appendDot()">.</button>
                                            <button class="button" style="visibility: hidden;"></button>

                                            <button class="button" onclick="appendNumber(0)" style="grid-column: span 2;">0</button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Loan Calculator</h3>

                                    <!-- Loan Form Inputs -->
                                    <form id="loan-form">
                                        <div class="form-group">
                                            <label for="loan-amount">Loan Amount ($)</label>
                                            <input type="number" id="loan-amount" class="form-control" placeholder="Enter loan amount" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="interest-rate">Interest Rate (%)</label>
                                            <input type="number" id="interest-rate" class="form-control" placeholder="Enter interest rate" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="loan-term">Term (Months)</label>
                                            <input type="number" id="loan-term" class="form-control" placeholder="Enter loan term in months" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="late-payment-days">Late Payment Days</label>
                                            <input type="number" id="late-payment-days" class="form-control" placeholder="Enter late payment days" required>
                                        </div>

                                        <!-- New input for manual late payment fee -->
                                        <div class="form-group">
                                            <label for="manual-late-fee">Manual Late Payment Fee ($)</label>
                                            <input type="number" id="manual-late-fee" class="form-control" placeholder="Enter additional late fee" value="0">
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-3">Calculate</button>
                                    </form>

                                    <hr>

                                    <h4>Loan Summary</h4>
                                    <div>
                                        <p><strong>Interest: </strong><span id="calculated-interest">0</span></p>
                                        <p><strong>Total Loan Repayable: </strong><span id="total-repayable">0</span></p>
                                        <p><strong>Late Payment Fee: </strong><span id="late-payment-fee">0</span></p>
                                        <p><strong>Total Amount Due (including late fee): </strong><span id="total-due">0</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                        // JavaScript Logic for Loan Calculator
                        document.getElementById('loan-form').addEventListener('submit', function(event) {
                            event.preventDefault(); // Prevent form submission to allow calculations

                            // Get input values
                            const loanAmount = parseFloat(document.getElementById('loan-amount').value);
                            const interestRate = parseFloat(document.getElementById('interest-rate').value);
                            const loanTerm = parseInt(document.getElementById('loan-term').value);
                            const latePaymentDays = parseInt(document.getElementById('late-payment-days').value);
                            const manualLateFee = parseFloat(document.getElementById('manual-late-fee').value);

                            // Validate input fields
                            if (isNaN(loanAmount) || isNaN(interestRate) || isNaN(loanTerm) || isNaN(latePaymentDays) || isNaN(manualLateFee)) {
                                alert('Please enter valid values in all fields.');
                                return;
                            }

                            // Calculate Interest and Repayable Amount
                            const interest = (loanAmount * interestRate) / 100; // Simple interest based on the loan amount and interest rate
                            const totalRepayable = loanAmount + interest; // Total repayable amount including interest

                            // Calculate Late Payment Fee (Assuming a daily fee of 0.1% of the loan amount)
                            const lateFeeRate = 0.001; // 0.1% daily charge
                            const latePaymentFee = (loanAmount * lateFeeRate * latePaymentDays) + manualLateFee; // Adding manual late fee

                            // Calculate Total Amount Due (including late fee)
                            const totalDue = totalRepayable + latePaymentFee;

                            // Update the UI with calculated values
                            document.getElementById('calculated-interest').textContent = interest.toFixed(2);
                            document.getElementById('total-repayable').textContent = totalRepayable.toFixed(2);
                            document.getElementById('late-payment-fee').textContent = latePaymentFee.toFixed(2);
                            document.getElementById('total-due').textContent = totalDue.toFixed(2);
                        });
                        </script>


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


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <script src="/assets/libs/parsleyjs/parsley.min.js"></script>

    <script src="/assets/js/pages/form-validation.init.js"></script>

    <script src="/assets/js/app.js"></script>
    <script>
        // Calculator JavaScript
        let displayElement = document.getElementById('display');
        let currentInput = '';

        function appendNumber(number) {
            currentInput += number;
            displayElement.innerText = currentInput;
        }

        function appendOperator(operator) {
            currentInput += ` ${operator} `;
            displayElement.innerText = currentInput;
        }

        function appendDot() {
            if (!currentInput.includes('.')) {
                currentInput += '.';
                displayElement.innerText = currentInput;
            }
        }

        function clearDisplay() {
            currentInput = '';
            displayElement.innerText = '0';
        }

        function calculateFunction(func) {
            try {
                let value = parseFloat(currentInput);
                let result;

                switch (func) {
                    case 'sin':
                        result = Math.sin(value);
                        break;
                    case 'cos':
                        result = Math.cos(value);
                        break;
                    case 'tan':
                        result = Math.tan(value);
                        break;
                    case 'log':
                        result = Math.log10(value);
                        break;
                    case 'sqrt':
                        result = Math.sqrt(value);
                        break;
                    default:
                        result = value;
                }

                currentInput = result.toString();
                displayElement.innerText = currentInput;
            } catch (error) {
                displayElement.innerText = 'Error';
            }
        }

        function calculateResult() {
            try {
                let result = eval(currentInput.replace('^', '**'));
                currentInput = result.toString();
                displayElement.innerText = currentInput;
            } catch (error) {
                displayElement.innerText = 'Error';
            }
        }
    </script>
</body>

</html>
