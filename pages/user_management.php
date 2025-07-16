<?php
session_start();
require_once '../class/encrypt.class.php';
$Encrypt = new Encrypt_data();
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>โพสต์</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="../assets/images/authentication/image.png" type="image/x-icon"> <!-- [Google Font] Family -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="../assets/fonts/feather.css">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/fontawesome.css">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="../assets/fonts/material.css">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link">
  <link rel="stylesheet" href="../assets/css/style-preset.css">

  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <!-- Bootstrap 5 CSS & JS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

  <!-- Bootstrap Icons (สำหรับจุดไข่ปลา) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">



  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
  <style>
    .post {
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }


    /* #post-container {
      min-height: 100vh;
    } */
  </style>
  <style>
    /* Skeleton Container */
    .skeleton-post {
      display: flex;
      align-items: flex-start;
      padding: 16px;
      /* background: #f1f1f1; */
      background: rgb(210, 241, 255);
      border-radius: 12px;
      margin-bottom: 16px;
      gap: 16px;
    }

    /* Avatar Placeholder */
    .skeleton-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      /* background-color: #ccc; */
      background-color: skyblue;
    }

    /* Text Lines Placeholder */
    .skeleton-lines {
      flex: 1;
    }

    .skeleton-line {
      height: 14px;
      /* background-color: #ccc; */
      background-color: skyblue;
      margin-bottom: 8px;
      border-radius: 8px;
    }

    .skeleton-line.short {
      width: 60%;
    }

    /* Animation effect */
    .shimmer {
      position: relative;
      overflow: hidden;
    }

    .shimmer::before {
      content: '';
      position: absolute;
      top: 0;
      left: -150px;
      height: 100%;
      width: 150px;
      background: linear-gradient(to right, transparent 0%, rgba(255, 255, 255, 0.6) 50%, transparent 100%);
      animation: loading 1.2s infinite;
    }

    @keyframes loading {
      100% {
        left: 100%;
      }
    }
  </style>
  <style>
    /* กำลังแก้ไข: พื้นหลังสีว่าง */
    .editing-effect {
      background-color: #fff8dc;
      /* light yellow */
      transition: background-color 0.4s ease;
    }

    /* Fade out ข้อมูลเก่า */
    .fade-out-old {
      animation: fadeOutMove 0.3s forwards;
    }

    @keyframes fadeOutMove {
      from {
        opacity: 1;
        transform: translateY(0);
      }

      to {
        opacity: 0;
        transform: translateY(-10px);
      }
    }

    /* Fade in ข้อมูลใหม่ */
    .fade-in-new {
      animation: fadeInMove 0.4s ease-in forwards;
    }

    @keyframes fadeInMove {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
  <style>
    .table-skeleton {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
    }

    .table-skeleton thead th,
    .table-skeleton tbody td {
      padding: 12px;
      border: 1px solid #e0e0e0;
    }

    .skeleton-box {
      height: 16px;
      background: linear-gradient(90deg, #e0e0e0 25%, #f5f5f5 50%, #e0e0e0 75%);
      background-size: 200% 100%;
      animation: shimmer 1.2s infinite linear;
      border-radius: 4px;
    }

    .skeleton-box.short {
      width: 40%;
    }

    .skeleton-box.medium {
      width: 70%;
    }

    .skeleton-box.long {
      width: 100%;
    }

    @keyframes shimmer {
      0% {
        background-position: -200% 0;
      }

      100% {
        background-position: 200% 0;
      }
    }

    #real-table {
      display: none;
    }
  </style>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <!-- [ Sidebar Menu ] start -->
  <?php include 'navbar.php' ?>
  <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
  <?php include 'header-bar.php' ?>
  <!-- [ Header ] end -->


  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <!-- <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Profile</a></li>
                <li class="breadcrumb-item" aria-current="page">User List</li>
              </ul>
            </div> -->
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">User List</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card table-card">
            <div class="card-body">
              <div class="text-end p-4 pb-0">
                <a href="#" class="btn btn-primary d-inline-flex align-item-center" data-bs-toggle="modal" data-bs-target="#user-edit_add-modal">
                  <i class="ti ti-plus f-18"></i> Add User
                </a>
              </div>
              <div style="margin-top: 10px; padding: 20px;" id="table-loader">
                <table class="table-skeleton">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ชื่อของผู้ใช้งาน</th>
                      <th>ตำแหน่ง</th>
                      <th>กลุ่มผู้ใช้</th>
                      <th>ระดับผู้ใช้</th>
                      <th>สถานะ</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- สร้างหลายแถวเพื่อให้เหมือนกำลังโหลด -->
                    <tr>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box long"></div>
                      </td>
                      <td>
                        <div class="skeleton-box medium"></div>
                      </td>
                      <td>
                        <div class="skeleton-box medium"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box long"></div>
                      </td>
                      <td>
                        <div class="skeleton-box medium"></div>
                      </td>
                      <td>
                        <div class="skeleton-box medium"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box long"></div>
                      </td>
                      <td>
                        <div class="skeleton-box medium"></div>
                      </td>
                      <td>
                        <div class="skeleton-box medium"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                      <td>
                        <div class="skeleton-box short"></div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
                <table class="table table-hover" id="real-table">
                  <thead>
                    <tr>
                      <!-- <th>#</th> -->
                      <th>ชื่อของผู้ใช้งาน</th>
                      <th>ตำแหน่ง</th>
                      <th>กลุ่มผู้ใช้</th>
                      <th>ระดับผู้ใช้</th>
                      <th>สถานะการใช้งาน</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--  -->
                  </tbody>
                </table>
              </div>



            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <div class="modal fade" id="user-modal" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0">
          <h5 class="mb-0">Customer Details</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body position-relative">
                  <div class="position-absolute end-0 top-0 p-3">
                    <span class="badge bg-primary">Relationship</span>
                  </div>
                  <div class="text-center mt-3">
                    <div class="chat-avtar d-inline-flex mx-auto">
                      <img class="rounded-circle img-fluid wid-60" src="../assets/images/user/avatar-5.jpg"
                        alt="User image">
                    </div>
                    <h5 class="mb-0">Aaron Poole</h5>
                    <p class="text-muted text-sm">Manufacturing Director</p>
                    <hr class="my-3">
                    <div class="row g-3">
                      <div class="col-4">
                        <h5 class="mb-0">45</h5>
                        <small class="text-muted">Age</small>
                      </div>
                      <div class="col-4 border border-top-0 border-bottom-0">
                        <h5 class="mb-0">86%</h5>
                        <small class="text-muted">Progress</small>
                      </div>
                      <div class="col-4">
                        <h5 class="mb-0">7634</h5>
                        <small class="text-muted">Visits</small>
                      </div>
                    </div>
                    <hr class="my-3">
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-mail"></i>
                      <p class="mb-0">bo@gmail.com</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-phone"></i>
                      <p class="mb-0">+1 (247) 849-6968</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                      <i class="ti ti-map-pin"></i>
                      <p class="mb-0">Lesotho</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-between w-100">
                      <i class="ti ti-link"></i>
                      <a href="#" class="link-primary">
                        <p class="mb-0">https://anshan.dh.url</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h5>Personal Details</h5>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 pt-0">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Full Name</p>
                          <h6 class="mb-0">Aaron Poole</h6>
                        </div>
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Father Name</p>
                          <h6 class="mb-0">Mr. Ralph Sabatini</h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Country</p>
                          <h6 class="mb-0">Lesotho</h6>
                        </div>
                        <div class="col-md-6">
                          <p class="mb-1 text-muted">Zip Code</p>
                          <h6 class="mb-0">247 849</h6>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item px-0 pb-0">
                      <p class="mb-1 text-muted">Address</p>
                      <h6 class="mb-0">647 Punam Center, Ulabifgu, Myanmar (Burma) - 41487</h6>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h5>About me</h5>
                </div>
                <div class="card-body">
                  <p class="mb-0">Hello, I’m Aaron Poole Manufacturing Director based in international company, Void
                    jiidki me na fep juih ced gihhiwi launke cu mig tujum peodpo.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="user-edit_add-modal" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="mb-0">Edit Customer</h5>
          <a href="#" class="avtar avtar-s btn-link-danger" data-bs-dismiss="modal">
            <i class="ti ti-x f-20"></i>
          </a>
        </div>
        <form id="EditUer_Form" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="row">
              <div class="col-sm-3 text-center mb-3">
                <div class="user-upload wid-75">
                  <img src="../assets/images/user/avatar-5.jpg" alt="img" class="img-fluid">
                  <label for="uplfile" class="img-avtar-upload">
                    <i class="ti ti-camera f-24 mb-1"></i>
                    <span>Upload</span>
                  </label>
                  <input type="file" id="uplfile" class="d-none">
                </div>
              </div>
              <div class="col-sm-9">
                <div class="form-group">
                  <label class="form-label">ชื่อ</label>
                  <input type="text" id="edit_user_fullname" name="user_fullname" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <label class="form-label">อีเมลล์</label>
                  <input type="text" id="edit_user_email" name="user_email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                  <label class="form-label">เบอร์โทร</label>
                  <input type="text" id="edit_user_tel" name="user_tel" class="form-control" placeholder="Tel">
                </div>
                <div class="form-group">
                  <label class="form-label">ตำแหน่ง</label>
                  <input type="text" id="edit_user_position" name="user_position" class="form-control" placeholder="Position" required>
                </div>
                <!-- <div class="form-group">
                <label class="form-label">กลุ่ม</label>
                <input type="text" id="edit_user_group" name="user_group" class="form-control" placeholder="Group">
              </div> -->
                <div class="form-group">
                  <label class="form-label">กลุ่ม</label>
                  <select class="form-select" id="edit_user_group" name="user_group">
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">ระดับผู้ใช้</label>
                  <select class="form-select" id="edit_user_status" name="user_status">
                  </select>
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <!-- <ul class="list-inline me-auto mb-0">
            <li class="list-inline-item align-bottom">
              <a href="#" class="avtar avtar-s btn-link-danger w-sm-auto" data-bs-toggle="tooltip" title="Delete">
                <i class="ti ti-trash f-18"></i>
              </a>
            </li>
          </ul> -->
            <div class="flex-grow-1 text-end">
              <button type="button" class="btn btn-link-danger" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" id="submit_edituser" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->


  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // โหลดข้อมูลจำลอง (เช่น ดึงจาก API หรือ delay)
      // setTimeout(() => {
      //   document.getElementById("table-loader").style.display = "none";
      //   document.getElementById("real-table").style.display = "table";
      //   $('#real-table').DataTable(); // ถ้าใช้ DataTables
      // }, 2000); // ปรับเวลาโหลดตามจริง
    });
  </script>

  <script>
    function loadUsers() {
      $.ajax({
        url: 'api_Load_users.php',
        method: 'POST',
        success: function(response) {
          // console.log(response);
          // ใส่เข้า tbody
          let tbody = document.querySelector("#real-table tbody");
          tbody.innerHTML = response;
          $('#real-table-body').html(response);
          $('#real-table').DataTable({
            pageLength: 10,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                targets: [5]
              } // ปิด sort สำหรับ Actions
            ]
          });
          setTimeout(() => {
            document.getElementById("table-loader").style.display = "none";
            document.getElementById("real-table").style.display = "table";
            $('#real-table').DataTable(); // ถ้าใช้ DataTables
          }, 2000); // ปรับเวลาโหลดตามจริง
          // setTimeout(function() {
          //   if (response.trim() === '') {
          //     noMoreData = true;
          //     $('#loader').html('<div class="text-center">ไม่พบข้อมูลเพิ่มเติม</div>');

          //   } else {
          //     $('#loader').before(response);

          //     offset += limit;
          //     $('#loader').hide();
          //     loading = false;
          //     console.log(offset + "///" + limit);

          //     // ✅ สร้าง CKEditor บน textarea ใหม่ที่เพิ่มเข้ามา
          //     document.querySelectorAll('textarea.ckeditor').forEach(el => {
          //       // เช็คว่า textarea นี้ยังไม่ได้มี editor มาก่อน
          //       if (!el.classList.contains('ck-editor__editable')) {
          //         ClassicEditor
          //           .create(el)
          //           .catch(error => console.error(error));
          //       }
          //     });
          //   }
          //   $('#loader2').html(''); //ปิด
          //   $('#post-new-container').html(''); //ปิด
          // }, 1500);
        }

      });
    }
    loadUsers();
  </script>

  <script>
    async function EditUser(Encrypt_user_id) {
      const formData = new FormData();
      formData.append('user_id', Encrypt_user_id);

      try {
        const response = await fetch('api_Load_user_edit.php', {
          method: 'POST',
          body: formData
        });

        const data = await response.json();

        if (data.success) {
          data1 = data.data; // ✅ ดึงเฉพาะข้อมูลโพสต์
          datagroup = data.data_group;
          console.log('รายละเอียดโพสต์:', data1);
          console.log('รายละเอียดกลุ่ม:', datagroup);
          document.getElementById('edit_user_fullname').value = data1.fd_user_fullname;
          document.getElementById('edit_user_email').value = data1.fd_user_email;
          document.getElementById('edit_user_tel').value = data1.fd_user_phone;
          document.getElementById('edit_user_position').value = data1.fd_user_position;
          // document.getElementById('edit_user_group').value = data1.fd_user_group;

          let select = document.getElementById("edit_user_group");
          select.innerHTML = "";

          datagroup.forEach(item => {
            let option = document.createElement("option");
            option.value = item.fd_group_id;
            option.textContent = item.fd_group_name;

            if (item.fd_group_id === data1.fd_user_group) {
              option.selected = true;
            }

            select.appendChild(option);
          });
          let select_status = document.getElementById("edit_user_status");
          select_status.innerHTML = ""; // ล้าง option เดิมก่อน

          let statuses = ["user", "admin", "executive"];

          statuses.forEach(status => {
            let option = document.createElement("option");
            option.value = status;
            option.textContent = status.charAt(0).toUpperCase() + status.slice(1); // แสดง User/Admin

            if (status === data1.fd_user_status) {
              option.selected = true;
            }

            select_status.appendChild(option);
          });
          // document.getElementById('edit_user_status').value = data1.fd_user_status;

        } else {
          console.warn('ไม่พบโพสต์:', data.message);
        }
      } catch (error) {
        console.error('เกิดข้อผิดพลาด:', error);
      }
    }

    document.getElementById('EditUer_Form').addEventListener('submit', async function(e) {
      const button = document.getElementById('submit_edituser');
      button.disabled = true;
      setTimeout(() => {
        button.disabled = false;
      }, 3000); // 3 วินาที
      e.preventDefault(); // ❌ ป้องกัน reload หน้า

      const form = this;
      const requiredFields = form.querySelectorAll('[required]');

      for (let field of requiredFields) {
        if (!field.value.trim()) {
          alert("กรุณากรอกข้อมูลให้ครบถ้วน");
          field.focus();
          return;
        }
      }
      // // trim เพื่อตัดช่องว่างที่ไม่มีความหมาย
      // const text = editor.innerText.trim();

      // if (text === '') {
      //   e.preventDefault(); // ป้องกันการส่งฟอร์ม
      //   error.style.display = 'block';
      //   editor.classList.add('border-danger');
      //   editor.focus();
      // } else {
      //   error.style.display = 'none';
      //   editor.classList.remove('border-danger');
      //   const form = document.getElementById("mentionForm");
      //   const hiddenInput = document.getElementById("post_content");
      //   const content = editor.innerHTML;

      //   hiddenInput.value = content;
      //   const formData = new FormData(form); // ✅ รวมข้อมูลทั้งหมดรวมไฟล์แนบ
      //   console.log(formData);

      //   try {
      //     const response = await fetch('action_add_post.php', {
      //         method: 'POST',
      //         body: formData
      //       }).then(response => response.json()) // ❗ ถ้า response ไม่ใช่ JSON → Error ทันที
      //       .then(data => {
      //         // console.log(data);
      //         if (data.success) {
      //           // alert('✅ บันทึกข้อมูลเรียบร้อย');
      //           // ถ้ามีฟังก์ชันอัปเดตอื่น
      //           if (cancelmodal_post("1")) { //สั่งปิด modal post ต้องreturn true
      //             loadNewPosts(); //โหลดโพสต์ใหม่
      //           }
      //         }
      //       })
      //       .catch(error => {
      //         console.error('เกิดข้อผิดพลาด:', error);
      //       });
      //   } catch (error) {
      //     console.error('เกิดข้อผิดพลาด2:', error);
      //   }
      // }
    });
  </script>

</body>
<!-- [Body] end -->

</html>