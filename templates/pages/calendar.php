
<?php
    $events = query("SELECT * from calendar_items ORDER BY start_datetime ASC;");
?>

<?php 
    if ($events){
        foreach ($events as $event){ ?>
            <div class="box container" style="height: 100%;">
                <h3 class="is-size-3"><?= htmlspecialchars($event['name']) ?></h3>
                
                <div class="columns">
                    <div class="column is-three-fifths">
                        <p>
                            <?= htmlspecialchars($event['description']) ?>
                        </p>
                    </div>
                    <div class="column">
                        <div class="is-flex is-flex-direction-column">
                            <span>
                                From
                                <strong>
                                    <?= htmlspecialchars(format_date($event['start_datetime']));?>
                                </strong>
                            </span>

                            <span>
                                to&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>
                                    <?= htmlspecialchars(format_date($event['end_datetime']));?>
                                </strong>
                            </span>

                            <span>
                                at&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>
                                    <?= htmlspecialchars($event['location']) ?>
                                </strong>
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        <?php
        }
    }
?>