<?php

namespace App\Ship\Services;

use ReflectionMethod;

class ReflectionApiService
{
    private $reflectionMethod;
    private $calledObject;
    private $calledMethod;

    public function __construct()
    {
        $this->reflectionMethod = null;
        $this->calledObject = null;
        $this->calledMethod = null;
    }

    public static function initService()
    {
        return new self();
    }

    public function initReflectionMethod($object, $calledMethod)
    {
        $this->reflectionMethod = new ReflectionMethod($object, $calledMethod);
        $this->calledObject = $object;
        $this->calledMethod = $calledMethod;

        return $this;
    }

    public function runWithArguments(...$arg)
    {
        if($this->reflectionMethod instanceof ReflectionMethod) {
            $this->makeAccessible();
            return $this->reflectionMethod->invokeArgs($this->calledObject, $arg);
        }
    }

    public function runWithOutArguments()
    {
        if($this->reflectionMethod instanceof ReflectionMethod) {
            $this->makeAccessible();
            return $this->reflectionMethod->invoke($this->calledObject);
        }
    }

    private function makeAccessible() {
        if(!$this->reflectionMethod->isPublic()) {
            $this->reflectionMethod->setAccessible(true);
        }
    }

}
