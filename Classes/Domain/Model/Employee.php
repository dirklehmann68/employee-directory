<?php

namespace DirkLehmann\EmployeeDirectory\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Repräsentiert einen Mitarbeiter im Mitarbeiterverzeichnis.
 */
class Employee extends AbstractEntity
{
    // Vorname des Mitarbeiters.
    protected string $firstName = '';

    // Nachname des Mitarbeiters.
    protected string $lastName = '';

    // Optionaler Titel des Mitarbeiters, z. B. "Dr." oder "Prof.".
    protected string $title = '';
    
    // Telefonnummer des Mitarbeiters.
    protected string $phone = '';

    // E-Mail-Adresse des Mitarbeiters.
    protected string $email = '';

    // Raum des Mitarbeiters, z. B. "B 2.14".
    protected string $room = '';

    // Standort des Mitarbeiters, z. B. "Lübeck" oder "Hauptgebäude".
    protected string $location = '';

    // Sprechzeiten des Mitarbeiters, z. B. "Mo–Do 09:00–12:00 Uhr".
    protected string $officeHours = '';

    // Beschreibung des Mitarbeiters für die Detailansicht.
    protected string $description = '';

    // Abteilung, der der Mitarbeiter zugeordnet ist.
    protected ?Department $department = null;

    // Funktion, die der Mitarbeiter ausübt.
    protected ?JobFunction $jobFunction = null;

    // Bild des Mitarbeiters als Referenz auf eine Datei in TYPO3.
    protected ?FileReference $image = null;



    // Gibt den Vornamen zurück.
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    // Setzt den Vornamen.
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    // Gibt den Nachnamen zurück.
    public function getLastName(): string
    {
        return $this->lastName;
    }

    // Setzt den Nachnamen.
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    // Gibt den Titel zurück.
    public function getTitle(): string
    {
        return $this->title;
    }

    // Setzt den Titel.
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    // Gibt die Telefonnummer zurück.
    public function getPhone(): string
    {
        return $this->phone;
    }

    // Setzt die Telefonnummer.
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    // Gibt die E-Mail-Adresse zurück.
    public function getEmail(): string
    {
        return $this->email;
    }

    // Setzt die E-Mail-Adresse.
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    // Gibt den Raum zurück.
    public function getRoom(): string
    {
        return $this->room;
    }

    // Setzt den Raum.
    public function setRoom(string $room): void
    {
        $this->room = $room;
    }

    // Gibt den Standort zurück.
    public function getLocation(): string
    {
        return $this->location;
    }

    // Setzt den Standort.
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
    
    // Gibt die Sprechzeiten zurück.
    public function getOfficeHours(): string
    {
        return $this->officeHours;
    }

    // Setzt die Sprechzeiten.
    public function setOfficeHours(string $officeHours): void
    {
        $this->officeHours = $officeHours;
    }

    // Gibt die Beschreibung zurück.
    public function getDescription(): string
    {
        return $this->description;
    }

    // Setzt die Beschreibung.
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    // Gibt die zugeordnete Abteilung zurück.
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    // Ordnet dem Mitarbeiter eine Abteilung zu.
    public function setDepartment(?Department $department): void
    {
        $this->department = $department;
    }

    // Gibt die zugeordnete Funktion zurück.
    public function getJobFunction(): ?JobFunction
    {
        return $this->jobFunction;
    }

    // Ordnet dem Mitarbeiter eine Funktion zu.
    public function setJobFunction(?JobFunction $jobFunction): void
    {
        $this->jobFunction = $jobFunction;
    }

    // Gibt das Bild des Mitarbeiters zurück.
    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    // Setzt das Bild des Mitarbeiters.
    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }
}
