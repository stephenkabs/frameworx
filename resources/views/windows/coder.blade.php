<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Editor with Line Numbers</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #282c34;
            color: #abb2bf;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .editor-container {
            width: 80%;
            height: 80%;
            display: flex;
            flex-direction: column;
            border: 2px solid #4c566a;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .toolbar {
            background-color: #3b4252;
            padding: 10px;
            text-align: right;
        }

        .toolbar button {
            background: #4c566a;
            border: none;
            color: #d8dee9;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }

        .toolbar button:hover {
            background: #5e81ac;
        }

        .editor {
            display: flex;
            flex-grow: 1;
            background-color: #282c34;
            color: #abb2bf;
            overflow: auto;
            font-family: 'Courier New', Courier, monospace;
        }

        .line-numbers {
            background-color: #3b4252;
            color: #5c6370;
            padding: 15px 10px;
            text-align: right;
            user-select: none;
        }

        .line-numbers span {
            display: block;
        }

        .code-area {
            flex-grow: 1;
            padding: 15px;
            font-size: 1em;
            background-color: #282c34;
            color: #abb2bf;
            overflow: auto;
            outline: none;
            line-height: 1.5em;
            white-space: pre;
        }

        .code-area span.keyword {
            color: #c678dd;
        }

        .code-area span.string {
            color: #98c379;
        }

        .code-area span.tag {
            color: #e06c75;
        }

        .code-area span.attribute {
            color: #61afef;
        }

        .code-area span.comment {
            color: #5c6370;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="editor-container">
        <div class="toolbar">
            <button onclick="navigateToDesktop()">Desktop</button>
            <button onclick="runCode()">Run</button>
            <button onclick="clearEditor()">Clear</button>
        </div>
        <div class="editor">
            <div class="line-numbers" id="lineNumbers"></div>
            <pre id="codeEditor" class="code-area" contenteditable="true" oninput="updateLineNumbers()">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;body&gt;
        &lt;h1&gt;Hello, <span class="string">World</span>!&lt;/h1&gt;
        &lt;p&gt;This is a <span class="keyword">paragraph</span>.&lt;/p&gt;
    &lt;/body&gt;
&lt;/html&gt;
            </pre>
        </div>
    </div>

    <script>
        function navigateToDesktop() {
            window.location.href = "/dashboard"; // Redirect to the Desktop page
        }

        function runCode() {
            const codeEditor = document.getElementById('codeEditor');
            const code = codeEditor.innerText;
            const win = window.open("", "_blank");
            win.document.open();
            win.document.write(code);
            win.document.close();
        }

        function clearEditor() {
            document.getElementById('codeEditor').innerHTML = '';
            updateLineNumbers();
        }

        function updateLineNumbers() {
            const codeEditor = document.getElementById('codeEditor');
            const lineNumbers = document.getElementById('lineNumbers');
            const lines = codeEditor.innerText.split('\n').length;
            lineNumbers.innerHTML = '';
            for (let i = 1; i <= lines; i++) {
                lineNumbers.innerHTML += `<span>${i}</span>`;
            }
        }

        // Initialize line numbers on page load
        document.addEventListener('DOMContentLoaded', updateLineNumbers);
    </script>
</body>
</html>
