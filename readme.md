# PHP Number to words converter

[![Travis](https://travis-ci.org/blackajew/number-to-words.svg?branch=main)](https://travis-ci.org/blackajew/number-to-words)
[![Code Climate](https://codeclimate.com/github/blackajew/number-to-words/badges/gpa.svg)](https://codeclimate.com/github/blackajew/number-to-words)
[![Test Coverage](https://codeclimate.com/github/blackajew/number-to-words/badges/coverage.svg)](https://codeclimate.com/github/blackajew/number-to-words/coverage)
[![Latest Stable Version](https://poser.pugx.org/blackajew/number-to-words/v/stable)](https://packagist.org/packages/blackajew/number-to-words)

This library allows you to convert a number to words.

## Installation

Add package to your composer.json by running:

```
$ composer require blackjew/number-to-words
```


## Usage

This library currently has two types of number-to-words transformations: number and currency. In order to use a specific transformer for certain language you need to create an instance of `NumberToWords` class and then call a method which creates a new instance of a transformer;

### Number Transformer

Before using a transformer, it must be created:

```php
use BlackJew\NumberToWords\NumberToWords;

// create the number to words "manager" class
$numberToWords = new NumberToWords();

// build a new number transformer using the RFC 3066 language identifier
$numberTransformer = $numberToWords->getNumberTransformer('en');
```

Then it can be used passing in numeric values to the `toWords()` method:

```php
$numberTransformer->toWords(5120); // outputs "five thousand one hundred twenty"
```

### Currency Transformer

Creating a currency transformer works just like a number transformer.

```php
use BlackJew\NumberToWords\NumberToWords;

// create the number to words "manager" class
$numberToWords = new NumberToWords();

// build a new currency transformer using the RFC 3066 language identifier
$currencyTransformer = $numberToWords->getCurrencyTransformer('en');
```

Then it can be used passing in numeric values for amount and ISO 4217 currency identifier to the `toWords()` method:

```php
$currencyTransformer->toWords(25000, 'UGX'); // outputs "twenty-five thousand ugandan shillings"
```

Bare in mind, the currency transformer accepts integers as the amount to transform. It means that if you store amounts as floats (e.g. 4.99) you need to multiply them by 100 and pass the integer (499) as an argument.

## Available locale

Language             | Identifier | Number | Currency |
---------------------|------------|--------|----------|
English              | en         | +      | +        |
