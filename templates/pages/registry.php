
<?php
    $items = query("SELECT * FROM registry_items;");
?>

<?php 
    if ($items){
        foreach ($items as $item){ ?>
            <div class="container box">
                <h3 class="is-size-3"><?= htmlspecialchars($item['name']) ?></h3>
                <div style="display: flex; justify-content: center;  margin: 1rem 0;">
                    <img style="max-height: 32rem; object-fit: cover;" src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                </div>
                

                <div class="is-flex is-align-items-end is-justify-content-end" style="width: 100%;">
                    <a style="margin-right: 2px;" target="_blank" href="<?= $item['affiliate_url'] != "" ? htmlspecialchars($item['affiliate_url']) : htmlspecialchars($item['url']) ?>" class="button">View Item</a>
                        <?php if ($item['buyer_id'] == null){ ?>
                            <form method="POST" action="/handle_guest_claim_registry_item">

                                <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">
                                <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']); ?>">
                                <div class="control">
                                    <button class="button is-link" type="submit">I'll Buy It!</button>
                                </div>
                            </form>
                        <?php } else if ($item['buyer_id'] != $_SESSION['user_id']) {?>
                            <button class="button is-link" disabled type="submit">Item Already Claimed</button>
                        <?php } else if (logged_in() && $item['buyer_id'] == $_SESSION['user_id']){ ?>
                            <form method="POST" action="/handle_guest_unclaim_registry_item">

                                <input type="hidden" name="csrf_token" value="<?= create_csrf_token(); ?>">
                                <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']); ?>">
                                <div class="control">
                                    <button class="button is-link" type="submit">Unclaim Item</button>
                                </div>
                            </form>
                        <?php } ?>
                        
                    </form>
                </div>
            </div>
        <?php
        }
    }
?>