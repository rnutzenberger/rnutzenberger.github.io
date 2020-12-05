<?php
    //Generates 10 numbers from 1-10 and puts it in a array
    //and shuffles
    function GenerateNumbers()
    {

        global $status;         //global variable for the status 
        //concatenate the status string when this function fires
        $status .= "+GenerateNumbers";
        $arr = array();
        for($i = 0; $i < 10; ++$i)
        {
            $arr[$i] = $i+1;
        }
        shuffle($arr);
        return $arr;
    }

    //makes the array into an html list
    function MakeList($array)
    {
        global $status;
        //concatenate the status string when this function fires
        $status .= "+MakeList";
        $list = "<ol>";
        for($i = 0; $i < count($array); ++$i)
        {
            $list .= "<li>$array[$i]</li>";
        }
        $list .= "</ul>";
        return $list;
    }
?>