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

Call_tag_in_post();
const editor = document.getElementById("editor");
const suggestions = document.getElementById("suggestions");
console.log("EDITOR");
let mentioned_name = [];
let mentioned_id = [];

// ฟังก์ชันหาคำก่อน cursor ว่ามี @ + คำอยู่หรือไม่
function getCurrentWord() {
  console.log("@@");
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
function showSuggestions(list, rect) {
  if (list.length === 0) {
    suggestions.style.display = "none";
    return;
  }
  suggestions.innerHTML = "";

  list.forEach((user) => {
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
//   suggestions.style.top = rect.bottom - window.scrollY + "px";
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
    .map((s) => s.getAttribute("data-id"))
    .filter((id) => id !== null);

  mentioned_name = Array.from(mentionSpans)
    .map((s) => s.getAttribute("data-mention"))
    .filter((id) => id !== null);

  console.log("mentioned IDs:", mentioned_id);
  console.log("mentioned names:", mentioned_name);
  document.getElementById("post_tag_inpost").value = mentioned_id;
}

editor.addEventListener("input", () => {
  updateMentioned();
});

// ฟังก์ชันค้นหาและแสดง suggestion ตอนพิมพ์
editor.addEventListener("keyup", (e) => {
  console.log("KEY");
  const current = getCurrentWord();
  if (current) {
    const keyword = current.word.toLowerCase();
    const filtered = users.filter(
      (u) =>
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
editor.addEventListener("click", function (e) {
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
