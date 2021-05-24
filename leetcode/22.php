<?php
/*
22. 括号生成

数字 n 代表生成括号的对数，请你设计一个函数，用于能够生成所有可能的并且 有效的 括号组合。

示例 1：
输入：n = 3
输出：["((()))","(()())","(())()","()(())","()()()"]

示例 2：
输入：n = 1
输出：["()"]
 
提示：
1 <= n <= 8

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/generate-parentheses
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

$n = 3;
$solution = new Solution();
$ret = $solution->generateParenthesis($n);
var_dump($ret);

/**
 * 思路:
 * 1.先考虑实现无重复的排列组合  如 "ABC" 的所有排列组合
 * 2.考虑有重复的排列组合 如 "AAB"
 * 3.本题本质上就是 n个( 和 )的排列组合但有限制
 *   限制:每个组合从第一位开始 )出现的次数不得 大于 ( 的出现次数 --------一种实现思路记录 ( 和 )的 出现/剩余 次数
 *        或者简化 每出现一个( depth++ 每出现 ) depth-- depth >= 0 -----------另一种思路记录depth 和 ( 的 出现/剩余 次数
 *   优化: 按照排列组合的做法第一步先构建元素 如 n=2  是对 ["(",")","(",")"] 排列组合
 *        因为每次只有 ( 或 ) 所以不像排列组合那样遍历所有的剩余符号, 只需要遍历 ( 和 ) ,同时是记录 ( 的剩余数量即可
 * 
 * @author zhaojian
 */
class Solution {
    private $tmp = [];
    
    /**
     * @param Integer $n
     * @return String[]
     */
    function generateParenthesis($n) {
        $this->tmp = [];
        $this->genrateAll($n,0);
        return $this->tmp;
    }
    
    private function genrateAll($traceN,$depth = 0,$current = ''){
        if($traceN == 0 && $depth == 0){
            $this->tmp[] = $current;
            return;
        }
        
        if($traceN == 0){
            for($i = 0;$i<$depth;$i++){
                $current = $current . ')';
            }
            $this->tmp[] = $current;
            return;
        }
        
        if($traceN > 0){
            $this->genrateAll($traceN -1,$depth + 1,$current . '(');
        }
        
        if($depth > 0){
            $this->genrateAll($traceN,$depth - 1,$current . ')');
        }
    }
}



