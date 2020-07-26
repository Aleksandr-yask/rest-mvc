<?php
namespace application\lib;

use application\lib\DirWorker\DirMaker;
use SplFileInfo;

class FileWorker
{
    // max file size in bytes
    const MAX_FILE_SIZE = 1000000;

    const IMAGE_TYPES = array
            (
                0=>'UNKNOWN',
                1=>'GIF',
                2=>'JPEG',
                3=>'PNG',
                4=>'SWF',
                5=>'PSD',
                6=>'BMP',
                7=>'TIFF_II',
                8=>'TIFF_MM',
                9=>'JPC',
                10=>'JP2',
                11=>'JPX',
                12=>'JB2',
                13=>'SWC',
                14=>'IFF',
                15=>'WBMP',
                16=>'XBM',
                17=>'ICO',
                18=>'COUNT'
            );

    public static function downloadFile(string $url, string $uploadPath, string $fileName)
    {
        $ch = curl_init($url);

        $file_name = $fileName;
        DirMaker::dirMaker($uploadPath, '/temp/');
        $save_file_loc = $uploadPath . 'temp/' . $file_name;


        $fp = fopen($save_file_loc, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $size = getimagesize($save_file_loc);
        if (@is_array($size)) {
            $size[2] = self::IMAGE_TYPES[$size[2]];
            rename($save_file_loc, $uploadPath . $file_name . '.' . mb_strtolower($size[2]));
        } else {
            unlink($save_file_loc);
        }

        return $file_name . '.' . mb_strtolower($size[2]);
    }
}