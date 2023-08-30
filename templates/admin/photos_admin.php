<div class="is-flex is-justify-content-space-between">
    <div>
        <h1 class="title">Photos</h1>
        <h4 class="subtitle is-italic has-text-weight-light ">Upload your engagement and other photos!</h4>
    </div>
    

    <form action="" style="float: right;">
        <div class="file is-link">
            <label class="file-label">
                <input class="file-input" type="file" name="resume">
                <span class="file-cta">
                
                <span class="file-label">
                    Add Photo
                </span>
                </span>
            </label>
        </div>
    </form>

    
</div>
<br>

<?php include('./templates/modals/add_registry_item_modal.php'); ?>



<div class='columns is-multiline'>
    <?php
    //get events
    //$photos = {GET URL LISTING};
    ?>

    <?php 
        if ($photos){
            foreach ($photos as $photo){
    ?>
        content here
    <?php 
            }
        }
    ?>
</div>