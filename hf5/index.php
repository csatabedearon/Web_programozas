<?php

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

$university = new University();

// Add subjects
$university->addSubject("101", "Mathematics");
$university->addSubject("102", "Physics");
$university->addSubject("103", "Chemistry");
$university->addSubject("104", "Biology");

// Add students
$student1 = new Student("Alice", 1);
$student2 = new Student("Bob", 2);
$student3 = new Student("Charlie", 3);
$student4 = new Student("Diana", 4);

// Enroll students in subjects
$university->addStudentOnSubject("101", $student1);
$university->addStudentOnSubject("101", $student2);
$university->addStudentOnSubject("102", $student2);
$university->addStudentOnSubject("102", $student3);
$university->addStudentOnSubject("103", $student1);
$university->addStudentOnSubject("103", $student4);
$university->addStudentOnSubject("104", $student3);
$university->addStudentOnSubject("104", $student4);

// Retrieve subjects
$subject101 = $university->getSubjectByCode("101");
$subject102 = $university->getSubjectByCode("102");
$subject103 = $university->getSubjectByCode("103");
$subject104 = $university->getSubjectByCode("104");

// Assign grades
$student1->setGrade($subject101, 8.5);
$student1->setGrade($subject103, 9.0);
$student2->setGrade($subject101, 7.5);
$student2->setGrade($subject102, 8.0);
$student3->setGrade($subject102, 6.5);
$student3->setGrade($subject104, 7.0);
$student4->setGrade($subject103, 9.5);
$student4->setGrade($subject104, 8.5);

// Print students and their grades
echo "Student Grades:" . PHP_EOL;
$students = [$student1, $student2, $student3, $student4];
foreach ($students as $student) {
    echo $student->getName() . " (Student Number: " . $student->getStudentNumber() . "):" . PHP_EOL;
    $student->printGrades();
    echo "Average Grade: " . $student->getAvgGrade() . PHP_EOL . PHP_EOL;
}

// Test deleting a subject with enrolled students
try {
    $university->deleteSubject($subject101);
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}

// Remove students from a subject and delete it
$subject104->deleteStudent($student3);
$subject104->deleteStudent($student4);

try {
    $university->deleteSubject($subject104);
    echo "Subject 104 deleted successfully." . PHP_EOL;
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}

// Test adding a subject that already exists
try {
    $university->addSubject("101", "Advanced Mathematics");
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
}

// Test getting students for a subject
echo "Students enrolled in Physics (102):" . PHP_EOL;
$studentsInPhysics = $university->getStudentsForSubject("102");
foreach ($studentsInPhysics as $student) {
    echo "- " . $student->getName() . PHP_EOL;
}

// Test total number of students in the university
echo "Total number of student enrollments in the university: " . $university->getNumberOfStudents() . PHP_EOL;

// Print all subjects in the university
echo "Subjects offered by the university:" . PHP_EOL;
$university->print();
