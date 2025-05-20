<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Git Terminal</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .terminal {
            width: 80%;
            max-width: 800px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .terminal-header {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .terminal-header span {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .close-btn {
            background-color: #ff5f56;
        }

        .minimize-btn {
            background-color: #ffbd2e;
        }

        .maximize-btn {
            background-color: #27c93f;
        }

        .output {
            padding: 10px;
            background-color: #2b2b2b;
            border-radius: 5px;
            min-height: 50px;
            margin-bottom: 15px;
            overflow-x: auto;
            white-space: pre-wrap;
        }

        .output.success {
            color: #00ff00;
        }

        .output.error {
            color: #ff4c4c;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            background-color: #1e1e1e;
            color: #e0e0e0;
            border: 1px solid #333;
            border-radius: 5px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #00aaff;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #00aaff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #007acc;
        }
    </style>
</head>
<body>
    <div class="terminal">
        <div class="terminal-header">
            <span class="close-btn"></span>
            <span class="minimize-btn"></span>
            <span class="maximize-btn"></span>
        </div>

        <!-- Output Section -->
        <div id="output-container">
            @if (session('success'))
                <div class="output success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="output error">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Clear Button -->
        <button id="clear-button" style="background-color: #ff4c4c; display: none;">Clear</button><br>

        <!-- Command Form -->
        <form action="{{ route('run.terminal') }}" method="POST">
            @csrf
            <input
                type="text"
                id="command"
                name="command"
                placeholder="Enter Git command (e.g., git status, git push)"
                required
            >
            <button type="submit">Run</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const outputContainer = document.getElementById('output-container');
            const clearButton = document.getElementById('clear-button');

            // Show the Clear button if there is output
            if (outputContainer.innerHTML.trim() !== '') {
                clearButton.style.display = 'block';
            }

            // Clear the output when the Clear button is clicked
            clearButton.addEventListener('click', () => {
                outputContainer.innerHTML = '';
                clearButton.style.display = 'none';
            });
        });
    </script>
</body>
</html>
