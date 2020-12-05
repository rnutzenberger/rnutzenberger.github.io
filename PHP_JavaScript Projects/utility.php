
<?php
    function GenerateNumbers()
    {
        $arr = array();
        for($i = 0; $i < 10; ++$i)
        {
            $arr[$i] = $i+1;
        }
        shuffle($arr);
        return $arr;
    }

    function MakeList($array)
    {
        $list = "<ol>";
        for($i = 0; $i < count($array); ++$i)
        {
            $list .= "<li>$array[$i]</li>";
        }
        $list .= "</ul>";
        return $list;
    }
?>