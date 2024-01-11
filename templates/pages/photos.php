<div class="clearfix">
    <?php
    //get photos
    $photos = array_filter( scandir('./uploads/images') , function($path){
        return $path !== '.' && $path !== '..';
    } );
    
    //display images
    if ($photos){
        $i = 0;
        foreach ($photos as $photo_name){
            $photo_path = '/uploads/images/' . $photo_name;
            ?>
                <?php $i++ ?>
                <figure class="photo_container" style="width: 49%; height: auto; object-fit: cover; float: <?= $i%2==0 ? 'left' : 'right' ?>; margin: 0.5%;">
                    <img src="<?= htmlspecialchars($photo_path) ?>" alt="Wedding Picture">
                </figure>
            <?php
        }
    }

    ?>
    <div style="clear: both;"></div>
</div>

<div class="hidden is-flex-direction-row is-justify-content-center is-align-items-center" id="photo_popup" style="border: 0px; padding: 0;">
    <img src="" alt="large, correct wedding photo">
</div>

<div class="hidden" id="photo_popup_backdrop"></div>

<script>
    //handle changing the image in the modal

    //get elements
    const photo_popup = document.querySelector('#photo_popup')
    const photo_containers = Array.from(document.querySelectorAll('.photo_container'))
    const popup_img = photo_popup.querySelector('img')
    const popup_backdrop = document.querySelector('#photo_popup_backdrop')
    
    //reveal photo on click
    photo_containers.map((container)=>{

        container.addEventListener('click', (event)=>{
            //get image
            const image = container.querySelector('img');

            //update image displayed on the photo modal
            popup_img.src = image.src;

            //open the photo modal
            photo_popup.classList.remove('hidden');
            photo_popup.classList.add('is-flex');

            //reveal backdrop
            popup_backdrop.classList.remove('hidden');

            //tag event as already having opened the modal
            event.img_opened = true;
        })
        
    })

    //hide photo when click off
    document.addEventListener('click', (event)=>{
        if (!photo_popup.contains(event.target) && !event.img_opened){
            //hide photo
            photo_popup.classList.remove('is-flex');
            photo_popup.classList.add('hidden');
            //hide backdrop
            popup_backdrop.classList.add('hidden');
        }
    })
</script>



<style>
    #photo_popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
    }

    #photo_popup img {
        max-width: 100%;
        max-height: 100%;
    }

    #photo_popup_backdrop{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        z-index: 99; /* Ensure the backdrop is above other content */
    }

    .photo_container{
        transition: transform 0.3s, border 0.3s;
    }
    .photo_container:hover{
        transform: scale(1.05);
    }

    .hidden{
        display: none;
    }
</style>