<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal Interface</title>
    {{-- <link rel="stylesheet" href="style.css"> --}}

    <style>
        /* Terminal container styling */
body {
    background-color: #282c34;
    font-family: "Courier New", Courier, monospace;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh;
}

/* Minimized state */
.terminal.minimized {
    height: 30px;
    overflow: hidden;
}

/* Maximized state */
.terminal.maximized {
    width: 100%;
    height: 100%;
    border-radius: 0;
    margin: 0;
    box-shadow: none;
}

.terminal {
    width: 900px;
        height: 400px;
    background-color: #1e1e1e;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    color: #dcdcdc;
}

/* Terminal header */
.terminal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 10px 15px;
}

.buttons {
    display: flex;
    gap: 8px;
}

.buttons span {
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.red {
    background-color: #ff5f56;
}

.yellow {
    background-color: #ffbd2e;
}

.green {
    background-color: #27c93f;
}

.terminal-title {
    color: #cfcfcf;
    font-size: 14px;
}

/* Terminal body */
.terminal-body {
    padding: 15px;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    overflow-y: auto;
    background-color: #1e1e1e;
}

.output p {
    margin: 0;
    padding: 5px 0;
    white-space: pre-wrap; /* Allows multi-line output */
}

.input-area {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 10px;
}

.prompt {
    color: #0db9d7;
}

input {
    background-color: transparent;
    color: #dcdcdc;
    border: none;
    outline: none;
    font-size: 16px;
        font-family: "Courier New", Courier, monospace;
    width: 100%;
}

    </style>
</head>
<body>
    <div class="terminal">
<div class="terminal-header">
    <div class="buttons">
        <span class="red" data-action="close"></span>
        <span class="yellow" data-action="minimize"></span>
        <span class="green" data-action="maximize"></span>
    </div>
    <span class="terminal-title">Terminal</span>
</div>

        <div class="terminal-body">
            <div class="output">
                <p>Welcome to the AwCloud terminal!</p>
                <p>Type "help" to get started.</p>
            </div>
            <div class="input-area">
                <span class="prompt">></span>
                <input type="text" id="terminal-input" autocomplete="off">
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const terminal = document.querySelector('.terminal');
    const buttons = document.querySelectorAll('.buttons span');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const action = button.getAttribute('data-action');

            if (action === 'close') {
                terminal.style.display = 'none'; // Close the terminal
            } else if (action === 'minimize') {
                terminal.classList.toggle('minimized'); // Toggle minimized state
            } else if (action === 'maximize') {
                terminal.classList.toggle('maximized'); // Toggle maximized state
            }
        });
    });

    const terminalInput = document.getElementById('terminal-input');
    const outputDiv = document.querySelector('.output');

    // Mock file system and command handling (as before)
    const fileSystem = {
        '/': ['home', 'var', 'etc', 'usr', 'bin'],
        '/home': ['user1', 'user2'],
        '/home/user1': ['documents', 'downloads', 'pictures'],
    };
    let currentDirectory = '/';

    terminalInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            const command = terminalInput.value.trim();
            outputDiv.innerHTML += `<p class="command">> ${command}</p>`;

            // Handle commands
            if (command === 'help') {
                outputDiv.innerHTML += `<p>Available commands:</p><ul><li>help</li><li>clear</li><li>pwd</li><li>ls</li><li>cd [path]</li><li>echo [text]</li></ul>`;
            } else if (command === 'clear') {
                outputDiv.innerHTML = '';
            } else if (command === 'pwd') {
                outputDiv.innerHTML += `<p>${currentDirectory}</p>`;
            } else if (command === 'ls') {
                if (fileSystem[currentDirectory]) {
                    outputDiv.innerHTML += `<p>${fileSystem[currentDirectory].join(' ')}</p>`;
                } else {
                    outputDiv.innerHTML += `<p>Error: Cannot list directory contents</p>`;
                }
            } else if (command.startsWith('cd ')) {
                const path = command.slice(3).trim();
                if (path === '/') {
                    currentDirectory = '/';
                } else if (path === '..') {
                    const parts = currentDirectory.split('/').filter(Boolean);
                    parts.pop();
                    currentDirectory = '/' + parts.join('/');
                } else {
                    const newPath = currentDirectory === '/' ? `/${path}` : `${currentDirectory}/${path}`;
                    if (fileSystem[newPath]) {
                        currentDirectory = newPath;
                    } else {
                        outputDiv.innerHTML += `<p>Error: Directory not found</p>`;
                    }
                }
            } else if (command.startsWith('echo ')) {
                const text = command.slice(5).trim();
                outputDiv.innerHTML += `<p>${text}</p>`;
            } else {
                outputDiv.innerHTML += `<p>Command not recognized: ${command}</p>`;
            }

            const terminalBody = document.querySelector('.terminal-body');
            terminalBody.scrollTop = terminalBody.scrollHeight;

            terminalInput.value = '';
        }
    });
});

    </script>
</body>
</html>
