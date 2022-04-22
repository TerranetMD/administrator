<?php

namespace Terranet\Administrator\Field;

use Carbon\Carbon;

class DateTime extends Field
{
    /** @var string */
    public $dateFormat = 'M j, Y';

    /** @var string */
    public $timeFormat = 'g:i A';

    /** @var string */
    public $dateTimeFormat = 'M j, Y g:i A';

    /**
     * @return array
     */
    public function onIndex(): array
    {
        $format = [
            self::class => $this->dateTimeFormat,
            Date::class => $this->dateFormat,
            Time::class => $this->timeFormat,
        ][get_class($this)];

        $date = Carbon::parse($this->value());

        return [
            'formatted' => $date->format($format),
            'formattedDate' => $date->format($this->dateFormat),
            'formattedTime' => $date->format($this->timeFormat),
            'formattedFull' => $date->format($this->dateTimeFormat),
        ];
    }

    /**
     * @return array
     */
    public function onView(): array
    {
        return $this->onIndex();
    }

    /**
     * @param string $format
     *
     * @return self
     */
    public function setDateTimeFormat(string $format): self
    {
        $this->dateTimeFormat = $format;

        return $this;
    }

    /**
     * @param string $dateFormat
     *
     * @return self
     */
    public function setDateFormat(string $dateFormat): self
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    /**
     * @param string $timeFormat
     *
     * @return self
     */
    public function setTimeFormat(string $timeFormat): self
    {
        $this->timeFormat = $timeFormat;

        return $this;
    }
}
