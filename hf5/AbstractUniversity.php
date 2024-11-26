<?php

abstract class AbstractUniversity {
    protected array $subjects = [];

    abstract public function getStudentsForSubject(string $subjectCode): array;
    abstract public function addStudentOnSubject(string $subjectCode, Student $student): void;
    abstract public function addSubject(string $code, string $name): void;

    public function getSubjects(): array {
        return $this->subjects;
    }

    public function getNumberOfStudents(): int {
        $total = 0;
        foreach ($this->subjects as $subject) {
            $total += count($subject->getStudents());
        }
        return $total;
    }

    public function print(): void {
        foreach ($this->subjects as $subject) {
            echo $subject . PHP_EOL;
        }
    }
}
