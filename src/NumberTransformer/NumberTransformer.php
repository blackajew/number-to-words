<?php

namespace BlackJew\NumberToWords\NumberTransformer;

interface NumberTransformer
{
    /**
     * @param int $number
     *
     * @return string
     */
    public function toWords($number);
}
