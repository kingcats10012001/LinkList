<?php

class ListNode
{
    public $data;
    public $next;
    /* tao node */
    function __construct($data)
    {
        $this->data = $data;
        $this->next = NULL;
    }
    //doc node
    function readNode()
    {
        return $this->data;
    }
}

class LinkList
{
    private $firstNode;
    private $lastNode;

    /* all nodes in the list */
    private $count;

    /* Hàm tạo danh sách*/
    function __construct()
    {
        $this->firstNode = NULL;
        $this->lastNode = NULL;
        $this->count = 0;
    }

    public function isEmpty()
    {
        return ($this->firstNode == NULL);
    }

    public function insertFirst($data)
    {
        $link = new ListNode($data);
        $link->next = $this->firstNode;
        $this->firstNode = &$link;

        /* If this is the first node inserted in the list
           then set the lastNode pointer to it.
        */
        if ($this->lastNode == NULL)
            $this->lastNode = &$link;

        $this->count++;
    }

    public function insertLast($data)
    {
        if ($this->firstNode != NULL) {
            $link = new ListNode($data);
            $this->lastNode->next = $link;
            $link->next = NULL;
            $this->lastNode = &$link;
            $this->count++;
        } else {
            $this->insertFirst($data);
        }
    }

    public function deleteFirstNode()
    {
        $temp = $this->firstNode;
        $this->firstNode = $this->firstNode->next;
        if ($this->firstNode != NULL)
            $this->count--;

        return $temp;
    }

    public function deleteLastNode()
    {
        if ($this->firstNode != NULL) {
            if ($this->firstNode->next == NULL) {
                $this->firstNode = NULL;
                $this->count--;
            } else {
                $previousNode = $this->firstNode;
                $currentNode = $this->firstNode->next;

                while ($currentNode->next != NULL) {
                    $previousNode = $currentNode;
                    $currentNode = $currentNode->next;
                }

                $previousNode->next = NULL;
                $this->count--;
            }
        }
    }

    public function deleteNode($key)
    {
        $current = $this->firstNode;
        $previous = $this->firstNode;

        while ($current->data != $key) {
            if ($current->next == NULL)
                return NULL;
            else {
                $previous = $current;
                $current = $current->next;
            }
        }

        if ($current == $this->firstNode) {
            if ($this->count == 1) {
                $this->lastNode = $this->firstNode;
            }
            $this->firstNode = $this->firstNode->next;
        } else {
            if ($this->lastNode == $current) {
                $this->lastNode = $previous;
            }
            $previous->next = $current->next;
        }
        $this->count--;
    }

    public function find($key)
    {
        $current = $this->firstNode;
        while ($current->data != $key) {
            if ($current->next == NULL)
                return null;
            else
                $current = $current->next;
        }
        return $current;
    }

    public function readNode($nodePos)
    {
        if ($nodePos <= $this->count) {
            $current = $this->firstNode;
            $pos = 1;
            while ($pos != $nodePos) {
                if ($current->next == NULL)
                    return null;
                else
                    $current = $current->next;

                $pos++;
            }
            return $current->data;
        } else
            return NULL;
    }

    public function totalNodes()
    {
        return $this->count;
    }

    public function readList()
    {
        $listData = array();
        $current = $this->firstNode;

        while ($current != NULL) {
            array_push($listData, $current->readNode());
            $current = $current->next;
        }
        return $listData;
    }

    public function reverseList()
    {
        if ($this->firstNode != NULL) {
            if ($this->firstNode->next != NULL) {
                $current = $this->firstNode;
                $new = NULL;

                while ($current != NULL) {
                    $temp = $current->next;
                    $current->next = $new;
                    $new = $current;
                    $current = $temp;
                }
                $this->firstNode = $new;
            }
        }
    }
}

$linkedList = new LinkList();
$linkedList->insertFirst(11);
$linkedList->insertFirst(22);
$linkedList->insertLast(33);
$linkedList->insertLast(44);
$linkData = $linkedList->readList();
echo implode('-', $linkData);
echo "\n";
$linkedList->deleteFirstNode();
$linkData = $linkedList->readList();
echo implode(',',$linkData);