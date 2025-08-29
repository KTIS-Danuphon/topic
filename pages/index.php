<?php
session_start();
if (!isset($_SESSION["TopicUserId"])) {
  // header("Location: ../auth/login.php");
  echo '<script></script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Home TOPIC</title>
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
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"> -->

  <style>
    .post {
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }


    #post-container {
      min-height: 100vh;
    }
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
    /* CSS แนบไฟล์ */
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

      <!-- <div class="pc-container"> -->
      <div class="pc-content container">
        <!-- [ Main Content ] start -->
        <!-- ปุ่มเพิ่มโพสต์ -->
        <div class="row">
          <div class="col-md-12 col-xl-12">
            <div class="card" id="card_add_post">
              <div class="card-header">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="wid-40 rounded-circle">
                  </div>
                  <div class="flex-grow-1 mx-3">
                    <button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#new-post-modal">
                      สร้างโพสต์ใหม่...
                    </button>
                    <!-- <button onclick="removeCardWithEffect('card_add_post')" class="btn btn-danger mt-2">
                      ลบโพสต์ 🫰
                    </button> -->
                  </div>
                </div>
              </div>
            </div>
            <style>
              @keyframes disintegrateEffect {
                0% {
                  opacity: 1;
                  transform: scale(1);
                  filter: blur(0);
                }

                100% {
                  opacity: 0;
                  transform: scale(1.2);
                  filter: blur(10px);
                }
              }

              .disintegrate {
                animation: disintegrateEffect 1s forwards;
                position: relative;
                overflow: hidden;
              }
            </style>
            <script>
              function removeCardWithEffect(cardId) {
                const card = document.getElementById(cardId);
                if (!card) return;

                card.classList.add('disintegrate');
                setTimeout(() => {
                  card.remove(); // ลบออกจาก DOM หลัง animation จบ (~1s)
                }, 1000);
              }
            </script>

          </div>
        </div>
        <!-- ปุ่มเพิ่มโพสต์ -->
        <!-- loading post โพสต์ที่แสดง -->
        <div class="row">
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

          <div id="post-container">
            <!-- โพสต์จะถูกเพิ่มที่นี่ -->
            <!-- loader จะอยู่ด้านล่างนี้ -->
            <!-- <div id="loader" style="display:none;">
              <div class="loader-spinner"></div>
            </div> -->
            <!-- <div id="loader" style="display:none;" class="skeleton-post">
              <div class="skeleton-avatar shimmer"></div>
              <div class="skeleton-lines">
                <div class="skeleton-line shimmer"></div>
                <div class="skeleton-line shimmer short"></div>
              </div>
            </div> -->

            <div id="loader">
              <div class="skeleton-post">
                <div class="skeleton-avatar shimmer"></div>
                <div class="skeleton-lines">
                  <div class="skeleton-line shimmer"></div>
                  <div class="skeleton-line shimmer short"></div>
                </div>
              </div>
            </div>
            <div id="loader2">
              <div class="skeleton-post">
                <div class="skeleton-avatar shimmer"></div>
                <div class="skeleton-lines">
                  <div class="skeleton-line shimmer"></div>
                  <div class="skeleton-line shimmer short"></div>
                </div>
              </div>
            </div>

            <script>
              function updatePostAndStatus(post_id, newStatus, newContent) {
                const postContainer = document.getElementById("post_content_" + post_id);
                const statusContainer = document.getElementById("post_status_" + post_id);

                // เพิ่ม effect 'กำลังแก้ไข'
                postContainer.classList.add("editing-effect");
                statusContainer.classList.add("editing-effect");

                setTimeout(() => {
                  // เริ่ม fade-out content
                  postContainer.classList.add("fade-out-old");
                  statusContainer.classList.add("fade-out-old");

                  postContainer.addEventListener("animationend", () => {
                    // แทนเนื้อหาใหม่
                    postContainer.innerHTML = newContent;

                    // เปลี่ยนสถานะพร้อมกัน
                    if (statusContainer) {
                      statusContainer.innerHTML = newStatus;
                      statusContainer.classList.remove("fade-out-old", "editing-effect");
                    }

                    // ล้างคลาสเก่า
                    postContainer.classList.remove("fade-out-old", "editing-effect");

                    // fade-in ข้อมูลใหม่
                    postContainer.classList.add("fade-in-new");
                    postContainer.addEventListener("animationend", () => {
                      postContainer.classList.remove("fade-in-new");
                    }, {
                      once: true
                    });

                  }, {
                    once: true
                  });

                }, 300); // รอสั้นๆ เพื่อให้เห็น effect "กำลังแก้"
              }
            </script>

            <!-- [ sample-page ] end -->
          </div>
          <!-- [ Main Content ] end -->
          <!-- </div> -->
        </div>
        <!-- loading post โพสต์ที่แสดง -->
      </div>
    </div>
  </div>
  <div class="modal fade" id="new-post-modal" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <div class="d-flex w-100 align-items-center">
            <div class="flex-grow-1 mx-3">
              <h4 class="mb-1">สร้างโพสต์ใหม่</h4>
            </div>
          </div>

        </div>
        <div class="modal-body">
          <form id="mentionForm" method="post" enctype="multipart/form-data">
            <div class="form-group row" style="padding: 0px 5%">
              <input type="hidden" name="post_user_id" value="<?= $_SESSION["TopicUserId"] ?>">
              <div class="col-sm-12">
                <b for="">หัวข้อ<code>*</code></b>
                <input type="" class="form-control" id="header_post" name="post_header" value="" placeholder="กรอก หัวข้อโพสต์" required>
                <div class="invalid-feedback">กรุณากรอก</div>
              </div>
              <p></p>

              <div class="col-sm-12">
                <label for="">เนื้อหา<code>*</code></label>
                <div class="card">
                  <div id="editor-wrapper" class="editor-wrapper">
                    <div id="editor" class="editor" name="editor" contenteditable="true" data-placeholder="กรอก เนื้อโพสต์"></div>
                  </div>
                  <div id="editor-error" class="text-danger" style="display: none;">กรุณากรอกเนื้อหาโพสต์</div>
                  <input type="hidden" name="post_content" id="post_content" required>
                  <input type="hidden" name="post_tag_inpost" id="post_tag_inpost">
                </div>
                <div id="suggestions" class="suggestions"></div>
              </div>

              <div class="col-md-12">
                <label for="post_add_file">แนบไฟล์</label>
                <input type="file" name="post_add_file" id="post_add_file" class="form-control" accept=".pdf,.png,.jpg,.jpe,.jpeg">
                <div class="invalid-feedback">แนบไฟล์</div>
              </div>
              <!-- <div class="comment-actions">
                <div class="col-md-12">
                  <label class="custom-file-label">
                    <i class="ti ti-paperclip"></i> แนบไฟล์
                    <input type="file" name="post_add_file" id="post_add_file" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">
                  </label>

                  <span id="post_file_name_container" class="file_name_container" style="display:none;">
                    <span id="post_file_name_display"></span>
                    <span class="remove-file" id="post_remove_file_btn">&times; ◀️คลิกเพื่อลบไฟล์แนบ</span>
                  </span>
                </div>
                <input type="hidden" id="post_has_old_file" name="has_old_file">
              </div> -->
              <p></p>

              <div class="col-md-4">
                <label for="tag">แท็กตั้งต้น : </label> <span class="badge bg-light-primary border border-primary bg-transparent f-14 me-1 mt-1">ผู้บริหาร</span>
              </div>
              <div class="col-md-8">
                <label for="">สถานะของโพสต์ : </label><span> </span>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status" id="post_status1" value="todo" required>
                  <label class="form-check-label badge bg-light-danger rounded-pill f-12" for="post_status1"> ต้องทำ </label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status" id="post_status2" value="doing">
                  <label class="form-check-label badge bg-light-primary rounded-pill f-12" for="post_status2">ดำเนินการ</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status" id="post_status3" value="success">
                  <label class="form-check-label badge bg-light-success rounded-pill f-12" for="post_status3">เสร็จ</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="post_status" id="post_status4" value="">
                  <label class="form-check-label" for="post_status4">ไม่มีสถานะ</label>
                </div>
              </div>
              <p></p>
              <div class="col-md-12">
                <label for="tag-users" class="tag-label">👥 แท็กผู้ใช้:</label>
                <div id="div-tag-users">
                  <select id="tag-users" name="tag_users[]" onchange="updateHiddenInput()" multiple></select>
                </div>
                <input type="hidden" name="post_tag_other" id="post_tag_other">
              </div>
              </select>

              <!-- <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

              <style>
                /* ปรับแต่ง Select */
                .choices__inner {
                  border-radius: 1rem;
                  border: 2px solid #ced4da;
                  box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
                  padding: 0.75rem;
                  background-color: #fff;
                  min-height: 52px;
                }

                .choices__list--multiple .choices__item {
                  background-color: #0d6efd;
                  border-radius: 20px;
                  padding: 5px 12px;
                  font-size: 0.9rem;
                  margin-right: 5px;
                  color: #fff;
                  font-weight: 500;
                }

                .choices__list--dropdown .choices__item--selectable {
                  padding: 10px;
                }

                .tag-label {
                  font-weight: bold;
                  margin-bottom: 0.5rem;
                  display: block;
                  font-size: 1rem;
                }

                .form-container {
                  max-width: 500px;
                  margin: 50px auto;
                }
              </style> -->
            </div>
            <!-- <button type="submit">ส่งข้อมูล</button> -->
            <div class="modal-footer">
              <button class="btn btn-link-success" id="submit_createpost" type="submit">สร้างโพสต์</button>
              <button class="btn btn-link-danger" onclick="cancelmodal_post('0')" type="button">ยกเลิก</button>

            </div>
          </form>

        </div>
      </div>
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
                    <input type="file" name="post_file_edit" id="post_add_file_edit" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">
                  </label>

                  <span id="post_file_name_container_edit" class="file_name_container" style="display:none;">
                    <span id="post_file_name_display_edit"></span>
                    <span class="remove-file" id="post_remove_file_btn_edit">&times; ◀️คลิกเพื่อลบไฟล์แนบ</span>
                  </span>
                </div>
                <input type="hidden" id="post_has_old_file_edit" name="has_old_file">
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
  <!-- [ Main Content ] end -->
  <!-- <footer class="pc-footer">
    <div class="footer-wrapper container-fluid">
      <div class="row">
        <div class="col-sm my-1">
          <p class="m-0">Mantis &#9829; crafted by Team <a href="https://themeforest.net/user/codedthemes" target="_blank">Codedthemes</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a>.</p>
        </div>
        <div class="col-auto my-1">
          <ul class="list-inline footer-link mb-0">
            <li class="list-inline-item"><a href="../index.html">Home</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer> -->

  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>

  <script src="../assets/js/plugins/choices.min.js"></script>

  <script>
    //! ----------------- Lazy load 3 โพสต์ล่าสุด ⬇️---------------------------
    let offset = 0;
    const limit = 3;
    let loading = false;
    let noMoreData = false;

    function loadPosts() {
      console.log(offset + "///" + limit);
      console.log("load..");
      if (loading || noMoreData) return;
      loading = true;
      $('#loader').show();

      $.ajax({
        url: 'api_Load_posts.php',
        method: 'POST',
        data: {
          offset: offset,
          limit: limit
        },
        success: function(response) {
          setTimeout(function() {
            if (response.trim() === '') {
              noMoreData = true;
              $('#loader').html('<div class="text-center">ไม่พบข้อมูลเพิ่มเติม</div>');

            } else {
              $('#loader').before(response);

              offset += limit;
              $('#loader').hide();
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
            $('#loader2').html(''); //ปิด
            $('#post-new-container').html(''); //ปิด
          }, 1500);
        }

      });
    }
    //! ----------------- Lazy load 3 โพสต์ล่าสุด ⬆️---------------------------


    //!-------------------------- โหลดโพสต์ล่าสุด ⬇️--------------------------------------
    let offset_new = 0;
    let limit_new = 5;

    function loadNewPosts() {
      offset = offset + 1; //เพิ่ม offset+1 บอกว่าแสดงกี่โพสต์แล้ว
      const postContent = $('#post-new-container').html(); //โพสต์ใหม่
      $('#loader_new2').prepend(postContent); // แทรกไว้ด้านบนของ loader2

      $('#post-new-container').html(`
                <div class="skeleton-post">
                      <div class="skeleton-avatar shimmer"></div>
                      <div class="skeleton-lines">
                            <span style="font-weight: bold; color: white; text-shadow: 0 0 3px black, 0 0 6px black;">กำลังสร้างโพสต์........</span>
                            <div class="skeleton-line shimmer"></div>
                            <div class="skeleton-line shimmer short"></div>
                      </div>
                </div>
      `); // แสดง div Skeleton

      $.ajax({
        url: 'api_Load_posts.php',
        method: 'POST',
        data: {
          offset_new: offset_new,
          limit_new: limit_new
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


    $(document).ready(function() {
      loadPosts(); //โหลดโพสต์
      $(window).on('scroll', function() {
        console.log('Scrolling...');
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
          loadPosts();
        }
      });
    });
  </script>
  <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก ⬇️--------------------------------------------->
  <script>
    let users = []; //array เก็บ id ชื่อ ที่จะแท็กในโพสต์

    async function Call_tag_in_post(retryCount = 1) {
      try {
        const response = await fetch(`post_tag.php?tag_in_post=1`);

        if (response.status === 500) {
          if (retryCount > 0) {
            console.warn("Server error 500. Retrying...");
            return Call_tag_in_post(tag_type, retryCount - 1);
          } else {
            throw new Error("Server error 500. Retry limit reached.");
          }
        }

        const data = await response.json();

        // สมมติว่า API คืนมาในรูปแบบ [{id: 1, inpost_user_name: "นาย1"}, ...]
        users = data;

        console.log("Users loaded:", users);
        // return users;

      } catch (error) {
        console.error("Error loading tag data:", error);
      }
    }

    function reloadTagUserSelect() { // ลบ tag-users แล้วสร้างใหม่
      const wrapper = document.getElementById('div-tag-users');

      // ✅ ล้าง HTML เดิมทั้งหมด
      wrapper.innerHTML = '';

      // ✅ สร้าง select ใหม่ (สด 300%)
      const select = document.createElement('select');
      select.id = 'tag-users';
      select.name = 'tag_users[]';
      select.multiple = true;
      select.setAttribute('onchange', 'updateHiddenInput()');

      wrapper.appendChild(select); // ใส่ select เข้าไปใหม่

      // ✅ ใส่ option ใหม่
      select_tag_backup.forEach(user => {
        const option = document.createElement('option');
        option.value = user.inpost_user_id;
        option.textContent = user.inpost_user_name;
        select.appendChild(option);
      });

      // ✅ เรียก Choices ใหม่
      new Choices(select, {
        removeItemButton: true,
        placeholderValue: 'แท็กผู้ใช้...',
        searchPlaceholderValue: 'พิมพ์ชื่อผู้ใช้...',
        allowHTML: false
      });
    }



    let select_tag_backup;

    async function Call_tag_other(retryCount = 1) {
      try {
        const response = await fetch(`post_tag.php?tag_other=1`);

        if (response.status === 500) {
          if (retryCount > 0) {
            console.warn("Server error 500. Retrying...");
            return Call_tag_in_post(tag_type, retryCount - 1);
          } else {
            throw new Error("Server error 500. Retry limit reached.");
          }
        }

        const data = await response.json();
        console.log("Users other loaded:", data);

        select_tag_backup = data;
        reloadTagUserSelect();

      } catch (error) {
        console.error("Error loading tag data:", error);
      }
    }
    // id="post_choices-multiple"


    Call_tag_in_post();
    Call_tag_other();
    const editor = document.getElementById("editor");
    const suggestions = document.getElementById("suggestions");

    let mentioned_name = [];
    let mentioned_id = [];


    // ฟังก์ชันหาคำก่อน cursor ว่ามี @ + คำอยู่หรือไม่
    function getCurrentWord() {
      const sel = window.getSelection();
      if (!sel.rangeCount) return null;

      const range = sel.getRangeAt(0);
      const node = sel.focusNode;
      if (!node) return null;

      // เราจะดูข้อความตั้งแต่จุดเริ่มต้น node ถึง cursor
      const text = node.textContent.slice(0, range.startOffset);

      // หา @ + ตัวอักษรต่อท้ายล่าสุด (คำสุดท้ายก่อน cursor)
      const match = /@([^\s@]*)$/.exec(text);
      if (match) {
        return {
          word: match[1],
          range,
          node
        };
      }
      return null;
    }

    // แสดงรายชื่อผู้ใช้ที่ตรงกับคำค้น
    function showSuggestions(list, rect) {
      if (list.length === 0) {
        suggestions.style.display = "none";
        return;
      }
      suggestions.innerHTML = "";

      list.forEach(user => {
        const div = document.createElement("div");
        div.textContent = user.inpost_user_name;
        div.addEventListener("mousedown", (e) => {
          e.preventDefault(); // ป้องกัน blur ก่อนแทรก
          try {
            insertMention(user);
          } catch (e) {
            console.error("Mention error:", e);
          }
        });
        suggestions.appendChild(div);
      });

      // ถ้าไม่มี rect ให้ใช้ตำแหน่ง cursor แทน
      if (!rect) {
        const sel = window.getSelection();
        if (sel.rangeCount > 0) {
          const range = sel.getRangeAt(0).cloneRange();
          const temp = document.createElement("span");
          range.insertNode(temp);
          rect = temp.getBoundingClientRect();
          temp.parentNode.removeChild(temp);
        } else {
          rect = editor.getBoundingClientRect(); // fallback
        }
      }

      suggestions.style.left = rect.left + "px";
      suggestions.style.top = rect.bottom + window.scrollY + "px";
      suggestions.style.width = "200px";
      suggestions.style.display = "block";
    }

    // แทรก mention (แท็ก) ลงใน editor
    function insertMention(user) {
      const sel = window.getSelection();
      if (!sel.rangeCount) return;

      const range = sel.getRangeAt(0);
      const node = sel.focusNode;

      if (!node || node.nodeType !== Node.TEXT_NODE) return;

      const textBeforeCursor = node.textContent.slice(0, range.startOffset);
      const match = /@([^\s@]*)$/.exec(textBeforeCursor);
      if (!match) return;

      const startPos = range.startOffset - match[0].length;
      const endPos = range.startOffset;

      // แยกข้อความก่อน & หลัง mention ที่พิมพ์
      const before = node.textContent.slice(0, startPos);
      const after = node.textContent.slice(endPos);

      // เตรียม text node ใหม่
      const beforeNode = document.createTextNode(before);
      const afterNode = document.createTextNode(after);

      // mention span
      const mentionSpan = document.createElement("span");
      mentionSpan.textContent = "" + user.inpost_user_name; //ใส่ @ ที่ช่องว่างก็จะได้ @ชื่อ
      mentionSpan.className = "mention";
      mentionSpan.setAttribute("data-mention", user.inpost_user_name);
      mentionSpan.setAttribute("data-id", user.inpost_user_id);
      mentionSpan.contentEditable = "false";

      const spaceNode = document.createTextNode("");

      // ลบ node เดิม
      const parent = node.parentNode;
      parent.replaceChild(afterNode, node); // วาง afterNode แทน node เดิม
      parent.insertBefore(spaceNode, afterNode);
      parent.insertBefore(mentionSpan, spaceNode);
      parent.insertBefore(beforeNode, mentionSpan);

      // เคอร์เซอร์ไปอยู่หลังช่องว่าง
      const newRange = document.createRange();
      newRange.setStartAfter(spaceNode);
      newRange.collapse(true);
      sel.removeAllRanges();
      sel.addRange(newRange);

      // บันทึก mention
      if (!mentioned_id.includes(user.inpost_user_id)) {
        mentioned_id.push(user.inpost_user_id);
      }

      if (!mentioned_name.includes(user.name)) {
        mentioned_name.push(user.name);
      }

      suggestions.style.display = "none";
      updateMentioned();
    }



    function updateMentioned() {
      const mentionSpans = editor.querySelectorAll("span.mention");
      mentioned_id = Array.from(mentionSpans)
        .map(s => s.getAttribute("data-id"))
        .filter(id => id !== null);

      mentioned_name = Array.from(mentionSpans)
        .map(s => s.getAttribute("data-mention"))
        .filter(id => id !== null);

      console.log("mentioned IDs:", mentioned_id);
      console.log("mentioned names:", mentioned_name);
      document.getElementById("post_tag_inpost").value = mentioned_id;
    }



    editor.addEventListener("input", () => {
      updateMentioned();
    });

    // ฟังก์ชันค้นหาและแสดง suggestion ตอนพิมพ์
    editor.addEventListener("keyup", (e) => {
      const current = getCurrentWord();
      if (current) {
        const keyword = current.word.toLowerCase();
        const filtered = users.filter(u =>
          !mentioned_name.includes(u.inpost_user_name) &&
          u.inpost_user_name.toLowerCase().includes(keyword)
        );

        // หาตำแหน่ง cursor เพื่อแสดง suggestions
        const range = window.getSelection().getRangeAt(0).cloneRange();
        let rect;
        if (range.getClientRects().length > 0) {
          rect = range.getClientRects()[0];
        } else {
          // fallback
          rect = editor.getBoundingClientRect();
        }

        showSuggestions(filtered, rect);
      } else {
        suggestions.style.display = "none";
      }
    });

    // ซ่อน suggestion เมื่อคลิกที่อื่น
    document.addEventListener("click", (e) => {
      if (!suggestions.contains(e.target) && e.target !== editor) {
        suggestions.style.display = "none";
      }
    });

    // ตั้ง event listener ให้กับ mention แต่ละตัว
    editor.addEventListener("click", function(e) {
      if (e.target.classList.contains("mention")) {
        const span = e.target;
        const parent = span.parentNode;
        const children = Array.from(parent.childNodes);

        const spanIndex = children.indexOf(span);
        const before = children[spanIndex - 1];
        const after = children[spanIndex + 1];

        const range = document.createRange();

        if (before?.nodeType === Node.TEXT_NODE && before.textContent === "") {
          range.setStartBefore(before);
        } else {
          range.setStartBefore(span);
        }

        if (after?.nodeType === Node.TEXT_NODE && after.textContent === "") {
          range.setEndAfter(after);
        } else {
          range.setEndAfter(span);
        }

        const sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
      }
    });
  </script>
  <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก ⬆️--------------------------------------------->
  <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก Edit ⬇️--------------------------------------------->
  <script>
    let users_edit = []; //array เก็บ id ชื่อ ที่จะแท็กในโพสต์

    async function Call_tag_in_post_edit(retryCount = 1) {
      try {
        const response = await fetch(`post_tag.php?tag_in_post=1`);

        if (response.status === 500) {
          if (retryCount > 0) {
            console.warn("Server error 500. Retrying...");
            return Call_tag_in_post_edit(tag_type, retryCount - 1);
          } else {
            throw new Error("Server error 500. Retry limit reached.");
          }
        }

        const data = await response.json();

        // สมมติว่า API คืนมาในรูปแบบ [{id: 1, inpost_user_name: "นาย1"}, ...]
        users = data;

        console.log("Users loaded edit:", users);
        // return users;

      } catch (error) {
        console.error("Error loading tag data:", error);
      }
    }

    function reloadTagUserSelect_edit() { // ลบ tag-users แล้วสร้างใหม่
      const oldSelect = document.getElementById("tag-users_edit");

      // ลบ Choices DOM เก่าออก
      const wrapper = oldSelect.closest('.choices');
      if (wrapper) wrapper.remove();

      // สร้าง <select> ใหม่ทดแทน
      const newSelect = document.createElement("select");
      newSelect.id = "tag-users_edit";
      newSelect.name = "tag_users_edit[]";
      newSelect.multiple = true;
      newSelect.setAttribute("onchange", "updateHiddenInput_edit()");
      // document.getElementById("div-tag-users_edit").innerHTML = '';
      // document.getElementById("div-tag-users_edit").appendChild(newSelect);
      const wrapperMain = document.getElementById('div-tag-users_edit');

      wrapperMain.innerHTML = '';

      wrapperMain.appendChild(newSelect); // ใส่ select เข้าไปใหม่
      // ใส่ <option> ใหม่
      select_tag_backup_edit.forEach(user => {
        const option = document.createElement("option");
        option.value = user.inpost_user_id;
        option.textContent = user.inpost_user_name;

        const fd_post_tag = document.getElementById('post_tag_other_edit').value;

        if (fd_post_tag.split(",").includes(String(user.inpost_user_id))) {
          option.selected = true;
        }

        newSelect.appendChild(option);
      });

      // สร้าง Choices ใหม่
      new Choices(newSelect, {
        removeItemButton: true,
        placeholderValue: 'แท็กผู้ใช้...',
        searchPlaceholderValue: 'พิมพ์ชื่อผู้ใช้...',
        allowHTML: false
      });
    }


    let select_tag_backup_edit;

    async function Call_tag_other_edit(retryCount = 1) {
      try {
        const response = await fetch(`post_tag.php?tag_other=1`);

        if (response.status === 500) {
          if (retryCount > 0) {
            console.warn("Server error 500. Retrying...");
            return Call_tag_in_post_edit(tag_type, retryCount - 1);
          } else {
            throw new Error("Server error 500. Retry limit reached.");
          }
        }

        const data = await response.json();
        console.log("Users other loaded_edit:", data);

        select_tag_backup_edit = data;
        reloadTagUserSelect_edit();

      } catch (error) {
        console.error("Error loading tag data_edit:", error);
      }
    }
    // id="post_choices-multiple"


    Call_tag_in_post_edit();
    Call_tag_other_edit();
    const editor_edit = document.getElementById("editor_edit");
    const suggestions_edit = document.getElementById("suggestions_edit");

    let mentioned_name_edit = [];
    let mentioned_id_edit = [];


    // ฟังก์ชันหาคำก่อน cursor ว่ามี @ + คำอยู่หรือไม่
    function getCurrentWord_edit() {
      const sel = window.getSelection();
      if (!sel.rangeCount) return null;

      const range = sel.getRangeAt(0);
      const node = sel.focusNode;
      if (!node) return null;

      // เราจะดูข้อความตั้งแต่จุดเริ่มต้น node ถึง cursor
      const text = node.textContent.slice(0, range.startOffset);

      // หา @ + ตัวอักษรต่อท้ายล่าสุด (คำสุดท้ายก่อน cursor)
      const match = /@([^\s@]*)$/.exec(text);
      if (match) {
        return {
          word: match[1],
          range,
          node
        };
      }
      return null;
    }

    // แสดงรายชื่อผู้ใช้ที่ตรงกับคำค้น
    function showSuggestions_edit(list, rect) {
      if (list.length === 0) {
        suggestions_edit.style.display = "none";
        return;
      }
      suggestions_edit.innerHTML = "";

      list.forEach(user => {
        const div = document.createElement("div");
        div.textContent = user.inpost_user_name;
        div.addEventListener("mousedown", (e) => {
          e.preventDefault(); // ป้องกัน blur ก่อนแทรก
          try {
            insertMention_edit(user);
          } catch (e) {
            console.error("Mention error:", e);
          }
        });
        suggestions_edit.appendChild(div);
      });

      // ถ้าไม่มี rect ให้ใช้ตำแหน่ง cursor แทน
      if (!rect) {
        const sel = window.getSelection();
        if (sel.rangeCount > 0) {
          const range = sel.getRangeAt(0).cloneRange();
          const temp = document.createElement("span");
          range.insertNode(temp);
          rect = temp.getBoundingClientRect();
          temp.parentNode.removeChild(temp);
        } else {
          rect = editor.getBoundingClientRect(); // fallback
        }
      }

      suggestions_edit.style.left = rect.left + "px";
      suggestions_edit.style.top = rect.bottom + "px";
      suggestions_edit.style.width = "200px";
      suggestions_edit.style.display = "block";
    }

    // แทรก mention (แท็ก) ลงใน editor
    function insertMention_edit(user) {
      const sel = window.getSelection();
      if (!sel.rangeCount) return;

      const range = sel.getRangeAt(0);
      const node = sel.focusNode;

      if (!node || node.nodeType !== Node.TEXT_NODE) return;

      const textBeforeCursor = node.textContent.slice(0, range.startOffset);
      const match = /@([^\s@]*)$/.exec(textBeforeCursor);
      if (!match) return;

      const startPos = range.startOffset - match[0].length;
      const endPos = range.startOffset;

      // แยกข้อความก่อน & หลัง mention ที่พิมพ์
      const before = node.textContent.slice(0, startPos);
      const after = node.textContent.slice(endPos);

      // เตรียม text node ใหม่
      const beforeNode = document.createTextNode(before);
      const afterNode = document.createTextNode(after);

      // mention span
      const mentionSpan = document.createElement("span");
      mentionSpan.textContent = "" + user.inpost_user_name; //ใส่ @ ที่ช่องว่างก็จะได้ @ชื่อ
      mentionSpan.className = "mention";
      mentionSpan.setAttribute("data-mention", user.inpost_user_name);
      mentionSpan.setAttribute("data-id", user.inpost_user_id);
      mentionSpan.contentEditable = "false";

      const spaceNode = document.createTextNode("");

      // ลบ node เดิม
      const parent = node.parentNode;
      parent.replaceChild(afterNode, node); // วาง afterNode แทน node เดิม
      parent.insertBefore(spaceNode, afterNode);
      parent.insertBefore(mentionSpan, spaceNode);
      parent.insertBefore(beforeNode, mentionSpan);

      // เคอร์เซอร์ไปอยู่หลังช่องว่าง
      const newRange = document.createRange();
      newRange.setStartAfter(spaceNode);
      newRange.collapse(true);
      sel.removeAllRanges();
      sel.addRange(newRange);

      // บันทึก mention
      if (!mentioned_id_edit.includes(user.inpost_user_id)) {
        mentioned_id_edit.push(user.inpost_user_id);
      }

      if (!mentioned_name_edit.includes(user.name)) {
        mentioned_name_edit.push(user.name);
      }

      suggestions_edit.style.display = "none";
      updateMentioned_edit();
    }



    function updateMentioned_edit() {
      const mentionSpans_edit = editor_edit.querySelectorAll("span.mention");
      mentioned_id_edit = Array.from(mentionSpans_edit)
        .map(s => s.getAttribute("data-id"))
        .filter(id => id !== null);

      mentioned_name_edit = Array.from(mentionSpans_edit)
        .map(s => s.getAttribute("data-mention"))
        .filter(id => id !== null);

      console.log("mentioned IDs_edit:", mentioned_id_edit);
      console.log("mentioned names_edit:", mentioned_name_edit);
      document.getElementById("post_tag_inpost_edit").value = mentioned_id_edit;
    }



    editor_edit.addEventListener("input", () => {
      updateMentioned_edit();
    });

    // ฟังก์ชันค้นหาและแสดง suggestion ตอนพิมพ์
    editor_edit.addEventListener("keyup", (e) => {
      const current = getCurrentWord_edit();
      if (current) {
        const keyword_edit = current.word.toLowerCase();
        const filtered_edit = users.filter(u =>
          !mentioned_name_edit.includes(u.inpost_user_name) &&
          u.inpost_user_name.toLowerCase().includes(keyword_edit)
        );

        // หาตำแหน่ง cursor เพื่อแสดง suggestions
        const range_edit = window.getSelection().getRangeAt(0).cloneRange();
        let rect_edit;
        if (range_edit.getClientRects().length > 0) {
          rect_edit = range_edit.getClientRects()[0];
        } else {
          // fallback
          rect_edit = editor_edit.getBoundingClientRect();
        }

        showSuggestions_edit(filtered_edit, rect_edit);
      } else {
        suggestions_edit.style.display = "none";
      }
    });

    // ซ่อน suggestion เมื่อคลิกที่อื่น
    document.addEventListener("click", (e) => {
      if (!suggestions_edit.contains(e.target) && e.target !== editor_edit) {
        suggestions_edit.style.display = "none";
      }
    });

    // ตั้ง event listener ให้กับ mention แต่ละตัว
    editor_edit.addEventListener("click", function(e) {
      if (e.target.classList.contains("mention")) {
        const span = e.target;
        const parent = span.parentNode;
        const children = Array.from(parent.childNodes);

        const spanIndex = children.indexOf(span);
        const before = children[spanIndex - 1];
        const after = children[spanIndex + 1];

        const range = document.createRange();

        if (before?.nodeType === Node.TEXT_NODE && before.textContent === "") {
          range.setStartBefore(before);
        } else {
          range.setStartBefore(span);
        }

        if (after?.nodeType === Node.TEXT_NODE && after.textContent === "") {
          range.setEndAfter(after);
        } else {
          range.setEndAfter(span);
        }

        const sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
      }
    });
  </script>
  <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก Edit ⬆️--------------------------------------------->
  <!-- //! ---------------- เติม , ให้ value แท็ก ⬇️ ----------------------------------------------------->
  <script>
    function updateHiddenInput() {
      const select = document.getElementById('tag-users');
      const selectedValues = Array.from(select.selectedOptions).map(opt => opt.value);
      document.getElementById('post_tag_other').value = selectedValues.join(',');
    }
  </script>
  <!-- //! ---------------- เติม , ให้ value แท็ก ⬆️ ----------------------------------------------------->
  <!-- //! ---------------- เติม , ให้ value แท็ก Edit ⬇️ ----------------------------------------------------->
  <script>
    // function updateHiddenInput_edit() {
    //   const select = document.getElementById('tag-users_edit');
    //   const selectedValues = Array.from(select.selectedOptions).map(opt => opt.value);
    //   document.getElementById('post_tag_other_edit').value = selectedValues.join(',');
    // }
    function updateHiddenInput_edit() {
      const select = document.getElementById("tag-users_edit");
      const selectedValues = Array.from(select.selectedOptions).map(opt => opt.value);
      document.getElementById("post_tag_other_edit").value = selectedValues.join(",");
    }
  </script>
  <!-- //! ---------------- เติม , ให้ value แท็ก Edit ⬆️ ----------------------------------------------------->
  <!-- //! ---------------- modal post submit ⬇️ ----------------------------------------------------->
  <script>
    document.getElementById('mentionForm').addEventListener('submit', async function(e) {
      const button = document.getElementById('submit_createpost');
      button.disabled = true;
      setTimeout(() => {
        button.disabled = false;
      }, 3000); // 3 วินาที
      e.preventDefault(); // ❌ ป้องกัน reload หน้า
      const editor = document.getElementById('editor');
      const error = document.getElementById('editor-error');

      // trim เพื่อตัดช่องว่างที่ไม่มีความหมาย
      const text = editor.innerText.trim();

      if (text === '') {
        e.preventDefault(); // ป้องกันการส่งฟอร์ม
        error.style.display = 'block';
        editor.classList.add('border-danger');
        editor.focus();
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
          const response = await fetch('action_add_post.php', {
              method: 'POST',
              body: formData
            }).then(response => response.json()) // ❗ ถ้า response ไม่ใช่ JSON → Error ทันที
            .then(data => {
              // console.log(data);
              if (data.success) {
                // alert('✅ บันทึกข้อมูลเรียบร้อย');
                // ถ้ามีฟังก์ชันอัปเดตอื่น
                if (cancelmodal_post("1")) { //สั่งปิด modal post ต้องreturn true
                  loadNewPosts(); //โหลดโพสต์ใหม่
                }
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

    document.getElementById('mentionForm_edit').addEventListener('submit', async function(e) {
      e.preventDefault(); // ❌ ป้องกัน reload หน้า
      const editor = document.getElementById('editor_edit');
      const error = document.getElementById('editor-error_edit');

      // trim เพื่อตัดช่องว่างที่ไม่มีความหมาย
      const text = editor.innerText.trim();

      if (text === '') {
        e.preventDefault(); // ป้องกันการส่งฟอร์ม
        error.style.display = 'block';
        editor.classList.add('border-danger');
        editor.focus();
      } else {
        error.style.display = 'none';
        editor.classList.remove('border-danger');
        const form = document.getElementById("mentionForm_edit");
        const hiddenInput = document.getElementById("post_content_edit");
        const content = editor.innerHTML;

        hiddenInput.value = content;
        const formData = new FormData(form); // ✅ รวมข้อมูลทั้งหมดรวมไฟล์แนบ
        console.log("farm Data:", formData.get("post_user_id_edit"));

        try {
          const response = await fetch('action_edit_post.php', {
              method: 'POST',
              body: formData
            }).then(response => response.json()) // ❗ ถ้า response ไม่ใช่ JSON → Error ทันที
            .then(data => {
              console.log(data);
              if (data.success) {
                // ปิด modal
                const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
                if (modal) modal.hide();

                updatePostAndStatus(formData.get("post_user_id_edit"), data.newstatus, data.newcontent);
                // // ถ้ามีฟังก์ชันอัปเดตอื่น
                // if (cancelmodal_post("1")) { //สั่งปิด modal post ต้องreturn true
                //   loadNewPosts(); //โหลดโพสต์ใหม่
                // }

              }
            })
            .catch(error => {
              console.error('เกิดข้อผิดพลาด6:', error);
              // ปิด modal
              const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
              if (modal) modal.hide();
            });

        } catch (error) {
          console.error('เกิดข้อผิดพลาด2:', error);
        }
      }
    });
    async function Load_newupdate_post(post_id, retryCount = 1) {
      const maxRetries = 3;
      const url = "api_Load_post_newupdate.php";

      // สร้างข้อมูล POST
      const formData = new FormData();
      formData.append("post_id", post_id);

      try {
        const response = await fetch(url, {
          method: "POST",
          body: formData
        });

        if (!response.ok) {
          throw new Error("HTTP status " + response.status);
        }

        const result = await response.json(); // หรือ .text() แล้วแต่ API
        console.log("📦 ได้ข้อมูลโพสต์:", result);

        // ตัวอย่าง: แสดงโพสต์
        displayPost(result);

      } catch (error) {
        console.error("❌ โหลดโพสต์ล้มเหลว:", error);
        if (retryCount < maxRetries) {
          console.log("🔁 ลองใหม่ครั้งที่ " + (retryCount + 1));
          return Load_newupdate_post(post_id, retryCount + 1);
        }
      }
    }
  </script>
  <!-- //! ---------------- modal post submit ⬆️ ----------------------------------------------------->
  <!-- //! ---------------- ปิด modal โพสต์ ⬇️ ----------------------------------------------------->
  <script>
    function cancelmodal_post(ids) {
      const form = document.getElementById('mentionForm');
      const inputs = form.querySelectorAll('input[type="text"], input[type="file"], textarea');

      let hasValue;
      if (ids == "1") {
        hasValue = false;

      } else {
        // ตรวจสอบว่ามี input ใดกรอกข้อมูลไว้หรือไม่
        inputs.forEach(input => {
          if (input.value.trim() !== '') {
            hasValue = true;
          }
        });

        // ตรวจสอบเนื้อหาใน div contenteditable (editor)
        const editorContent = document.getElementById('editor').innerText.trim();
        if (editorContent !== '') {
          hasValue = true;
        }
        // return hasValue;
      }


      if (hasValue) {
        // ถ้ามีข้อมูล แสดงกล่องยืนยัน
        if (confirm("คุณต้องการยกเลิกและล้างข้อมูลที่กรอกไว้หรือไม่?")) {
          form.reset(); // ล้าง input ทั้งหมด
          document.getElementById('editor').innerHTML = ''; // ล้าง contenteditable
          const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
          if (modal) modal.hide(); // ปิด modal ถ้าเปิดอยู่
        }
      } else {
        // ถ้าไม่มีข้อมูล ก็ปิด modal ได้เลย
        form.reset(); // ล้าง input ทั้งหมด
        document.getElementById('editor').innerHTML = '';
        const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
        if (modal) modal.hide();
      }
      reloadTagUserSelect();

      return true;
    }
  </script>
  <!-- //! ---------------- ปิด modal โพสต์ ⬆️ ----------------------------------------------------->

  <!-- //! ----------------modal แก้ไข โพสต์ ⬇️ ----------------------------------------------------->
  <script>
    async function EditPost(Encrypt_post_id) {
      const formData = new FormData();
      formData.append('post_id', Encrypt_post_id);

      try {
        const response = await fetch('api_Load_post_edit.php', {
          method: 'POST',
          body: formData
        });

        const data = await response.json();

        if (data.success) {
          data1 = data.data; // ✅ ดึงเฉพาะข้อมูลโพสต์
          console.log('รายละเอียดโพสต์:', data1);
          document.getElementById('header_post_edit').value = data1.fd_post_title;
          let content = data1.fd_post_content;

          // สร้าง DOM จาก content เดิม
          let div = document.createElement("div");
          div.innerHTML = content;

          // ค้นหา <a> ที่มี <span class="mention"> อยู่ด้านใน
          div.querySelectorAll("a").forEach(a => {
            const span = a.querySelector("span.mention");
            if (span) {
              const newSpan = span.cloneNode(true); // คัดลอก <span>
              //const space = document.createTextNode('\u00A0'); // ช่องว่างแบบไม่ตัดบรรทัด (&nbsp;)
              const space = document.createTextNode('');
              // แทนที่ <a> ด้วย <span> ตามด้วยช่องว่าง
              a.replaceWith(newSpan, space);
            }
          });

          // แปลง DOM กลับเป็น HTML string
          data1.fd_post_content = div.innerHTML;


          document.getElementById("post_user_id_edit").value = data1.fd_post_id;
          document.getElementById("editor_edit").innerHTML = data1.fd_post_content;
          document.getElementById("post_content_edit").value = data1.fd_post_content;

          document.getElementById("post_tag_inpost_edit").value = data1.fd_post_tag_inpost;

          //สถานะ
          const statusValue = data1.fd_post_status;
          const radios = document.getElementsByName("post_status_edit");
          radios.forEach(radio => {
            if (radio.value === statusValue) {
              radio.checked = true;
            }
          });

          const fileInput = document.getElementById('post_add_file_edit');
          const fileNameDisplay = document.getElementById('post_file_name_display_edit');
          const fileNameContainer = document.getElementById('post_file_name_container_edit');
          const removeFileBtn = document.getElementById('post_remove_file_btn_edit');
          const hasOldFile = document.getElementById('post_has_old_file_edit');

          fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
              console.log(file);
              console.log(file.name);
              fileNameDisplay.textContent = file.name;
              fileNameContainer.style.display = 'inline-flex';
              console.log(fileNameContainer.style.display);

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
          if (data1.fd_post_file != '') {
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

          //🏷️ แท็กผู้ที่มีสิทธิ์เห็นโพสต์ 🔻
          document.getElementById('post_tag_other_edit').value = data1.fd_post_tag;
          reloadTagUserSelect_edit(); //รีโหลด choices เลือกแท็ก
          // 👉 ทำอะไรกับ data.data ก็ได้
        } else {
          console.warn('ไม่พบโพสต์:', data.message);
        }
      } catch (error) {
        console.error('เกิดข้อผิดพลาด:', error);
      }
    }
  </script>
  <!-- EditPost -->
</body>
<!-- [Body] end -->

</html>