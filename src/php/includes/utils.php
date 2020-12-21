<?php
    
    /**
     * File Upload
     * @desc uploads a new file to the desired directory
     * @param targetDir relative path to target dir
     * @param fileName  name of the form field of the file to be uploaded
     */
    function fileUpload($targetDir, $fileName) {
        $targetFile = __DIR__ . $targetDir . basename($_FILES[$fileName]['name']);
        $uploadOk = true;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file is an actual image
        if (isset($_POST['submit'])) {
            $check = getimagesize($_FILES[$fileName]['tmp_name']);
            
            if (!$check) {
                $uploadOk = false;
                throw new Exception("Invalid file.");
            }
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            $uploadOk = false;
            throw new Exception("File already exists.");
        }

        // Check file size
        if ($_FILES[$fileName]['size'] > 50000000000) {
            $uploadOk = false;
            throw new Exception("File size too large.");
        }
        
        // Allow certain file formats 
        if ($imageFileType != "jpg") {
            if ($imageFileType != "png") {
                if ($imageFileType != "jpeg") {
                    if ($imageFileType != "gif") {
                        $uploadOk  = false;
                        throw new Exception("Invalid file type.");
                    }
                }
            }
        }

        if ($uploadOk) {
            move_uploaded_file($_FILES[$fileName]['tmp_name'], $targetFile);
        } else {
            throw new Exception("File upload error.");
        }
    }
?>