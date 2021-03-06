<?php
/**
 * Created by chen3jian
 * Date: 2021/7/30
 * Time: 19:00
 */

namespace jz\Helper;

/**
 * 常用方法
 * Created by chen3jian
 * Date: 2021/7/30
 * Time: 23:51
 * Class Common
 * @package jz\Helper
 */
class Common
{
    /**
     * 判断是否为Windows环境
     * @return bool
     * @author：cxj
     * @since：v1.0
     * @Time: 2021/7/30 19:01
     */
    public static function isWin(): bool
    {
        return DIRECTORY_SEPARATOR == '\\';
    }

    /**
     * 设置代码页
     * @param int $code
     * @author：cxj
     * @since：v1.0
     * @Time: 2021/7/30 19:01
     */
    public static function setCodePage($code = 65001)
    {
        $ds = DIRECTORY_SEPARATOR;
        $codePageBinary = implode($ds, ['C:', 'Windows', 'System32', 'chcp.com']);
        if (file_exists($codePageBinary) && Analysis::canUseExcCommand()) {
            @pclose(@popen("{$codePageBinary} {$code}", 'r'));
        }
    }

    /**
     * 开启异步信号
     * @return bool
     * @author：cxj
     * @since：v1.0
     * @Time: 2021/7/28 17:08
     */
    public static function openAsyncSignal()
    {
        return pcntl_async_signals(true);
    }

    /**
     * 设置掩码
     * @author：cxj
     * @since：v1.0
     * @Time: 2021/7/28 17:08
     */
    public static function setMask()
    {
        umask(0);
    }

    /**
     * 睡眠
     * @param int $time
     * @param int $type
     * @author：cxj
     * @since：v1.0
     * @Time: 2021/8/4 18:34
     */
    public static function sleep(int $time, int $type = 1)
    {
        if ($type == 2) $time *= 1000;
        $type == 1 ? sleep($time) : usleep($time);
    }

    /**
     * 编码转换
     * @param string $char
     * @param string $coding
     * @return string
     * @author：cxj
     * @since：v1.0
     * @Time: 2021/7/28 17:08
     */
    public static function convert_char(string $char, string $coding = 'UTF-8'): string
    {
        $encode_arr = ['UTF-8', 'ASCII', 'GBK', 'GB2312', 'BIG5', 'JIS', 'eucjp-win', 'sjis-win', 'EUC-JP'];
        $encoded = mb_detect_encoding($char, $encode_arr);
        if ($encoded) {
            $char = mb_convert_encoding($char, $coding, $encoded);
        }
        return $char;
    }

    /**
     * 设置进程标题
     * @param string $title
     * @author：cxj
     * @since：v1.0
     * @Time: 2021/8/4 17:57
     */
    public static function cli_set_process_title(string $title)
    {
        if (function_exists('cli_set_process_title')) {
            cli_set_process_title($title);
        }
    }
}