<?php
/*
 剑指 Offer 38. 字符串的排列
 输入一个字符串，打印出该字符串中字符的所有排列。

 你可以以任意顺序返回这个字符串数组，但里面不能有重复元素。
 示例:

输入：s = "abc"
输出：["abc","acb","bac","bca","cab","cba"]

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/zi-fu-chuan-de-pai-lie-lcof
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 
 */

$s = "123456";
$ret = (new Solution())->permutation($s);
var_dump($ret);

/**
 * 思路是我们做排列组合的最原始想法
 * 如: abcd 做排列组合  第一位有4种取法a,b,c,d,第二位3种....
 * 每次从字符串中取一个字符 abcd取a, 然后其余字串bcd进入下次迭代
 *  
 * 这种方式缺点是空间复杂度很高,一次完整的组合需要用的字符串 是 abcd,bcd,cd,d 空间复杂度等差数列求和:O(n²)
 * 另外因为使用了递归,递归带来的问题同样存在,递归最大深度 n
 * 时间复杂度 O(n²)
 *
 */
class Solution {
    
    /**
     * @param String $s
     * @return String[]
     */
    function permutation($s) {
        $this->tmp = [];
        $this->permutationAll($s);
        return $this->tmp;
    }
    
    private $tmp = [];
    private function permutationAll($s,$current = ''){
        $len = strlen($s);
        if($len == 0){
            $this->tmp[] = $current;
            return ;
        }
        $map = [];
        $prefix = '';
        for($i = 0;$i < $len;$i++){
            $char = $s[$i];
            if(!isset($map[$char])) { //去重处理
                $this->permutationAll($prefix . substr($s, $i+1),$current.$char);
                $map[$char] = 1;
            }
            $prefix .= $char;
        }
    }
}