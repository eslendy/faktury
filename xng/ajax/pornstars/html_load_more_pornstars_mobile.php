<?php
$basehttp = $Params['basehttp'];
$misc_url = $Params['misc_url'];
$Pornstars = $Params['Pornstars'];

$bad = array('?', '!', ' ', '&', '*', '$', '#', '@');
$good = array('', '', '-', '', '', '', '', '');
foreach ($Params['data'] as $row) {
    $link = "$basehttp/pornstar/" . strtolower(str_replace($bad, $good, $row['name']));
    ?>

    <li class="main-pornstar pornstar-thumb-large pornstar-<? echo $row['record_num'] ?>" rel ="<? echo $row['record_num'] ?>">
        <a href="<?php echo $link; ?>" class='thumbnail'>
            <?php if ($row['thumb'] != '') { ?>
                <img class="img" src="<?php echo $misc_url; ?>/pornstars/<?php echo $row['dir1']; ?>/<?php echo $row['dir2']; ?>/<?php echo $row['thumb']; ?>.jpg" alt="<?php echo ucwords($row['name']); ?>">
            <?php } else { ?>
                <img class="img" src="<?php echo $basehttp; ?>/media/misc/catdefault.jpg" alt="<?php echo ucwords($row['name']); ?>">
            <?php } ?>
            <h3 class="pornstar_<? echo $row['record_num'] ?>" >
                <span><?php echo ucwords($row['name']); ?></span>
                <br>
                <span class="white">
                    <b>Videos: <? echo $Pornstars->findTotalVideosByPornStarId($row['record_num']) ?></b>
                    <br>
                    <b>Visits <?php echo $row['views']; ?></b>
                </span>
            </h3>
        </a>

    </li>
    <?
}
?>
