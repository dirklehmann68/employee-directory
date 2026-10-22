<?php

namespace DirkLehmann\EmployeeDirectory\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class EmployeeRepository extends Repository
{
    protected $defaultOrderings = [
        'lastName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
        'firstName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
    ];
    public function findFiltered(
        string $name = '',
        int $jobFunction = 0,
        int $department = 0,
        string $initial = ''
    ) {
        $query = $this->createQuery();
        $constraints = [];

        if ($name !== '') {
            $constraints[] = $query->like('lastName', '%' . $name . '%');
        }
        if ($jobFunction > 0) {
            $constraints[] = $query->equals('jobFunction', $jobFunction);
        }
        if ($department > 0) {
            $constraints[] = $query->equals('department', $department);
        }
        if ($initial !== '') {
            $constraints[] = $query->like('lastName', $initial . '%');
        }
        if ($constraints !== []) {
            $query->matching(
                $query->logicalAnd(...$constraints)
            );
        }

        return $query->execute();
    }

    public function findUsedDepartmentIds(): array
    {
        $ids = [];

        foreach ($this->findAll() as $employee) {
            $department = $employee->getDepartment();

            if ($department !== null) {
                $ids[$department->getUid()] = true;
            }
        }

        return array_keys($ids);
    }

    public function findUsedJobFunctionIds(): array
    {
        $ids = [];

        foreach ($this->findAll() as $employee) {
            $jobFunction = $employee->getJobFunction();

            if ($jobFunction !== null) {
                $ids[$jobFunction->getUid()] = true;
            }
        }

        return array_keys($ids);
    }

    public function findAvailableInitials(
        string $name = '',
        int $jobFunction = 0,
        int $department = 0
    ): array {
        $employees = $this->findFiltered(
            $name,
            $jobFunction,
            $department
        );

        $initials = [];

        foreach ($employees as $employee) {
            $lastName = $employee->getLastName();
            $initial = mb_strtoupper(mb_substr($lastName, 0, 1));
            $initial = strtr($initial, ['Ä' => 'A', 'Ö' => 'O', 'Ü' => 'U']);
            $initials[$initial] = true;
        }

        return $initials;
    }
}