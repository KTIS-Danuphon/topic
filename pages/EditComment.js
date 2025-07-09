//   <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก Edit ⬇️--------------------------------------------->

let users_comment_edit = []; //array เก็บ id ชื่อ ที่จะแท็กในโพสต์

async function Call_tag_in_comment_edit(retryCount = 1) {
  try {
    const response = await fetch(`post_tag.php?tag_in_post=1`);

    if (response.status === 500) {
      if (retryCount > 0) {
        console.warn("Server error 500. Retrying...");
        return Call_tag_in_comment_edit(tag_type, retryCount - 1);
      } else {
        throw new Error("Server error 500. Retry limit reached.");
      }
    }

    const data = await response.json();

    // สมมติว่า API คืนมาในรูปแบบ [{id: 1, inpost_user_name: "นาย1"}, ...]
    users_comment = data;

    console.log("Users loaded edit:", users_comment);
    // return users;
  } catch (error) {
    console.error("Error loading tag data:", error);
  }
}

Call_tag_in_comment_edit();

const editor_comment_edit = document.getElementById("editor_comment_edit");
const suggestions_comment_edit = document.getElementById(
  "suggestions_comment_edit"
);

let mentioned_name_comment_edit = [];
let mentioned_id_comment_edit = [];

// ฟังก์ชันหาคำก่อน cursor ว่ามี @ + คำอยู่หรือไม่
function getCurrentWord_comment_edit() {
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
function showsuggestions_comment_edit(list, rect) {
  if (list.length === 0) {
    suggestions_comment_edit.style.display = "none";
    return;
  }
  suggestions_comment_edit.innerHTML = "";

  list.forEach((user) => {
    const div = document.createElement("div");
    div.textContent = user.inpost_user_name;
    div.addEventListener("mousedown", (e) => {
      e.preventDefault(); // ป้องกัน blur ก่อนแทรก
      try {
        insertMention_comment_edit(user);
      } catch (e) {
        console.error("Mention error:", e);
      }
    });
    suggestions_comment_edit.appendChild(div);
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

  suggestions_comment_edit.style.left = rect.left + "px";
  suggestions_comment_edit.style.top = rect.bottom + "px";
  suggestions_comment_edit.style.width = "200px";
  suggestions_comment_edit.style.display = "block";
}

// แทรก mention (แท็ก) ลงใน editor
function insertMention_comment_edit(user) {
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
  if (!mentioned_id_comment_edit.includes(user.inpost_user_id)) {
    mentioned_id_comment_edit.push(user.inpost_user_id);
  }

  if (!mentioned_name_comment_edit.includes(user.name)) {
    mentioned_name_comment_edit.push(user.name);
  }

  suggestions_comment_edit.style.display = "none";
  updateMentioned_comment_edit();
}

function updateMentioned_comment_edit() {
  const mentionSpans_edit =
    editor_comment_edit.querySelectorAll("span.mention");
  mentioned_id_comment_edit = Array.from(mentionSpans_edit)
    .map((s) => s.getAttribute("data-id"))
    .filter((id) => id !== null);

  mentioned_name_comment_edit = Array.from(mentionSpans_edit)
    .map((s) => s.getAttribute("data-mention"))
    .filter((id) => id !== null);

  console.log("mentioned IDs_comment_edit:", mentioned_id_comment_edit);
  console.log("mentioned names_comment_edit:", mentioned_name_comment_edit);
  document.getElementById("comment_tag_inpost_edit").value =
    mentioned_id_comment_edit;
}

editor_comment_edit.addEventListener("input", () => {
  updateMentioned_comment_edit();
});

// ฟังก์ชันค้นหาและแสดง suggestion ตอนพิมพ์
editor_comment_edit.addEventListener("keyup", (e) => {
  const current = getCurrentWord_comment_edit();
  if (current) {
    const keyword_edit = current.word.toLowerCase();
    const filtered_edit = users_comment.filter(
      (u) =>
        !mentioned_name_comment_edit.includes(u.inpost_user_name) &&
        u.inpost_user_name.toLowerCase().includes(keyword_edit)
    );

    // หาตำแหน่ง cursor เพื่อแสดง suggestions
    const range_edit = window.getSelection().getRangeAt(0).cloneRange();
    let rect_comment_edit;
    if (range_edit.getClientRects().length > 0) {
      rect_comment_edit = range_edit.getClientRects()[0];
    } else {
      // fallback
      rect_comment_edit = editor_comment_edit.getBoundingClientRect();
    }

    showsuggestions_comment_edit(filtered_edit, rect_comment_edit);
  } else {
    suggestions_comment_edit.style.display = "none";
  }
});

// ซ่อน suggestion เมื่อคลิกที่อื่น
document.addEventListener("click", (e) => {
  if (
    !suggestions_comment_edit.contains(e.target) &&
    e.target !== editor_comment_edit
  ) {
    suggestions_comment_edit.style.display = "none";
  }
});

// ตั้ง event listener ให้กับ mention แต่ละตัว
editor_comment_edit.addEventListener("click", function (e) {
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

// ----------------------------------------------------------
