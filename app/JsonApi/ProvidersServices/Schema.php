<?php

namespace App\JsonApi\ProvidersServices;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'providers-services';

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
            'services_catalogue_id' => $resource->services_catalogue_id,
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
            ]
        ];
    }
}
