
<h1 class="title">Guest List</h1>
<h4 class="subtitle is-italic has-text-weight-light ">Here is the list of people who have RSVP'd so far!</h4>

<br>

<table class="table is-striped">
  <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Attending?</th>
        <th>Admin?</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //get guests
    $guests = query('SELECT * FROM guests ORDER BY fname, lname;');

    //track number of admins
    $admin_count = 0;
    $attending_count = 0;

    //display guests in table
    foreach ($guests as $guest){
        if ($guest['admin']){ $admin_count++; }
        if ($guest['attending']){ $attending_count++; }
    ?> 
        <tr>
            <td><?=$guest['fname'] ?></th>
            <td><?=$guest['lname'] ?></td>
            <td><a href="mailto: <?=$guest['email'] ?>"><?=$guest['email'] ?></a></td>
            <td><a href="tel:<?=$guest['phone'] ?>"><?=$guest['phone'] ?></a></td>
            <td><?= $guest['attending'] ? "yes" : "no" ?></td>
            <td>
                <form method="POST" action="/handle_toggle_admin">
                    <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">
                    <input type="hidden" name="guest_id" value="<?= $guest['id']; ?>">
                    <input onChange="this.form.submit()" type="checkbox" name="is_admin" <?=$guest['admin'] ? "checked" : ""?>>
                </form>
            </td>
        </tr>
    <?php } ?>
  </tbody>

  <tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Guests: <?= count($guests); ?></th>
        <th>Admins: <?= $admin_count ?></th>
      
    </tr>
  </tfoot>
</table>