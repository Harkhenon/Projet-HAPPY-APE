<?php 

namespace App\Serializer;
use App\Entity\Event;
use App\Entity\News;
use Symfony\Component\Routing\RouterInterface;
class CircularReferenceHandler
{
    /**
     * @var RouterInterface
     */
    private $router;
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    
    public function __invoke($object)
    {
        switch ($object) {
            case $object instanceof Event:
                return $object->getId();
            case $object instanceof News:
                return $object->getId();
        }
        return $object->getId();
    }
}