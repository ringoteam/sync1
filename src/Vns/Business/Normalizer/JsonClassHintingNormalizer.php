<?php
namespace Vns\Business\Normalizer;
 
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
 
class JsonClassHintingNormalizer implements NormalizerInterface
{
    public function normalize($object, $format = null)
    {
        $data = array();
 
        $reflectionClass = new \ReflectionClass($object);
 
        /*
        $data['__jsonclass__'] = array(
            get_class($object),
            array(), // constructor arguments
        );*/
        $data = array();
        
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            if (strtolower(substr($reflectionMethod->getName(), 0, 3)) !== 'get') {
                continue;
            }
 
            if ($reflectionMethod->getNumberOfRequiredParameters() > 0) {
                continue;
            }
 
            $property = lcfirst(substr($reflectionMethod->getName(), 3));
            $value = $reflectionMethod->invoke($object);
 
            $data[$property] = $value;
        }
 
        return $data;
    }

    public function denormalize($data, $class, $format = null)
    {
        $class = $data['__jsonclass__'][0];
        $reflectionClass = new \ReflectionClass($class);
 
        $constructorArguments = $data['__jsonclass__'][1] ?: array();
 
        $object = $reflectionClass->newInstanceArgs($constructorArguments);
 
        //unset($data['__jsonclass__']);
 
        foreach ($data as $property => $value) {
            $setter = 'set' . $property;
            if (method_exists($object, $setter)) {
                $object->$setter($value);
            }
        }
 
        return $object;
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && 'json' === $format;
    }
 
    public function supportsDenormalization($data, $type, $format = null)
    {
        return isset($data['__jsonclass__']) && 'json' === $format;
    }
}