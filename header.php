<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EdusparkOnline Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        #header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        #header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #f18930, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 300% 100%;
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        #logo {
            flex-shrink: 0;
        }

        #logo1 {
            height: 60px;
            width: auto;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
        }

        #logo1:hover {
            transform: scale(1.05);
        }

        .nav-bar {
            display: flex;
            list-style: none;
            gap: 5px;
            margin: 0;
            flex: 1;
            justify-content: center;
        }

        .nav {
            position: relative;
        }

        .nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            padding: 10px 20px;
            display: block;
            transition: all 0.3s ease;
            border-radius: 8px;
            letter-spacing: 0.3px;
        }

        .nav a::before {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #f18930;
            transition: width 0.3s ease;
        }

        .nav a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #f18930;
        }

        .nav a:hover::before {
            width: 60%;
        }

        .cart-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            color: #ffffff;
            font-size: 18px;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            margin-left: auto;
        }

        .cart-icon::after {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: #ff6b6b;
            border-radius: 50%;
            border: 2px solid #667eea;
        }

        .cart-icon:hover {
            background: #f18930;
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(241, 137, 48, 0.4);
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
            flex-shrink: 0;
        }

        button {
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        #log-in {
            background: transparent;
            color: #ffffff;
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        #log-in:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ffffff;
            transform: translateY(-2px);
        }

        #sign-up {
            background: linear-gradient(135deg, #f18930 0%, #ff6b6b 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(241, 137, 48, 0.3);
        }

        #sign-up:hover {
            background: linear-gradient(135deg, #ff6b6b 0%, #f18930 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(241, 137, 48, 0.5);
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 8px;
        }

        .mobile-toggle span {
            display: block;
            width: 28px;
            height: 3px;
            background: #ffffff;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            #header {
                padding: 15px 25px;
                gap: 20px;
            }

            .nav-bar {
                gap: 2px;
            }

            .nav a {
                padding: 10px 15px;
                font-size: 14px;
            }
        }

        @media (max-width: 868px) {
            .mobile-toggle {
                display: flex;
            }

            .nav-bar {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                flex-direction: column;
                gap: 0;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .nav-bar.active {
                max-height: 500px;
            }

            .nav a {
                padding: 15px 20px;
                border-radius: 8px;
            }

            .cart-icon {
                order: -1;
            }

            .auth-buttons {
                gap: 8px;
            }

            button {
                padding: 8px 16px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            #header {
                padding: 12px 15px;
                gap: 12px;
            }

            #logo1 {
                height: 45px;
            }

            .cart-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            button {
                padding: 8px 12px;
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <div id="logo">
            <img src="images/logo1.png" alt="EdusparkOnline Logo" id="logo1">
        </div>

        <button class="mobile-toggle" onclick="toggleMenu()" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-bar" id="navBar">
            <li class="nav"><a href="#">Home</a></li>
            <li class="nav"><a href="course-listing.php">Courses</a></li>
            <li class="nav"><a href="#">Events</a></li>
            <li class="nav"><a href="#">About Us</a></li>
            <li class="nav"><a href="#">Contact Us</a></li>
        </ul>

        <a href="#" class="cart-icon" aria-label="Shopping cart">
            <i class="fa fa-shopping-cart"></i>
        </a>

        <div class="auth-buttons">
            <button id="log-in">LOG IN</button>
            <button id="sign-up">SIGN UP</button>
        </div>
    </header>

    <script>
        function toggleMenu() {
            const navBar = document.getElementById('navBar');
            navBar.classList.toggle('active');
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const header = document.getElementById('header');
            const navBar = document.getElementById('navBar');
            const toggle = document.querySelector('.mobile-toggle');
            
            if (!header.contains(event.target)) {
                navBar.classList.remove('active');
            }
        });
    </script>
</body>
</html>