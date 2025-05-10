<?php
include 'connect.php'; // your DB connection

function getCategory($standard) {
    if ($standard >= 1 && $standard <= 4) return 'Primary';
    if ($standard >= 5 && $standard <= 7) return 'Middle';
    if ($standard >= 8 && $standard <= 10) return 'Secondary';
    return '';
}

function getTeachersByCategory($conn, $category) {
    $teachers = [];
    $sql = "SELECT teacher_id, category FROM teachers WHERE FIND_IN_SET(?, category)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $subjects = explode(',', $row['category']);
        foreach ($subjects as $subject) {
            if (trim($subject) == $category) {
                $teachers[] = $row['teacher_id'];
                break;
            }
        }
    }
    return $teachers;
}

function getPreferences($conn, $standard, $section) {
    $preferences = [];
    $sql = "SELECT teacher_id, subject_id FROM preferences WHERE standards = ? AND section = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $standard, $section);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $preferences[] = $row;
    }
    return $preferences;
}

function getSubjectSlotCount($timetable, $subject_id) {
    $count = 0;
    foreach ($timetable as $day => $slots) {
        foreach ($slots as $slot => $entry) {
            if ($entry['subject_id'] == $subject_id) $count++;
        }
    }
    return $count;
}

function fillTimetable($teachers, $preferences) {
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $slots = ['Slot 1', 'Slot 2', 'Slot 3', 'Slot 4', 'Slot 5', 'Slot 6'];

    $timetable = [];
    foreach ($days as $day) {
        $timetable[$day] = [];
        foreach ($slots as $slot) {
            $timetable[$day][$slot] = null;
        }
    }

    // First: Fill with preferences
    foreach ($preferences as $pref) {
        $subject_id = $pref['subject_id'];
        $teacher_id = $pref['teacher_id'];

        // fill 5 slots per subject from preferences
        $filled = 0;
        foreach ($days as $day) {
            foreach ($slots as $slot) {
                if ($timetable[$day][$slot] == null) {
                    $timetable[$day][$slot] = ['teacher_id' => $teacher_id, 'subject_id' => $subject_id];
                    $filled++;
                    if ($filled >= 5) break 2;
                }
            }
        }
    }

    // Second: Fill remaining with random eligible assignments
    foreach ($days as $day) {
        foreach ($slots as $slot) {
            if ($timetable[$day][$slot] == null) {
                // pick random teacher and subject
                $rand_teacher = $teachers[array_rand($teachers)];
                $sql = "SELECT subject_id FROM preferences WHERE teacher_id = ?";
                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->bind_param("s", $rand_teacher);
                $stmt->execute();
                $res = $stmt->get_result();
                $subs = [];
                while ($r = $res->fetch_assoc()) $subs[] = $r['subject_id'];

                if (!empty($subs)) {
                    $subject = $subs[array_rand($subs)];
                    $timetable[$day][$slot] = ['teacher_id' => $rand_teacher, 'subject_id' => $subject];
                }
            }
        }
    }

    return $timetable;
}

// === MAIN EXECUTION ===
$standard = 8;
$section = 'A';
$school_code = 'SCH001'; // can be dynamic

$category = getCategory($standard);
$teachers = getTeachersByCategory($conn, $category);
$preferences = getPreferences($conn, $standard, $section);

$timetable = fillTimetable($teachers, $preferences);

// Insert into DB
foreach ($timetable as $day => $slots) {
    $sql = "INSERT INTO timetable (school_code, Day, `Slot 1`, `Slot 2`, `Slot 3`, `Slot 4`, `Slot 5`, `Slot 6`, standard, section)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssss",
        $school_code,
        $day,
        $slots['Slot 1']['subject_id'],
        $slots['Slot 2']['subject_id'],
        $slots['Slot 3']['subject_id'],
        $slots['Slot 4']['subject_id'],
        $slots['Slot 5']['subject_id'],
        $slots['Slot 6']['subject_id'],
        $standard,
        $section
    );
    $stmt->execute();
}

echo "Timetable generated successfully for Standard $standard Section $section.";
?>
