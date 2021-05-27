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

$s = "1234567890a";
$ret = (new Solution2())->permutation($s);
var_dump($ret);

/**
 * 思路是我们做排列组合的最原始想法
 * 如: abcd 做排列组合  第一位有4种取法a,b,c,d,第二位3种....
 * 每次从字符串中取一个字符 abcd取a, 然后其余字串bcd进入下次迭代
 *  
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


/**
 * 优化版,不必记录每次的str,但由于最终要记录全结果,所以其实空间没省多少
 * 
 * @author zhaojian
 *
 */
class Solution2 {
    
    /**
     * @param String $s
     * @return String[]
     */
    function permutation($s) {
        $this->tmp = [];
        $this->list = $s;
        $this->len = strlen($s);
        $this->permutationAll();
        return $this->tmp;
    }
    
    private $tmp = [];
    private $list = '';
    private $len = 0;
    
    private function permutationAll($start = 0,$current = ''){
        if($this->len <= $start){
            $this->tmp[] = $current;
            return ;
        }
        
        $map = [];
        for($i = $start;$i < $this->len;$i++){
            $char = $this->list[$i];
            if(!isset($map[$char])) { //去重处理
                $this->swap($start, $i);
                $this->permutationAll($start + 1,$current.$char);
                $map[$char] = 1;
                $this->swap($start, $i);
            }
        }
    }
    
    private function swap($i,$j){
        $tmp = $this->list[$i];
        $this->list[$i] = $this->list[$j];
        $this->list[$j] = $tmp;
    }
}
