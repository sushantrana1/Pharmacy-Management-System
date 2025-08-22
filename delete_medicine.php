<!-- <?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$conn->query("DELETE FROM medicine WHERE Med_ID=$id");
header("Location: medicine.php");
?>
 -->


 <?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $delete = $conn->query("DELETE FROM medicine WHERE Med_ID = $id");

  if ($delete) {
    header("Location: medicine.php?deleted=success");
  } else {
    echo " Error: " . $conn->error;
  }
} else {
  echo " No medicine ID provided.";
}
?>

