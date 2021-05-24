<?php
namespace lib;

/**
 * 二叉树节点
 * 
 * @author zhaojian
 *
 */
class BinaryTreeNode {
    public $val = null;
    public $left = null;
    public $right = null;
    function __construct($value) { $this->val = $value; }
    
    /**
     * 工具方法，通过数组构建二叉树
     * 例: [1,2,3,null,4,5,6] =>      1
     *                             /    \
     *                            2      3 
     *                            \     / \
     *                             4   5   6
     * 
     * @param array $vals
     * @return \lib\BinaryTreeNode 返回root节点
     */
    public static function BuildBinaryTree(array $vals){
        $len = count($vals);
        if($len == 0) return null;
        $root = new BinaryTreeNode($vals[0]);
        
        $list = [];
        array_push($list, [$root,'left']);
        array_push($list, [$root,'right']);
        
        for($i = 1;$i < $len;$i++){
            $nodeInfo = array_shift($list);
            $parent = $nodeInfo[0];
            $childStr = $nodeInfo[1];
            $val = $vals[$i];
            if($val === null) continue;
            $node = new BinaryTreeNode($vals[$i]);
            if($childStr == 'left'){
                $parent->left = $node;
            } else {
                $parent->right = $node;
            }
            array_push($list, [$node,'left']);
            array_push($list, [$node,'right']);
        }
        return $root;
    }
    
    /**
     * 工具方法,将二叉树还原成数组
     * 例:     1              => [1,2,3,4,null,6,7]
     *       /   \
     *      2     3
     *     /     / \
     *    4     6   7
     *  
     *    
     * @param BinaryTreeNode $root
     * @return array
     */
    public static function ToArray(BinaryTreeNode $root){
        if(!$root) return [];
        $list = [$root];
        $ret = [];
        $len = 0;
        while($list){
            $node = array_shift($list);
            if($node){
                $ret[] = $node->val;
                array_push($list,$node->left,$node->right);
            } else {
                $ret[] = null;
            }
            $len++;
        }
        
        ////去除队尾多余的null
        for($i = $len -1;$i > 0;$i--){
            $val = $ret[$i];
            if($val !== null){
                break;
            } else {
                unset($ret[$i]);
            }
        }
        return $ret;
    }
}