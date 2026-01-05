<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Library | Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('') ?>assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('') ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="<?= base_url('') ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('') ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        .otp-box {
            width: 50px;
            height: 50px;
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Library</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body" id="loginFromDiv">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>
                                    <form id="loginFromSubmit" action="#" method="" lass="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input id="email" type="email" name="email" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12" style="padding-bottom: 10px;">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input id="password" type="password" name="password" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12" style="padding-top:10px;">
                                            <p class=" small mb-0">Don't have account? <a href="pages-register.html">Forgot Password</a></p>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-body" id="otpValidationDiv" style="display: none;">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your 4-digit OTP</p>
                                    </div>

                                    <form id="otpSubmitForm" novalidate>
                                        <div class="d-flex justify-content-center gap-2 mb-3 otp-inputs">
                                            <input type="text" class="form-control text-center otp-box" maxlength="1" inputmode="numeric">
                                            <input type="text" class="form-control text-center otp-box" maxlength="1" inputmode="numeric">
                                            <input type="text" class="form-control text-center otp-box" maxlength="1" inputmode="numeric">
                                            <input type="text" class="form-control text-center otp-box" maxlength="1" inputmode="numeric">
                                        </div>

                                        <input type="hidden" name="otp" id="otpValue">

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">
                                                Verify OTP
                                            </button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="<?= base_url('') ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/quill/quill.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('') ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('') ?>assets/js/main.js"></script>
</body>
<script>
    const otpBoxes = document.querySelectorAll('.otp-box');
    const otpValue = document.getElementById('otpValue');

    otpBoxes.forEach((box, index) => {

        // Only numbers + auto move
        box.addEventListener('input', (e) => {
            box.value = box.value.replace(/[^0-9]/g, '');

            if (box.value && index < otpBoxes.length - 1) {
                otpBoxes[index + 1].focus();
            }

            updateOtp();
        });

        // Backspace support
        box.addEventListener('keydown', (e) => {
            console.log("============= Backspace ", e);

            if (e.key === "Backspace" && !box.value && index > 0) {
                otpBoxes[index - 1].focus();
            }
        });

        // Paste support (1234)
        box.addEventListener('paste', (e) => {
            e.preventDefault();

            const pasteData = e.clipboardData.getData('text').replace(/\D/g, '');
            if (!pasteData) return;

            pasteData.split('').forEach((num, i) => {
                if (otpBoxes[i]) {
                    otpBoxes[i].value = num;
                }
            });

            updateOtp();
            otpBoxes[Math.min(pasteData.length, otpBoxes.length) - 1].focus();
        });
    });

    function updateOtp() {
        let otp = '';
        otpBoxes.forEach(box => otp += box.value);
        otpValue.value = otp;
    }
    document.getElementById('otpSubmitForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (otpValue.value.length !== 4) {
            notificationMessage('Please enter full 4-digit OTP');
            return;
        }

        console.log("OTP Submitted:", otpValue.value);

        // AJAX API call here
    });


    $('#loginFromSubmit').submit(function(e) {
        e.preventDefault();

        let email = $('#email').val().trim();
        let password = $('#password').val().trim();
        let loginFromDiv = $('#loginFromDiv');

        if (email === '') {
            return notificationMessage('Email is required', 'error');
        }

        if (password === '') {
            return notificationMessage('Password is required', 'error');
        }

        const loginPayload = {
            email: email,
            password: password
        };
        const deviceInfo = {
            userAgent: navigator.userAgent,
            platform: navigator.platform,
            language: navigator.language,
            screen: `${screen.width}x${screen.height}`,
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        };

        console.log("================== deviceInfo ", JSON.stringify(deviceInfo));


        $.ajax({
            type: "POST",
            url: "http://localhost:8080/backend-api/libraries/login",
            contentType: "application/json",
            data: JSON.stringify(loginPayload),
            success: function(response) {
                notificationMessage(response.message, 'success');
                const loginData = response.data;
                const dashboardUrl = "<?= base_url('libraries/dashboard') ?>";
                if (response.success && response.httpStatus === 200) {
                    if (loginData.twoSetupAuthentication === false) {
                        localStorage.setItem(
                            'loggedUserDetails',
                            JSON.stringify(loginData.loginUserData)
                        );
                       
                        setTimeout(() => {
                            window.location.href = dashboardUrl;
                        }, 1200);
                    } else {
                        const otpValidationDiv = document.getElementById('otpValidationDiv');
                        loginFromDiv.css("display", "none");
                        otpValidationDiv.style.display = "block";
                    }
                }
            },
            error: function(xhr) {
                notificationMessage(xhr.responseJSON.message);
                console.log("================ error Response", xhr);


                console.error(xhr.responseJSON);
            }
        });
    });
</script>
<script>
    function notificationMessage(message, type = 'error') {
        let bgColor = "";

        if (type === "success") {
            bgColor = "linear-gradient(to right, #00b09b, #96c93d)";
        } else if (type === "error") {
            bgColor = "linear-gradient(to right, #ff5f6d, #ffc371)";
        }

        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: bgColor,
            },
        }).showToast();
    }
</script>

</html>