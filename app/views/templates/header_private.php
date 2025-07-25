<?php
// templates/header_private.php

// Ensure session is started if it's not already, though it should be by index.php now
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITENAME ?></title> <!-- Use SITENAME constant -->
    <!-- You might have your CSS links here -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Add Tailwind CSS if you are using it, otherwise remove this line -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the header */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f4f7f6;
        }
        .header-container {
            background-color: #ffffff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }
        .header-left a {
            font-weight: bold;
            font-size: 1.5rem;
            color: #333;
            text-decoration: none;
            padding: 0.5rem 0;
            display: block;
        }
        .header-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap; /* Allow navigation items to wrap */
            justify-content: center; /* Center items on wrap */
        }
        .header-nav ul li a {
            color: #555;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0;
            transition: color 0.3s ease;
        }
        .header-nav ul li a:hover {
            color: #007bff; /* Example hover color */
        }
        .header-right {
            margin-left: auto; /* Push logout to the right */
        }
        .header-right a {
            background-color: #dc3545; /* Red for logout */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .header-right a:hover {
            background-color: #c82333;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }
            .header-nav ul {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
                width: 100%;
                margin-top: 1rem;
            }
            .header-right {
                margin-top: 1rem;
                margin-left: 0;
                width: 100%;
                text-align: center;
            }
            .header-right a {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="header-left">
            <a href="/home"><?= SITENAME ?></a>
        </div>
        <nav class="header-nav">
            <ul>
                <li><a href="<?= URLROOT ?>/home">Home</a></li>
                <li><a href="<?= URLROOT ?>/movie">Search Movies</a></li> <!-- New link for movie search -->
                <li><a href="<?= URLROOT ?>/reminders">Reminders</a></li>
                <li><a href="<?= URLROOT ?>/about">About Us</a></li>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li><a href="<?= URLROOT ?>/reports">Admin Reports</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="header-right">
            <a href="<?= URLROOT ?>/logout">Logout</a>
        </div>
    </div>

    <!-- Toast Message Display -->
    <?php if (isset($_SESSION['toast_message'])): ?>
        <div id="toast-message" class="toast toast-<?php echo htmlspecialchars($_SESSION['toast_type']); ?>">
            <?php echo htmlspecialchars($_SESSION['toast_message']); ?>
        </div>
        <?php
        // Clear the toast message after displaying
        unset($_SESSION['toast_message']);
        unset($_SESSION['toast_type']);
        ?>
        <style>
            .toast {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: bold;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.5s ease-in-out;
            }
            .toast.show {
                opacity: 1;
            }
            .toast-success { background-color: #28a745; }
            .toast-danger { background-color: #dc3545; }
            .toast-info { background-color: #17a2b8; }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('toast-message');
                if (toast) {
                    toast.classList.add('show');
                    setTimeout(() => {
                        toast.classList.remove('show');
                        toast.addEventListener('transitionend', () => toast.remove());
                    }, 3000); // Hide after 3 seconds
                }
            });
        </script>
    <?php endif; ?>

    <!-- The rest of your page content will follow after this header -->
