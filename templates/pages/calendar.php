
<?php
    $events = query("SELECT * from calendar_items ORDER BY start_datetime ASC;");
?>

<?php 
    if ($events){
        foreach ($events as $event){ ?>
            <div class="box container" style="height: 100%;">
                <h3 class="is-size-3"><?= $event['name'] ?></h3>
                
                <div class="columns">
                    <div class="column is-three-fifths">
                        <p>
                            <?= $event['description'] ?>
                        </p>
                    </div>
                    <div class="column">
                        <div class="is-flex is-flex-direction-column">
                            <span>
                                From
                                <strong>
                                    <?= format_date($event['start_datetime']);?>
                                </strong>
                            </span>

                            <span>
                                to&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>
                                    <?= format_date($event['end_datetime']);?>
                                </strong>
                            </span>

                            <span>
                                at&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>
                                    <?= $event['location'] ?>
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