<div class="is-flex is-justify-content-space-between">
    <div>
        <h1 class="title">Wedding Registry</h1>
        <h4 class="subtitle is-italic has-text-weight-light ">Add items to your wedding registry!</h4>
    </div>
    

    <button class="button is-link add_event_btn" style="float: right;" onclick="add_registry_item_modal.showModal();">Add Item</button>
</div>
<br>

<?php include('./templates/modals/add_registry_item_modal.php'); ?>



<div class='columns is-multiline'>
    <?php
    //get events
    $items = query("SELECT * FROM registry_items;");
    ?>

    <?php 
        if ($items){
            foreach ($items as $item){
    ?>
        <div class="box column is-two-fifths" style="margin: 0 1rem 1rem 0; min-height: 6rem;">
            <div class="columns">
                <h4 class="column is-size-4"><?= $item['name'] ?></h4>

                <?php include('./templates/modals/edit_registry_item_modal.php'); ?>

                <div class="column is-flex is-justify-content-end">
                    <button class="button edit_event_btn" style="margin-right: 1px;" onclick="edit_item_<?= $item['id'] ?>_modal.showModal()">Edit</button>
                    
                    <form action="/handle_delete_registry_item" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                        <button class="button delete_item_btn" type="submit">Delete</button>
                    </form>
                    
                </div>
            </div>
            <div>
                <img style="width: 32rem; height: 24rem; object-fit: cover;" src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>">
                <a style="float: right;" target="_blank" href="<?= $item['affiliate_url'] != "" ? $item['affiliate_url'] : $item['url'] ?>" class="button is-link">View Item</a>
            </div>
        </div>
    <?php 
            }
        }
    ?>
</div>