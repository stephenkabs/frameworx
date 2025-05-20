
<style>
    /* Container background */
    .section-with-bg {
        background-image: url('/path-to-your-image.jpg'); /* Replace with your image path */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 50px 0;
    }

    /* App-like button styles */
    .app-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); /* Auto-sizing columns for responsiveness */
        gap: 20px; /* Spacing between buttons */
        justify-items: center;
        padding: 20px; /* Optional padding around buttons */
    }

    .button-app {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px; /* App icon width */
        height: 100px; /* App icon height */
        color: white;
        text-align: center;
        font-size: 14px;
        border-radius: 20px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* App icon shadow */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none; /* Remove underline */
        overflow: hidden;
        white-space: pre-wrap; /* Allow line breaks inside button text */
        position: relative; /* For animation effect */
    }

    /* Hover effect for buttons */
    .button-app:hover {
        transform: scale(1.05); /* Slightly enlarge the button on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); /* Enhanced shadow on hover */
    }

    @keyframes pop-in {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
            opacity: 0.8;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Individual colors for each button */
    .aeChurch-btn {
        background: linear-gradient(135deg, #690606 0%, #a20606 50%, #e71717 100%);
    }

    .atestimonial-btn {
        background: linear-gradient(135deg, #572606 0%, #7c3a1d 50%, #572811 100%);
    }

    .agive-btn {
        background: linear-gradient(135deg, #36e7f4 0%, #075f7a 50%, #022235 100%);
    }

    .aministries-btn {
        background: linear-gradient(135deg, #2196F3 0%, #6EC6FF 100%);
    }

    .atv-btn {
        background: linear-gradient(135deg, #6a0707 0%, #f11212 100%);
    }

    .acontacts-btn {
        background: linear-gradient(135deg, #FFEB3B 0%, #887b07 100%);
        color: #000; /* Black text for readability */
    }

    .aapp-btn {
        background: linear-gradient(135deg, #3F51B5 0%, #162158 100%);
    }

    .acontactus-btn {
        background: linear-gradient(135deg, #08b410 0%, #114a03 100%);
    }

    .areminder-btn {
        background: linear-gradient(135deg, #2a5605 0%, #84ab06 100%);
    }

    .anotepad-btn {
        background: linear-gradient(135deg, #560529 0%, #d81874 100%);
    }
    .aministry-btn {
        background: linear-gradient(135deg, #760505 0%, #eb0606 100%);
    }

    .aprograms-btn {
        background: linear-gradient(135deg, #0664a3 0%, #3a96ff 100%);
    }

    .thispc-btn {
        background: linear-gradient(135deg, #04345e 0%, #3a96ff 100%);
    }
    /* Animation effect for buttons */
    .aanimated-btn {
        animation: pop-in 0.5s ease forwards; /* Animate on load */
    }

    /* Adjust animation delay for staggered effect */
    .aeChurch-btn { animation-delay: s; }
    .atestimonial-btn { animation-delay: 0.1s; }
    .agive-btn { animation-delay: 0.2s; }
    .aministries-btn { animation-delay: 0.3s; }
    .atv-btn { animation-delay: 0.4s; }
    .acontacts-btn { animation-delay: 0.5s; }
    .aapp-btn { animation-delay: 0.6s; }
    .acontactus-btn { animation-delay: 0.7s; }
    .areminder-btn { animation-delay: 0.9s; }
    .anotepad-btn { animation-delay: 0.9s; }
    .aministry-btn { animation-delay: 0s; }
    .aprograms-btn { animation-delay: 0.1s; }
    .agive-btn { animation-delay: 0.2s; }

</style>
