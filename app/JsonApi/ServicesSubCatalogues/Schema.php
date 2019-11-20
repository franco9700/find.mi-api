<?php

namespace App\JsonApi\ServicesSubCatalogues;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'services-sub-catalogues';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'services_catalogue_id' => $resource->services_catalogue_id,
            'title'=> $resource->title,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }
}
