<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bite Tech Systems</title>
    <link rel="stylesheet" href="css/login-light.css" id="theme-stylesheet">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <style>
        /* Dark Mode Toggle Button */
        .theme-toggle {
            position: fixed;
            top: 24px;
            right: 24px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .theme-toggle:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }
        
        .theme-toggle:active {
            transform: scale(0.95);
        }
        
        .theme-toggle svg {
            width: 24px;
            height: 24px;
            stroke: white;
            transition: all 0.3s ease;
        }
        
        .theme-icon {
            position: absolute;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        
        .theme-icon.hidden {
            opacity: 0;
            transform: rotate(180deg);
        }
        
        /* Dark mode specific button styling */
        body.dark-mode .theme-toggle {
            background: rgba(59, 130, 246, 0.15);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }
        
        body.dark-mode .theme-toggle svg {
            stroke: #60a5fa;
        }
    </style>
</head>
<body>
    <!-- Dark Mode Toggle Button -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
        <!-- Sun Icon (for light mode - shows in dark mode) -->
        <svg class="theme-icon" id="sunIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
        </svg>
        
        <!-- Moon Icon (for dark mode - shows in light mode) -->
        <svg class="theme-icon hidden" id="moonIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
    </button>

    <div class="login-container">
        <!-- Logo and Header -->
        <div class="login-logo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                <circle cx="12" cy="20" r="1"></circle>
            </svg>
        </div>
        
        <h1 class="login-title">Mikhmon Hotspot Management System</h1>
        <p class="login-subtitle">Welcome back! Please login to continue</p>
        
        <!-- Login Card -->
        <div class="login-card">
            <h2 class="login-card-title">Login</h2>

            <?php if(isset($error) && !empty($error)): ?>
            <div class="error-message">
                <?= $error ?>
            </div>
            <?php endif; ?>
            
            <form autocomplete="off" action="" method="post">
                <!-- Username Field -->
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input 
                            type="text" 
                            id="username" 
                            name="user" 
                            class="form-input" 
                            placeholder="Enter your username" 
                            required 
                            autofocus
                        >
                    </div>
                </div>
                
                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input 
                            type="password" 
                            id="password" 
                            name="pass" 
                            class="form-input" 
                            placeholder="Enter your password" 
                            required
                        >
                    </div>
                </div>
                             
                <!-- Login Button -->
                <button type="submit" name="login" class="btn-login">
                    Login
                    <svg class="btn-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
                
                <!-- Sign Up Link -->
                <p class="signup-text">
                    Default Credentials - <strong> Username:</strong> mikhmon <strong>Password:</strong> 1234
                </p>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="login-footer">
            © 2025 Onlus Technologies. Credit to Mikhmon by: Laksamadi Guko.
        </div>
    </div>

    <script>
        // Dark Mode Toggle Script
        const themeToggle = document.getElementById('themeToggle');
        const themeStylesheet = document.getElementById('theme-stylesheet');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        const body = document.body;

        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        
        // Apply saved theme on page load
        if (currentTheme === 'dark') {
            enableDarkMode();
        }

        // Toggle theme on button click
        themeToggle.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                enableLightMode();
            } else {
                enableDarkMode();
            }
        });

        function enableDarkMode() {
            themeStylesheet.setAttribute('href', 'css/login-dark.css');
            body.classList.add('dark-mode');
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
            localStorage.setItem('theme', 'dark');
        }

        function enableLightMode() {
            themeStylesheet.setAttribute('href', 'css/login-light.css');
            body.classList.remove('dark-mode');
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
            localStorage.setItem('theme', 'light');
        }
    </script>
</body>
</html>