<?php

class Subject {
    private string $code;
    private string $name;
    private array $students = [];

    public function __construct(string $code, string $name) {
        $this->code = $code;
        $this->name = $name;
    }

    public function __toString(): string {
        return "{$this->name} ({$this->code})";
    }

    public function setCode(string $code): void {
        $this->code = $code;
    }

    public function getCode(): string {
        return $this->code;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function addStudent(Student $student): void {
        $this->students[] = $student;
    }

    public function deleteStudent(Student $student): bool {
        foreach ($this->students as $key => $enrolledStudent) {
            if ($enrolledStudent->getStudentNumber() === $student->getStudentNumber()) {
                unset($this->students[$key]);
                return true;
            }
        }
        return false;
    }

    public function getStudents(): array {
        return $this->students;
    }

    public function isStudentExists(int $studentNumber): bool {
        foreach ($this->students as $student) {
            if ($student->getStudentNumber() === $studentNumber) {
                return true;
            }
        }
        return false;
    }
}
