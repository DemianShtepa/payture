<?php

namespace DemianShtepa\Payture;

use DemianShtepa\Payture\Exceptions\PaytureException;

interface TransportInterface
{
    /**
     * @param string $url
     * @param string $merchant
     * @param array $data
     *
     * @return array
     *
     * @throws PaytureException
     */
    public function send(string $url, string $merchant, array $data): array;
}