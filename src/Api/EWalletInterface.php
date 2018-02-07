<?php

namespace DemianShtepa\Payture\Api;

use DemianShtepa\Payture\Exceptions\PaytureException;

interface EWalletInterface
{
    /**
     * @param string $VWUserLgn
     * @param string $VWUserPsw
     * @param array $data
     *
     * @return array
     *
     * @throws PaytureException
     */
    public function GetList(string $VWUserLgn, string $VWUserPsw, $data = []): array;
}