<?php

namespace core;

/**
 * Gestionnaire de rendu
 *
 * @author : Thibaut CHIRON
 */
class Renderer
{
    /**
     * @var Renderer Contient une instance d'elle-même
     */
    protected static Renderer $instance;

    /**
     * @var string Contient le chemin du dossier des vues
     */
    protected string $pathView;

    /**
     * @param string|null $pathView Chemin du dossier des vues, par défaut c'est le dossier views à la racine du projet
     */
    public function __construct(?string $pathView)
    {
        $this->pathView = $pathView ?? implode(DIRECTORY_SEPARATOR, ['..', 'views']);
    }

    /**
     * Un singleton permettant de ne créer qu'une instance de Renderer
     * Et de la récupérer autant de fois qu'on le souhaites
     *
     * @return Renderer
     */
    public static function getInstance(?string $pathView = null): Renderer
    {
        return self::$instance ?? self::$instance = new Renderer($pathView);
    }

    /**
     * Génères le rendu html
     *
     * @param string[] $pathBaseView Chemin vers le fichier html de base depuis la racine du dossier des vues
     * @param string[] $pathContentView Chemin vers le fichier html de contenu depuis la racine du dossier des vues
     * @param array $options Tableau associatif de variable pour les fichiers html dont la clé est le nom de la variable
     * dans les fichiers de vues et la valeur sa valeur
     */
    public function render(array $pathBaseView, array $pathContentView, array $options = []): void
    {
        array_unshift($pathBaseView, $this->pathView);
        array_unshift($pathContentView, $this->pathView);

        extract($options);

        ob_start();
        require implode(DIRECTORY_SEPARATOR, $pathContentView);
        $content = ob_get_clean();
        require implode(DIRECTORY_SEPARATOR, $pathBaseView);
    }
}