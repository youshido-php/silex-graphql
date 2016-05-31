<?php

namespace Youshido\Silex\Traits;

/**
 * Date: 5/31/16
 *
 * @author Portey Vasil <portey@gmail.com>
 */
trait ContainerAwareTrait
{

    /** @var \Pimple\Container */
    protected $container;

    /**
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param \Pimple\Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }
}
