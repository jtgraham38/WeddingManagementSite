<form method="POST" action="/handle_rsvp">
    <h3 class="title">RSVP to the wedding of <?= get_setting('groom_fname') ?> and <?= get_setting('bride_fname') ?></h3>
    <hr>

    <div class="field">
        <label class="label">Your First Name</label>
        <div class="control">
            <input name="fname" class="input" type="text" placeholder="Your First Name" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Your Last Name</label>
        <div class="control">
            <input name="lname" class="input" type="text" placeholder="Your Last Name" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Your Email</label>
        <div class="control">
            <input name="email" class="input" type="text" placeholder="Your Email" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Your Phone Number</label>
        <div class="control">
            <input name="phone" class="input" type="tel" placeholder="Your Phone Number (xxx-xxx-xxxx)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
        </div>
    </div>

    <div class="field">
        <label class="label">Choose Your Password</label>
        <div class="control">
            <input name="password" id="password" class="input" type="password" placeholder="Choose Your Password" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Confirm Your Password</label>
        <div class="control">
            <input name="confirm_password" id="confirm_password" class="input" type="password" placeholder="Confirm Your Password" required>
        </div>
    </div>

    <div class="field">
        <label class="label">RSVP Code</label>
        <div class="control">
            <input name="rsvp_key" id="rsvp_key" class="input" type="password" placeholder="RSVP Code" required>
        </div>
    </div>

    <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

    <br>

    <div class="control">
        <button class="button is-link" type="submit">RSVP</button>
    </div>
</form>