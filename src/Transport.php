<?php

namespace DemianShtepa\Payture;

use DemianShtepa\Payture\Exceptions\PaytureException;
use DemianShtepa\streams\Stream;

class Transport implements TransportInterface
{
    /**
     * @var XmlConverterInterface
     */
    private $xmlConverter;

    /**
     * Transport constructor.
     *
     * @param XmlConverterInterface|null $xmlConverter
     */
    public function __construct(XmlConverterInterface $xmlConverter = null)
    {
        if ($xmlConverter === null) {
            $xmlConverter = new XmlConverter;
        }

        $this->xmlConverter = $xmlConverter;
    }

    /**
     * @param string $url
     * @param string $merchant
     * @param array $data
     *
     * @return array
     *
     * @throws PaytureException
     */
    public function send(string $url, string $merchant, array $data): array
    {
        $stream = new Stream($url);

        $stream->pushPost([
            'VWID' => $merchant,
            'DATA' => Helper::stringify($data)
        ]);

        $stream->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $stream->setOpt(CURLOPT_RETURNTRANSFER, true);

        $response = $stream->exec();

        return $this->xmlConverter->convert($response);
    }
}