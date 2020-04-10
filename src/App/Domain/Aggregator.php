<?php

namespace App\Domain;

use App\Domain\Model\Visit;
use App\Domain\Source\Provider;

class Aggregator
{
    /**
     * @var Provider[] $_providers
     */
    private $_providers;

    /**
     * Aggregator constructor.
     * @param Provider[] $providers
     */
    public function __construct(Provider ...$providers)
    {
        $this->_providers = $providers;

        array_walk($this->_providers, function (Provider $provider) {
            $provider->fetch();
        });
    }

    public function aggregate(): array
    {
        $data = [];

        /* @var Provider $provider */
        foreach ($this->_providers as $provider) {
            /* @var Visit $visit */
            foreach ($provider->getData() as $visit) {
                if (!empty($data[$visit->getVisitor()])) {
                    $data[$visit->getVisitor()] += $visit->getVisits();
                } else {
                    $data[$visit->getVisitor()] = $visit->getVisits();
                }
            }
        }

        return $data;
    }
}