<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | <?= $pageTitle ?? "Dashboard" ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= PAGE_ICON_IMAGE_URL ?>" rel="icon">
  <link href="<?= base_url() ?> assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <!-- loader css -->
  <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
  <!-- == -->
  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <script>
    const loginUrl = "<?= base_url('libraries/login') ?>";
    /**
     * local storage data 
     */
    const loggedUserDetailsRaw = localStorage.getItem('loggedUserDetails');

    let loggedUserDetails = null;

    if (loggedUserDetailsRaw === null) {
      console.error('Invalid JSON in loggedUserDetails');
      setTimeout(function() {
        window.location.href = loginUrl;
      }, 1500);
    }

    loggedUserDetails = JSON.parse(loggedUserDetailsRaw);
    let userId = loggedUserDetails.userId;
    let loginSessionId = loggedUserDetails.loginSessionId;
    console.log('===================== loggedUserDetails:', loggedUserDetails);

    /**
     * url string 
     * data array or object
     * accepts method(GET , POST , PATCH ,PUT , DELETE)
     * !test report 
     *      -- 
     */
    function HandleAjaxRequest(url, data, method) {
      console.log("======================", data);

      return new Promise((resolve, reject) => {
        $.ajax({
          url: url,
          data: data,
          type: method,
          dataType: "json",
          success: function(response) {
            resolve({
              status: response.success ?? false,
              statusCode: response.httpStatus ?? 405,
              message: response.message,
              data: response.data ?? null,
              errors: response.errors ?? null,
            });
          },
          error: function(xhr, ajaxOptions, thrownError) {
            if (xhr.status === 401) {
              window.location.href = loginUrl;
            }
            reject(xhr.responseJSON);
          }
        });
      });
    }
  </script>

  <div id="global-loader">
    <div class="loader-spinner"></div>
  </div>