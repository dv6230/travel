<?php

class manager_file_upload
{
    public function process_file($getfile)
    {
        $file_name = $_FILES['image']['name'];
        $file_random_name = uniqid();
        switch ($_FILES['image']['type']) {
            case 'image/jpeg':
                $file_type = 'jpg';
                break;
            case 'image/png':
                $file_type = 'png';
                break;
            case 'image/gif':
                $file_type = 'gif';
                break;
            case 'image/webp':
                $file_type = 'webp';
                break;
            default:
                $file_type = '';
                break;
        }
        if ($file_type) {
            $file_path = '../product_image/' . $file_random_name . '.' . $file_type;
            move_uploaded_file($_FILES['image']['tmp_name'], $file_path);            
        } else {
            $err = '無法上傳此類型的檔案';
        }
        return $err ;
    }
}
