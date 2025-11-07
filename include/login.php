<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bite Tech Systems</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/favicon.png" type="image/png">
</head>
<body>
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
        
        <h1 class="login-title">Bite Tech Systems</h1>
        <p class="login-subtitle">Welcome back! Please login to continue</p>
        
        <!-- Login Card -->
        <div class="login-card">
            <h2 class="login-card-title">Login</h2>
            <p class="login-card-subtitle">Enter your credentials to access your account</p>
            
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
                
                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="checkbox-input"
                        >
                        <label for="remember" class="checkbox-label">Remember me</label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
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
                    Don't have an account? <a href="#" class="signup-link">Sign up now</a>
                </p>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="login-footer">
            © 2025 Bite Tech Systems Ltd. All rights reserved.
        </div>
    </div>
</body>
</html>