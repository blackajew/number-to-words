<?php

namespace BlackJew\NumberToWords\CurrencyTransformer;

use BlackJew\NumberToWords\Exception\NumberToWordsException;
use BlackJew\NumberToWords\Language\English\EnglishDictionary;
use BlackJew\NumberToWords\Language\English\EnglishExponentGetter;
use BlackJew\NumberToWords\Language\English\EnglishTripletTransformer;
use BlackJew\NumberToWords\NumberTransformer\NumberTransformerBuilder;
use BlackJew\NumberToWords\Service\NumberToTripletsConverter;

class EnglishCurrencyTransformer implements CurrencyTransformer
{
    /**
     * {@inheritdoc}
     *
     * @throws NumberToWordsException
     * @return string
     */
    public function toWords($amount, $currency, $options = null)
    {
        $dictionary = new EnglishDictionary();
        $numberToTripletsConverter = new NumberToTripletsConverter();
        $tripletTransformer = new EnglishTripletTransformer($dictionary);
        $exponentInflector = new EnglishExponentGetter();

        $numberTransformer = (new NumberTransformerBuilder())
            ->withDictionary($dictionary)
            ->withWordsSeparatedBy(' ')
            ->transformNumbersBySplittingIntoTriplets($numberToTripletsConverter, $tripletTransformer)
            ->useRegularExponents($exponentInflector)
            ->build();

        $decimal = $currency != 'UGX' ? (int) ($amount / 100) : (int) ($amount);
        $fraction = $currency != 'UGX' ? abs($amount % 100) : abs($amount % 1);

        if ($fraction === 0) {
            $fraction = null;
        }

        $currency = strtoupper($currency);

        if (!array_key_exists($currency, EnglishDictionary::$currencyNames)) {
            throw new NumberToWordsException(
                sprintf('Currency "%s" is not available for "%s" language', $currency, get_class($this))
            );
        }

        $currencyNames = EnglishDictionary::$currencyNames[$currency];

        $return = trim($numberTransformer->toWords($decimal));
        $level = ($decimal === 1) ? 0 : 1;

        if ($level > 0) {
            if (count($currencyNames[0]) > 1) {
                $return .= ' ' . $currencyNames[0][$level];
            } else {
                $return .= ' ' . $currencyNames[0][0] . 's';
            }
        } else {
            $return .= ' ' . $currencyNames[0][0];
        }

        if (null !== $fraction) {
            $return .= ' ' . trim($numberTransformer->toWords($fraction));

            $level = $fraction === 1 ? 0 : 1;

            if ($level > 0) {
                if (count($currencyNames[1]) > 1) {
                    $return .= ' ' . $currencyNames[1][$level];
                } else {
                    $return .= ' ' . $currencyNames[1][0] . 's';
                }
            } else {
                $return .= ' ' . $currencyNames[1][0];
            }
        }

        return $return;
    }
}
