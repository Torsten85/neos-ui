<?php
namespace Neos\Neos\Ui\Fusion;

use Neos\Neos\Ui\Domain\Service\StateRenderingService;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Exception;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class RenderStateImplementation extends AbstractFusionObject
{

    /**
     * @Flow\Inject
     * @var StateRenderingService
     */
    protected $stateRenderingService;

    /**
     * @Flow\InjectConfiguration(path="state")
     * @var array
     */
    protected $stateInSettings;

    protected function getContext()
    {
        return $this->tsValue('context');
    }

    protected function getState()
    {
        return $this->tsValue('state');
    }


    /**
     * Appends an item to the given collection
     *
     * @return string
     * @throws Exception
     */
    public function evaluate()
    {
        $context = $this->getContext();
        $stateNameToRender = $this->getState();
        $context['controllerContext'] = $this->getTsRuntime()->getControllerContext();

        if (!isset($this->stateInSettings[$stateNameToRender])) {
            throw new Exception('The state "Neos.Neos.Ui.state.' . $stateNameToRender . '" was not found in the settings.', 1458814468);
        }

        return $this->stateRenderingService->computeState($this->stateInSettings[$stateNameToRender], $context);
    }
}