<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$feedback = new \CNetworks\Helpers\Bll\Feedback();
$logBook = new \CNetworks\Helpers\Bll\LogBook();
$connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $logBook, $feedback);
$model = new \CNetworks\EyeVent\Model\Event($connector, $logBook, $feedback);
?>
<HTML>
<HEAD>
    <TITLE></TITLE>
</HEAD>
<BODY>

<table style="width:30%">
    <tr>
        <th>Evenement</th>
        <th>Datum</th>
    </tr>

    <?php
    foreach ($model->loadAll() as $event) {
    ?>
        <tr>
            <td><a href="event.php?id=<?php echo $event->getId(); ?>"><?php echo $event->getName(); ?></a></td>
            <td><?php echo $event->getDate(); ?></td>
        </tr>
    <?php
    }
    ?>
</table>
<?php
print_r($feedback);
?>
</BODY>
</HTML>