<dialog id="edit_item_<?= $item['id'] ?>_modal" style="padding: 2rem; border-radius: 0.2rem;">
    <form method="POST" action="/handle_add_registry_item">
        <h3 class="title">Edit Registry Item</h3>
        <hr>
        
        <div class="field">
            <label class="label">Item Name</label>
            <div class="control">
                <input name="name" value="<?= $item['name'] ?>" class="input" type="text" placeholder="Item Name" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Source</label>
            <div class="control">
                <select name="source" id="source_select" class="select" style="width: 100%;">
                    <option value="" <?= $item['source'] == "" ? "selected" : "" ?> >Choose One...</option>
                    <option value="Amazon" <?= $item['source'] == "Amazon" ? "selected" : "" ?> >Amazon</option>
                    <option value="Walmart" <?= $item['source'] == "Walmart" ? "selected" : "" ?> >Walmart</option>
                    <option value="Ebay" <?= $item['source'] == "Ebay" ? "selected" : "" ?> >Ebay</option>
                    <option value="Other" <?= $item['source'] == "Other" ? "selected" : "" ?> >Other</option>
                </select>
            </div>
        </div>

        <div class="field">
            <label class="label">URL</label>
            <div class="control">
                <input name="url" value="<?= $item['url'] ?>" class="input" type="text" placeholder="URL" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Affiliate URL</label>
            <div class="control">
                <input name="aff_url" value="<?= $item['affiliate_url'] ?>" class="input" type="text" placeholder="Affiliate URL">
            </div>
        </div>

        <div class="field">
            <label class="label">Image URL</label>
            <div class="control">
                <input name="img_url" value="<?= $item['image_url'] ?>" class="input" type="text" placeholder="Image URL" required>
            </div>
        </div>

        <input id="item_id_hidden_input" type="hidden" name="item_id" value="<?= $item['id'] ?>">
        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Update Item</button>
            </div>
            <div class="control">
                <button class="button is-light" type="button" onclick="edit_item_<?= $item['id'] ?>_modal.close();">Cancel</button>
            </div>
        </div>
    </form>
</dialog>