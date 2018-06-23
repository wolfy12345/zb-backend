<?php
namespace app\common\components;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class UploadQiniu {

    public static function uploadToQiniu($localFile, $qiniuFile)
    {
        $accessKey = 'HYrr4Yw63Og612IAJd4JgAwKCHV-13-wke4pQYMb';
        $secretKey = '0SDXjeAi-LViyyUl9Luds5ykpJUrxAfri1oViaFN';
        $bucket = 'xiaochengxu';

        $auth = new Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucket);
        // 要上传文件的本地路径
        $filePath = $localFile;
        // 上传到七牛后保存的文件名
        $key = $qiniuFile;

        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
    }
}

?>