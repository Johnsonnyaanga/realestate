<?php 
print_r($_FILES);
?>
<hr>
<?php 
print_r($_POST);

$fpath = "/tmp/";

// move (actually just rename) the temporary file to the real name
move_uploaded_file ( $_FILES{myfile}{tmp_name}, $fpath.$_FILES{myfile}{name} );

// convert the uploaded file back to binary

// javascript "escape" does not encode the plus sign "+", but "urldecode"
//	in PHP make a space " ". So replace any "+" in the file with %2B first

$filename = $fpath.$_FILES{myfile}{name};
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$contents = preg_replace("/\+/", "%2B", $contents);

$handle = fopen($filename, "w");
fwrite($handle, urldecode($contents));
fclose($handle);

?>
