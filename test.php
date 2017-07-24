function high_order_bitmask ($wordSize)
{
    $half = $wordSize / 2;
    $mask = "";
    for ($i = 1; $i = $wordSize, $i++)
    {
        $mask .= ($i <= $half) ? "1" : "0";
    }
    
    echo $mask;
}

high_order_bitmask(2);
