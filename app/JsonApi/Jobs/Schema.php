<?php

namespace App\JsonApi\Jobs;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'jobs';

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
            'user_id' => $resource->user_id,
            'jobs_status_id' => $resource->jobs_status_id,
            'providers_service_id' => $resource->providers_service_id,
            'short_description' => $resource->short_description,
            'detailed_description' => $resource->detailed_description,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }
}
