<?php

declare(strict_types=1);

namespace Yiisoft\Log\ContextProvider;

/**
 * `CompositeContextProvider` allows to combine multiple context providers into one.
 */
final class CompositeContextProvider implements ContextProviderInterface
{
    /**
     * @var ContextProviderInterface[]
     */
    private readonly array $providers;

    public function __construct(
        ContextProviderInterface ...$providers
    ) {
        $this->providers = $providers;
    }

    #[\Override]
    public function getContext(): array
    {
        $contexts = [];
        foreach ($this->providers as $provider) {
            $contexts[] = $provider->getContext();
        }
        return array_merge(...$contexts);
    }
}
