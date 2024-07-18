<?php
// includes findable in "my_includes" repo
require("../includes/config.inc.php");
require("../includes/common.inc.php");
require("../includes/db.inc.php");

$conn = dbConnect();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <form method="post">
        <input type="text" name="NameInput" placeholder="Search..">
        <input type="submit" value="filtern">
    </form>
    <?php
    $sql="
        SELECT
            *
        from tbl_table2
        INNER JOIN tbl_table1 ON tbl_table2.FID1 = tbl_table1.ID1
        INNER JOIN tbl_table3 ON tbl_table1.FID3 = tbl_table3.ID3
    ";

    // -------------------------------
    // Filtern
    if(count($_POST)>0 && strlen($_POST["NameInput"])>0) {
        $sql.="
            WHERE(
                tbl_table2.Name LIKE '" . $_POST["NameInput"] . "%'
            )
        ";
    }

    $sql.= "
        ORDER BY tbl_table2.Name ASC
    ";
    // -------------------------------

    // Ausgabe:
    $namen = dbQuery($conn, $sql);
    while($name = $namen->fetch_object()) {
        echo('
            <li> ' . $name->Name . ' </li>
        ');
    }
    ?>
</body>
</html>