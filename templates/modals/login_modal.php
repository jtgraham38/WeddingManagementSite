<dialog id="login_modal" style="padding: 2rem; border-radius: 0.2rem;">
    <form method="POST" action="/handle_login">
        <h3 class="title">Sign In</h3>
        <hr>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input name="email" class="input" type="email" placeholder="Email" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input name="password" class="input" type="password" placeholder="Password" required>
            </div>
        </div>

        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link" type="submit">Log In</button>
            </div>
            <div class="control">
                <button class="button is-light" type="button" onclick="login_modal.close();">Cancel</button>
            </div>
        </div>
    </form>
</dialog>