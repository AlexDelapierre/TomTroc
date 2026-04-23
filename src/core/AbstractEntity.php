<?php

namespace App\Core;

abstract class AbstractEntity
{
    protected ?int $id = null;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    protected function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            // Transformation de user_id en setUserId
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
