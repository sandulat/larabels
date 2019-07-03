<?php

declare(strict_types=1);

namespace Sandulat\Larabels\Domain;

final class Label
{
    /**
     * Label text.
     *
     * @var string
     */
    private $text;

    /**
     * Label key.
     *
     * @var string
     */
    private $key;
    
    /**
     * Label slug.
     *
     * @var string
     */
    private $slug;

    /**
     * Create a new label instance.
     *
     * @param array $label
     * @param string $key
     * @param string $parentSlug
     */
    public function __construct(string $label, string $key, string $parentSlug = null)
    {
        $this->text = $label;

        $this->key = $key;

        $this->slug = $parentSlug ? $parentSlug.'.'.$key : $key;
    }

    /**
     * Returns label key.
     *
     * @return string
     */
    public function key(): string
    {
        return $this->key;
    }

    /**
     * Returns label text.
     *
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * Returns label slug.
     *
     * @return string
     */
    public function slug(): string
    {
        return $this->slug;
    }

    /**
     * Returns label slug formatted for frontend input.
     *
     * @return string
     */
    public function slugForInput(): string
    {
        return collect(explode('.', $this->slug))->map(static function ($item, $key) {
            if ($key > 0) {
                return '['.$item.']';
            }

            return $item;
        })->implode('');
    }
}
