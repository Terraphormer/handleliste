<?php
require_once "php/functions.php";
checkLogin();
$uid = $_SESSION['id'];

require_once "php/config.php";
include "header.php";

$sql = "SELECT * FROM handleliste WHERE brukerid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $param_uid);
$param_uid = $uid;
$stmt->execute();
$result = $stmt->get_result();

$allitems = array();

while ($row = $result->fetch_assoc()) {
    array_push($allitems, $row['navn']);
}
$numberOfItems = array_count_values(array: $allitems);
$uniqueItems = array_unique($allitems);
arsort($numberOfItems);
$topTreEn = array_slice($numberOfItems, 0, 1);
$topTreTo = array_slice($numberOfItems, 1, 1);
$topTreTre = array_slice($numberOfItems, 2, 1);

$topTreEnNr = array_key_first(array_flip($topTreEn));
$topTreToNr = array_key_first(array_flip($topTreEn));
$topTreTreNr = array_key_first(array_flip($topTreEn));

?>
<div class="statsGrid">
    <div class="stats">
        <p>Du har hatt: <span style="font-weight: bold;"><?php echo count($allitems); ?></span> elementer i handlelisten.</p>
    </div>
    <div class="stats">
        <p>Hvorav <span style="font-weight: bold;"><?php echo count($numberOfItems); ?></span> elementer er unike.</p>
    </div>
    <div class="stats">
        <p>Dine top 3 er:<br>
            1. <span style="font-weight: bold;"><?php echo array_key_first($topTreEn); ?></span>. Handlet <span style="font-weight: bold;"><?php echo $topTreEnNr; ?></span> ganger.<br>
            2. <span style="font-weight: bold;"><?php echo array_key_first($topTreTo); ?></span>. Handlet <span style="font-weight: bold;"><?php echo $topTreToNr; ?></span> ganger.<br>
            3. <span style="font-weight: bold;"><?php echo array_key_first($topTreTre); ?></span>. Handlet <span style="font-weight: bold;"><?php echo $topTreTreNr; ?></span> ganger.<br>
        </p>
    </div>
</div>

<?php
include "footer.php"
?>