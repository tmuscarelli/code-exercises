<?php

class Node {
    public $value;
    public $next;
    public function __construct($value) {
        $this->value = $value;
        $this->next = null;
    }
}

class SortedLinkedList {
    private $head = null;
    private $type = null;

    public function insert($value) {
        $t = gettype($value);
        if (!in_array($t, ['integer', 'string'])) {
            throw new Exception("Only int or string allowed");
        }
        if ($this->type === null) {
            $this->type = $t;
        } elseif ($this->type !== $t) {
            throw new Exception("Cannot mix int and string");
        }

        $node = new Node($value);
        if ($this->head === null || $value < $this->head->value) {
            $node->next = $this->head;
            $this->head = $node;
            return;
        }

        $cur = $this->head;
        while ($cur->next && $cur->next->value < $value) {
            $cur = $cur->next;
        }
        $node->next = $cur->next;
        $cur->next = $node;
    }

    public function printList() {
        $cur = $this->head;
        while ($cur) {
            echo $cur->value . " ";
            $cur = $cur->next;
        }
        echo "\n";
    }
}

// Example
/*
$l = new SortedLinkedList();
$l->insert(5);
$l->insert(2);
$l->insert(8);
$l->printList(); // 2 5 8
*/
