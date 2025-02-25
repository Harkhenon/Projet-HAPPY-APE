<?php
namespace App\Serializer\Normalizer;
use App\Entity\Event;
use App\Entity\News;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
class PublicDataNormalizer implements NormalizerInterface {
    
    /**
     * @var ObjectNormalizer
     */
    private $objectNormalizer;

    public function __construct(ObjectNormalizer $objectNormalizer)
    {
        $this->objectNormalizer = $objectNormalizer;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $context['ignored_attributes'] = ['user'];
        $data = $this->objectNormalizer->normalize($object, $format, $context);
        return $data;
    }
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Event || $data instanceof News;
    }
}