<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url(''); ?>assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title><?= $title; ?></title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url(''); ?>assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="<?= base_url(''); ?>assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- SweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">

  <!-- Css DataTable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.0/css/buttons.bootstrap4.min.css">

  <!-- Select 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Helpers -->
  <script src="<?= base_url(''); ?>assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= base_url(''); ?>assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php $this->load->view('template/sidebar'); ?>

      <!-- Layout container -->
      <div class="layout-page">
        <?php $this->load->view('template/navbar'); ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div id="alert-succeed" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
            <div id="alert-wrong" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
            <?= $contents; ?>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://www.instagram.com/bgsmhrdkabdhrto_/" target="_blank" class="footer-link fw-bolder">Bgsmhrdkabdhrto_</a>
              </div>
              <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="<?= base_url(''); ?>assets/vendor/libs/jquery/jquery.js"></script>
  <script src="<?= base_url(''); ?>assets/vendor/libs/popper/popper.js"></script>
  <script src="<?= base_url(''); ?>assets/vendor/js/bootstrap.js"></script>
  <script src="<?= base_url(''); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="<?= base_url(''); ?>assets/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?= base_url(''); ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="<?= base_url(''); ?>assets/js/main.js"></script>

  <!-- Page JS -->
  <script src="<?= base_url(''); ?>assets/js/dashboards-analytics.js"></script>

  <!-- DataTable -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>

  <!-- Select 2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  <script>
    $('#ngilang').delay('slow').slideDown('slow').delay(4000).slideUp(600)

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
      $('.js-select2').select2();
    });

    $(function() {
      $("#myTable").DataTable();
    });

    const flashData = $("#alert-succeed").data("flashdata"),
      flash = $("#alert-wrong").data("flashdata");
    if (flashData) {
      swal.fire({
        icon: "success",
        title: "Selamat",
        text: flashData,
        type: "success",
      });
    }
    if (flash) {
      swal.fire({
        icon: "error",
        title: "Gagal Kenapa?",
        text: flash,
      });
    }

    $(document).on("click", "#btn-hapus", function(e) {
      e.preventDefault();
      const href = $(this).attr("href");

      Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Data Akan DiHapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus Data!",
      }).then((result) => {
        if (result.isConfirmed) {
          document.location = href;
        }
      });
    });

    $(document).on("click", "#yakin", function(e) {
      e.preventDefault();
      const href = $(this).attr("href");

      Swal.fire({
        title: "Apakah Anda Yakin?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yakinn!",
      }).then((result) => {
        if (result.isConfirmed) {
          document.location = href;
        }
      });
    });
  </script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>