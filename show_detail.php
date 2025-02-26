<?php 
    $subject = "This is my UDID from iOS device";
    $body  = "Hello\n\nThis is my UDID: {$_GET['UDID']}\n";
    $body .= "Device product: {$_GET['DEVICE_PRODUCT']}\n";
    $body .= "Device version: {$_GET['DEVICE_VERSION']}\n";
    $body .= "Device name: {$_GET['DEVICE_NAME']}\n";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UDID Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#6782f5">
    <style>
        :root {
            --primary-color: #6782f5;
            --secondary-color: #6782f5;
            --dark-color: #32325d;
            --light-color: #f7fafc;
            --accent-color: #11cdef;
            --animation-duration: 0.6s;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            user-select: none;
        }
        
        html {
            background-color: var(--primary-color);
            height: 100%;
            overflow: hidden;
            position: fixed;
            width: 100%;
        }
        
        body {
            background-color: var(--primary-color);
            color: var(--dark-color);
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            position: fixed;
            overflow: hidden;
            text-align: center;
            padding: 20px;
            padding-left: env(safe-area-inset-left);
            padding-right: env(safe-area-inset-right);
            padding-top: env(safe-area-inset-top);
            padding-bottom: env(safe-area-inset-bottom);
        }
        
        body::before {
            content: "";
            position: fixed;
            top: -50px;
            left: 0;
            width: 100%;
            height: calc(100% + 100px);
            background-color: var(--primary-color);
            z-index: -1;
        }
        
        .container {
            margin-top: 50px;
            width: 90%;
            max-width: 400px;
            background-color: white;
            border-radius: 20px;
            padding: 35px 25px;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            transform: translateY(30px);
            opacity: 0;
            animation: fadeIn var(--animation-duration) ease-out forwards;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        h1 {
            color: var(--dark-color);
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
            display: inline-block;
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            height: 3px;
            width: 80px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-color));
            border-radius: 3px;
            animation: lineGrow 0.8s 0.3s ease forwards;
        }
        
        @keyframes lineGrow {
            to {
                transform: translateX(-50%) scaleX(1);
            }
        }
        
        .info-item {
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp var(--animation-duration) ease forwards;
            animation-delay: calc(0.2s + var(--delay, 0s));
            font-size: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .info-item:nth-child(2) { --delay: 0.1s; }
        .info-item:nth-child(3) { --delay: 0.2s; }
        .info-item:nth-child(4) { --delay: 0.3s; }
        .info-item:nth-child(5) { --delay: 0.4s; }
        
        .info-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
            font-size: 14px;
            opacity: 0.7;
        }
        
        .info-value {
            background-color: var(--light-color);
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            word-break: break-all;
        }
        
        .section-title {
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-color);
            opacity: 0;
            animation: fadeIn 0.6s 0.6s ease forwards;
        }
        
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(45deg, #4286f5, #00c6fb);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            opacity: 0;
            animation: fadeIn 0.6s 0.8s ease forwards;
            box-shadow: 0 4px 11px rgba(66, 134, 245, 0.35);
            letter-spacing: 0.5px;
            margin-top: 15px;
            margin-right: 10px;
        }
        
        .button:hover, .button:focus {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(66, 134, 245, 0.4);
        }
        
        .button:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 11px rgba(66, 134, 245, 0.35);
        }
        
        .copy-button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(45deg, #32a852, #4cd066);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            opacity: 0;
            cursor: pointer;
            animation: fadeIn 0.6s 0.8s ease forwards;
            box-shadow: 0 4px 11px rgba(50, 168, 82, 0.35);
            letter-spacing: 0.5px;
            margin-top: 15px;
        }
        
        .copy-button:hover, .copy-button:focus {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(50, 168, 82, 0.4);
        }
        
        .copy-button:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 11px rgba(50, 168, 82, 0.35);
        }
        
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        
        .copy-notification {
            position: fixed;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 24px;
            background-color: rgba(50, 50, 93, 0.9);
            color: white;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        
        .copy-notification.show {
            bottom: 30px;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(66, 134, 245, 0.5);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(66, 134, 245, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(66, 134, 245, 0);
            }
        }
        
        @media (max-width: 768px) {
            .button-container {
                flex-direction: column;
            }
            
            .button, .copy-button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Device Information</h1>
        
        <div class="info-item">
            <div class="info-label">UDID</div>
            <div class="info-value" id="udid-value"><?php echo htmlspecialchars($_GET['UDID']); ?></div>
        </div>
        
        <div class="info-item">
            <div class="info-label">Device Model</div>
            <div class="info-value"><?php echo htmlspecialchars($_GET['DEVICE_PRODUCT']); ?></div>
        </div>
        
        <div class="info-item">
            <div class="info-label">Device Version</div>
            <div class="info-value"><?php echo htmlspecialchars($_GET['DEVICE_VERSION']); ?></div>
        </div>
        
        <div class="info-item">
            <div class="info-label">Device Name</div>
            <div class="info-value"><?php echo htmlspecialchars($_GET['DEVICE_NAME']); ?></div>
        </div>
        
        <div class="section-title">Share Your Device Information</div>
        
        <div class="button-container">
            <button class="copy-button" id="copy-button">Copy UDID</button>
            <a class="button" href="mailto:?subject=<?php echo urlencode($subject); ?>&body=<?php echo urlencode($body); ?>">Send by Email</a>
        </div>
    </div>

    <div class="copy-notification" id="copy-notification">UDID copied to clipboard!</div>

    <script>
        // Prevent scrolling
        document.addEventListener('touchmove', function(e) {
            e.preventDefault();
        }, { passive: false });
        
        // Prevent zooming
        document.addEventListener('gesturestart', function(e) {
            e.preventDefault();
        });
        
        // Create fullscreen background color element
        document.addEventListener('DOMContentLoaded', function() {
            var fullscreenElement = document.createElement('div');
            fullscreenElement.style.position = 'fixed';
            fullscreenElement.style.top = '0';
            fullscreenElement.style.left = '0';
            fullscreenElement.style.width = '100%';
            fullscreenElement.style.height = '100%';
            fullscreenElement.style.backgroundColor = '#6782f5';
            fullscreenElement.style.zIndex = '-2';
            document.body.appendChild(fullscreenElement);
            
            // Copy button functionality
            const copyButton = document.getElementById('copy-button');
            const notification = document.getElementById('copy-notification');
            const udidValue = document.getElementById('udid-value').textContent;
            
            copyButton.addEventListener('click', function() {
                // Copy to clipboard
                navigator.clipboard.writeText(udidValue).then(function() {
                    // Success
                    notification.classList.add('show');
                    setTimeout(function() {
                        notification.classList.remove('show');
                    }, 2000);
                }).catch(function(err) {
                    // Fallback for older browsers
                    const textarea = document.createElement('textarea');
                    textarea.value = udidValue;
                    textarea.style.position = 'fixed';
                    textarea.style.opacity = '0';
                    document.body.appendChild(textarea);
                    textarea.select();
                    try {
                        document.execCommand('copy');
                        notification.classList.add('show');
                        setTimeout(function() {
                            notification.classList.remove('show');
                        }, 2000);
                    } catch (err) {
                        console.error('Failed to copy: ', err);
                        alert('Could not copy UDID. Please select and copy manually.');
                    }
                    document.body.removeChild(textarea);
                });
                
                // Button touch effect
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
            
            // Button touch effects
            document.querySelectorAll('.button, .copy-button').forEach(button => {
                button.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.95)';
                });
                
                button.addEventListener('touchend', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>