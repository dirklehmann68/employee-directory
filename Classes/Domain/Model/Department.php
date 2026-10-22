<?php

// Der Namespace ordnet diese Klasse unserer Extension und dem Bereich
// "Domain/Model" zu. Er entspricht der Ordnerstruktur unter Classes/.
namespace DirkLehmann\EmployeeDirectory\Domain\Model;

// Importiert die TYPO3-Extbase-Basisklasse für Domain-Modelle.
// Dadurch können wir später einfach "AbstractEntity" verwenden,
// statt den vollständigen Klassennamen ausschreiben zu müssen.
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Repräsentiert eine Abteilung im Mitarbeiterverzeichnis.
 */
class Department extends AbstractEntity
{
    // Name der Abteilung, z. B. "Verwaltung" oder "IT".
    protected string $title = '';

    // Gibt den Namen der Abteilung zurück.
    public function getTitle(): string
    {
        return $this->title;
    }

    // Setzt den Namen der Abteilung.
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}