<?php

namespace DirkLehmann\EmployeeDirectory\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class DepartmentRepository extends Repository
{
    protected $defaultOrderings = [
        'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
    ];
}