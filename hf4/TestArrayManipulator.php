<?php

require_once 'ArrayManipulator.php';

// Test constructor and __toString method
$testArray = new ArrayManipulator(['name' => 'John', 'age' => 30]);
echo "Initial array:\n" . $testArray . "\n";

// Test __get method
echo "\n<br>Testing __get:\n";
echo "Name: " . $testArray->name . "\n";  // Expected: John
echo "Age: " . $testArray->age . "\n";    // Expected: 30
echo "Non-existent key: " . $testArray->nonExistentKey . "\n";  // Expected: null

// Test __set method
echo "\n<br>Testing __set:\n";
$testArray->city = 'New York';
echo "Updated array with 'city':\n" . $testArray . "\n"; // Expected: city is added

// Test __isset method
echo "\n<br>Testing __isset:\n";
echo isset($testArray->name) ? "Name is set\n" : "Name is not set\n";  // Expected: Name is set
echo isset($testArray->nonExistentKey) ? "Key exists\n" : "Key does not exist\n";  // Expected: Key does not exist

// Test __unset method
echo "\nTesting __unset:\n";
unset($testArray->age);
echo "After unsetting 'age':\n" . $testArray . "\n";  // Expected: age is removed

// Test __clone method
echo "\nTesting __clone:\n";
$clonedArray = clone $testArray;
$clonedArray->city = 'Los Angeles';  // Change in cloned array should not affect original
echo "Original array after clone modification:\n" . $testArray . "\n";  // Expected: city remains 'New York'
echo "Cloned array after modification:\n" . $clonedArray . "\n";  // Expected: city is 'Los Angeles'

