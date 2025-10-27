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
    private $_type = null;

    public function insert($value) {
        $type = gettype($value);
        if (!in_array($type, ['integer', 'string'])) {
            throw new Exception("Only int or string allowed");
        }
        if ($this->_type === null) {
            $this->_type = $type;
        } elseif ($this->_type !== $type) {
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

    public function delete($value) {
        if ($this->head === null) return;

        if ($this->head->value === $value) {
            $this->head = $this->head->next;
            return;
        }

        $cur = $this->head;
        while ($cur->next && $cur->next->value !== $value) {
            $cur = $cur->next;
        }

        if ($cur->next) {
            $cur->next = $cur->next->next;
        }
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
$l->delete(5);
$l->printList(); // 2 8

Example with strings
$list = new SortedLinkedList();
$list->insert("pear");
$list->insert("apple");
$list->insert("orange");
$list->printList(); // Output: apple -> orange -> pear
