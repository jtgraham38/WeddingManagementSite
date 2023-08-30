<dialog id="add_registry_item_modal" style="padding: 2rem; border-radius: 0.2rem;">
    <form method="POST" action="/handle_add_registry_item">
        <h3 class="title">Add Registry Item</h3>
        <hr>

        <div class="field">
            <label class="label">Item Name</label>
            <div class="control">
                <input name="name" class="input" type="text" placeholder="Item Name" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Source</label>
            <div class="control">
                <select name="source" id="source_select" class="select" style="width: 100%;">
                    <option value="" selected>Choose One...</option>
                    <option value="Amazon">Amazon</option>
                    <option value="Walmart">Walmart</option>
                    <option value="Etsy">Etsy</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>

        <div class="field">
            <label class="label">URL</label>
            <div class="control">
                <input name="url" class="input" type="text" placeholder="URL" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Affiliate URL</label>
            <div class="control">
                <input name="aff_url" class="input" type="text" placeholder="Affiliate URL">
            </div>
        </div>

        <div class="field">
            <label class="label">Image URL</label>
            <div class="control">
                <input name="img_url" class="input" type="text" placeholder="Image URL" required>
            </div>
        </div>

        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Add Item</button>
            </div>
            <div class="control">
                <button class="button is-light" type="button" onclick="add_registry_item_modal.close();">Cancel</button>
            </div>
        </div>
    </form>
</dialog>