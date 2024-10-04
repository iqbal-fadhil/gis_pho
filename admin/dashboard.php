<?php
// Ensure this page is only accessible to admins
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header('Location: ../public/index.php');
    exit();
}
?>
<h1>Admin Dashboard</h1>
<label for="layer-select">Select Layer to Edit:</label>
<select id="layer-select">
  <option value="points">Points</option>
  <option value="polygons">Polygons</option>
</select>
<button onclick="goToEditor()">Go to Editor</button>

<script>
function goToEditor() {
  var selectedLayer = document.getElementById('layer-select').value;
  window.location.href = selectedLayer + '_editor.php';
}
</script>
