
<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Check if user is logged in
$loggedIn = isset($_SESSION['user_id']) ? true : false;
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'news';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LURK Forum</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <h1>LURK</h1>
            </div>
            <nav>
                <?php if($loggedIn): ?>
                    <div class="user-menu">
                        <span class="username"><?php echo getUserData($_SESSION['user_id'])['username']; ?></span>
                        <a href="profile.php" class="btn btn-transparent"><i class="fas fa-user"></i> Profile</a>
                        <a href="logout.php" class="btn btn-transparent"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                <?php else: ?>
                    <div class="auth-buttons">
                        <a href="login.php" class="btn btn-primary">Login</a>
                        <a href="register.php" class="btn btn-secondary">Register</a>
                    </div>
                <?php endif; ?>
            </nav>
        </header>
        
        <div class="tabs">
            <a href="index.php?tab=news" class="tab <?php echo ($activeTab == 'news') ? 'active' : ''; ?>">
                <i class="fas fa-newspaper"></i> News
            </a>
            <a href="index.php?tab=members" class="tab <?php echo ($activeTab == 'members') ? 'active' : ''; ?>">
                <i class="fas fa-users"></i> Members
            </a>
            <?php if($loggedIn): ?>
            <a href="index.php?tab=settings" class="tab <?php echo ($activeTab == 'settings') ? 'active' : ''; ?>">
                <i class="fas fa-cog"></i> Settings
            </a>
            <?php endif; ?>
        </div>
        
        <main class="content">
            <div class="glass-panel">
                <?php
                switch($activeTab) {
                    case 'news':
                        include 'includes/news.php';
                        break;
                    case 'members':
                        include 'includes/members.php';
                        break;
                    case 'settings':
                        if($loggedIn) {
                            include 'includes/settings.php';
                        } else {
                            echo '<div class="message error">You must be logged in to access settings.</div>';
                        }
                        break;
                    default:
                        include 'includes/news.php';
                }
                ?>
            </div>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> LURK Forum. All rights reserved.</p>
        </footer>
    </div>
    
    <script src="js/scripts.js"></script>
</body>
</html>
