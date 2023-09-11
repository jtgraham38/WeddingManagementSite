<dialog id="add_event_modal" style="padding: 2rem; border-radius: 0.2rem;">
    <?php $wedding_event = query("SELECT * from calendar_items WHERE name = 'Wedding Reception';")[0]; ?>
    <form method="POST" action="/handle_add_event">
        <h3 class="title"><?= $wedding_event ? 'Add Event' : 'Add Your Reception' ?></h3>
        <hr>

        <?php if ($wedding_event){ ?>
            <div class="field">
                <label class="label">Event Name</label>
                <div class="control">
                    <input maxlength="50" name="name" class="input" type="text" placeholder="Event Name" required>
                </div>
            </div>
        <?php } else {?>
            <input type="hidden" name="name" value="Wedding Reception">
        <?php } ?>
        <?php unset($wedding_event); ?>

        <div class="field">
            <label class="label"><?= $wedding_event ? 'Description' : 'Wedding Description' ?></label>
            <div class="control">
                <input maxlength="2500" name="desc" class="input" type="text" placeholder="Description" required>
            </div>
        </div>

        <div class="field">
            <label class="label"><?= $wedding_event ? 'Location' : 'Wedding Location' ?></label>
            <div class="control">
                <input maxlength="100" name="location" class="input" type="text" placeholder="Location" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Start Date</label>
            <div class="control">
                <input name="start_date" class="input" type="datetime-local" required>
            </div>
        </div>

        <div class="field">
            <label class="label">End Date</label>
            <div class="control">
                <input name="end_date" class="input" type="datetime-local" required>
            </div>
        </div>

        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Add Event</button>
            </div>
            <div class="control">
                <button class="button is-light" type="button" onclick="add_event_modal.close();">Cancel</button>
            </div>
        </div>
    </form>
</dialog>