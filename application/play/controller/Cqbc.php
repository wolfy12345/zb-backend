<?php
/**
 * 拆迁
 *
 * @author     chenfenghua<843958575@qq.com>
 * @copyright  Copyright 2014-2017
 * @version    2.0
 */
namespace app\play\controller;
use think\Request;

class Cqbc
{
    /**
     * 入口页
     */
    public function index()
    {
        $this->data['title'] = '拆迁补偿协议 ';

        $this->render('index', $this->data);
    }

    /**
     * 生成图
     */
    public function image(Request $req)
    {
        header("content-type:image/png");
        $name = $req->get('name', "神笔记");
        $im = imagecreatetruecolor(1000, 1333);
        $bg = imagecreatefromjpeg(IA_ROOT.'/example/cqbc/mainn.jpg');
        imagecopy($im,$bg,0,0,0,0,1000,1333);
        imagedestroy($bg);
        $black = imagecolorallocate($im, 40, 40, 40);
        $text = $name;
        $num = rand(1000000,3000000);
        $numr = "￥".$num;
        /**
         * 人民币小写转大写
         *
         * @param string $number 数值
         * @param string $int_unit 币种单位，默认"元"，有的需求可能为"圆"
         * @param bool $is_round 是否对小数进行四舍五入
         * @param bool $is_extra_zero 是否对整数部分以0结尾，小数存在的数字附加0,比如1960.30，
         *             有的系统要求输出"壹仟玖佰陆拾元零叁角"，实际上"壹仟玖佰陆拾元叁角"也是对的
         * @return string
         */

        $number = $num;
        $dnum = $this->num2rmb($number);
        $date = date("Y-m-d");
        $year = date("Y");
        $months = date("m");
        $day = date("d");
        $font = IA_ROOT.'/static/fonts/xjl.ttf';
        imagettftext($im, 28, 0, 745, 990, $black, $font, $text);
        imagettftext($im, 28, 0, 570, 1092, $black, $font, $year);
        imagettftext($im, 28, 0, 670, 1092, $black, $font, $months);
        imagettftext($im, 28, 0, 740, 1092, $black, $font, $day);
        imagettftext($im, 28, 0, 640, 260, $black, $font, $numr);
        imagettftext($im, 28, 0, 230, 300, $black, $font, $dnum);
        imagejpeg($im);
        imagedestroy($im);
    }

    private function num2rmb($number = 0, $int_unit = '元', $is_round = TRUE, $is_extra_zero = FALSE)
    {
        // 将数字切分成两段
        $parts = explode('.', $number, 2);
        $int = isset($parts[0]) ? strval($parts[0]) : '0';
        $dec = isset($parts[1]) ? strval($parts[1]) : '';

        // 如果小数点后多于2位，不四舍五入就直接截，否则就处理
        $dec_len = strlen($dec);
        if (isset($parts[1]) && $dec_len > 2)
        {
            $dec = $is_round
                ? substr(strrchr(strval(round(floatval("0.".$dec), 2)), '.'), 1)
                : substr($parts[1], 0, 2);
        }

        // 当number为0.001时，小数点后的金额为0元
        if(empty($int) && empty($dec))
        {
            return '零';
        }

        // 定义
        $chs = array('0','壹','贰','叁','肆','伍','陆','柒','捌','玖');
        $uni = array('','拾','佰','仟');
        $dec_uni = array('角', '分');
        $exp = array('', '万');
        $res = '';

        // 整数部分从右向左找
        for($i = strlen($int) - 1, $k = 0; $i >= 0; $k++)
        {
            $str = '';
            // 按照中文读写习惯，每4个字为一段进行转化，i一直在减
            for($j = 0; $j < 4 && $i >= 0; $j++, $i--)
            {
                $u = $int{$i} > 0 ? $uni[$j] : ''; // 非0的数字后面添加单位
                $str = $chs[$int{$i}] . $u . $str;
            }
            //echo $str."|".($k - 2)."<br>";
            $str = rtrim($str, '0');// 去掉末尾的0
            $str = preg_replace("/0+/", "零", $str); // 替换多个连续的0
            if(!isset($exp[$k]))
            {
                $exp[$k] = $exp[$k - 2] . '亿'; // 构建单位
            }
            $u2 = $str != '' ? $exp[$k] : '';
            $res = $str . $u2 . $res;
        }

        // 如果小数部分处理完之后是00，需要处理下
        $dec = rtrim($dec, '0');

        // 小数部分从左向右找
        if(!empty($dec))
        {
            $res .= $int_unit;

            // 是否要在整数部分以0结尾的数字后附加0，有的系统有这要求
            if ($is_extra_zero)
            {
                if (substr($int, -1) === '0')
                {
                    $res.= '零';
                }
            }

            for($i = 0, $cnt = strlen($dec); $i < $cnt; $i++)
            {
                $u = $dec{$i} > 0 ? $dec_uni[$i] : ''; // 非0的数字后面添加单位
                $res .= $chs[$dec{$i}] . $u;
            }
            $res = rtrim($res, '0');// 去掉末尾的0
            $res = preg_replace("/0+/", "零", $res); // 替换多个连续的0
        }
        else
        {
            $res .= $int_unit . '整';
        }
        return $res;
    }
}