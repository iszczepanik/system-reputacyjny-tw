
<br />
<h2>Offer details</h2>
<table class="detail-view" >
<?php foreach($details as $key=>$detail): ?>
<?
echo "<tr class='" . (($key+1) % 2 == 0 ? "even":"odd") . "' >";

echo "<th>".$detail->Detail_criteria->CRT_NAME."</th><td>".$detail->DET_VALUE."</td>"; 
echo "<tr/>";
?>
<?php endforeach; ?>
</table>
