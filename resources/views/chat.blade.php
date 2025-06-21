@extends('layouts.website.app')
<style>
    .chatbox {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 12px;
        background-color: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .chatbox textarea {
        width: 100%;
        height: 100px;
        resize: none;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .chatbox button {
        background-color: #8d1e1e;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .chatbox button:hover {
        background-color: #a42d2d;
    }

    #response {
        background: #f4f4f4;
        padding: 15px;
        font-weight: bold;
        border-radius: 8px;
        min-height: 50px;
        color: #8d1e1e;
        white-space: pre-wrap;
        margin-top: 20px;
        line-height: 1.7;
        font-size: 25px;
    }

    .quick-keywords {
        margin-top: 15px;
    }

    .quick-keywords button {
        background-color: #8d1e1e;
        color: #fff;
        padding: 6px 10px;
        border: none;
        border-radius: 5px;
        margin: 0 5px 5px 0;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .quick-keywords button:hover {
        background-color: #a82c2c;
    }
</style>
@section('content')
    <div class="chatbox">
        <textarea id="question" placeholder="Ask your question..."></textarea>
        <button onclick="askBot()"><i class="fa-solid fa-paper-plane"></i></button>

        <!-- ✅ كلمات مفتاحية -->
        <div id="quick-questions" class="quick-keywords" style="display: none;">
            <p style="font-size: 20px; margin-bottom:10px">Common Questions:</p>
            <button onclick="sendKeyword('How can I request blood?')">How can I request blood?</button>
            <button onclick="sendKeyword('Where is the nearest blood bank?')">Where is the nearest blood bank?</button>
            <button onclick="sendKeyword('How often can I donate blood?')">How often can I donate blood?</button>
            <button onclick="sendKeyword('How do I know my donation was accepted?')">How do I know my donation was
                accepted?</button>
            <button onclick="sendKeyword('Is blood donation safe?')">Is blood donation safe?</button>
        </div>

        <div id="response" style="margin-top: 10px; background: #f4f4f4; padding: 10px;"></div>
    </div>

    <script>
        function askBot(keyword = null) {
            const message = keyword || document.getElementById("question").value;

            fetch("{{ route('chatbot.handle') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message
                    })
                })
                .then(res => res.json())
                .then(data => {
                    const respEl = document.getElementById("response");
                    respEl.innerHTML = data;

                    const quickQs = document.getElementById("quick-questions");
                    // إذا كانت الرسالة تبدأ بـ "عفواً"، نظهر div الأسئلة الشائعة
                    if (data.startsWith("عفواً")) {
                        quickQs.style.display = "block";
                    } else {
                        quickQs.style.display = "none";
                    }
                })
                .catch(err => {
                    document.getElementById("response").innerText = "Something went wrong!";
                    // في حالة الخطأ، نُبقي الأسئلة الشائعة ظاهرة
                    document.getElementById("quick-questions").style.display = "block";
                });
        }

        // عند الضغط على كلمة مفتاحية
        function sendKeyword(keyword) {
            document.getElementById("question").value = keyword;
            askBot(keyword);
        }
    </script>
@endsection
