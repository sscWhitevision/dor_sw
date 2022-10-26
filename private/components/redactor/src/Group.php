<?php

namespace modmore\Redactor;

final class Group {
    /** @var  string */
    protected $name;
    /** @var Setting[] */
    protected $settings = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addSetting(Setting $setting): self
    {
        $this->settings[] = $setting;
        return $this;
    }

    public function toArray(): array
    {
        $array = [
            'name' => $this->name,
            'layout' => 'form',
            'labelAlign' => 'top',
            'defaults' => [
                'anchor' => '100%'
            ],
            'items' => [],
        ];

        foreach ($this->settings as $setting) {
            $array['items'][] = $setting->toArray();
        }
        return $array;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Setting[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }
}