<?php
namespace lib;

/**
 * 单链表的节点定义
 *
 * @author zhaojian
 *
 */
class LinkNode{
    public $val;
    public $next;
    
    public function __construct($val){
        $this->val = $val;
    }
    
    /**
     * 工具方法，将给定的数组转化成一个链表
     * 如 [1,2,3,4] => node(1)->node(2)->node(3)->node(4)
     * 
     * 方便构造一个链表
     * 
     * @param array $array
     * @return \lib\LinkedNode
     */
    public static function BuildLinkedList(array $array){
        $pre = null;
        $head = null;
        foreach ($array as $val){
            $node = new LinkNode($val);
            if(!$pre){
                $pre = $node;
                $head = $node;
            } else {
                $pre->next = $node;
                $pre = $node;
            }
        }
        return $head;
    }
    
    /**
     * 工具方法 BuildLinkedList 的反向方法,将链表转化成数组
     * 如 node(1)->node(2)->node(3)->node(4) => [1,2,3,4]
     * 
     * 方便查看一个链表的结构
     * 
     * @param LinkedNode $head
     * @return array
     */
    public static function LinkListToArray(LinkNode $head){
        $node = $head;
        $ret = [];
        while ($node){
            $ret[] = $node->val;
            $node = $node->next;
        }
        return $ret;
    }
}
