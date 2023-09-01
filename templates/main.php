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
        <img class="decoration" src="/static/images/roses_top.png" alt="bundle of white roses">
        
        <div class="wedding_intro has-text-centered">
            <div class="script couple_names" style="font-size: 5rem;">
                <span class="bride_name"><?= get_setting('bride_fname'); ?></span> & <span class="groom_name"><?= get_setting('groom_fname'); ?></span> 
            </div>
            <div id="countdown" class="is-size-4"></div>

            <script>
                //program countdown js

                //update countdown func
                function update_countdown(){
                    const wedding_date = new Date(wedding_date_str).getTime();

                    //get time until wedding
                    var time_until = wedding_date - new Date().getTime()

                    //convert to days, hours, minutes, and seconds 
                    //TODO: account for leap years!
                    var days = Math.floor(time_until / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((time_until % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((time_until % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((time_until % (1000 * 60)) / 1000);

                    //update countdown element
                    if (time_until >= 0){
                        document.querySelector('#countdown').innerHTML = days + ' days, ' + hours + " hours, " + minutes + " minutes, and " + seconds + " seconds until the big day!";
                    }else{
                        clearInterval(countdown)
                        document.querySelector('#countdown').innerHTML = "Congratulations on getting married!"
                    }
                }

                //date we are counting down to 
                <?php 
                $date_record = query("SELECT start_datetime FROM calendar_items WHERE name = 'Wedding Day';")[0]['start_datetime'];
                if ($date_record != null){
                    $wedding_date = new DateTime($date_record);
                }
                else{
                    $wedding_date = null;
                }
                
                ?>
                const wedding_date_str = '<?= $wedding_date ? $wedding_date->format('M d, Y H:i:s') : "" ?>'
                var countdown = null;

                //if the wedding date is set
                if (wedding_date_str != ""){
                    
                    update_countdown();
                    //update every second
                    countdown = setInterval(update_countdown, 1000)
                }
                //otherwise, if it is not set
                else{
                    document.querySelector('#countdown').innerHTML = "The date for the wedding has not been decided yet!"
                }
            </script>
            
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
                <a class="navbar-item is-size-3" href="/rsvp">RSVP</a>
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
            
            <article style="padding: 1rem; min-height: 15rem;">
                <?= $content ?>
            </article>

            <img class="main_corner_decoration bl"src="/static/images/gold_corner_decoration.png" alt="gold corner decoration">
            <img class="main_corner_decoration br"src="/static/images/gold_corner_decoration.png" alt="gold corner decoration">

        </div>
    </section>

    <footer>
        <img class="decoration" src="/static/images/roses_bottom.png" alt="bundle of white roses">
    </footer>
    <div id="login_logout" style="position: fixed; right: 10px; top: 10px; padding: 0;">
        <?php if (logged_in()){ ?>
            <?php if (is_admin()) { ?>
                <a class="button box" href="/dashboard" style="margin-right: 1px">Dashboard</a>
            <?php } ?>
            <a class="button box" href="/handle_logout">Logout</a>
        <?php } else{ ?>
            <button class="button box" onclick="login_modal.showModal();">Login</button>
        <?php } ?>
    </div>

    

    <?php include('./templates/modals/login_modal.php'); //modal has id "login_modal" ?>
</body>
</html>