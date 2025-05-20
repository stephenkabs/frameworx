<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AI Voice Assistant</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background: #f5f5f5;
    }

    #response {
      margin-top: 20px;
      padding: 1rem;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    #speakBtn {
      padding: 15px 30px;
      font-size: 18px;
      background-color: #007BFF;
      border: none;
      color: white;
      border-radius: 10px;
      cursor: pointer;
    }

    #speakBtn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <h1>Ask Your AI Assistant</h1>
  <button id="speakBtn">🎤 Click & Speak</button>
  <div id="response">Your answer will appear here...</div>

  <script>
    const speakBtn = document.getElementById("speakBtn");
    const responseDiv = document.getElementById("response");

    const synth = window.speechSynthesis;
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    speakBtn.addEventListener("click", () => {
      responseDiv.textContent = "🎙️ Listening...";
      recognition.start();
    });

    recognition.onresult = async (event) => {
      const question = event.results[0][0].transcript;
      responseDiv.innerHTML = `<strong>You asked:</strong> ${question}<br>⏳ Thinking...`;

      try {
        const response = await fetch("/ask", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },
          body: JSON.stringify({ question })
        });

        const data = await response.json();

        if (data.answer) {
          responseDiv.innerHTML = `<strong>Answer:</strong> ${data.answer}`;
          speakText(data.answer);
        } else {
          responseDiv.innerHTML = `⚠️ Error: Could not get an answer.`;
          console.error(data);
        }
      } catch (error) {
        console.error("Fetch error:", error);
        responseDiv.textContent = "⚠️ Problem getting answer.";
      }
    };

    recognition.onerror = (event) => {
      responseDiv.textContent = "❌ Speech recognition error: " + event.error;
    };

    function speakText(text) {
      const utterance = new SpeechSynthesisUtterance(text);
      utterance.lang = "en-US";
      synth.speak(utterance);
    }
  </script>
</body>
</html>
