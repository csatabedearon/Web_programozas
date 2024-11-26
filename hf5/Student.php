<?php

class Student {
    private string $name;
    private int $studentNumber;
    private array $grades = [];

    public function __construct(string $name, int $studentNumber) {
        $this->name = $name;
        $this->studentNumber = $studentNumber;
    }

    public function setStudentNumber(int $studentNumber): void {
        $this->studentNumber = $studentNumber;
    }

    public function getStudentNumber(): int {
        return $this->studentNumber;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setGrade(Subject $subject, float $grade): void {
        $this->grades[$subject->getCode()] = $grade;
    }

    public function getAvgGrade(): float {
        if (empty($this->grades)) {
            return 0.0;
        }
        return array_sum($this->grades) / count($this->grades);
    }

    public function printGrades(): void {
        foreach ($this->grades as $subjectCode => $grade) {
            echo "$subjectCode - $grade" . PHP_EOL;
        }
    }
}
