<?php

namespace BlackJew\NumberToWords\NumberTransformer;

use BlackJew\NumberToWords\Language\Dictionary;
use BlackJew\NumberToWords\Language\ExponentGetter;
use BlackJew\NumberToWords\Language\ExponentInflector;
use BlackJew\NumberToWords\Language\PowerAwareTripletTransformer;
use BlackJew\NumberToWords\Language\TripletTransformer;
use BlackJew\NumberToWords\Service\NumberToTripletsConverter;

class NumberTransformerBuilder
{
    /**
     * @var NumberTransformer
     */
    private $numberTransformer;

    public function __construct()
    {
        $this->numberTransformer = new GenericNumberTransformer();
    }

    /**
     * @param Dictionary $dictionary
     *
     * @return $this
     */
    public function withDictionary(Dictionary $dictionary)
    {
        $this->numberTransformer->setDictionary($dictionary);

        return $this;
    }

    /**
     * @param string $separator
     *
     * @return $this
     */
    public function withWordsSeparatedBy($separator)
    {
        $this->numberTransformer->setWordsSeparator($separator);

        return $this;
    }

    /**
     * @param string $separator
     *
     * @return $this
     */
    public function withExponentsSeparatedBy($separator)
    {
        $this->numberTransformer->setExponentsSeparator($separator);

        return $this;
    }

    /**
     * @param NumberToTripletsConverter $numberToTripletsConverter
     * @param TripletTransformer        $tripletTransformer
     *
     * @return $this
     */
    public function transformNumbersBySplittingIntoTriplets(
        NumberToTripletsConverter $numberToTripletsConverter,
        TripletTransformer $tripletTransformer
    ) {
        $this->numberTransformer->setNumberToTripletsConverter($numberToTripletsConverter);
        $this->numberTransformer->setTripletTransformer($tripletTransformer);

        return $this;
    }

    /**
     * @param NumberToTripletsConverter    $numberToTripletsConverter
     * @param PowerAwareTripletTransformer $powerAwareTripletTransformer
     *
     * @return $this
     */
    public function transformNumbersBySplittingIntoPowerAwareTriplets(
        NumberToTripletsConverter $numberToTripletsConverter,
        PowerAwareTripletTransformer $powerAwareTripletTransformer
    ) {
        $this->numberTransformer->setNumberToTripletsConverter($numberToTripletsConverter);
        $this->numberTransformer->setPowerAwareTripletTransformer($powerAwareTripletTransformer);

        return $this;
    }

    /**
     * @param ExponentInflector $exponentInflector
     *
     * @return $this
     */
    public function inflectExponentByNumbers(ExponentInflector $exponentInflector)
    {
        $this->numberTransformer->setExponentInflector($exponentInflector);

        return $this;
    }

    /**
     * @param ExponentGetter $exponentGetter
     *
     * @return $this
     */
    public function useRegularExponents(ExponentGetter $exponentGetter)
    {
        $this->numberTransformer->setExponentGetter($exponentGetter);

        return $this;
    }

    /**
     * @return NumberTransformer
     */
    public function build()
    {
        return $this->numberTransformer;
    }
}
