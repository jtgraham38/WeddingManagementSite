<div class="is-flex is-justify-content-space-between">
    <div>
        <h1 class="title">Wedding Details</h1>
        <h4 class="subtitle is-italic has-text-weight-light ">Adjust the details for your wedding and site!</h4>
    </div>
</div>
<br>

<form action="/handle_update_settings" method="POST">
    <?php $settings = query('SELECT * FROM settings;'); ?>

    <?php foreach($settings as $setting){ ?>

    <div class="field">
        <label class="label"><?= $setting['label'] ?>:</label>
        <div class="control">
            <input name="<?= $setting['name'] ?>" value="<?= $setting['value'] ?>" class="input setting_input" type="text" placeholder="<?= $setting['label'] ?>">
        </div>
    </div>

    <?php } ?>

    <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

    <div class="control">
        <button id="settings_submit_btn" class="button is-link" type="submit" disabled>Update Details</button>
    </div>
</form>

<script>
    //get elements
    const inputs = Array.from(document.querySelectorAll('.setting_input'))
    const submit_btn = document.querySelector('#settings_submit_btn')

    inputs.map((input)=>{
        input.addEventListener('input', (event)=>{
            submit_btn.disabled = false;
        })
    })
</script>