<div class="container p-3">
    <h1 class="title">
        You're getting married!  Congratulations!
    </h1>
    <hr>
    <div class="subtitle is-italic has-text-weight-light">Let's get your site set up!</div>
    <br>
    <form action="/handle_setup_admin" onsubmit="return validate_passwords()" method="POST">
        <div class="field">
            <label class="label">First Name</label>
            <div class="control">
                <input maxlength="25" name="fname" class="input" type="text" placeholder="First Name">
            </div>
        </div>

        <div class="field">
            <label class="label">Last Name</label>
            <div class="control">
                <input maxlength="25" name="lname" class="input" type="text" placeholder="Last Name">
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input maxlength="50" name="email" class="input" type="email" placeholder="Email" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Phone Number</label>
            <div class="control">
                <input maxlength="15" name="phone" class="input" type="tel" placeholder="Phone Number (xxx-xxx-xxxx)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input maxlength="25" name="password" id="password" class="input" type="password" placeholder="Password" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Confirm Password</label>
            <div class="control">
                <input maxlength="25" name="confirm_password" id="confirm_password" class="input" type="password" placeholder="Confirm Password" required>
            </div>
        </div>

        <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">

        <br>
        <div class="control">
            <button class="button is-link">Submit</button>
        </div>
    </form>

    <script>
    function validate_passwords() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        
        if (password !== confirm_password) {
            alert("Passwords do not match");
            return false;
        }
        
        return true;
    }
    </script>
</div>