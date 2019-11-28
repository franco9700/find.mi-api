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

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'user' => [
                self::SHOW_SELF => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA => isset($includeRelationships['user']),
                self::DATA => function () use ($resource) {
                    return $resource->user;
                }
            ],

            'jobs-status' => [
                self::SHOW_SELF => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA => isset($includeRelationships['jobs-status']),
                self::DATA => function () use ($resource) {
                    return $resource->jobsStatus;
                }
            ],
        ];
    }
}
