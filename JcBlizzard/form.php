<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$feedback = new \CNetworks\Helpers\Bll\Feedback();
$logBook = new \CNetworks\Helpers\Bll\LogBook();
$connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $logBook, $feedback);
$model = new \CNetworks\EyeVent\Model\Form($connector, $logBook, $feedback);
//$formModel = new \CNetworks\EyeVent\Model\Form($connector, $logBook, $feedback);
$controller = new \CNetworks\EyeVent\Controller($feedback);
//$controller->initRequestScanner();
$form = null;
$formList = null;
$listForm = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $formList = $model->loadAllByEventId($id);
    $form = $formList[0];
    print_r($form->getInputFields());
}
?>
<HTML>
<HEAD>
    <TITLE></TITLE>
</HEAD>
<BODY>
<FORM method="post">
    <div>
        <label id="form-name">Naam van het formulier: </label>
        <input type="text" id="form-name" name="form-name" value="<?php if (isset($_GET['id'])) { echo $form->getName(); }  ?>"/>
    </div>
    <?php
    if (isset($_GET['id'])) {
        $i = 1;
        $listForm = $form->getInputFields();
        print_r($listForm);
        foreach ($listFrom as $inputField) {
        ?>
        <div>
            <label id="input-field-name-<?php echo $i; ?>">Naam van het veld: </label>
            <input type="text" id="input-field-name-<?php echo $i; ?>" name="input-field-name-<?php echo $i; ?>" value="<?php echo $inputField->getName(); ?>"/>
            <label id="input-field-comment-<?php echo $i; ?>">Commentaar: </label>
            <input type="text" id="input-field-comment-<?php echo $i; ?>" name="input-field-comment-<?php echo $i; ?>" value="<?php echo $inputField->getComment(); ?>"/>
            <label id="input-field-position-<?php echo $i; ?>">Volgorde: </label>
            <input type="text" id="input-field-position-<?php echo $i; ?>" name="input-field-position-<?php echo $i; ?>" value="<?php echo $inputField->getPosition(); ?>"/>
            <label id="input-field-type-<?php echo $i; ?>">Type veld: </label>
            <select id="input-field-type-<?php echo $i; ?>" name="input-field-type-<?php echo $i; ?>">
                <option value="text">text</option>
                <option value="checkbox">checkbox</option>
            </select>
        </div>
        <?php
        $i++;
        }
    }
    ?>
    <div>
        <button type="submit" name="action" value="add-event">Save</button>
    </div>
</FORM>
<?php
print_r($feedback);
?>
</BODY>
</HTML>
