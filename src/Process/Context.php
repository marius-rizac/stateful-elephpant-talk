<?php

namespace Application\Process;

use Application\Process\Checkout\StepInterface;
use Symfony\Component\HttpFoundation\Request;

class Context
{
    /**
     * @var StepInterface[]
     */
    protected $steps;

    /**
     * @var StepInterface
     */
    protected $currentStep;

    /**
     * @var StepInterface|null
     */
    protected $nextStep;

    /**
     * @var StepInterface|null
     */
    protected $previousStep;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Coordinator
     */
    protected $coordinator;

    /**
     * @param StepInterface[] $steps
     * @param StepInterface $currentStep
     * @param Coordinator $coordinator
     */
    public function __construct(array $steps, StepInterface $currentStep, Coordinator $coordinator)
    {
        $this->steps = $steps;
        $this->currentStep = $currentStep;
        $this->coordinator = $coordinator;

        foreach ($steps as $index => $step) {
            if ($step === $currentStep) {
                $this->previousStep = $index-1 >= 0 ? $this->steps[$index-1] : null;
                $this->nextStep = $index+1 < count($this->steps) ?$this->steps[$index+1] : null;
            }
        }
    }

    /**
     * @return StepInterface
     */
    public function getCurrentStep()
    {
        return $this->currentStep;
    }

    /**
     * @return StepInterface
     */
    public function getPreviousStep()
    {
        return $this->previousStep;
    }

    /**
     * @return StepInterface
     */
    public function getNextStep()
    {
        return $this->nextStep;
    }

    /**
     * @return StepInterface
     */
    public function getFirstStep()
    {
        return $this->steps[0];
    }

    /**
     * @return StepInterface
     */
    public function getLastStep()
    {
        return end($this->steps);
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Coordinator
     */
    public function getCoordinator()
    {
        return $this->coordinator;
    }
}
