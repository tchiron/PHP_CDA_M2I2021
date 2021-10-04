<?php

namespace App\Model;

use DateTime;

class Article
{
    /**
     * @var int Identifiant de l'article
     */
    protected int $id;

    /**
     * @var string Titre de l'article
     */
    protected string $title;

    /**
     * @var string Contenu de l'article
     */
    protected string $content;

    /**
     * @var string Date et heure de l'article
     */
    protected string $created_at;

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created_at
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    /**
     * Get the value of created_at
     *
     * @return string
     */
    public function getCreatedAtFormat(): string
    {
        return (new DateTime($this->created_at))->format('l d F Y à G:i:s');
    }

    /**
     * Set the value of created_at
     *
     * @param DateTime $created_at
     *
     * @return self
     */
    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at->format('Y-m-d G:i:s');

        return $this;
    }
}
