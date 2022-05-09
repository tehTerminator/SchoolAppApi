<?php

namespace App\Http\Helper;

use Exception;
use Illuminate\Http\Request;

class Helper {
    private array $rules;
    private array $columns;

    public function extractData(Request $request) {
        return $request->only($this->columns);
    }

    public function getRules($includeUniqueFields = false)
    {
        if ($includeUniqueFields) 
        {
            return $this->rules;
        }

        $rules = $this->rules;
        foreach($this->getUniqueColumns() as $column)
        {
            $count = count($rules[$column]);
            for($i = 0; $i < $count; $i++) 
            {
                try
                {
                    if (strpos($rules[$column][$i], 'unique'))
                    {
                        unset($rules[$column][$i]);
                    }
                } 
                catch (Exception $e)
                {
                    continue;
                }
            }
        }
        return $rules;
    }

    private function getUniqueColumns() {
        $uniqueColumns = [];
        foreach($this->columns as $key => $value) 
        {
            if ($value)
            {
                array_push($uniqueColumns, $key);
            }
        }

        return $uniqueColumns;
    }

    private function containsUnique(array $rules)
    {
        foreach($rules as $item)
        {
            return strpos($item, 'unique');
        }
    }

    public function __construct(array $rules)
    {
        $this->rules = $rules;
        foreach($rules as $column => $rule) {
            if (count($rule) == 0) {
                unset($this->rules[$column]);
            }
            
            if ($this->containsUnique($rule)) {
                $this->column[$column] = true;
            }
            $this->column[$column] = false;
        }
    }
}