# Mask

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phlllpe/mask/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phlllpe/mask/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/phlllpe/mask/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phlllpe/mask/?branch=master)
[![Build Status](https://travis-ci.org/phlllpe/mask.svg?branch=master)](https://travis-ci.org/phlllpe/mask)
- Mask


## Install

``` sh
composer require phlllpe/mask
```

## Usage

```php

        use Mask\Predefined\Br\Cep;
        use Mask\Predefined\Br\Cpf;

        ...

        public function foo($cepValue)
        {
            ...
            $maskCep = new Cep()->mask($cepValue)->toString();
            ...
        }

        public function bar($cpfValue)
        {
            ...
            echo new Cpf()->mask($cpfValue);
            ...
        }

```
