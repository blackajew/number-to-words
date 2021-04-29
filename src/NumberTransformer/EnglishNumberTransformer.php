<?php

namespace BlackJew\NumberToWords\NumberTransformer;

use BlackJew\NumberToWords\Language\English\EnglishDictionary;
use BlackJew\NumberToWords\Language\English\EnglishExponentGetter;
use BlackJew\NumberToWords\Language\English\EnglishTripletTransformer;
use BlackJew\NumberToWords\Service\NumberToTripletsConverter;

class EnglishNumberTransformer implements NumberTransformer
{
    /**
     * @inheritdoc
     */
    public function toWords($number)
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

        return $numberTransformer->toWords($number);
    }
}
