

//   <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก Edit ⬇️--------------------------------------------->

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

function reloadTagUserSelect_edit() {
  // ลบ tag-users แล้วสร้างใหม่
  const oldSelect = document.getElementById("tag-users_edit");

  // ลบ Choices DOM เก่าออก
  const wrapper = oldSelect.closest(".choices");
  if (wrapper) wrapper.remove();

  // สร้าง <select> ใหม่ทดแทน
  const newSelect = document.createElement("select");
  newSelect.id = "tag-users_edit";
  newSelect.name = "tag_users_edit[]";
  newSelect.multiple = true;
  newSelect.setAttribute("onchange", "updateHiddenInput_edit()");
  // document.getElementById("div-tag-users_edit").innerHTML = '';
  // document.getElementById("div-tag-users_edit").appendChild(newSelect);
  const wrapperMain = document.getElementById("div-tag-users_edit");

  wrapperMain.innerHTML = "";

  wrapperMain.appendChild(newSelect); // ใส่ select เข้าไปใหม่
  // ใส่ <option> ใหม่
  select_tag_backup_edit.forEach((user) => {
    const option = document.createElement("option");
    option.value = user.inpost_user_id;
    option.textContent = user.inpost_user_name;

    const fd_post_tag = document.getElementById("post_tag_other_edit").value;

    if (fd_post_tag.split(",").includes(String(user.inpost_user_id))) {
      option.selected = true;
    }

    newSelect.appendChild(option);
  });

  // สร้าง Choices ใหม่
  new Choices(newSelect, {
    removeItemButton: true,
    placeholderValue: "แท็กผู้ใช้...",
    searchPlaceholderValue: "พิมพ์ชื่อผู้ใช้...",
    allowHTML: false,
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
      node,
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

  list.forEach((user) => {
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
  mentionSpan.textContent = "@" + user.inpost_user_name;
  mentionSpan.className = "mention";
  mentionSpan.setAttribute("data-mention", user.inpost_user_name);
  mentionSpan.setAttribute("data-id", user.inpost_user_id);
  mentionSpan.contentEditable = "false";

  const spaceNode = document.createTextNode(" ");

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
    .map((s) => s.getAttribute("data-id"))
    .filter((id) => id !== null);

  mentioned_name_edit = Array.from(mentionSpans_edit)
    .map((s) => s.getAttribute("data-mention"))
    .filter((id) => id !== null);

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
    const filtered_edit = users.filter(
      (u) =>
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
editor_edit.addEventListener("click", function (e) {
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

//   <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก Edit ⬆️--------------------------------------------->
//   <!-- //! ---------------- เติม , ให้ value แท็ก Edit ⬇️ ----------------------------------------------------->

function updateHiddenInput_edit() {
  const select = document.getElementById("tag-users_edit");
  const selectedValues = Array.from(select.selectedOptions).map(
    (opt) => opt.value
  );
  document.getElementById("post_tag_other_edit").value =
    selectedValues.join(",");
}

//   <!-- //! ---------------- เติม , ให้ value แท็ก Edit ⬆️ ----------------------------------------------------->

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

    postContainer.addEventListener(
      "animationend",
      () => {
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
        postContainer.addEventListener(
          "animationend",
          () => {
            postContainer.classList.remove("fade-in-new");
          },
          {
            once: true,
          }
        );
      },
      {
        once: true,
      }
    );
  }, 300); // รอสั้นๆ เพื่อให้เห็น effect "กำลังแก้"
}

async function EditPost(Encrypt_post_id) {
  const formData = new FormData();
  formData.append("post_id", Encrypt_post_id);

  try {
    const response = await fetch("load_post_edit.php", {
      method: "POST",
      body: formData,
    });

    const data = await response.json();

    if (data.success) {
      data1 = data.data; // ✅ ดึงเฉพาะข้อมูลโพสต์
      console.log("รายละเอียดโพสต์:", data1);
      document.getElementById("header_post_edit").value = data1.fd_post_title;
      let content = data1.fd_post_content;

      // สร้าง DOM จาก content เดิม
      let div = document.createElement("div");
      div.innerHTML = content;

      // ค้นหา <a> ที่มี <span class="mention"> อยู่ด้านใน
      div.querySelectorAll("a").forEach((a) => {
        const span = a.querySelector("span.mention");
        if (span) {
          const newSpan = span.cloneNode(true); // คัดลอก <span>
          const space = document.createTextNode("\u00A0"); // ช่องว่างแบบไม่ตัดบรรทัด (&nbsp;)

          // แทนที่ <a> ด้วย <span> ตามด้วยช่องว่าง
          a.replaceWith(newSpan, space);
        }
      });

      // แปลง DOM กลับเป็น HTML string
      data1.fd_post_content = div.innerHTML;

      document.getElementById("post_user_id_edit").value = data1.fd_post_id;
      document.getElementById("editor_edit").innerHTML = data1.fd_post_content;
      document.getElementById("post_content_edit").value =
        data1.fd_post_content;

      document.getElementById("post_tag_inpost_edit").value =
        data1.fd_post_tag_inpost;

      //สถานะ
      const statusValue = data1.fd_post_status;
      const radios = document.getElementsByName("post_status_edit");
      radios.forEach((radio) => {
        if (radio.value === statusValue) {
          radio.checked = true;
        }
      });

      //🏷️ แท็กผู้ที่มีสิทธิ์เห็นโพสต์ 🔻
      document.getElementById("post_tag_other_edit").value = data1.fd_post_tag;
      reloadTagUserSelect_edit(); //รีโหลด choices เลือกแท็ก
      // 👉 ทำอะไรกับ data.data ก็ได้
    } else {
      console.warn("ไม่พบโพสต์:", data.message);
    }
  } catch (error) {
    console.error("เกิดข้อผิดพลาด:", error);
  }
}
document
  .getElementById("mentionForm_edit")
  .addEventListener("submit", async function (e) {
    e.preventDefault(); // ❌ ป้องกัน reload หน้า
    const editor = document.getElementById("editor_edit");
    const error = document.getElementById("editor-error_edit");

    // trim เพื่อตัดช่องว่างที่ไม่มีความหมาย
    const text = editor.innerText.trim();

    if (text === "") {
      e.preventDefault(); // ป้องกันการส่งฟอร์ม
      error.style.display = "block";
      editor.classList.add("border-danger");
      editor.focus();
    } else {
      error.style.display = "none";
      editor.classList.remove("border-danger");
      const form = document.getElementById("mentionForm_edit");
      const hiddenInput = document.getElementById("post_content_edit");
      const content = editor.innerHTML;

      hiddenInput.value = content;
      const formData = new FormData(form); // ✅ รวมข้อมูลทั้งหมดรวมไฟล์แนบ
      console.log("farm Data:", formData.get("post_user_id_edit"));

      try {
        const response = await fetch("action_edit_post.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json()) // ❗ ถ้า response ไม่ใช่ JSON → Error ทันที
          .then((data) => {
            console.log(data);
            if (data.success) {
              // ปิด modal
              const modal = bootstrap.Modal.getInstance(
                document.querySelector(".modal.show")
              );
              if (modal) modal.hide();

              updatePostAndStatus(
                formData.get("post_user_id_edit"),
                data.newstatus,
                data.newcontent
              );
              // // ถ้ามีฟังก์ชันอัปเดตอื่น
              // if (cancelmodal_post("1")) { //สั่งปิด modal post ต้องreturn true
              //   loadNewPosts(); //โหลดโพสต์ใหม่
              // }
            }
          })
          .catch((error) => {
            console.error("เกิดข้อผิดพลาด6:", error);
            // ปิด modal
            const modal = bootstrap.Modal.getInstance(
              document.querySelector(".modal.show")
            );
            if (modal) modal.hide();
          });
      } catch (error) {
        console.error("เกิดข้อผิดพลาด2:", error);
      }
    }
  });
async function Load_newupdate_post(post_id, retryCount = 1) {
  const maxRetries = 3;
  const url = "load_post_newupdate.php";

  // สร้างข้อมูล POST
  const formData = new FormData();
  formData.append("post_id", post_id);

  try {
    const response = await fetch(url, {
      method: "POST",
      body: formData,
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

// ----------------------------------------------------------

