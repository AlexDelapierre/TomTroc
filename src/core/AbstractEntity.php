<?php

namespace App\Core;

/**
 * Entité de base fournissant des méthodes communes à toutes les entités
 */
abstract class AbstractEntity
{
    protected ?int $id = null;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Hydrate l'entité à partir d'un tableau de données
     * Permet de remplir les propriétés de l'entité en utilisant les setters correspondants
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            // Transformation de user_id en setUserId
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Retourne l'ID de l'entité
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Définit l'ID de l'entité
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
