<div class="is-flex is-justify-content-space-between">
    <div>
        <h1 class="title">Wedding Calendar</h1>
        <h4 class="subtitle is-italic has-text-weight-light ">Add events for your big day!</h4>
    </div>
    

    <button class="button is-link add_event_btn" style="float: right;" onclick="add_event_modal.showModal();">Add Event</button>
</div>
<br>

<?php include('./templates/modals/add_calendar_event_modal.php'); ?>



<div class='columns is-multiline'>
    <?php
    //get events
    $events = query("SELECT * from calendar_items ORDER BY start_datetime ASC;");
    ?>

    <?php 
        if ($events){
            foreach ($events as $event){
    ?>
        <div class="box column is-two-fifths" style="margin: 0 1rem 1rem 0; min-height: 6rem;">
            <div class="columns">
                <h4 class="column is-size-4"><?= $event['name'] ?></h4>

                <?php include('./templates/modals/edit_calendar_event_modal.php'); ?>

                <div class="column is-flex is-justify-content-end">
                    <button class="button edit_event_btn" style="margin-right: 1px;" onclick="edit_event_<?= $event['id'] ?>_modal.showModal()">Edit</button>
                    
                    <?php if ($event['name'] != "Wedding Reception") {?>
                        <form action="/handle_delete_event" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">
                            <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                            <button class="button delete_event_btn" type="submit">Delete</button>
                        </form>
                    <?php } ?>
                    
                </div>
            </div>
            <div class="columns">
                <div class="column is-two-fifths">
                    <p>
                        <?= $event['description'] ?>
                    </p>
                </div>
                <div class="column">
                    <div class="is-flex is-flex-direction-column">
                        <span>
                            From
                            <strong>
                                <?= format_date($event['start_datetime']);?>
                            </strong>
                        </span>

                        <span>
                            to&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>
                                <?= format_date($event['end_datetime']);?>
                            </strong>
                        </span>

                        <span>
                            at&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>
                                <?= $event['location'] ?>
                            </strong>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    <?php 
            }
        }
    ?>
</div>