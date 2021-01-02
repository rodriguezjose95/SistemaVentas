
<?php 

	require '../Classes/PHPExcel.php';
	require '../Classes/PHPExcel/Writer/Excel2007.php';

	$objPHPExcel = new PHPExcel();

	$objPHPExcel -> getProperties() 
		-> setCreator('Tienda Ventura S.A.')
		-> setTitle('Clientes')
		-> setDescription('Reporte de Clientes')
		-> setKeywords('excel phpexcel php')
		-> setCategory('Reportes');

	$objPHPExcel -> getActiveSheetIndex(0);
	$objPHPExcel -> getActiveSheet() -> setTitle('Hoja1');

	$objPHPExcel -> getActiveSheet() -> setCellValue('A1','PHPExcel');
	$objPHPExcel -> getActiveSheet() -> setCellValue('A2',123.56);
	$objPHPExcel -> getActiveSheet() -> setCellValue('A3',TRUE);
	$objPHPExcel -> getActiveSheet() -> setCellValue('A4','=CONCATENATE(A1," ",A2)');

	$objPHPExcel->setActiveSheetIndex(0);

	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save('temp/nombredearchivo.xlsx');

 ?>