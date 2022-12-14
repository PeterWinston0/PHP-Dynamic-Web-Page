<?php require_once "../DB/dbCon.php";
if (isset($_POST['submit'])) {
    $hoursID = $_POST['id'];
    $open = $_POST['open'];
    $close = $_POST['close'];

    var_dump($hoursID);
    var_dump($open);
    var_dump($close);

    $idArray = $_POST['id'];
    $openArray = $_POST['open'];
    $closeArray = $_POST['close'];

    $myArray = array_combine($idArray, $openArray);
    var_dump($myArray);


    $dbCon = dbCon($user, $pass);

    // var_dump($catArray);
    foreach (array_combine($openArray, $idArray) as $open => $id) {
        $sql27 = "UPDATE company_hours (`open`) VALUES ($open) WHERE id = $id ";
        echo $sql27;
        $queryOpen = $dbCon->prepare($sql27);
        $queryOpen->execute();
    }
    //var_dump($openArray);

    foreach ($closeArray as $close) {
        $sql29 = "UPDATE company_hours (`close`) VALUES ($close) WHERE id = $hoursID ";
        echo $sql29;
        $queryClose = $dbCon->prepare($sql29);
        $queryClose->execute();
    }
    //var_dump($closeArray);


    // $dbCon = dbCon($user, $pass);
    // $query = $dbCon->prepare("UPDATE company_hours SET `open`='$open', `close`='$close' ");
    // $query->execute();
    //header("Location: hours.php?status=updated");

} else {
    echo "There is an error";
    // header("Location: ../../admin/company.php?status=0");
}