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

    // Optionaler Beschreibungstext der Abteilung.
    protected string $description = '';

    // Darstellung des Textes: Subline oder Fließtext.
    protected string $descriptionDisplay = 'subline';

    // Optionaler Link zu weiterführenden Informationen.
    protected string $detailLink = '';

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

    // Gibt den Beschreibungstext der Abteilung zurück.
    public function getDescription(): string
    {
        return $this->description;
    }

    // Setzt den Beschreibungstext der Abteilung.
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    // Gibt die gewählte Darstellungsart zurück.
    public function getDescriptionDisplay(): string
    {
        return $this->descriptionDisplay;
    }

    // Setzt die Darstellungsart.
    public function setDescriptionDisplay(string $descriptionDisplay): void
    {
        $this->descriptionDisplay = $descriptionDisplay;
    }

    // Gibt den optionalen Link zurück.
    public function getDetailLink(): string
    {
        return $this->detailLink;
    }

    // Setzt den optionalen Link.
    public function setDetailLink(string $detailLink): void
    {
        $this->detailLink = $detailLink;
    }
}