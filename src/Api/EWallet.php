<?php

namespace DemianShtepa\Payture\Api;

use DemianShtepa\Payture\Configuration;
use DemianShtepa\Payture\Helper;
use DemianShtepa\Payture\Transport;
use DemianShtepa\Payture\TransportInterface;

class EWallet
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var TransportInterface
     */
    private $transport;

    /**
     * EWallet constructor.
     *
     * @param Configuration $configuration
     * @param TransportInterface|null $transport
     */
    public function __construct(
        Configuration $configuration,
        TransportInterface $transport = null
    )
    {
        $this->configuration = $configuration;

        if ($transport === null) {
            $transport = new Transport();
        }

        $this->transport = $transport;
    }

    /**
     * @param string $VWUserLgn
     * @param string $VWUserPsw
     * @param array $data
     *
     * @return mixed
     */
    public function GetList(string $VWUserLgn, string $VWUserPsw, $data = [])
    {
        $params = array_merge([
            "VWUserLgn" => $VWUserLgn,
            "VWUserPsw" => $VWUserPsw,
        ], $data);

        $url = Helper::getEWalletUrl($this->configuration->getUrl(), 'GetList');

        return $this->transport->send(
            $url,
            $this->configuration->getMerchantByType(Configuration::TYPE_MERCHANT_ADD),
            $params
        );
    }
}