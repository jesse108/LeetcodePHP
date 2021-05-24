<?php
use lib\LinkNode;
require_once dirname(__FILE__) .'/autoload.php';

$a = [1,2,3,4];
$node = LinkNode::BuildLinkedList($a);