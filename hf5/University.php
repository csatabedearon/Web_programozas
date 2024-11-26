<?php

require_once 'AbstractUniversity.php';

class University extends AbstractUniversity {

    public function getStudentsForSubject(string $subjectCode): array {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() === $subjectCode) {
                return $subject->getStudents();
            }
        }
        return [];
    }

    public function addStudentOnSubject(string $subjectCode, Student $student): void {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() === $subjectCode) {
                $subject->addStudent($student);
                return;
            }
        }
        throw new Exception("Subject not found: $subjectCode");
    }

    public function addSubject(string $code, string $name): void {
        if ($this->isSubjectExists($code)) {
            throw new Exception("Subject already exists.");
        }
        $this->subjects[] = new Subject($code, $name);
    }

    public function deleteSubject(Subject $subject): void {
        if (!empty($subject->getStudents())) {
            throw new Exception("Cannot delete a subject with enrolled students.");
        }
        foreach ($this->subjects as $key => $existingSubject) {
            if ($existingSubject->getCode() === $subject->getCode()) {
                unset($this->subjects[$key]);
                return;
            }
        }
    }

    private function isSubjectExists(string $code): bool {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() === $code) {
                return true;
            }
        }
        return false;
    }

    public function getSubjectByCode(string $code): ?Subject {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() === $code) {
                return $subject;
            }
        }
        return null;
    }
}
