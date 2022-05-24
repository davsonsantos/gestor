<?php

namespace Source\Models\Admin;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\DataLayer\Connect;
/**
 * Class Category
 * @package Source\Models
 */
class Category extends DataLayer
{
    /**
     * Category constructor.
     */
    public function __construct()
    {
        parent::__construct("categories", ["title", "description"]);
    }

    /**
     * @param string $uri
     * @param string $columns
     * @return null|Category
     */
    public function findByUri(string $uri, string $columns = "*"): ?Category
    {
        $find = $this->find("uri = :uri", "uri={$uri}", $columns);
        return $find->fetch();
    }

    /**
     * @return Post
     */
    public function posts(): Post
    {
        return (new Post())->find("category_id = :id", "id={$this->id}");
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $checkUri = (new Category())->find("uri = :uri AND id != :id", "uri={$this->uri}&id={$this->id}");

        if ($checkUri->count()) {
            $this->uri = "{$this->uri}-". $this->lastId();
        }

        return parent::save();
    }

    /**
     * @return int
     */
    public function lastId(): int
    {
        return Connect::getInstance()->query("SELECT MAX(id) as maxId FROM categories")->fetch()->maxId + 1;
    }
}