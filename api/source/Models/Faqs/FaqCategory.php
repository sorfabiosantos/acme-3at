<?php

namespace Source\Models\Faqs;

use Source\Core\Model;

class FaqCategory extends Model
{
    private ?int $id;
    private ?string $name;
    private ?int $active;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?int $active = 1
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->active = $active;

        $this->table = 'faqs_categories';
        $this->primaryKey = 'id';
        $this->fillable = ['name', 'active'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }
}
