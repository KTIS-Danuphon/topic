<?php
session_start();
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
  <style>
    .post {
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    #loader {
      text-align: center;
      padding: 20px;
      display: none;
      color: gray;
    }

    #post-container {
      min-height: 100vh;
    }

    #loader {
      text-align: center;
      padding: 20px;
      margin-top: 10px;
    }

    .loader-spinner {
      border: 6px solid #f3f3f3;
      border-top: 6px solid #3498db;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
      margin: auto;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
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
        <div class="row">
          <div class="col-md-12 col-xl-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="wid-40 rounded-circle">
                  </div>
                  <div class="flex-grow-1 mx-3">
                    <button type="button" class=" btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#new-post-modal">สร้างโพสต์ใหม่...</button>
                    <!-- <span class="badge bg-light-secondary rounded-pill f-12 w-100">กำลังทำ</span> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- [ sample-page ] start -->
          <div id="post-container">
            <!-- โพสต์จะถูกเพิ่มที่นี่ -->
            <!-- loader จะอยู่ด้านล่างนี้ -->
            <div id="loader" style="display:none;">
              <div class="loader-spinner"></div>
            </div>
          </div>

          <!-- //! modal -->


          <div class="modal fade" id="user-modal" data-bs-keyboard="false" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="d-flex w-100 align-items-center">
                    <div class="flex-shrink-0">
                      <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="wid-50 rounded-circle">
                    </div>
                    <div class="flex-grow-1 mx-3">
                      <h6 class="mb-1">Marc Hubbard</h6>
                      <p class="text-muted text-sm mb-0">Airline Pilot</p>
                    </div>
                    <div class="dropdown">
                      <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-dots-vertical f-18"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Share</a>
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="card">
                        <div class="card-header">
                          <h5>About me</h5>
                        </div>
                        <div class="card-body">
                          <p class="mb-0">Hello, I’m Aaron Poole Manufacturing Director based in international company, Void
                            jiidki me na fep juih ced gihhiwi launke cu mig tujum peodpo.</p>
                        </div>
                      </div>
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
                          <h5>Skills</h5>
                        </div>
                        <div class="card-body">
                          <span class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">Web
                            App</span>
                          <span
                            class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">Figma</span>
                          <span
                            class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">Javascript</span>
                          <span
                            class="badge bg-light-secondary border border-secondary bg-transparent f-14 me-1 mt-1">ES6</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                        <div class="card-body">
                          <p class="mb-1 text-muted">Father Name</p>
                          <h6 class="mb-4">Mr. Iva Mancini</h6>
                          <p class="mb-1 text-muted">Father Name</p>
                          <h6 class="mb-4">tawguffim@gmail.com</h6>
                          <p class="mb-1 text-muted">Father Name</p>
                          <h6 class="mb-4">+1 (668) 503-4328</h6>
                          <p class="mb-1 text-muted">Father Name</p>
                          <h6 class="mb-4">British Indian Ocean Territory</h6>
                          <p class="mb-1 text-muted">Father Name</p>
                          <a href="#" class="link-primary text-truncate">
                            <span class="f-16 f-w-600 mb-0 text-truncate">https://anshan.dh.url</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-link-danger" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <!-- //! modal -->

          <script>
            let offset = 0;
            const limit = 3;
            let loading = false;
            let noMoreData = false;

            function loadPosts() {
              console.log("load..");
              if (loading || noMoreData) return;
              loading = true;
              $('#loader').show();

              $.ajax({
                url: 'load_posts.php',
                method: 'POST',
                data: {
                  offset: offset,
                  limit: limit
                },
                success: function(response) {
                  setTimeout(function() {
                    if (response.trim() === '') {
                      noMoreData = true;
                      $('#loader').html('No more data.');
                    } else {
                      $('#loader').before(response);
                      offset += limit;
                      $('#loader').hide();
                      loading = false;

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
                  }, 1500);
                }

              });
            }



            $(document).ready(function() {
              loadPosts();

              $(window).on('scroll', function() {
                console.log('Scrolling...');
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                  loadPosts();
                }
              });
            });
          </script>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
        <!-- </div> -->
      </div>
      <!-- //!-------------------------------------------------------------------------- -->

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
          <form id="mentionForm" method="get" action="action_add_post.php">
            <div class="row" style="padding: 0px 50px">
              <div class="form-group row">
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
                    <div id="editor-wrapper">
                      <div id="editor" name="editor" contenteditable="true" data-placeholder="กรอก เนื้อโพสต์"></div>
                    </div>
                    <input type="hidden" name="post_content" id="post_content">
                    <input type="hidden" name="post_tag_inpost" id="post_tag_inpost">
                  </div>
                  <div id="suggestions"></div>
                </div>

                <div class="col-md-12">
                  <label for="post_add_file">แนบไฟล์</label>
                  <input type="file" name="post_add_file" id="post_add_file" class="form-control" accept=".pdf,.png,.jpg,.jpe,.jpeg">
                  <div class="invalid-feedback">แนบไฟล์</div>
                </div>
                <p></p>

                <div class="col-md-12">
                  <label for="tag">แท็กตั้งต้น : </label> <span class="badge bg-light-primary border border-primary bg-transparent f-14 me-1 mt-1">ผู้บริหาร</span>
                </div>
                <p></p>

                <div class="col-md-12">
                  <label for="tag_ohter">แท็กเพิ่มเติม</label>
                  <select
                    class="form-control"
                    name="post_choices-multiple"
                    id="post_choices-multiple"
                    multiple
                    onchange="updateHiddenInput()">
                    <option value="1">เกม</option>
                    <option value="2">เบรฟ</option>
                    <option value="3">บอล</option>
                    <option value="4">พี่กร</option>
                  </select>

                  <input type="text" name="post_tag_other" id="post_tag_other" readonly>

                  <script>
                    function updateHiddenInput() {
                      const select = document.getElementById('post_choices-multiple');
                      const selectedValues = Array.from(select.selectedOptions).map(opt => opt.value);
                      document.getElementById('post_tag_other').value = selectedValues.join(',');
                    }
                  </script>

                </div>
              </div>
            </div>
        </div>
        <button type="submit">ส่งข้อมูล</button>
        </form>
        <div class="modal-footer">
          <button class="btn btn-link-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <footer class="pc-footer">
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
  </footer>

  <!-- [Page Specific JS] start -->
  <!-- <script src="../assets/js/plugins/apexcharts.min.js"></script> -->
  <!-- <script src="../assets/js/pages/dashboard-default.js"></script> -->
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>

  <script src="../assets/js/plugins/choices.min.js"></script>

  <script>
    var multipleCancelButton = new Choices('#post_choices-multiple', {
      removeItemButton: true
    });
  </script>



  <script>
    layout_change('light');
  </script>




  <script>
    change_box_container('false');
  </script>



  <script>
    layout_rtl_change('false');
  </script>


  <script>
    preset_change("preset-1");
  </script>


  <script>
    font_change("Public-Sans");
  </script>

  <script>
    const users = [];

    for (let i = 1; i <= 5; i++) {
      users.push({
        id: i,
        username: `นาย${i}`,
      });
    }

    for (let i = 6; i <= 10; i++) {
      users.push({
        id: i,
        username: `ทนาย${i}`
      });
    }

    users.push({
      id: 101,
      username: `แอดมินดนุพล พื้นสันเทียะ`
    }, {
      id: 102,
      username: `จอมโจร เบรฟ`
    });

    const editor = document.getElementById("editor");
    const suggestions = document.getElementById("suggestions");

    let mentioned = [];
    let mentioned_id = [];

    const form = document.getElementById("mentionForm");
    const hiddenInput = document.getElementById("post_content");

    form.addEventListener("submit", function(e) {
      // ดึงข้อความ HTML หรือ textContent ขึ้นกับที่ต้องการส่ง
      // ถ้าต้องการส่งเป็นข้อความที่มี tag mention แนะนำส่ง innerHTML
      const content = editor.innerHTML;

      hiddenInput.value = content;
      // form จะ submit ไปตามปกติด้วย method="get"
    });


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
        div.textContent = user.username;
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

      const current = getCurrentWord();
      if (!current) return;

      const {
        range,
        node
      } = current;

      const textBeforeCursor = node.textContent.slice(0, range.startOffset);
      const match = /@([^\s@]*)$/.exec(textBeforeCursor);
      if (!match) return;

      const startPos = range.startOffset - match[0].length;
      const endPos = range.startOffset;
      const before = node.textContent.slice(0, startPos);
      const after = node.textContent.slice(endPos);

      const parent = node.parentNode;

      const beforeNode = document.createTextNode(before);
      const afterNode = document.createTextNode(after);

      const spaceBefore = document.createTextNode(" ");
      const spaceAfter = document.createTextNode(" ");

      const mentionSpan = document.createElement("span");
      mentionSpan.textContent = user.username;
      mentionSpan.className = "mention";
      mentionSpan.setAttribute("data-mention", user.username);
      mentionSpan.contentEditable = "false";

      // ลบ text node เดิม แล้วแทรกใหม่ในตำแหน่งเดิม
      parent.replaceChild(afterNode, node);
      parent.insertBefore(spaceAfter, afterNode);
      parent.insertBefore(mentionSpan, spaceAfter);
      parent.insertBefore(spaceBefore, mentionSpan);
      parent.insertBefore(beforeNode, spaceBefore);

      // ย้าย cursor ไปหลังช่องว่างหลัง
      const newRange = document.createRange();
      newRange.setStartAfter(spaceAfter);
      newRange.collapse(true);
      sel.removeAllRanges();
      sel.addRange(newRange);

      if (!mentioned.includes(user.username)) {
        mentioned.push(user.username);
        mentioned_id.push(user.username);
      }

      suggestions.style.display = "none";
      updateMentioned();
    }


    function updateMentioned() {
      const mentionSpans = editor.querySelectorAll("span.mention");
      const currentMentioned = [];

      mentionSpans.forEach(span => {
        const username = span.textContent.trim();
        if (users.some(u => u.username === username)) {
          currentMentioned.push(username);
        } else {
          // ถ้า user ไม่อยู่ใน list แล้ว → ลบ class & attribute
          span.classList.remove("mention");
          span.removeAttribute("data-mention");
        }
      });

      mentioned = currentMentioned;
      console.log("updated mentioned:", mentioned);
      document.getElementById("post_tag_inpost").value = mentioned;
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
          !mentioned.includes(u.username) &&
          u.username.toLowerCase().includes(keyword)
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
  </script>
</body>
<!-- [Body] end -->

</html>