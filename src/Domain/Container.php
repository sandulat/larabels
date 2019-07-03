<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Domain;

use Illuminate\Support\Collection;

final class Container
{
    /**
     * Localization labels collection.
     *
     * @var \Illuminate\Support\Collection
     */
    private $labels;

    /**
     * Localization containers collection.
     *
     * @var \Illuminate\Support\Collection
     */
    private $containers;

    /**
     * Container key.
     *
     * @var string
     */
    private $key;

    /**
     * Container slug.
     *
     * @var string
     */
    private $slug;

    /**
     * Create a new container instance.
     *
     * @param array $data
     * @param string $key
     * @param string $parentSlug
     */
    public function __construct(array $data, string $key, string $parentSlug = null)
    {
        $this->key = $key;

        $this->slug = $parentSlug ? $parentSlug.'.'.$key : $key;

        $this->parseData($data);
    }

    /**
     * Prases labels & containers.
     *
     * @param array $data
     * @return void
     */
    public function parseData(array $data): void
    {
        $collection = new Collection($data);

        $this->labels = $collection->filter(static function ($item) {
            return is_string($item);
        })->map(function ($item, $key) {
            return new Label($item, $key, $this->slug);
        });

        $this->containers = $collection->filter(static function ($item) {
            return is_array($item);
        })->map(function ($item, $key) {
            return new Container($item, $key, $this->slug);
        });
    }

    /**
     * Returns labels collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function labels(): Collection
    {
        return $this->labels;
    }

    /**
     * Returns containers collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function containers(): Collection
    {
        return $this->containers;
    }

    /**
     * Returns container key.
     *
     * @return string
     */
    public function key(): string
    {
        return $this->key;
    }

    /**
     * Returns container slug.
     *
     * @return string
     */
    public function slug(): string
    {
        return $this->slug;
    }
}
