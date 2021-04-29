<?php

namespace BlackJew\NumberToWords;

use BlackJew\NumberToWords\CurrencyTransformer\CurrencyTransformer;
use BlackJew\NumberToWords\CurrencyTransformer\EnglishCurrencyTransformer;
use BlackJew\NumberToWords\NumberTransformer\EnglishNumberTransformer;
use BlackJew\NumberToWords\NumberTransformer\NumberTransformer;


class NumberToWords
{
    private $numberTransformers = [
        'en' => EnglishNumberTransformer::class,
    ];

    private $currencyTransformers = [
        'en' => EnglishCurrencyTransformer::class
    ];

    /**
     * @param string $language
     *
     * @throws \InvalidArgumentException
     * @return NumberTransformer
     */
    public function getNumberTransformer($language)
    {
        if (!array_key_exists($language, $this->numberTransformers)) {
            throw new \InvalidArgumentException(sprintf(
                'Number transformer for "%s" language is not implemented.',
                $language
            ));
        }

        return new $this->numberTransformers[$language];
    }

    /**
     * @param string $language
     *
     * @throws \InvalidArgumentException
     * @return CurrencyTransformer
     */
    public function getCurrencyTransformer($language)
    {
        if (!array_key_exists($language, $this->currencyTransformers)) {
            throw new \InvalidArgumentException(sprintf(
                'Currency transformer for "%s" language is not implemented.',
                $language
            ));
        }

        return new $this->currencyTransformers[$language];
    }
}
