<?php
trait fileUpload
{
    public static $fileErrors = array();
    public static $data;
    public static $fileData = array();

    public static function file($data = array())
    {
        self::$fileData = array(
            'fileName' => $_FILES[$data['fileName']]['name'],
            'fileTmp' => $_FILES[$data['fileName']]['tmp_name'],
            'extension' => $data['allowedExtension'],
            'uploadPath' => $data['uploadPath'],
            'fieldName' => $data['fileName'],
            'label' => $data['label'],
            'fileExtension' => pathinfo($_FILES[$data['fileName']]['name'], PATHINFO_EXTENSION)
        );

        if(empty(self::$fileData['fileName']))
        {
            self::$fileErrors[self::$fileData['fieldName']] = self::$fileData['label'] . " is required";

            return self::$fileErrors;
        }

        $fileExtension = self::$fileData['fileExtension'];
        $extension = explode("|", $fileExtension);

        if(!in_array($fileExtension, $extension))
        {
            self::$fileErrors[$fileData['fieldName']] = $fileData['label'] . " is not a valid extension";

            return self::$fileErrors;
        }

        if(!file_exists(self::$fileData['uploadPath']))
        {
            $directory = rtrim(self::$fileData['uploadPath'], "/");
            self::$fileErrors[self::$fileData['fieldName']] = $directory . " is not a valid directory";

            return self::$fileErrors;
        }
    }

    public static function fileRun()
    {
        if(empty(self::$fileErrors))
        {
            $fileName = pathinfo(self::$fileData['fileName'], PATHINFO_FILENAME);
            $fileName = preg_replace("/\s+/", '_', $fileName);
            $fileName = time();
            $fileName = $fileName.".".self::$fileData['fileExtension'];

            move_uploaded_file(self::$fileData['fileTmp'], self::$fileData['uploadPath'].$fileName);
            self::$fileData['fileName'] = $fileName;

            return true;
        }
        else
        {
            return false;
        }
    }
}