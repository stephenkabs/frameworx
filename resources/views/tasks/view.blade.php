<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <button onclick="startApp()">Start</button>
    <input type="text" id="task" placeholder="Your task will appear here..." size="50">
    <button onclick="startListening()" id="start-btn">Start Talking</button>
    <button onclick="addTask()">Add Task</button>
    <ul id="task_list"></ul>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function speakWelcome() {
            const message = "Welcome back Stephen, what's your programs today?";
            const speech = new SpeechSynthesisUtterance(message);
            speech.lang = 'en-US';
            window.speechSynthesis.speak(speech);
        }

        function startApp() {
            speakWelcome();
            loadTasks();
        }

        async function addTask() {
            const task = document.getElementById('task').value;
            if (!task.trim()) {
                alert("Please speak or type a task.");
                return;
            }
            const response = await fetch('/tasks/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ task: task })
            });
            const result = await response.json();
            alert(result.message);
            document.getElementById('task').value = '';
            loadTasks();
        }

        async function loadTasks() {
            const res = await fetch('/tasks/get');
            const tasks = await res.json();
            const list = document.getElementById('task_list');
            list.innerHTML = '';
            tasks.forEach(t => {
                const li = document.createElement('li');
                li.textContent = `${t.time} - ${t.task}`;
                list.appendChild(li);
            });
        }

        function startListening() {
            if (!('webkitSpeechRecognition' in window)) {
                alert("Speech Recognition not supported in this browser. Try Chrome.");
                return;
            }

            const recognition = new webkitSpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            recognition.start();
            document.getElementById('start-btn').innerText = "Listening...";

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                document.getElementById('task').value = transcript;
                document.getElementById('start-btn').innerText = "Start Talking";
            };

            recognition.onerror = (event) => {
                alert('Error occurred in recognition: ' + event.error);
                document.getElementById('start-btn').innerText = "Start Talking";
            };

            recognition.onend = () => {
                document.getElementById('start-btn').innerText = "Start Talking";
            };
        }
    </script>
</body>
