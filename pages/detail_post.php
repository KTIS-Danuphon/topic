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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap 5 CSS & JS -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

  <!-- Bootstrap Icons (สำหรับจุดไข่ปลา) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
    .editor {
      border: 1px solid #ccc;
      padding: 10px;
      min-height: 100px;
      font-size: 16px;
      position: relative;
    }

    .editor:empty::before {
      content: attr(data-placeholder);
      color: #888;
      pointer-events: none;
    }

    .mention {
      color: #007bff;
      font-weight: bold;
    }

    .suggestions {
      position: fixed;
      border: 1px solid #ccc;
      background: white;
      z-index: 1000;
      max-height: 150px;
      overflow-y: auto;
      display: none;
    }

    .suggestions div {
      padding: 1px 1px;
      cursor: pointer;
    }

    .suggestions div:hover {
      background: #eee;
    }

    #suggestions2 {
      position: absolute;
      top: 100%;
      /* ด้านล่างของ editor */
      left: 0;
      width: 100%;
    }

    .editor-wrapper {
      position: relative;
    }
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
  <div class="pc-container" id="post-test">
    <div class="pc-content">

      <!-- <div class="pc-container"> -->
      <div class="pc-content container">
        <!-- [ Main Content ] start -->
        <div id="post-container">
          <!-- <div class="skeleton-post">
            <div class="skeleton-avatar shimmer"></div>
            <div class="skeleton-lines">
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer"></div>
              <div class="skeleton-line shimmer short"></div>
            </div>

          </div> -->

        </div>

        <!-- loading post โพสต์ที่แสดง -->
        <div class="col-md-12 col-xl-12" id="post_id_<?= $Encrypt->DeCrypt_pass($_GET["post"]) ?>">
          <div id="loader_card_post"></div>

          <div class="card" id="main_post">

            <div id="content_post"></div>

            <div class="card-body">
              <!-- <hr> -->
              <!-- แสดงจำนวนคอมเมนต์ -->
              <!-- <p class="text-muted mb-2">ความคิดเห็น 2 รายการ</p> -->
              <div id="post-new-container">
                <div class="skeleton-post">
                  <div class="skeleton-avatar shimmer"></div>
                  <div class="skeleton-lines">
                    <div class="skeleton-line shimmer"></div>
                    <div class="skeleton-line shimmer short"></div>
                  </div>
                </div>
              </div>
              <div id="loader_new">
                <div id="loader_new2"></div>
              </div>

              <div id="loader_comment">
                <div class="skeleton-post">
                  <div class="skeleton-avatar shimmer"></div>
                  <div class="skeleton-lines">
                    <div class="skeleton-line shimmer"></div>
                    <div class="skeleton-line shimmer short"></div>
                  </div>
                </div>

                <div class="skeleton-post">
                  <div class="skeleton-avatar shimmer"></div>
                  <div class="skeleton-lines">
                    <div class="skeleton-line shimmer"></div>
                    <div class="skeleton-line shimmer short"></div>
                  </div>
                </div>

                <div class="skeleton-post">
                  <div class="skeleton-avatar shimmer"></div>
                  <div class="skeleton-lines">
                    <div class="skeleton-line shimmer"></div>
                    <div class="skeleton-line shimmer short"></div>
                  </div>
                </div>
              </div>
              <div id="loader-new-comment">
                <div class="skeleton-post">
                  <div class="skeleton-avatar shimmer"></div>
                  <div class="skeleton-lines">
                    <div class="skeleton-line shimmer"></div>
                    <div class="skeleton-line shimmer short"></div>
                  </div>
                </div>
              </div>


              <!-- กล่องพิมพ์คอมเมนต์ -->
              <!-- <div class="d-flex mt-3">
                <img src="../assets/images/user/avatar-2.jpg" class="rounded-circle me-2" style="width: 32px; height: 32px;">
                <input type="text" class="form-control" placeholder="เขียนความคิดเห็น...">
              </div> -->
              <form id="mentionForm" method="post" enctype="multipart/form-data">
                <div class="d-flex mb-3">
                  <!-- รูปโปรไฟล์ -->
                  <div class="flex-shrink-0 me-2">
                    <img src="../assets/images/user/avatar-2.jpg" alt="user" class="rounded-circle" style="width: 32px; height: 32px;">
                  </div>

                  <!-- กล่องคอมเมนต์ -->
                  <div class="flex-grow-1 w-100">
                    <label for="editor" class="form-label mb-1">แสดงความคิดเห็น <code>*</code></label>

                    <!-- กล่องพิมพ์ -->
                    <div class="card border rounded shadow-sm">
                      <div id="editor-wrapper" class="p-2">
                        <div id="editor"
                          class="editor"
                          name="editor"
                          contenteditable="true"
                          data-placeholder="เขียนความคิดเห็น..."
                          class="form-control border-0"
                          style="min-height: 60px;"></div>
                        <div id="editor-error" class="text-danger" style="display: none;">กรุณากรอกความคิดเห็น</div>
                      </div>
                      <input type="hidden" name="post_id" id="post_id" value="<?= $_GET["post"] ?>">
                      <input type="hidden" name="comment_content" id="post_content">
                      <input type="hidden" name="comment_tag_inpost" id="post_tag_inpost">
                    </div>

                    <!-- ปุ่มแนบไฟล์และส่ง -->
                    <!-- <div class="d-flex justify-content-between align-items-center mt-2">
                      <div>
                        <label class="btn btn-sm btn-outline-secondary mb-0"> -->
                    <!-- <input type="file" name="comment_file" id="comment_file" class="d-none" accept=".jpg,.jpeg,.png,.pdf"> -->
                    <!-- <div class="form-group">
                            <i class="ti ti-paperclip"></i> แนบไฟล์
                            <input class="form-control" type="file" name="comment_file" id="comment_file">
                          </div>
                        </label>
                        <span id="file_name_display" class="text-muted ms-2" style="font-size: 13px;"></span>
                      </div>
                      <button class="btn btn-sm btn-primary" type="submit">ส่ง</button>
                    </div> -->

                    <style>
                      .comment-actions {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-top: 0.75rem;
                        border-top: 1px solid #e0e0e0;
                        padding-top: 0.5rem;
                      }

                      .custom-file-label {
                        display: flex;
                        align-items: center;
                        cursor: pointer;
                        font-size: 14px;
                        color: #555;
                      }

                      .custom-file-label i {
                        margin-right: 5px;
                        color: #555;
                      }

                      .custom-file-input {
                        display: none;
                      }

                      .file_name_container {
                        display: inline-flex;
                        align-items: center;
                        gap: 4px;
                        font-size: 12px;
                        color: #888;
                        margin-left: 10px;
                      }

                      .remove-file {
                        cursor: pointer;
                        font-weight: bold;
                        color: #dc3545;
                      }

                      .btn-send {
                        padding: 4px 16px;
                        font-size: 14px;
                        border-radius: 20px;
                      }
                    </style>

                    <div class="comment-actions">
                      <div>
                        <label class="custom-file-label">
                          <i class="ti ti-paperclip"></i> แนบไฟล์
                          <input type="file" name="comment_file" id="comment_file" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">
                        </label>

                        <span id="file_name_container" class="file_name_container" style="display:none;">
                          <span id="file_name_display"></span>
                          <span class="remove-file" id="remove_file_btn">&times;</span>
                        </span>
                      </div>

                      <button class="btn btn-sm btn-primary btn-send" href="#" type="submit">ส่ง</button>
                    </div>


                  </div>
              </form>
              <!-- <button class="btn btn-sm btn-primary" type="button" id="btnClear">ล้าง</button> -->
              <script>
                const fileInput = document.getElementById('comment_file');
                const fileNameDisplay = document.getElementById('file_name_display');
                const fileNameContainer = document.getElementById('file_name_container');
                const removeFileBtn = document.getElementById('remove_file_btn');

                fileInput.addEventListener('change', function() {
                  const file = this.files[0];
                  if (file) {
                    fileNameDisplay.textContent = file.name;
                    fileNameContainer.style.display = 'inline-flex';
                  } else {
                    fileNameDisplay.textContent = '';
                    fileNameContainer.style.display = 'none';
                  }
                });

                removeFileBtn.addEventListener('click', function() {
                  // Reset input
                  fileInput.value = '';
                  fileNameDisplay.textContent = '';
                  fileNameContainer.style.display = 'none';
                });



                // document.getElementById('btnClear').addEventListener('click', function() {
                //   const form = document.getElementById('mentionForm');
                //   form.reset(); // ล้าง input และ textarea
                //   // ถ้ามี contenteditable ต้องล้างแยก
                //   const editor = document.getElementById('editor');
                //   if (editor) editor.innerHTML = ''; // หรือใช้ innerText = '' ถ้าไม่มี HTML
                // });
              </script>
            </div>
            <div id="suggestions" class="suggestions "></div>
          </div>


        </div>
      </div>


      <script></script>


    </div>
  </div>
  <!-- loading post โพสต์ที่แสดง -->
  </div>
  </div>
  <div class="modal fade" id="edit-post-modal" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <div class="d-flex w-100 align-items-center">
            <div class="flex-grow-1 mx-3">
              <h4 class="mb-1">แก้ไขโพสต์</h4>
            </div>
          </div>

        </div>
        <div class="modal-body">
          <form id="mentionForm_edit" method="post" enctype="multipart/form-data">
            <div class="form-group row" style="padding: 0px 5%">
              <input type="hidden" id="post_user_id_edit" name="post_user_id_edit" value="">
              <div class="col-sm-12">
                <b for="">หัวข้อ<code>*</code></b>
                <input type="" class="form-control" id="header_post_edit" name="post_header_edit" value="" placeholder="กรอก หัวข้อโพสต์" required>
                <div class="invalid-feedback">กรุณากรอก</div>
              </div>
              <p></p>

              <div class="col-sm-12">
                <label for="">เนื้อหา<code>*</code></label>
                <div class="card">
                  <div id="editor-wrapper" class="editor-wrapper">
                    <div id="editor_edit" name="editor_edit" class="editor" contenteditable="true" data-placeholder="กรอก เนื้อโพสต์"></div>
                  </div>
                  <div id="editor-error_edit" class="text-danger" style="display: none;">กรุณากรอกเนื้อหาโพสต์</div>
                  <input type="hidden" name="post_content_edit" id="post_content_edit" required>
                  <input type="hidden" name="post_tag_inpost_edit" id="post_tag_inpost_edit">
                </div>
                <div id="suggestions_edit" class="suggestions"></div>
              </div>

              <!-- <div class="col-md-12">
                <label for="post_add_file_edit">แนบไฟล์</label>
                <input type="file" name="post_add_file_edit" id="post_add_file_edit" class="form-control" accept=".pdf,.png,.jpg,.jpe,.jpeg">
                <div class="invalid-feedback">แนบไฟล์</div>
              </div> -->

              <div class="comment-actions">
                <div class="col-md-12">
                  <label class="custom-file-label">
                    <i class="ti ti-paperclip"></i> แนบไฟล์
                    <input type="file" name="post_file_edit" id="post_file_edit" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">
                  </label>

                  <span id="post_file_name_container" class="file_name_container" style="display:none;">
                    <span id="post_file_name_display"></span>
                    <span class="remove-file" id="post_remove_file_btn">&times; ◀️คลิกเพื่อลบไฟล์แนบ</span>
                  </span>
                </div>
                <input type="hidden" id="post_has_old_file" name="has_old_file">
              </div>
              <p></p>

              <div class="col-md-4">
                <label for="tag">แท็กตั้งต้น : </label> <span class="badge bg-light-primary border border-primary bg-transparent f-14 me-1 mt-1">ผู้บริหาร</span>
              </div>
              <div class="col-md-8">
                <label for="">สถานะของโพสต์ : </label><span> </span>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status_edit" id="post_status_edit1" value="todo" required>
                  <label class="form-check-label badge bg-light-danger rounded-pill f-12" for="post_status_edit1"> ต้องทำ </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status_edit" id="post_status_edit2" value="doing">
                  <label class="form-check-label badge bg-light-primary rounded-pill f-12" for="post_status_edit2">ดำเนินการ</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status_edit" id="post_status_edit3" value="success">
                  <label class="form-check-label badge bg-light-success rounded-pill f-12" for="post_status_edit3">เสร็จ</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status_edit" id="post_status_edit4" value="">
                  <label class="form-check-label" for="post_status_edit4">ไม่มีสถานะ</label>
                </div>
              </div>
              <p></p>
              <div class="col-md-12">
                <label for="tag-users_edit" class="tag-label">👥 แท็กผู้ใช้:</label>
                <div id="div-tag-users_edit">
                  <select id="tag-users_edit" name="tag_users_edit[]" onchange="updateHiddenInput_edit()" multiple></select>
                </div>
                <input type="hidden" name="post_tag_other_edit" id="post_tag_other_edit">
              </div>
              </select>


            </div>
            <!-- <button type="submit">ส่งข้อมูล</button> -->
            <div class="modal-footer">
              <button class="btn btn-link-success" type="submit">บันทึก</button>
              <button class="btn btn-link-danger" type="button" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit-comment-modal" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <div class="d-flex w-100 align-items-center">
            <div class="flex-grow-1 mx-3">
              <h4 class="mb-1">แก้ไขความคิดเห็น</h4>
            </div>
          </div>

        </div>
        <div class="modal-body">
          <form id="mentionForm_comment_edit" method="post" enctype="multipart/form-data">
            <div class="form-group row" style="padding: 0px 5%">
              <input type="hidden" id="comment_id_edit" name="comment_id_edit" value="">

              <div class="col-sm-12">
                <label for="">เนื้อหา<code>*</code></label>
                <div class="card">
                  <div id="editor-wrapper" class="editor-wrapper">
                    <div id="editor_comment_edit" name="editor_comment_edit" class="editor" contenteditable="true" data-placeholder="กรอก เนื้อโพสต์"></div>
                  </div>
                  <div id="editor-error_comment_edit" class="text-danger" style="display: none;">กรุณากรอกเนื้อหาโพสต์</div>
                  <input type="hidden" name="comment_content_edit" id="comment_content_edit" required>
                  <input type="hidden" name="comment_tag_inpost_edit" id="comment_tag_inpost_edit">
                </div>
                <div id="suggestions_comment_edit" class="suggestions"></div>
              </div>

              <div class="comment-actions">
                <div class="col-md-12">
                  <label class="custom-file-label">
                    <i class="ti ti-paperclip"></i> แนบไฟล์
                    <input type="file" name="comment_file_edit" id="comment_file_edit" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">
                  </label>

                  <span id="comment_file_name_container" class="file_name_container" style="display:none;">
                    <span id="comment_file_name_display"></span>
                    <span class="remove-file" id="comment_remove_file_btn">&times; ◀️คลิกเพื่อลบไฟล์แนบ</span>
                  </span>
                </div>
                <input type="hidden" id="has_old_file" name="has_old_file">
              </div>
            </div>
            <p></p>

            <!-- <button type="submit">ส่งข้อมูล</button> -->
            <div class="modal-footer">
              <button class="btn btn-link-success" type="submit">บันทึก</button>
              <button class="btn btn-link-danger" type="button" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>

  <script src="../assets/js/plugins/choices.min.js"></script>
  <script>
    let offset = 0;
    const limit = 5;
    let loading = false;
    let noMoreData = false;

    function load_more_comments() {
      $('#btn-refresh-comment').remove(); // ลบออกจาก DOM
      if ($('#btn-refresh-comment').length === 0) {
        console.log('ปุ่มถูกลบออกจาก DOM แล้ว');
        loadComments();
      }
    }

    function loadMainPost() {
      $('#loader_card_post').html(`
      <div class="skeleton-post"><div class="skeleton-avatar shimmer"></div><div class="skeleton-lines"><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer"></div><div class="skeleton-line shimmer short"></div></div></div>`); //ปิด
      // $('#loader_post').show();
      let post_id = '<?= $_GET["post"] ?>';
      if (post_id) {
        setTimeout(() => {

        }, 500);

        console.log(9999);

        $.ajax({
          url: 'api_Load_post_detail.php',
          method: 'POST',
          data: {
            post_id: post_id,
          },
          success: function(response) {
            // console.log(response);
            setTimeout(function() {
              if (response.trim() === '') {
                // $('#post-container').html(''); //ปิด

                // $('#post-container').html('<div id="" class="text-center">ไม่พบข้อมูลเพิ่มเติม</div>');

              } else {
                $('#content_post').before(response);

                // $('#loader').hide();

              }
              // $('#loader2').html(''); //ปิด
              // $('#post-container').html(''); //ปิด
              // $('#loader-new-comment').html(''); //ปิด

              $('#loader_card_post').remove();
              document.getElementById("main_post").removeAttribute("hidden");
            }, 1500);
          }

        });
      } else {
        console.log(5555);
        // $('#post-test').remove(); //ปิด
        setTimeout(() => {
          $('#post_id_').html('<div id="" class="text-center">ไม่พบข้อมูลของหน้านี้</div>');
        }, 500);
      }
    }
    let count_post = 0;

    function loadComments() {
      console.log(offset + "///" + limit);
      console.log("load..");
      if (loading || noMoreData) return;
      loading = true;
      $('#loader_comment').show();
      let post_id = '<?= $_GET["post"] ?>';
      if (post_id) {
        console.log(9.2);
        $.ajax({
          url: 'api_Load_comments.php',
          method: 'POST',
          data: {
            offset: offset,
            limit: limit,
            post_id: post_id,
          },
          success: function(response) {
            // console.log(response);
            setTimeout(function() {
              if (response.trim() === '') {
                noMoreData = true;
                $('#loader_comment').html('<div id="text-no-data" class="text-center">ไม่พบข้อมูลเพิ่มเติม</div>');

              } else {
                $('#loader_comment').before(response);

                offset += limit;
                $('#loader_comment').hide();
                loading = false;
                console.log(offset + "///" + limit);

                // ✅ สร้าง CKEditor บน textarea ใหม่ที่เพิ่มเข้ามา
                document.querySelectorAll('textarea.ckeditor').forEach(el => {
                  // เช็คว่า textarea นี้ยังไม่ได้มี editor มาก่อน
                  if (!el.classList.contains('ck-editor__editable')) {
                    ClassicEditor
                      .create(el)
                      .catch(error => console.error(error));
                  }
                });
              }
              // $('#loader2').html(''); //ปิด
              $('#post-container').html(''); //ปิด
              $('#loader-new-comment').html(''); //ปิด
              $('#post-new-container').html(''); //ปิด


            }, 1500);
          }

        });
      }
    }
    //!-------------------------- โหลดโพสต์ล่าสุด ⬇️--------------------------------------
    let offset_new = 0;
    let limit_new = 1;

    function loadNewComments(post_id) {
      offset = offset + 1; //เพิ่ม offset+1 บอกว่าแสดงกี่โพสต์แล้ว
      const postContent = $('#post-new-container').html(); //โพสต์ใหม่
      $('#loader_new2').prepend(postContent); // แทรกไว้ด้านบนของ loader2
      const form = document.getElementById('mentionForm');
      form.reset(); // ล้าง input และ textarea
      // ถ้ามี contenteditable ต้องล้างแยก
      const editor = document.getElementById('editor');
      if (editor) editor.innerHTML = ''; // หรือใช้ innerText = '' ถ้าไม่มี HTML

      $('#post-new-container').html(`
                <div class="skeleton-post">
                      <div class="skeleton-avatar shimmer"></div>
                      <div class="skeleton-lines">
                            <span style="font-weight: bold; color: white; text-shadow: 0 0 3px black, 0 0 6px black;">กำลังสร้างความคิดเห็นใหม่........</span>
                            <div class="skeleton-line shimmer"></div>
                            <div class="skeleton-line shimmer short"></div>
                      </div>
                </div>
      `); // แสดง div Skeleton

      $.ajax({
        url: 'api_Load_comments.php',
        method: 'POST',
        data: {
          offset_new: offset_new,
          limit_new: limit_new,
          post_id: post_id
        },
        success: function(response) {
          // offset_new = offset_new + limit_new;
          console.log(limit_new);
          // limit_new += 1;
          console.log(limit_new);

          setTimeout(function() {
            $('#post-new-container').html(response); // ✅ แทนที่ Skeleton ด้วยโพสต์ใหม่

            // ✅ สร้าง CKEditor ถ้ามี textarea
            document.querySelectorAll('textarea.ckeditor').forEach(el => {
              if (!el.classList.contains('ck-editor__editable')) {
                ClassicEditor
                  .create(el)
                  .catch(error => console.error(error));
              }
            });
          }, 1500); // ตั้งเวลาหน่วงเพื่อให้เห็น animation
        }
      });
    }
    //!-------------------------- โหลดโพสต์ล่าสุด ⬆️--------------------------------------
    loadComments();
    loadMainPost();

    document.getElementById('mentionForm').addEventListener('submit', async function(e) {
      e.preventDefault(); // ❌ ป้องกัน reload หน้า
      const editor = document.getElementById('editor');
      const error = document.getElementById('editor-error');
      console.log("submit");
      // trim เพื่อตัดช่องว่างที่ไม่มีความหมาย
      const text = editor.innerText.trim();

      if (text === '') {
        e.preventDefault(); // ป้องกันการส่งฟอร์ม
        error.style.display = 'block';
        editor.classList.add('border-danger');
        editor.focus();
        setTimeout(() => {
          error.style.display = 'none';
          editor.classList.remove('border-danger');
        }, 5000); // 5000 มิลลิวินาที = 5 วินาที
      } else {
        error.style.display = 'none';
        editor.classList.remove('border-danger');
        const form = document.getElementById("mentionForm");
        const hiddenInput = document.getElementById("post_content");
        const content = editor.innerHTML;

        hiddenInput.value = content;
        const formData = new FormData(form); // ✅ รวมข้อมูลทั้งหมดรวมไฟล์แนบ
        console.log(formData);

        try {
          const response = await fetch('action_add_comment.php', {
              method: 'POST',
              body: formData
            }).then(response => response.json()) // ❗ ถ้า response ไม่ใช่ JSON → Error ทันที
            .then(data => {
              // console.log(data);
              if (data.success) {
                // แล้วเลื่อนไปบนสุด
                window.scrollTo({
                  top: 0,
                  behavior: 'smooth'
                });
                document.getElementById('comment_file').value = '';
                document.getElementById('file_name_container').style.display = 'none';
                loadNewComments(formData.get("post_id"));
                updateCountComment();


                // ถ้ามีฟังก์ชันอัปเดตอื่น
                // if (cancelmodal_post("1")) { //สั่งปิด modal post ต้องreturn true
                //   loadNewPosts(); //โหลดโพสต์ใหม่
                // }

              }
            })
            .catch(error => {
              console.error('เกิดข้อผิดพลาด:', error);
            });

        } catch (error) {
          console.error('เกิดข้อผิดพลาด2:', error);
        }
      }
    });
    document.getElementById('mentionForm_comment_edit').addEventListener('submit', async function(e) {
      e.preventDefault(); // ❌ ป้องกัน reload หน้า
      const editor = document.getElementById('editor_comment_edit');
      const error = document.getElementById('editor-error_comment_edit');
      console.log("submit");
      // trim เพื่อตัดช่องว่างที่ไม่มีความหมาย
      const text = editor.innerText.trim();

      if (text === '') {
        e.preventDefault(); // ป้องกันการส่งฟอร์ม
        error.style.display = 'block';
        editor.classList.add('border-danger');
        editor.focus();
        setTimeout(() => {
          error.style.display = 'none';
          editor.classList.remove('border-danger');
        }, 5000); // 5000 มิลลิวินาที = 5 วินาที
      } else {
        error.style.display = 'none';
        editor.classList.remove('border-danger');

        const form = document.getElementById("mentionForm_comment_edit");
        const hiddenInput = document.getElementById("comment_content_edit");
        const content = editor.innerHTML;

        hiddenInput.value = content;
        const formData = new FormData(form); // ✅ รวมข้อมูลทั้งหมดรวมไฟล์แนบ
        console.log(formData);

        try {
          const response = await fetch('action_edit_comment.php', {
              method: 'POST',
              body: formData
            }).then(response => response.json()) // ❗ ถ้า response ไม่ใช่ JSON → Error ทันที
            .then(data => {
              console.log(data);
              if (data.success) {
                // แล้วเลื่อนไปบนสุด

                console.log(data.newcontent);
                $('#edit-comment-modal').modal('hide');
                updateComment(data.comment_id, data.newcontent);
                // document.getElementById('comment_file').value = '';
                // document.getElementById('file_name_container').style.display = 'none';

                // loadNewComments(formData.get("post_id"));
                // updateCountComment();


                // ถ้ามีฟังก์ชันอัปเดตอื่น
                // if (cancelmodal_post("1")) { //สั่งปิด modal post ต้องreturn true
                //   loadNewPosts(); //โหลดโพสต์ใหม่
                // }

              }
            })
            .catch(error => {
              $('#edit-comment-modal').modal('hide');

              console.error('เกิดข้อผิดพลาด:', error);
            });

        } catch (error) {
          console.error('เกิดข้อผิดพลาด2:', error);
        }
      }
    });
  </script>

  <script src="Editor_input.js">

  </script>
  <script src="EditPost.js"></script>
  <script src="EditComment.js"></script>
  <script>
    function updateCountComment() {
      const countElement = document.getElementById('count_comment');
      if (!countElement) return;

      // เพิ่มคลาสเอฟเฟกต์
      countElement.classList.add("editing-effect");

      setTimeout(() => {
        // เริ่มเฟดเอาต์ก่อนเปลี่ยนตัวเลข
        countElement.classList.add("fade-out-old");

        // รอให้เอฟเฟกต์ fade-out แสดงก่อนเปลี่ยนตัวเลข
        setTimeout(() => {
          let currentCount = parseInt(countElement.innerText, 10) || 0;
          countElement.innerText = currentCount + 1;

          // ลบคลาสเอฟเฟกต์ทั้งหมด
          countElement.classList.remove("fade-out-old", "editing-effect");

          // ถ้าอยากให้ fade-in ใหม่ก็เพิ่มคลาสใหม่ได้ที่นี่
          // countElement.classList.add("fade-in-new");

        }, 200); // ระยะเวลา fade-out
      }, 100); // รอสั้นๆ ให้เห็นการเริ่มแก้ไขก่อน
    }

    function scroll_down() {
      window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth'
      });
    }

    async function EditComment(Encrypt_comment_id) { //เรียกใช้ตอน กดปุ่มแก้ไข ความคิดเห้น
      const formData = new FormData();
      formData.append("comment_id", Encrypt_comment_id);

      try {
        const response = await fetch("api_Load_comment_edit.php", {
          method: "POST",
          body: formData,
        });

        const data = await response.json();

        if (data.success) {
          data1 = data.data; // ✅ ดึงเฉพาะข้อมูลโพสต์

          let content = data1.fd_comment_mesage;
          // สร้าง DOM จาก content เดิม
          let div = document.createElement("div");
          div.innerHTML = content;
          // แปลง DOM กลับเป็น HTML string
          data1.fd_comment_mesage = div.innerHTML;

          document.getElementById("comment_id_edit").value = data1.fd_comment_id;
          document.getElementById("editor_comment_edit").innerHTML = data1.fd_comment_mesage;
          document.getElementById("comment_content_edit").value =
            data1.fd_comment_mesage;
          const fileInput = document.getElementById('comment_file_edit');
          const fileNameDisplay = document.getElementById('comment_file_name_display');
          const fileNameContainer = document.getElementById('comment_file_name_container');
          const removeFileBtn = document.getElementById('comment_remove_file_btn');
          const hasOldFile = document.getElementById('has_old_file');

          fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
              fileNameDisplay.textContent = file.name;
              fileNameContainer.style.display = 'inline-flex';
              hasOldFile.value = 1; //ตั้งเป็น 1 เมื่อมีไฟล์
            } else {
              fileNameDisplay.textContent = '';
              fileNameContainer.style.display = 'none';
            }
          });

          removeFileBtn.addEventListener('click', function() {
            // Reset input
            fileInput.value = '';
            fileNameDisplay.textContent = '';
            fileNameContainer.style.display = 'none';
            hasOldFile.value = 0;
          });
          if (data1.fd_comment_file != '') {
            fileInput.value = '';
            fileNameDisplay.textContent = 'มีไฟล์แนบเดิม';
            fileNameContainer.style.display = 'inline-block';
            fileInput.style.display = 'none';
            hasOldFile.value = 1; //ตั้งเป็น 1 เมื่อมีไฟล์เดิม
          } else {
            fileNameDisplay.textContent = '';
            fileNameContainer.style.display = 'none';
            fileInput.value = '';
            hasOldFile.value = 0;
          }
          document.getElementById("comment_tag_inpost_edit").value =
            data1.fd_comment_tag; //เก็บ IDผู้ใช้ แท็กในความคิดเห้น

        } else {
          console.warn("ไม่พบโพสต์:", data.message);
        }
      } catch (error) {
        console.error("เกิดข้อผิดพลาด:", error);
      }
    }

    function updateComment(comment_id, newContent) {
      const commentContainer = document.getElementById("comment_" + comment_id);
      // const statusContainer = document.getElementById("post_status_" + post_id);

      // เพิ่ม effect 'กำลังแก้ไข'
      commentContainer.classList.add("editing-effect");
      // statusContainer.classList.add("editing-effect");

      setTimeout(() => {
        // เริ่ม fade-out content
        commentContainer.classList.add("fade-out-old");
        // statusContainer.classList.add("fade-out-old");

        commentContainer.addEventListener(
          "animationend",
          () => {
            // แทนเนื้อหาใหม่
            commentContainer.innerHTML = newContent;

            // เปลี่ยนสถานะพร้อมกัน
            // if (statusContainer) {
            //   statusContainer.innerHTML = newStatus;
            //   statusContainer.classList.remove("fade-out-old", "editing-effect");
            // }

            // ล้างคลาสเก่า
            commentContainer.classList.remove("fade-out-old", "editing-effect");

            // fade-in ข้อมูลใหม่
            commentContainer.classList.add("fade-in-new");
            commentContainer.addEventListener(
              "animationend",
              () => {
                commentContainer.classList.remove("fade-in-new");
              }, {
                once: true,
              }
            );
          }, {
            once: true,
          }
        );
      }, 300); // รอสั้นๆ เพื่อให้เห็น effect "กำลังแก้"
    }
  </script>
</body>
<!-- [Body] end -->

</html>