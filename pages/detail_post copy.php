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
    #editor {
      border: 1px solid #ccc;
      padding: 10px;
      min-height: 100px;
      font-size: 16px;
      position: relative;
    }

    #editor:empty::before {
      content: attr(data-placeholder);
      color: #888;
      pointer-events: none;
    }

    .mention {
      color: #007bff;
      font-weight: bold;
    }

    #suggestions {
      position: fixed;
      border: 1px solid #ccc;
      background: white;
      z-index: 1000;
      max-height: 150px;
      overflow-y: auto;
      display: none;
    }

    #suggestions div {
      padding: 1px 1px;
      cursor: pointer;
    }

    #suggestions div:hover {
      background: #eee;
    }

    #suggestions2 {
      position: absolute;
      top: 100%;
      /* ด้านล่างของ editor */
      left: 0;
      width: 100%;
    }

    #editor-wrapper {
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
            <div id="content_post">
              <!-- <div class="card-header">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="wid-40 rounded-circle">
                  </div>
                  <div class="flex-grow-1 mx-3">
                    <h6 class="mb-1">ศุภกรBKK ทดสอบ</h6>
                    <p class="text-muted text-sm mb-0">Manager IT</p>
                  </div>
                  <div class="dropdown"><span id="post_status"><span class="badge bg-light-danger rounded-pill f-12"><b style="font-size: medium;">ต้องทำ</b></span></span> <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ti ti-dots-vertical f-18"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a class="dropdown-item" href="#" onclick="loadPosts()">ประวัติการแก้ไข</a>
                      <a class="dropdown-item" href="#">แก้ไข</a>
                      <a class="dropdown-item" onclick="removeCardWithEffect('post_id_12')">ส่งโพสต์ไปถังขยะ</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body" id="post_content">
                <h5>เรื่องบุคคลค้ำ</h5>
                <p class="mb-4"></p>
                <p>ให้<a href="farmer.php?id=3" target="_blank"><span class="mention" data-mention="นายอภิสิทธิ์BKK ทดสอบ" data-id="3" contenteditable="false">นายอภิสิทธิ์BKK ทดสอบ</span></a> โน๊ตเงื่อนไขการจับจำนวนบุคคลค้ำ<br>ให้ดึงมาตรวจสอบได้ ให้โชว์แยกไปเลย ให้ฝ่ายไร่ดู</p>
                <p></p>
                <div class="row g-2">
                  <div class="col-sm-12">
                    <div class="d-inline-flex align-items-center justify-content-start w-100">
                      <i class="ti ti-file-symlink"></i>
                      <a href="" class="link-primary text-truncate">
                        <p class="mb-0 ms-2 text-truncate"></p>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="mt-3"><span class="">ผู้ที่ได้รับการแท็ก : </span><a href="farmer.php?id=3" target="_blank"><span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">นายอภิสิทธิ์BKK ทดสอบ</span> </a></div>
              </div>
              <button class="btn btn-success-outline" onclick="updatePostAndStatus()">click</button>
              <div class="card mb-2 shadow-sm">
                <div class="card-body py-2 px-3 d-flex align-items-center justify-content-between">-->

                  <!-- ด้านซ้าย: วันที่โพสต์ -->
                  <!-- <div class="text-muted" style="font-size: 14px; margin-left:1%">
                    <i class="ti ti-clock me-1"></i> โพสต์เมื่อ 2025-06-25 15:48:43
                  </div> -->

                  <!-- ด้านขวา: จำนวนความคิดเห็น -->
                  <!-- <div class="text-muted d-flex align-items-center" style="font-size: 14px; margin-right:1%;cursor: pointer;">
                    <i class="ti ti-message-circle me-1" style="font-size: 18px;"></i> 4 ความคิดเห็น
                  </div>

                </div>
              </div>  -->
            </div>

            <div class="card-body">
              <!-- <hr> -->
              <!-- แสดงจำนวนคอมเมนต์ -->
              <!-- <p class="text-muted mb-2">ความคิดเห็น 2 รายการ</p> -->
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
                        name="editor"
                        contenteditable="true"
                        data-placeholder="เขียนความคิดเห็น..."
                        class="form-control border-0"
                        style="min-height: 60px;"></div>
                    </div>
                    <input type="hidden" name="post_content" id="post_content">
                    <input type="hidden" name="post_tag_inpost" id="post_tag_inpost">
                  </div>

                  <!-- ปุ่มแนบไฟล์และส่ง -->
                  <div class="d-flex justify-content-between align-items-center mt-2">
                    <div>
                      <label class="btn btn-sm btn-outline-secondary mb-0">
                        <i class="ti ti-paperclip"></i> แนบไฟล์
                        <input type="file" name="comment_file" id="comment_file" class="d-none" accept=".jpg,.jpeg,.png,.pdf">
                      </label>
                      <span id="file_name_display" class="text-muted ms-2" style="font-size: 13px;"></span>
                    </div>

                    <button class="btn btn-sm btn-primary">ส่ง</button>
                  </div>

                </div>
                <div id="suggestions" class="mt-1"></div>
              </div>


            </div>
          </div>





        </div>
      </div>
      <!-- loading post โพสต์ที่แสดง -->
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
      let post_id = '<?= $Encrypt->DeCrypt_pass($_GET["post"]) ?>';
      if (post_id) {
        setTimeout(() => {

        }, 500);

        console.log(9999);

        $.ajax({
          url: 'load_post_detail.php',
          method: 'POST',
          data: {
            post_id: post_id,
          },
          success: function(response) {
            console.log(response);
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
      let post_id = '<?= $Encrypt->DeCrypt_pass($_GET["post"]) ?>';
      if (post_id) {
        console.log(9.2);
        $.ajax({
          url: 'load_comments.php',
          method: 'POST',
          data: {
            offset: offset,
            limit: limit,
            post_id: post_id,
          },
          success: function(response) {
            console.log(response);
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

            }, 1500);
          }

        });
      }
    }
    loadComments();
    loadMainPost();
  </script>
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

    // สร้าง Choices instance
    // var multipleCancelButton = new Choices('#post_choices-multiple', {
    //   removeItemButton: true
    // });
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

        // แปลงข้อมูลให้เป็นรูปแบบของ Choices
        const choicesData = data.map(user => ({
          value: user.inpost_user_id,
          label: user.inpost_user_name
        }));

        // ล้างค่าเดิม และใส่ใหม่เข้าไป
        multipleCancelButton.clearChoices();
        multipleCancelButton.setChoices(choicesData, 'value', 'label', true);

      } catch (error) {
        console.error("Error loading tag data:", error);
      }
    }
    // id="post_choices-multiple"


    Call_tag_in_post();
    // Call_tag_other();
    const editor = document.getElementById("editor");
    const suggestions = document.getElementById("suggestions");

    let mentioned_name = [];
    let mentioned_id = [];



    // form.addEventListener("submit", function(e) {
    //   // ดึงข้อความ HTML หรือ textContent ขึ้นกับที่ต้องการส่ง
    //   // ถ้าต้องการส่งเป็นข้อความที่มี tag mention แนะนำส่ง innerHTML
    //   const content = editor.innerHTML;

    //   hiddenInput.value = content;
    //   // form จะ submit ไปตามปกติด้วย method="get"
    // });


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
      suggestions.style.top = rect.bottom + "px";
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
      const before = node.textContent.slice(0, startPos);
      const after = node.textContent.slice(endPos);

      const parent = node.parentNode;

      const beforeNode = document.createTextNode(before);
      const mentionSpan = document.createElement("span");
      mentionSpan.textContent = user.inpost_user_name;
      mentionSpan.className = "mention";
      mentionSpan.setAttribute("data-mention", user.inpost_user_name);
      mentionSpan.setAttribute("data-id", user.inpost_user_id); // ✅ เก็บ ID ที่นี่
      mentionSpan.contentEditable = "false";

      const spaceNode = document.createTextNode("  ");
      const afterNode = document.createTextNode(after);

      parent.removeChild(node);
      parent.appendChild(beforeNode);
      parent.appendChild(mentionSpan);
      parent.appendChild(spaceNode);
      parent.appendChild(afterNode);

      const newRange = document.createRange();
      newRange.setStartAfter(spaceNode);
      newRange.collapse(true);
      sel.removeAllRanges();
      sel.addRange(newRange);

      // ✅ เก็บ ID 
      if (!mentioned_id.includes(user.inpost_user_id)) {
        mentioned_id.push(user.inpost_user_id);
      }
      // ✅ เก็บ ชื่อ 

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


    if (document.getElementById("editor")) { //ป้องกัน error เมื่อหา DOM editor ไม่เจอ
      document.getElementById("editor").addEventListener("input", () => {
        editor.addEventListener("input", () => {
          updateMentioned();
        });
      });
    }

    if (document.getElementById("editor")) { //ป้องกัน error เมื่อหา DOM editor ไม่เจอ 2
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
          console.log("เจอ@");
        } else {
          suggestions.style.display = "none";
          console.log("ไม่เจอ@");

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

          if (before?.nodeType === Node.TEXT_NODE && before.textContent === " ") {
            range.setStartBefore(before);
          } else {
            range.setStartBefore(span);
          }

          if (after?.nodeType === Node.TEXT_NODE && after.textContent === " ") {
            range.setEndAfter(after);
          } else {
            range.setEndAfter(span);
          }

          const sel = window.getSelection();
          sel.removeAllRanges();
          sel.addRange(range);
        }
      });
    }
  </script>
  <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก ⬆️--------------------------------------------->
  <!-- //! ---------------- เติม , ให้ value แท็ก ⬇️ ----------------------------------------------------->
  <!-- <script>
    function updateHiddenInput() {
      const select = document.getElementById('post_choices-multiple');
      const selectedValues = Array.from(select.selectedOptions).map(opt => opt.value);
      document.getElementById('post_tag_other').value = selectedValues.join(',');
    }
  </script> -->
  <!-- //! ---------------- เติม , ให้ value แท็ก ⬆️ ----------------------------------------------------->

  <script>
    function updatePostAndStatus() {
      const postContainer = document.getElementById("post_content");
      const statusContainer = document.getElementById("post_status");

      // เพิ่ม effect 'กำลังแก้ไข'
      postContainer.classList.add("editing-effect");

      setTimeout(() => {
        // เริ่ม fade-out content
        postContainer.classList.add("fade-out-old");

        postContainer.addEventListener("animationend", () => {
          // แทนเนื้อหาใหม่
          postContainer.innerHTML = newHtml;

          // เปลี่ยนสถานะพร้อมกัน
          if (statusContainer) {
            statusContainer.innerHTML = newStatusHtml;
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


    // 🔽 เนื้อหาใหม่ของคุณ
    const newStatusHtml = '<span class="badge bg-light-success rounded-pill f-12"><b style="font-size: medium;">เสร็จสิ้น</b></span>';


    const newHtml = `
  <h5>การ์ดชาวไร่</h5>
  <p class="mb-4"></p>
  <p>UI รอการประชุม 
    <a href="farmer.php?id=2" target="_blank">
      <span class="mention" data-mention="นายเบรฟ ทดสอบ" data-id="2" contenteditable="false">นายเบรฟ ทดสอบ</span>
    </a>
  เข้าใจไหมเบรฟ เข้าใจไหมเบรฟ เข้าใจไหมเบรฟ เข้าใจไหมเบรฟ เข้าใจไหมเบรฟ</p>
  <p></p>
  <div class="row g-2">
    <div class="col-sm-12">
      <div class="d-inline-flex align-items-center justify-content-start w-100">
        <i class="ti ti-file-symlink"></i>
        <a href="" class="link-primary text-truncate">
          <p class="mb-0 ms-2 text-truncate"></p>
        </a>
      </div>
    </div>
  </div>
  <div class="mt-3">
    <span class="">ผู้ที่ได้รับการแท็ก : </span>
    <a href="farmer.php?id=2" target="_blank">
      <span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">นายเบรฟ ทดสอบ</span>
    </a>
    <a href="farmer.php?id=3" target="_blank">
      <span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">นายอภิสิทธิ์BKK ทดสอบ</span>
    </a>
    <a href="farmer.php?id=4" target="_blank">
      <span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">ศุภกรBKK ทดสอบ</span>
    </a>
  </div>
`;
  </script>

</body>
<!-- [Body] end -->

</html>