<?php

namespace modmore\Redactor;

final class Setting {
    /** @var string */
    protected $name;
    /** @var mixed */
    protected $default;
    /** @var string */
    protected $type;
    /** @var callable */
    protected $callback;

    /**
     * Setting constructor.
     * @param string $name
     * @param mixed $default
     * @param string $type
     * @param callable|null $callback
     */
    public function __construct(string $name, string $default, string $type = 'textfield', callable $callback = null)
    {
        $this->name = $name;
        $this->default = $default;
        $this->type = $type;
        $this->callback = $callback ?: static function($value) { return $value; };
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'default' => $this->default,
            'type' => $this->type,
        ];
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
     * @return string
     */
    public function getXType(): string
    {
        if ($this->type === 'checkbox') {
            return 'xcheckbox';
        }
        return $this->type;
    }

    public function call($value)
    {
        return call_user_func($this->callback, $value);
    }

    public static function castToArray(): callable
    {
        return static function($value) {
            $value = trim($value);
            if ('' === $value) {
                return [];
            }
            return array_map('trim', explode(',', $value));
        };
    }

    public static function castJSONToObject(): callable
    {
        return static function ($value) {
            $array = json_decode($value, true);
            if (!is_array($array)) {
                return [];
            }
            return $array;
        };
    }

    public static function castToBool(): callable
    {
        return static function($value) {
            if (in_array(strtolower($value), array('false', 'no'), true)) {
                return false;
            }
            return (bool)$value;
        };
    }

    public static function castToPixelOrFalse(): callable
    {
        return static function($value) {
            $value = (int)$value;
            if ($value === 0) {
                return false;
            }
            return $value . 'px';
        };
    }

    public static function castToStringOrFalse(): callable
    {
        return static function($value) {
            if ($value === 'false' || empty($value)) {
                return false;
            }
            return (string)$value;
        };
    }

    public static function castToIntOrFalse(): callable
    {
        return static function($value) {
            $value = (int)$value;
            if ($value === 0) {
                return false;
            }
            return (string)$value;
        };
    }

    public static function castToClipsArray(): callable
    {
        return static function ($value) {
            $value = json_decode($value, true);
            if (!is_array($value)) {
                return '';
            }
            $array = [];
            foreach ($value as $item) {
                // Automatically convert Redactor 2 to Redactor 3 syntax
                if (array_key_exists('clip', $item)) {
                    $array[] = [$item['title'], $item['clip']];
                }
                else {
                    $array[] = $item;
                }
            }
            return $array;
        };
    }
}