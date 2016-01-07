<?php $basePath="http://".$_SERVER['SERVER_NAME']."/AwesomeConversionScript/script/"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Awesome Conversion Script is a script for import/export CSV, Excel, PDF, Database, Array, HTML, SQL, XML.This provide the easy way to convert one format file into another.">
<title>Awesome Conversion Script</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $basePath;?>css/bootstrap.min.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/bootstrap-responsive.min.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/style.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/styleButton.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>css/styletable.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $basePath;?>themes/obsidian.css" type="text/css" media="screen" title="default" />
<script src="<?php echo $basePath;?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/ajax.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/common.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/validation.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>js/rainbow.min.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>language/generic.js" type="text/javascript"></script>
<script src="<?php echo $basePath;?>language/php.js" type="text/javascript"></script>
</head>
<body>
<div id="main">
<header>
   <h1><strong>Awesome Conversion Script</strong></h1>
   <h2>Import/Export <strong>CSV, Excel, PDF, Database , Array, HTML, SQL, XML</strong> </h2>
   <div id="menu">
      <ul class="main-ul">
         <li><a href="<?php echo $basePath;?>csv/import/importDB.php">CSV</a>
            <ul>
               <li><a href="#">Convert To</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>csv/import/importDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>csv/import/importExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>csv/import/importHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>csv/import/importPDF.php">PDF</a></li>
                     <li><a href="<?php echo $basePath;?>csv/import/importXML.php">XML</a></li>
                  </ul>
               </li>
               <li><a href="#">Generate From</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>csv/export/exportDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>csv/export/exportExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>csv/export/exportHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>csv/export/exportSQL.php">SQL</a></li>
                     <li><a href="<?php echo $basePath;?>csv/export/exportXML.php">XML</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="<?php echo $basePath;?>db/import/importCSV.php">DB</a>
            <ul>
               <li><a href="#">Convert To</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>db/import/importCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>db/import/importExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>db/import/importHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>db/import/importPDF.php">PDF</a></li>
                     <li><a href="<?php echo $basePath;?>db/import/importXML.php">XML</a></li>
                  </ul>
               </li>
               <li><a href="#">Generate From</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>db/export/exportCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>db/export/exportExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>db/export/exportHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>db/export/exportXML.php">XML</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="<?php echo $basePath;?>excel/import/importCSV.php">EXCEL</a>
            <ul>
               <li><a href="#">Convert To</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>excel/import/importCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>excel/import/importDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>excel/import/importHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>excel/import/importPDF.php">PDF</a></li>
                     <li><a href="<?php echo $basePath;?>excel/import/importXML.php">XML</a></li>
                  </ul>
               </li>
               <li><a href="#">Generate From</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>excel/export/exportCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>excel/export/exportDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>excel/export/exportHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>excel/export/exportSQL.php">SQL</a></li>
                     <li><a href="<?php echo $basePath;?>excel/export/exportXML.php">XML</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="<?php echo $basePath;?>html/import/importCSV.php">HTML TABLE</a>
            <ul>
               <li><a href="#">Convert To</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>html/import/importCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>html/import/importDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>html/import/importExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>html/import/importPDF.php">PDF</a></li>
                     <li><a href="<?php echo $basePath;?>html/import/importxml.php">XML</a></li>
                  </ul>
               </li>
               <li><a href="#">Generate From</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>html/export/exportCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>html/export/exportDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>html/export/exportExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>html/export/exportSQL.php">SQL</a></li>
                     <li><a href="<?php echo $basePath;?>html/export/exportXML.php">XML</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="<?php echo $basePath;?>pdf/export/csvToPDF.php">PDF</a>
            <ul>
               <li><a href="#">Generate From</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>pdf/export/csvToPDF.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>pdf/export/dbToPDF.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>pdf/export/excelToPDF.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>pdf/export/htmlToPDF.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>pdf/export/sqlToPDF.php">SQL</a></li>
                     <li><a href="<?php echo $basePath;?>pdf/export/xmlToPDF.php">XML</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="<?php echo $basePath;?>sql/Import/sqlToCSV.php">SQL</a>
            <ul>
               <li><a href="#">Convert To</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>sql/import/sqlToCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>sql/import/sqlToExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>sql/import/sqlToHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>sql/import/sqlToPDF.php">PDF</a></li>
                     <li><a href="<?php echo $basePath;?>sql/import/sqlToXML.php">XML</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="#">XML</a>
            <ul>
               <li><a href="<?php echo $basePath;?>xml/import/importCSV.php">Convert To</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>xml/import/importCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>xml/import/importDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>xml/import/importExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>xml/import/importHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>xml/import/importPDF.php">PDF</a></li>
                  </ul>
               </li>
               <li><a href="#">Generate From</a>
                  <ul>
                     <li><a href="<?php echo $basePath;?>xml/export/exportCSV.php">CSV</a></li>
                     <li><a href="<?php echo $basePath;?>xml/export/exportDB.php">DB</a></li>
                     <li><a href="<?php echo $basePath;?>xml/export/exportExcel.php">EXCEL</a></li>
                     <li><a href="<?php echo $basePath;?>xml/export/exportHTML.php">HTML TABLE</a></li>
                     <li><a href="<?php echo $basePath;?>xml/export/exportSQL.php">SQL</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="<?php echo $basePath;?>array/array.php">Array</a></li>
         <li><a href="#">More</a>
         	<ul>
            	<li><a href="<?php echo $basePath;?>More/Forms/csvform.php">CSV Form</a></li>
            	<li><a href="<?php echo $basePath;?>More/Forms/excelform.php">Excel Form</a></li>          
            	<li><a href="<?php echo $basePath;?>More/Forms/dbform.php">DB Form</a></li>    
            	<li><a href="<?php echo $basePath;?>More/Forms/importDBwithColMapping.php">Col Mapping</a></li>                                  
            </ul>
         </li>   
      </ul>
   </div>
</header>
<div id="main-container"> 