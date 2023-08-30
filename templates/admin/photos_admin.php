<div class="is-flex is-justify-content-space-between">
    <div>
        <h1 class="title">Photos</h1>
        <h4 class="subtitle is-italic has-text-weight-light ">Upload your engagement and other photos!</h4>
    </div>
    

    <form action="/handle_add_photo" method="POST" style="float: right;" enctype="multipart/form-data">
        <div class="file is-link">
            <label class="file-label">
                <input id="photo_upload" class="file-input" type="file" name="photo" accept=".jpg, .jpeg, .png">
                <span class="file-cta">
                
                <span class="file-label">
                    Add Photo
                </span>
                </span>
            </label>
        </div>

        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

        <script>
            //submit form when a photo is selected

            //get elements
            const photo_input = document.querySelector('#photo_upload');

            //submit the form
            photo_input.addEventListener('change', (event) => {
                event.preventDefault();
                photo_input.form.submit();
            })

        </script>

    </form>

    
</div>
<br>

<?php include('./templates/modals/add_registry_item_modal.php'); ?>



<div class='columns is-multiline'>
    <?php
    //get events
    $photos = array_filter( scandir('./uploads/images') , function($path){
        return $path !== '.' && $path !== '..';
    } );
    ?>

    <?php 
        if ($photos){
            foreach ($photos as $photo_path){
    ?>
        <div class="box column is-two-fifths" style="margin: 0 1rem 1rem 0; min-height: 6rem;">
            <div class="image is-4by3">
                <img src="/uploads/images/<?= $photo_path ?>" alt="Wedding Picture" loading="lazy">
            </div>
        </div>
    <?php 
            }
        }
    ?>
</div>