<?php

// Der Namespace ordnet diese Klasse unserer Extension und dem Bereich
// "Domain/Model" zu. Er entspricht der Ordnerstruktur unter Classes/.
namespace DirkLehmann\EmployeeDirectory\Domain\Model;

// Importiert die TYPO3-Extbase-Basisklasse für Domain-Modelle.
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Repräsentiert eine Funktion im Mitarbeiterverzeichnis,
 * z. B. "Projektleitung" oder "Verwaltungskraft".
 */
class JobFunction extends AbstractEntity
{
    // Bezeichnung der Funktion.
    protected string $title = '';

    // Gibt die Bezeichnung der Funktion zurück.
    public function getTitle(): string
    {
        return $this->title;
    }

    // Setzt die Bezeichnung der Funktion.
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}