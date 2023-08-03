<?= '<h1>' . $title . '</h1>' ?>


<?php foreach ($details as $detail) : ?>
    <ul>
        <li><strong>From:</strong><?= $detail["fromName"] ?></li>
        <li><strong>Address: </strong> <?= $detail["fromAddr"] ?></li>
        <li><strong>Subject:</strong> <?= $detail["subject"] ?></li>
        <li><strong>Body:</strong> <?= $detail['body'] ?></li>

        <!-- <li><a href="mail.php?folder=' . $folder . '&uid=' . $uid . '&func=read">Read</a> -->

        <!-- <a href="mail.php?folder=' . $folder . '&uid=' . $uid . '&func=delete">Delete</a></li> -->
    </ul>

<?php endforeach; ?>