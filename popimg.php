<?php
if ($_GET['imagen']<>"" && $_GET['alter']<>""){
	echo "<img src='images/gran/".$_GET['imagen'].".jpg' border="0" alt=".$_GET['alter'].">";
}
?>