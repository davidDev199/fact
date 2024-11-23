<?php

namespace App\Services\Sunat;

use App\Traits\Sunat\UtilTrait;
use DateTime;
use Greenter\Model\Voided\Voided;
use Greenter\Model\Voided\VoidedDetail;

class VoidedService
{
    use UtilTrait;

    public function getVoided($data)
    {
        return (new Voided())
            ->setCorrelativo($data['correlativo'])
            ->setFecGeneracion(new DateTime($data['fecGeneracion'] ?? null))
            ->setFecComunicacion(new DateTime($data['fecComunicacion'] ?? null))
            ->setCompany($this->getCompany())
            ->setDetails($this->getVoidedDetails($data['details']));
    }

    public function getVoidedDetails($details)
    {
        $greenDetails = [];

        foreach ($details as $detail) {
            $greenDetails[] = (new VoidedDetail())
                ->setTipoDoc($detail['tipoDoc']) // Factura - Catalog. 01
                ->setSerie($detail['serie'])
                ->setCorrelativo($detail['correlativo'])
                ->setDesMotivoBaja($detail['desMotivoBaja']);
        }

        return $greenDetails;
    }
}