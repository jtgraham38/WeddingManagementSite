<dialog id="edit_event_<?= $event['event_id'] ?>_modal" style="padding: 2rem; border-radius: 0.2rem;">
    <form method="POST" action="/handle_add_event">
        <h3 class="title">Edit Event</h3>
        <hr>

        <div class="field">
            <label class="label">Event Name</label>
            <div class="control">
                <input name="name" value="<?= $event['name'] ?>" class="input" type="text" placeholder="Event Name" required>
            </div>
        </div>

        <div class="field">
            <label class="label"><?= $wedding_event ? 'Description' : 'Wedding Description' ?></label>
            <div class="control">
                <input name="desc" value="<?= $event['description'] ?>" class="input" type="text" placeholder="Description" required>
            </div>
        </div>

        <div class="field">
            <label class="label"><?= $wedding_event ? 'Location' : 'Wedding Location' ?></label>
            <div class="control">
                <input name="location" value="<?= $event['location'] ?>" class="input" type="text" placeholder="Location" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Start Date</label>
            <div class="control">
                <input name="start_date" value="<?= $event['start_datetime'] ?>" class="input" type="datetime-local" required>
            </div>
        </div>

        <div class="field">
            <label class="label">End Date</label>
            <div class="control">
                <input name="end_date" value="<?= $event['end_datetime'] ?>" class="input" type="datetime-local" required>
            </div>
        </div>

        <input id="event_id_hidden_input" type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Update Event</button>
            </div>
            <div class="control">
                <button class="button is-light" type="button" onclick="edit_event_<?= $event['event_id'] ?>_modal.close();">Cancel</button>
            </div>
        </div>
    </form>
</dialog>

TODO: add support for autofilling the previous values of each input when editing