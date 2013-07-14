<?php
$basehttp = $Params['basehttp'];
$misc_url = $Params['misc_url'];
$Pornstars = $Params['Pornstars'];

foreach ($Params['data'] as $row) {

    $bad = array('?', '!', ' ', '&', '*', '$', '#', '@');
    $good = array('', '', '-', '', '', '', '', '');
    $link = "$basehttp/pornstar/" . strtolower(str_replace($bad, $good, $row['name']));
    ?>

    <div class="main-pornstar pornstar-thumb-large pornstar-<? echo $row['record_num'] ?>" rel ="<? echo $row['record_num'] ?>">
        <a href="<?php echo $link; ?>">
            <?php if ($row['thumb'] != '') { ?>
                <img class="img" src="<?php echo $misc_url; ?>/pornstars/<?php echo $row['dir1']; ?>/<?php echo $row['dir2']; ?>/<?php echo $row['thumb']; ?>.jpg" alt="<?php echo ucwords($row['name']); ?>">
            <?php } else { ?>
                <img class="img" src="<?php echo $basehttp; ?>/media/misc/catdefault.jpg" alt="<?php echo ucwords($row['name']); ?>">
            <?php } ?>
        </a>
        <div class="pornstar-thumb-info">
            <p><a href="<?php echo $link; ?>"><?php echo ucwords($row['name']); ?></a></p>
            <p>Videos: <span class="blue-text"><? echo $Pornstars->findTotalVideosByPornStarId($row['record_num']) ?></span> Visits <span class="blue-text"><?php echo $row['views']; ?></span></p>
        </div>
    </div>

    <?
}