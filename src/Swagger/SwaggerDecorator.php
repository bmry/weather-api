<?php

namespace App\Swagger;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SwaggerDecorator implements NormalizerInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);

        $countryCodeDefinition = [
            'name' => 'countryCode',
            'description' => 'Example: US',
            'in' => 'query',
            'items'=> ['type' => 'integer', 'example' => '44']
        ];

        $cityDefinition = [
            'name' => 'cityName',
            'description' => 'Example: London',
            'in' => 'query',
        ];


        // e.g. add a custom parameter
        $docs['paths']['/api/temperatures']['get']['parameters'][] = $countryCodeDefinition;
        $docs['paths']['/api/temperatures']['get']['parameters'][] = $cityDefinition;



        $docs['paths']['/api/temperatures']['get']['parameters'] = array_values(array_filter($docs['paths']['/api/temperatures']['get']['parameters'], function ($param) {
            return $param['name'] !== 'id';
        }));


        // Override title
        $docs['info']['title'] = 'MangaHigh Weather API';

        return $docs;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }
}