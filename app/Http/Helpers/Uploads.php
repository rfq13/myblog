<?php

if (! function_exists('areActiveRoutesHome')) {
    function compressImage($source, $destination, $quality) {
        // Mendapatkan info gambar
        $imgInfo = getimagesize($source);
        $mime = $imgInfo['mime'];
         
        // Membuat gambar baru dari file yang diupload
        switch($mime){
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                $image = imagecreatefromjpeg($source);
        }
         
        // simpan gambar
        imagejpeg($image, $destination, $quality);
         
        // Return gambar yang dikompres
        return $destination;
    }
     
     
    // Lokasi path untuk upload
    $uploadPath = "uploads/";
     
    // ketika melakukan submit file
    $status = $statusMsg = '';
    if(isset($_POST["submit"])){
        $status = 'error';
        if(!empty($_FILES["image"]["name"])) {
            // File info
            $fileName = basename($_FILES["image"]["name"]);
            $imageUploadPath = $uploadPath . $fileName;
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
             
            // Syarat format yang diperbolehkan
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)){
                // array gambar sementara
                $imageTemp = $_FILES["image"]["tmp_name"];
                 
                // Kompres dan upload data
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 75);
                 
                if($compressedImage){
                    $status = 'success';
                    $statusMsg = "Gambar Berhasil dikompres.";
                }else{
                    $statusMsg = "Kompres gambar gagal!";
                }
            }else{
                $statusMsg = 'Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.';
            }
        }else{
            $statusMsg = 'Pilih gambar untuk diupload.';
        }
    }
    
}