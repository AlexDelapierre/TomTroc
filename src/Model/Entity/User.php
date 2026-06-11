<?php

namespace App\Model\Entity;

use DateTimeImmutable;

use App\Core\AbstractEntity;

/****
 * Entité représentant un utilisateur de l'application
 */
class User extends AbstractEntity
{
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar = null;
    private DateTimeImmutable $createdAt;

    public function __construct(array $data = [])
    {
        $this->createdAt = new DateTimeImmutable();
        parent::__construct($data);
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
    public function setCreatedAt(string|DateTimeImmutable $createdAt): void
    {
        if (is_string($createdAt)) {
            $this->createdAt = new DateTimeImmutable($createdAt);
        } else {
            $this->createdAt = $createdAt;
        }
    }
    public function getAccountAge(): \DateInterval
    {
        $now = new DateTimeImmutable();
        return $this->createdAt->diff($now);
    }

    /**
     * Calcule et retourne la phrase d'ancienneté de l'utilisateur
     * Exemple : "2 ans 3 mois", "2 mois 10 jours" ou "aujourd'hui"
     * * @return string
     */
    public function getFormattedAnciennete(): string
    {
        $now = new \DateTimeImmutable();
        $age = $this->getCreatedAt()->diff($now);

        $parts = [];

        // 1. Gestion des années
        if ($age->y > 0) {
            $parts[] = $age->y . ($age->y > 1 ? " ans" : " an");
        }

        // 2. Gestion des mois
        if ($age->m > 0) {
            $parts[] = $age->m . " mois";
        }

        // 3. Gestion des jours (s'affichent en complément des mois/ans)
        if ($age->d > 0) {
            $parts[] = $age->d . ($age->d > 1 ? " jours" : " jour");
        }

        // 4. Sécurité : si l'utilisateur vient tout juste de s'inscrire aujourd'hui
        if (empty($parts)) {
            $parts[] = "aujourd'hui";
        }

        // On assemble les morceaux avec un espace
        return implode(' ', $parts);
    }
}
