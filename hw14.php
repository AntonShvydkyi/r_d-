<?php
class StackQueue
{
    private $data = [];

    public function add($element)
    {
        $this->data[] = $element;
    }


    public function get()
    {
        if (!$this->isEmpty()) {
            return array_pop($this->data);
        } else {
            return null;
        }
    }

    public function count()
    {
        return count($this->data);
    }
    public function clear()
    {
        $this->data = [];
    }
    public function isEmpty()
    {
        return empty($this->data);
    }
}

$stackQueue = new StackQueue();
$stackQueue->add("Element 1");
$stackQueue->add("Element 2");
$stackQueue->add("Element 3");

echo $stackQueue->get();
echo $stackQueue->count();

$stackQueue->clear();
echo $stackQueue->isEmpty() ? "Empty" : "Not Empty";

