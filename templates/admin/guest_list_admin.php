
<h1 class="title">Guest List</h1>
<h4 class="subtitle is-italic has-text-weight-light ">People who have RSVP'd so far!</h4>

<br>

<table class="table is-striped">
  <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Attending?</th>
        <th>Additional Guests</th>
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
        if ($guest['attending']){ 
            $attending_count++;
            $attending_count += isset($guest['additional_guests']) ? $guest['additional_guests'] : 0; 
        }
    ?> 
        <tr>
            <td><?=htmlspecialchars($guest['fname']) ?></th>
            <td><?=htmlspecialchars($guest['lname']) ?></td>
            <td><a href="mailto: <?=htmlspecialchars($guest['email']) ?>"><?=htmlspecialchars($guest['email']) ?></a></td>
            <td><a href="tel:<?=htmlspecialchars($guest['phone']) ?>"><?=htmlspecialchars($guest['phone']) ?></a></td>
            <td>
            
                <form method="POST" action="/handle_toggle_attending">
                    <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">
                    <input type="hidden" name="guest_id" value="<?= htmlspecialchars($guest['id']); ?>">
                    <input onChange="this.form.submit()" type="checkbox" name="is_attending" <?= $guest['attending'] ? "checked" : ""?>>
                </form>
            </td>
            <td><?=htmlspecialchars($guest['additional_guests'])?></td>
            <td>
                <form method="POST" action="/handle_toggle_admin">
                    <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">
                    <input type="hidden" name="guest_id" value="<?= htmlspecialchars($guest['id']); ?>">
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
        <th>
            <a href="mailto: <?= htmlspecialchars(implode(',', array_map(function($guest){
                return $guest['email'];
            }, $guests))) ?>">Mail all guests</a>
        </th>
        <th></th>
        <th>Guests: <?= $attending_count; ?></th>
        <th>Admins: <?= $admin_count ?></th>
      
    </tr>
  </tfoot>
</table>