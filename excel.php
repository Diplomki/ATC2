<?php
require_once 'secure.php';

if (!Helper::can('admin')) {
    header('Location: 404');
    exit();
}

// Импортируем необходимые классы из PHPExcel
require 'phpoffice/phpexcel/Classes/PHPExcel.php';

$fileName = "Оценки_" . time() . ".xlsx";

$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();

$fields = array('fio', 'subject', 'grade', 'date');

// Записываем заголовки столбцов
$col = 'A';
foreach ($fields as $field) {
    $sheet->setCellValue($col . '1', $field);
    $col++;
}

$gradeMap = new GradeMap();
$grades = $gradeMap->findBySubjectId($_SESSION['subject_id']);

if ($grades) {
    $row = 2;
    foreach ($grades as $grade) {
        $col = 'A';
        foreach ($fields as $field) {
            $sheet->setCellValue($col . $row, $grade->$field);
            $col++;
        }
        $row++;
    }
} else {
    $sheet->setCellValue('A2', "no records found...");
}

// Устанавливаем заголовки для файла Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

// Выводим содержимое в браузер
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>