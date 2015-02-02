<?php

namespace Application\Process\Checkout;

use Twig_Environment;

abstract class AbstractStep implements StepInterface
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     * @param Twig_Environment $twig
     */
    public function __construct($name, Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
