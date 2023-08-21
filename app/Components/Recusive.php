<?php
namespace App\Components;

use App\Models\Category;

class Recusive
{
    private $data;
    private $htmlSelect = '';
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function CategoriesShow($parent_Id, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if(!empty($parent_Id) && $parent_Id == $value['id'] ) {
                    $this->htmlSelect .=
                                "<option selected value='" . $value['id'] . "'>" . $text . $value['name'] . '</option>';
                    $this->CategoriesShow($parent_Id, $value['id'], $text . '--');
                }else {
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['name'] . '</option>';
                }
                $this->CategoriesShow($parent_Id, $value['id'], $text . '--');
            }
        }
        return $this->htmlSelect;
    }



}
