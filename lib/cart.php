<?php

class Item {

    var $item_id;
    var $item_name;
    var $qty;
    var $price;
    var $img_file;//added
    var $deleted = false;

    function get_item_cost() {
        return $this->qty * $this->price;
    }

    function delete_item() {
        $this->deleted = true;
    }

    function Item($item_id, $item_name, $qty, $price, $img_file) {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->qty = $qty;
        $this->price = $price;
        $this->img_file = $img_file; //added
    }

    function get_item_id() {
        return $this->item_id;
    }

    function get_item_name() {
        return $this->item_name;
    }

    function get_qty() {
        return $this->qty;
    }
    //-----------------------
    function set_qty($new_qty){
        $this->qty = $new_qty;
    }
    //-----------------------
    function get_price() {
        return $this->price;
    }
    // added
    function get_img_file(){
        return $this->img_file;
    }
}









class Cart {

    var $items;
    var $depth;

    function Cart() {
        $this->items = array();
        $this->depth = 0;
    }

    function add_item($item) {
        $this->items[$this->depth] = $item;
        $this->depth++;
    }

    function delete_item($item_no) {
        $this->items[$item_no]->delete_item();
    }

    function get_depth() {
        return $this->depth;
    }

    function get_item($item_no) {
        return $this->items[$item_no];
    }

}

?>