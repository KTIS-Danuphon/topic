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
      const wrapper = document.getElementById('div-tag-users_edit');

      // ✅ ล้าง HTML เดิมทั้งหมด
      wrapper.innerHTML = '';

      // ✅ สร้าง select ใหม่ (สด 300%)
      const select = document.createElement('select');
      select.id = 'tag-users_edit';
      select.name = 'tag_users_edit[]';
      select.multiple = true;
      select.setAttribute('onchange', 'updateHiddenInput_edit()');

      wrapper.appendChild(select); // ใส่ select เข้าไปใหม่

      // ✅ ใส่ option ใหม่
      select_tag_backup_edit.forEach(user => {
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
      suggestions_edit.style.top = rect.bottom + window.scrollY + "px";
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
  <!-- //! --------------------------- ดึงข้อมูล ผู้ใช้ไปแสดงใน แท็ก Edit ⬆️--------------------------------------------->
  <!-- //! ---------------- เติม , ให้ value แท็ก Edit ⬇️ ----------------------------------------------------->
  <script>
    function updateHiddenInput_edit() {
      const select = document.getElementById('tag-users_edit');
      const selectedValues = Array.from(select.selectedOptions).map(opt => opt.value);
      document.getElementById('post_tag_other_edit').value = selectedValues.join(',');
    }
  </script>
  <!-- //! ---------------- เติม , ให้ value แท็ก Edit ⬆️ ----------------------------------------------------->