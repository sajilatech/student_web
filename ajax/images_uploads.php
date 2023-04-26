<?php require('../application_top.php');
define('CERTIFICATETABLE',MTABLE.'student_certificates');
if (isset($_FILES['files']) && !empty($_FILES['files'])) { 
    $no_files = count($_FILES["files"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["files"]["error"][$i] > 0) {
            echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
        } else {
			$random_num=rand();
				$file_name=$random_num.'_'.$_FILES["files"]["name"][$i];
            if (file_exists('../uploads/' . $file_name)) {
                echo 'File already exists : /uploads/' . $file_name;
            } else {
				
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], '../uploads/' . $file_name);
                echo  $file_name ;
				
            }
        }
    }
} else {
    echo 'Please choose at least one file';
}
    
/* 
 * End of script
 */
?>