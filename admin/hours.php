<?php
require_once "../db/config.php";
require "../includes/layout/backHeader.php";
?>

<!-- <link href='style.css' rel='stylesheet' type='text/css'> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->


<div class='container'>

    <table width='100%' border='0'>
        <tr>
            <th width='10%'>S.no</th>
            <th width='40%'>day</th>
            <th width='40%'>time</th>
        </tr>
        <?php
            $query = "select * from company_hours order by id";
            $result = mysqli_query($con, $query);
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $day = $row['day'];
                $time = $row['time'];
            ?>
        <tr>
            <td>
                <?php echo $count; ?>
            </td>
            <td>
                <div contentEditable='true' class='edit' id='day_<?php echo $id; ?>'>
                    <?php echo $day; ?>
                </div>
            </td>
            <td>
                <div contentEditable='true' class='edit' id='time_<?php echo $id; ?>'>
                    <?php echo $time; ?>
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