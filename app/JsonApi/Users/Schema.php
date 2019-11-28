<?php

namespace App\JsonApi\Users;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

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
            'firstname' => $resource->firstname,
            'lastname' => $resource->lastname,
            'birthdate' => $resource->birthdate,
            'gender' => $resource->gender,
            'phone' => $resource->phone,
            'address' => $resource->address,
            'email' => $resource->email,
            'password' => $resource->password,
            'score' => $resource->score,
            'profile_img' => $resource->profile_img,
            'role' => $resource->role,
            'created-at' => $resource->created_at->toAtomString(),
            'updated-at' => $resource->updated_at->toAtomString(),
        ];
    }

    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        return [
            'users-provider' => [
                self::SHOW_SELF => false,
                self::SHOW_RELATED => false,
                self::SHOW_DATA => isset($includeRelationships['users-provider']),
                self::DATA => function () use ($resource) {
                    return $resource->usersProvider;
                }
            ]
        ];
    }
}
