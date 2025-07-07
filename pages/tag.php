<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <title>แท็กผู้ใช้ใน contenteditable</title>
    <style>
        #editor {
            width: 100%;
            min-height: 100px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
        }

        .mention {
            color: #007bff;
            font-weight: bold;
        }


        /* .mention:hover {
            background-color: #0056b3;
        } */


        #suggestions {
            position: absolute;
            border: 1px solid #ccc;
            background: white;
            z-index: 1000;
            max-height: 150px;
            overflow-y: auto;
            display: none;
        }

        #suggestions div {
            padding: 5px 10px;
            cursor: pointer;
        }

        #suggestions div:hover {
            background: #eee;
        }
    </style>
</head>

<body>

    <h3>พิมพ์ @ เพื่อแท็ก</h3>
    <form id="mentionForm" method="get" action="your_target_page.php">
        <?php $_GET['content'] = '<span+class%3D"mention"+data-mention%3D"นาย1"+contenteditable%3D"true">นาย1<%2Fspan>%26nbsp%3Bทำงานบัญชีส่งให้<span+class%3D"mention"+data-mention%3D"ทนาย100"+contenteditable%3D"false">ทนาย100<%2Fspan>%26nbsp%3Bโดยที่+<span+class%3D"mention"+data-mention%3D"จอมโจร+เบรฟ"+contenteditable%3D"false">จอมโจร+เบรฟ<%2Fspan>%26nbsp%3Bโดน<span+class%3D"mention"+data-mention%3D"แอดมินดนุพล+พื้นสันเทียะ"+contenteditable%3D"false">แอดมินดนุพล+พื้นสันเทียะ<%2Fspan>%26nbsp%3Bลงโทษอย่างทารุณ';
        $content = urldecode($_GET['content']); ?>
        <div id="editor" contenteditable="true" spellcheck="false"><?= $content  ?></div>
        <input type="hidden" name="content" id="hiddenContent">
        <button type="submit">ส่งข้อมูล</button>
    </form>

    <!-- <input id="editor" contenteditable="true" spellcheck="false"> -->
    <div id="suggestions"></div>

    <script>
        // const users = [{
        //         id: 1,
        //         username: "นาย1"
        //     },
        //     {
        //         id: 2,
        //         username: "นาย2"
        //     },
        //     {
        //         id: 3,
        //         username: "นาย3"
        //     },
        //     {
        //         id: 4,
        //         username: "นาย4"
        //     },
        //     {
        //         id: 5,
        //         username: "ทนาย5"
        //     }
        // ];

        const users = [];

        for (let i = 1; i <= 95; i++) {
            users.push({
                id: i,
                username: `นาย${i}`
            });
        }

        for (let i = 96; i <= 100; i++) {
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

        let mentioned = ["นาย1", "ทนาย100"];

        const form = document.getElementById("mentionForm");
        const hiddenInput = document.getElementById("hiddenContent");

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
            }

            suggestions.style.display = "none";
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

</html>