<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/static/images/white_rose_icon.png" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="/static/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/admin_style.css">

    <title>Wedding Admin</title>
</head>
<body>
    <aside class="menu" id="admin_menu>" style="background-color: #ccb98a; height: 100vh; position: fixed; left: 0; top: 0; min-width: 10rem; padding: 0.2rem;">
        <p class="menu-label">
            Hi, <?= htmlspecialchars($_SESSION['fname'] . " " . $_SESSION['lname']) ?>
        </p>
        <ul class="menu-list">
            
            <li>
                <a href="/dashboard/details" class="<?= htmlspecialchars($_SERVER['REQUEST_URI']) == '/dashboard/details' ? 'is-active' : ''?>">Details</a>
            </li>
            <li>
                <a href="/dashboard/guest-list" class="<?= htmlspecialchars($_SERVER['REQUEST_URI']) == '/dashboard/guest-list' ? 'is-active' : ''?>">Guest List</a>
            </li>
            <li>
                <a href="/dashboard/calendar" class="<?= htmlspecialchars($_SERVER['REQUEST_URI']) == '/dashboard/calendar' ? 'is-active' : ''?>">Calendar</a>
            </li>
            <li>
                <a href="/dashboard/photos" class="<?= htmlspecialchars($_SERVER['REQUEST_URI']) == '/dashboard/photos' ? 'is-active' : ''?>">Photos</a>
            </li>
            <li>
                <a href="/dashboard/registry" class="<?= htmlspecialchars($_SERVER['REQUEST_URI']) == '/dashboard/registry' ? 'is-active' : ''?>">Registry</a>
            </li>
        </ul>

        <p class="menu-label">
            Site
        </p>
        <ul class="menu-list">
            <li>
                <a href="/">Go to site</a>
            </li>
            <li>
                <a href="/handle_logout">Log Out</a>
            </li>
        </ul>
        
    </aside>

    <div style="margin-left: 11rem;">
        <section class="container" id="admin_body" style="padding: 1rem 0;">
            <?= $content ?>
        </section>
    </div>
    
</body>
</html>