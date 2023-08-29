<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= get_setting('groom_fname') ?> and <?= get_setting('bride_fname') ?>'s Wedding </title>

    <link rel="stylesheet" type="text/css" href="/static/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">

</head>
<body class="container">
    <header>
        <img src="/static/images/roses_top.png" alt="bundle of white roses">
        
        <div class="wedding_intro has-text-centered">
            <div class="script couple_names" style="font-size: 5rem;">
                <span class="bride_name"><?= get_setting('bride_fname'); ?></span> & <span class="groom_name"><?= get_setting('groom_fname'); ?></span> 
            </div>
            <div class="countdown is-size-4">(Countdown here!)</div>
            <div class="tagline is-size-5"><?= get_setting('tagline'); ?></div>
        </div>

        <hr>

        <nav class="navbar" id="main_nav" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar_data">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbar_data" class="navbar-menu">

                <div class="navbar-start"></div>

                <a class="navbar-item is-size-3" href="/home">Details</a>
                <a class="navbar-item is-size-3" href="/calendar">Calendar</a>
                <a class="navbar-item is-size-3" href="/calendar">RSVP</a>
                <a class="navbar-item is-size-3" href="/photos">Photos</a>
                <a class="navbar-item is-size-3" href="/registry">Registry</a>

                <div class="navbar-end"></div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {

                // get all "navbar-burger" elements
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                // Add a click event on each of them
                $navbarBurgers.forEach( el => {
                    el.addEventListener('click', () => {

                    // get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                    });
                });

                });
            </script>

            </nav>
    </header>

    <section style="position: relative;">
        <div class="body_container">

            <img class="main_corner_decoration tl"src="/static/images/gold_corner_decoration.png" alt="gold corner decoration">
            <img class="main_corner_decoration tr"src="/static/images/gold_corner_decoration.png" alt="gold corner decoration">
            
            <article>
                <?= $content ?>
            </article>

            <img class="main_corner_decoration bl"src="/static/images/gold_corner_decoration.png" alt="gold corner decoration">
            <img class="main_corner_decoration br"src="/static/images/gold_corner_decoration.png" alt="gold corner decoration">

        </div>
    </section>

    <footer>
        <img src="/static/images/roses_bottom.png" alt="bundle of white roses">
    </footer>
    <div id="login_logout" style="position: fixed; right: 10px; top: 10px; padding: 0;">
        <?php if (logged_in()){ ?>
            <a class="button box" href="/dashboard" style="margin-right: 1px">Dashboard</a>
            <a class="button box" href="/handle_logout">Logout</a>
        <?php } else{ ?>
            <button class="button box" onclick="login_modal.showModal();">Login</button>
        <?php } ?>
    </div>

    

    <?php include('./templates/modals/login_modal.php'); //modal has id "login_modal" ?>
</body>
</html>