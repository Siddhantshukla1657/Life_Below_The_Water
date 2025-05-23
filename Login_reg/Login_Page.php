<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ALL STYLES -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('https://i.imgur.com/hIwBAuk.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: rgba(0,0,0,0.7);
            overflow: hidden;
        }
        .login-container {
            margin-top: 23%;
            margin-left: 800px;
            text-align: center;
            color: rgb(0, 0, 0); 
            text-shadow: 2px 2px 4px rgb(255, 255, 255); 
        }
        .login-container h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .login-container input {
            background-color: transparent;
            border: 2px solid rgba(255,255,255,0.5);
            color: white;
            font-size: 1em;
        }
        .login-container input::placeholder {
            color: #fff;
            font-weight: bold;
        }
         h2 {
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgb(255, 255, 255);
            text-shadow: 2px 2px 4px rgb(0, 0, 0);
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease;
            background-color: rgba(255,255,255,0.8);
        }
        input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76,175,80,0.6);
            transform: scale(1.02);
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        .bubble {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            background-image: url("https://wp.technologyreview.com/wp-content/uploads/2019/08/ball-black-bubble-35016-10.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            animation: bubbleAnim 2s ease-out forwards;
            mix-blend-mode: screen;
        }
        @keyframes bubbleAnim {
            0% {
                transform: translate(-50%, -50%) scale(0.6);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(2);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm" method="POST" action="auth.php">
            <input type="text" id="loginid" name="loginid" placeholder="Login ID" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <button type="button" onclick="window.location.href='register_page.php'">Register</button>
    </div>
    
    <script>
    document.addEventListener('mousemove', function(e) {
            const bubble = document.createElement('div');
            bubble.className = 'bubble';
            const size = Math.random() * 40 + 30;
            bubble.style.width = size + 'px';
            bubble.style.height = size + 'px';
            bubble.style.left = e.clientX + 'px';
            bubble.style.top = e.clientY + 'px';
            document.body.appendChild(bubble);
            setTimeout(() => { bubble.remove(); }, 1000);
        });
    </script>
</body>
</html>
