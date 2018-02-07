<?php

namespace DemianShtepa\Payture;

use DemianShtepa\Payture\Exceptions\PaytureException;

interface XmlConverterInterface
{
    /**
     * @param string $xml
     *
     * @return array
     *
     * @throws PaytureException
     */
    public function convert(string $xml): array;
}