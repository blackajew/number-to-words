<?php

namespace BlackJew\NumberToWords\Language;

interface ExponentGetter
{
    /**
     * @param int $power
     *
     * @return string
     */
    public function getExponent($power);
}
