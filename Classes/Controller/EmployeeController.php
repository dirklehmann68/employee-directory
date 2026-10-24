<?php

namespace DirkLehmann\EmployeeDirectory\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use DirkLehmann\EmployeeDirectory\Domain\Repository\EmployeeRepository;
use DirkLehmann\EmployeeDirectory\Domain\Repository\JobFunctionRepository;
use DirkLehmann\EmployeeDirectory\Domain\Repository\DepartmentRepository;
use DirkLehmann\EmployeeDirectory\Domain\Model\Employee;
use Psr\Http\Message\ResponseInterface;

class EmployeeController extends ActionController
{
    public function __construct(
        private readonly EmployeeRepository $employeeRepository,
        private readonly JobFunctionRepository $jobFunctionRepository,
        private readonly DepartmentRepository $departmentRepository
    ) {
    }

    public function listAction(
        string $initial = '',
        string $name = '',
        int $jobFunction = 0,
        int $department = 0
    ): ResponseInterface
    {
        if ($name !== '' || $jobFunction > 0 || $department > 0 || $initial !== '') {
            $employees = $this->employeeRepository->findFiltered(
                $name,
                $jobFunction,
                $department,
                $initial
            );
        } else {
            $employees = $this->employeeRepository->findAll();
        }

        $letters = range('A', 'Z');
        $availableInitials = $this->employeeRepository->findAvailableInitials(
            $name,
            $jobFunction,
            $department
        );
        $usedJobFunctionIds = $this->employeeRepository->findUsedJobFunctionIds();
        $usedDepartmentIds = $this->employeeRepository->findUsedDepartmentIds();

        $jobFunctions = [];
        foreach ($this->jobFunctionRepository->findAll() as $functionItem) {
            if (in_array($functionItem->getUid(), $usedJobFunctionIds, true)) {
                $jobFunctions[] = $functionItem;
            }
        }

        $departments = [];
        foreach ($this->departmentRepository->findAll() as $departmentItem) {
            if (in_array($departmentItem->getUid(), $usedDepartmentIds, true)) {
                $departments[] = $departmentItem;
            }
        }

        $this->view->assign('letters', $letters);
        $this->view->assign('availableInitials', $availableInitials);
        $this->view->assign('employees', $employees);
        $this->view->assign('selectedInitial', $initial);
        $this->view->assign('selectedName', $name);
        $this->view->assign('jobFunctions', $jobFunctions);
        $this->view->assign('selectedJobFunction', $jobFunction);
        $this->view->assign('departments', $departments);
        $this->view->assign('selectedDepartment', $department);
        $this->view->assign(
            'isStandaloneList',
            $this->request->getPluginName() === 'EmployeeListOnly'
        );

        return $this->htmlResponse();
    }

    public function showAction(int $employee): ResponseInterface
    {
        $employee = $this->employeeRepository->findByUid($employee);

        if ($employee === null) {
            $response = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                \TYPO3\CMS\Frontend\Controller\ErrorController::class
            )->pageNotFoundAction(
                $this->request,
                'Das angeforderte Mitarbeiterprofil konnte nicht gefunden werden.'
            );

            throw new \TYPO3\CMS\Core\Http\PropagateResponseException(
                $response,
                1761292800
            );
        }

        $this->view->assign('employee', $employee);

        $this->view->assign(
            'isStandaloneDetail',
            $this->request->getPluginName() === 'EmployeeDetail'
        );

        return $this->htmlResponse();
    }

    public function filterAction(
        string $name = '',
        int $jobFunction = 0,
        int $department = 0,
        string $initial = ''
    ): ResponseInterface
    {
        $name = trim($name);

        return $this->redirect(
            'list',
            arguments: [
                'name' => $name,
                'jobFunction' => $jobFunction,
                'department' => $department,
                'initial' => $initial,
            ]
        );
    }
}