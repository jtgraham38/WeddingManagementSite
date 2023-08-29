
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
            <td><?=$guest['email'] ?></td>
            <td><?=$guest['phone'] ?></td>
            <td><?= $guest['attending'] ? "yes" : "no" ?></td>
            <td>
                <input type="checkbox" name="<?= $guest['id']; ?>_is_admin" <?=$guest['admin'] ? "checked" : ""?>>
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