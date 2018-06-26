<?php
/**
 * 2017关键词
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2017
 * @version    2.0
 */
namespace app\play\controller;
use think\Request;
class Guanjianci
{
    /**
     * 入口页
     */
    public function index()
    {
        $this->data['title'] = '2018关键词';

        $this->render('index', $this->data);
    }

    /**
     * 生成图
     */
   public function image(Request $req)
    {
        header("content-type:image/png");
        $name = $req->get('param2', "装B高手");
        $avatar = $req->get('avatar', "");
        $type = 2;
        $num =rand(1,65);
        $tp = '/example/guanjianci/'.$num.'.jpg';
        $img_l_t = imagecreatefrompng(IA_ROOT.'/example/guanjianci/'.$num.'.png');
        $im = imagecreatetruecolor(750, 1389);
        $bg = imagecreatefromjpeg(IA_ROOT . $tp);
        imagecopy($im, $bg, 0, 0, 0, 0, 750, 1389);
        imagedestroy($bg);
        $black = imagecolorallocate($im, 0, 0, 0);

        $font = IA_ROOT . '/static/fonts/6.ttf';

        if ($type == 1) {
            $qq = IA_ROOT.'/avatar/'.$avatar;
        } else {
            $qq = IA_ROOT.'/images/'.$avatar;
        }


        $this->getyuan($qq,$avatar);


        $tt = IA_ROOT.'/images/yuan'.$avatar;
        $change = $this->change($tt);
        imagecopymerge($im, $change, 286, 581, 0, 0, 170, 170, 100);

       
        $white = imagecolorallocate($img_l_t , 255 , 255 , 255);
        imagecolortransparent($img_l_t , $white ) ;
        imagealphablending($img_l_t , false);
        imagefill($img_l_t , 0 , 0 , $white);
        imagesavealpha($img_l_t , true);
        imagecopy($im, $img_l_t, 0, 0, 0, 0, 750, 1389);
        //姓名
        imagettftext($im, 50, 0, 250, 100, $black, $font, $name);
        #二维码
        $im1 = imagecreatefromstring(file_get_contents(IA_ROOT.'/static/qrcode/qr160.png'));
        $white = imagecolorallocate($im1 , 255 , 255 , 255);
        imagecolortransparent($im1 , $white ) ;
        imagefill($im1 , 0, 0 , $white);
        imagecopy($im, $im1, 290, 1100, 0, 0, 160, 160);

        imagettftext($im, 18, 0, 220, 1300, $black, $font, '扫一扫，获取你的2018关键词');

        imagejpeg($im);
        imagedestroy($im);
    }

    public function getyuan($imgpath,$avatar)
    {

        /**
         *  blog:http://www.zhaokeli.com
         * 处理成圆图片,如果图片不是正方形就取最小边的圆半径,从左边开始剪切成圆形
         * @param  string $imgpath [description]
         * @return [type]          [description]
         */

//        $ext = pathinfo($imgpath);
        $src_img = null;
//        switch ($ext['extension']) {
//            case 'jpg':
//                $src_img = imagecreatefromjpeg($imgpath);
//                break;
//            case 'png':
//                $src_img = imagecreatefrompng($imgpath);
//                break;
//        }
        $src_img = imagecreatefromjpeg($imgpath);
        $wh = getimagesize($imgpath);
        $w = $wh[0];
        $h = $wh[1];
        $w = min($w, $h);
        $h = $w;
        $img = imagecreatetruecolor($w, $h);
        //这一句一定要有
        imagesavealpha($img, true);
        //拾取一个完全透明的颜色,最后一个参数127为全透明
        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        $r = $w / 2; //圆半径
        $y_x = $r; //圆心X坐标
        $y_y = $r; //圆心Y坐标
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    imagesetpixel($img, $x, $y, $rgbColor);
                }
            }
        }
        imagejpeg($img,IA_ROOT.'/images/yuan'.$avatar);
       // return $img;
    }

    public function change($url){
        //图片的等比缩放

        //因为PHP只能对资源进行操作，所以要对需要进行缩放的图片进行拷贝，创建为新的资源
        $src=imagecreatefromjpeg($url);

        //取得源图片的宽度和高度
        $size_src=getimagesize($url);
        $w=$size_src['0'];
        $h=$size_src['1'];

        //指定缩放出来的最大的宽度（也有可能是高度）
        $max=170;

        //根据最大值为300，算出另一个边的长度，得到缩放后的图片宽度和高度
        if($w > $h){
            $w=$max;
            $h=$h*($max/$size_src['0']);
        }else{
            $h=$max;
            $w=$w*($max/$size_src['1']);
        }


        //声明一个$w宽，$h高的真彩图片资源
        $image=imagecreatetruecolor($w, $h);


        //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
        imagecopyresampled($image, $src, 0, 0, 0, 0, $w, $h, $size_src['0'], $size_src['1']);
        return $image;
    }

}

