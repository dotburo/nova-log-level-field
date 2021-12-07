<?php

namespace Dotburo\NovaErrorLevel;

use Laravel\Nova\Fields\Text;
use Psr\Log\LogLevel;

/**
 * Nova error level field base class.
 *
 * @copyright 2021 dotburo
 * @author dotburo <code@dotburo.org>
 */
class ErrorLevelField extends Text
{
    /** @var array */
    const LEVEL_COLORS = [
        LogLevel::EMERGENCY => '#7F1D1D',
        LogLevel::ALERT => '#991B1B',
        LogLevel::CRITICAL => '#B91C1C',
        LogLevel::ERROR => '#DC2626',
        LogLevel::WARNING => '#D97706',
        LogLevel::NOTICE => '#059669',
        LogLevel::INFO => '#2563EB',
        LogLevel::DEBUG => 'transparent; color: unset; border: 1px dashed',
    ];

    /** @inheritDoc */
    public function jsonSerialize()
    {
        if (!$this->isLevel($this->value)) {
            return parent::jsonSerialize();
        }

        $this->meta['asHtml'] = true;

        $styles = $this->getBadgeStyles($this->value, $this->meta['colors'] ?? []);

        $classes = $this->getBadgeClasses($this->value, $this->meta['small'] ?? false);

        $this->value = "<span class='$classes' style='background: $styles'>$this->value</span>";

        return parent::jsonSerialize();
    }

    /**
     * Show a small badge.
     * @return $this
     */
    public function small(): ErrorLevelField
    {
        return $this->withMeta(['small' => true]);
    }

    /**
     * Override default colors.
     * @param array $colors
     * @return $this
     */
    public function colors(array $colors = []): ErrorLevelField
    {
        return $this->withMeta(['colors' => $colors]);
    }

    /**
     * Build the CSS class list.
     * @param string $level
     * @param bool $small
     * @return string
     */
    protected function getBadgeClasses(string $level, bool $small = false): string
    {
        $small = $small ? 'text-sm px-2' : 'px-4 py-1';

        return "text-white rounded $small badge-$level";
    }

    /**
     * Build the CSS style attribute value.
     * @param string $level
     * @param array $colors
     * @return string
     */
    protected function getBadgeStyles(string $level, array $colors = []): string
    {
        return $colors[$level] ?? static::LEVEL_COLORS[$level];
    }

    /**
     * Check if given level is valid.
     * @param string $level
     * @return bool
     */
    protected function isLevel(string $level): bool
    {
        return static::LEVEL_COLORS[$level] ?? false;
    }
}