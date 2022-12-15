<?php
//require_once "../db/config.php";
require_once "../db/dbcon.php";
require "../includes/layout/backHeader.php";

if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
    $dbCon = dbCon($user, $pass);

    $field = $_POST['field']; 
    $value = $_POST['value'];
    $editid = $_POST['id'];

    $sql = "UPDATE company_hours SET ".$field."='".$value."' WHERE id=".$editid;
    $query = $dbCon->prepare($sql);
    $query->execute();
}
?>

<div class='container'>

    <table width='100%' border='0'>
        <tr>
            <th width='10%'>S.no</th>
            <th width='40%'>day</th>
            <th width='40%'>time</th>
        </tr>
        <?php
            $dbCon = dbCon($user, $pass);
            $sql = "SELECT * FROM company_hours ORDER BY id";
            $query = $dbCon->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

             $count = 1;

            foreach ($results as $result) {
            ?>
        <tr>
            <td>
                <?php echo $count; ?>
            </td>
            <td>
                <div contentEditable='true' class='edit' id='day_<?php echo $result->id; ?>'>
                    <?php echo $result->day; ?>
                </div>
            </td>
            <td>
                <div contentEditable='true' class='edit' id='time_<?php echo $result->id; ?>'>
                    <?php echo $result->time; ?>
                </div>
            </td>
        </tr>
        <?php
                $count++;
            }
            ?>
    </table>

</div>

<script src='../assets/js/editHours.js' type='text/javascript'></script>
<?php require "../includes/layout/backFooter.php"; ?>