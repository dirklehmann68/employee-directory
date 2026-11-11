<?php

declare(strict_types=1);

namespace DirkLehmann\EmployeeDirectory\Backend\Form;

use TYPO3\CMS\Core\DataHandling\ItemsProcessorContext;
use TYPO3\CMS\Core\DataHandling\ItemsProcessorInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Schema\Struct\SelectItemCollection;
use TYPO3\CMS\Core\Schema\Struct\SelectItem;

final class DepartmentItemsProvider implements ItemsProcessorInterface
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
    }

    public function processItems(
        SelectItemCollection $items,
        ItemsProcessorContext $context,
    ): SelectItemCollection {
        $parentRow = $context->additionalParameters['flexParentDatabaseRow'] ?? [];

        $startingPoints = $parentRow['pages'] ?? '';

        if (is_array($startingPoints)) {
            $startingPoints = implode(',', $startingPoints);
        }

        $startingPoints = (string)$startingPoints;

        $pageIds = array_values(array_unique(array_filter(
            array_map('intval', explode(',', $startingPoints)),
            static fn (int $pageId): bool => $pageId > 0
        )));

        if ($pageIds === []) {
            return $items;
        }

        $queryBuilder = $this->connectionPool->getQueryBuilderForTable(
            'tx_employeedirectory_domain_model_department'
        );

        $departments = $queryBuilder
            ->select('uid', 'title')
            ->from('tx_employeedirectory_domain_model_department')
            ->where(
                $queryBuilder->expr()->in(
                    'pid',
                    $queryBuilder->createNamedParameter(
                        $pageIds,
                        \Doctrine\DBAL\ArrayParameterType::INTEGER
                    )
                )
            )
            ->andWhere(
                $queryBuilder->expr()->eq(
                    'hidden',
                    $queryBuilder->createNamedParameter(0, \Doctrine\DBAL\ParameterType::INTEGER)
                )
            )
            ->orderBy('title', 'ASC')
            ->executeQuery()
            ->fetchAllAssociative();

        foreach ($departments as $department) {
            $items->add(
                new SelectItem(
                    type: 'select',
                    label: (string)$department['title'],
                    value: (int)$department['uid']
                )
            );
        }

        return $items;
    }
}