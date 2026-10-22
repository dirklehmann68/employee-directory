<?php

declare(strict_types=1);

namespace DirkLehmann\EmployeeDirectory\Hooks;

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class PreventAssignedRecordDeletionHook
{
    private const EMPLOYEE_TABLE =
        'tx_employeedirectory_domain_model_employee';

    private const PROTECTED_RELATIONS = [
        'tx_employeedirectory_domain_model_department' => 'department',
        'tx_employeedirectory_domain_model_jobfunction' => 'job_function',
    ];

    public function processCmdmap_deleteAction(
        string $table,
        int $id,
        array $record,
        bool &$recordWasDeleted,
        DataHandler $dataHandler
    ): void {
        // Andere Tabellen nicht beeinflussen.
        if (!isset(self::PROTECTED_RELATIONS[$table])) {
            return;
        }

        $field = self::PROTECTED_RELATIONS[$table];

        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable(self::EMPLOYEE_TABLE);

        $queryBuilder = $connection->createQueryBuilder();

        // Auch ausgeblendete Mitarbeiter berücksichtigen.
        // Gelöschte Mitarbeiter dagegen nicht mitzählen.
        $count = (int)$queryBuilder
            ->count('uid')
            ->from(self::EMPLOYEE_TABLE)
            ->where(
                $queryBuilder->expr()->eq(
                    $field,
                    $queryBuilder->createNamedParameter($id)
                )
            )
            ->executeQuery()
            ->fetchOne();

        if ($count === 0) {
            // Keine Zuordnung: TYPO3 darf normal löschen.
            return;
        }

        // Löschvorgang verhindern.
        $recordWasDeleted = true;

        // Fehlermeldung im TYPO3-Protokoll hinterlegen.
        $dataHandler->log(
            $table,
            $id,
            3,
            0,
            2,
            'Löschen verhindert: Der Datensatz wird noch von '
                . $count . ' Mitarbeiter(n) verwendet.',
            0,
            []
        );
    }
}