<?php

namespace Bbsnly\ChartJs\Config;

interface ConfigInterface extends \JsonSerializable
{
    /**
     * Flags used for every JSON serialization in this package. The HEX
     * flags make the output safe to embed directly in HTML.
     */
    public const JSON_FLAGS = JSON_THROW_ON_ERROR | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT;

    /**
     * @return array<string, mixed>
     */
    public function get(): array;

    public function toJson(): string;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
