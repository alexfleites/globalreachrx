<?php
require_once("../header.php");
?>
<div id="array_to_csv" class="code">
<h5 class="head5">Convert Array To CSV</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Generates the csv file as output from the array provided. 
  * Returns true if operation performed successfully else return false.
  * 
  * @param   array     $csvArray             	Associative array with key as column name and value as table values.
  * @param   string    $outputFileName          Output csv file name
  *
  */	
   
   $ACS->arrayToCSV($csvArray,$fileName="file.csv");
?&gt;    
</code>
</pre>
</div>
<div id="array_to_db" class="code">
<h5 class="head5">Convert Array To DB</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Insert the data from two dimensional associative array to database using insert batch operation. Returns true 
  * if operation performed successfully
  * 
  * @param   array     $data             	2 Dimensional Associative array with key as column name and value as table values.
  *
  */		
   
   $ACS->arrayToDB($data);
?&gt;    
</code>
</pre>
</div>
<div id="array_to_excel" class="code">
<h5 class="head5">Convert Array To Excel</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Generates the excel file as output from the array provided. 
  * Returns true if operation performed successfully else return false.
  * 
  * @param   array     $excelArray             	Associative array with key as column name and value as table values.
  * @param   string    $outputFileName          Output excel file name
  *
  */		
   
   $ACS->arrayToExcel($excelArray,$outputFileName="file.xlsx");
?&gt;    
</code>
</pre>
</div>
<div id="array_to_html" class="code">
<h5 class="head5">Convert Array To HTML</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Generates the html table as output from the array provided.
  * 
  * @param   array     $htmlArray             	Associative array with key as column name and value as table values.
  *
  */		
   
   $ACS->arrayToHTML($htmlArray,$outputFileName="file.html");
?&gt;    
</code>
</pre>
</div>
<div id="array_to_pdf" class="code">
<h5 class="head5">Convert Array To PDF</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Generates the pdf as output from the array provided. Returns true if operation performed successfully else return false
  * 
  * @param   array     $pdfArray             	Associative array with key as column name and value as table values.
  * @param   string    $outputFileName          Output pdf file name
  *
  */		
   
   $ACS->arrayToPDF($pdfArray,$outputFileName="file.pdf");
?&gt;    
</code>
</pre>
</div>
<div id="array_to_xml" class="code">
<h5 class="head5">Convert Array To XML</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Generates the xml as output from the array provided. Returns true if operation performed successfully else return false
  * 
  * @param   array     $xmlArray             	Associative array with key as column name and value as table values.
  * @param   string    $outputFileName          Output xml file name
  *
  */		
   
   $ACS->arrayToXML($xmlArray,$outputFileName="file.xml");
?&gt;    
</code>
</pre>
</div>
<div id="array_from_csv" class="code">
<h5 class="head5">Generate Array From CSV</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Read a CSV File and return content as an array.
  *
  * @param   string    $fileName       			Path of file with file name (default is 'file.csv')
  *
  * return   array                              return content array
  *
  */	
   
   $ACS->csvToArray($fileName);
?&gt;    
</code>
</pre>
</div>
<div id="array_from_excel" class="code">
<h5 class="head5">Generate Array From Excel</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Read an excel file and return content as array
  *
  * @param   string    $fileName                excel file name
  *
  * return   array                              return array 
  *
  */	
   
   $ACS->excelToArray($fileName);
?&gt;    
</code>
</pre>
</div>
<div id="array_from_html" class="code">
<h5 class="head5">Generate Array From HTML</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Read an html file/html and return content as array
  *
  * @param   string    $html               	    html as string or xml file name
  *
  * return   array                        	    return array
  * 
  */	
   
   $ACS->htmlToArray($htmlContent);
?&gt;    
</code>
</pre>
</div>
<div id="array_from_xml" class="code">
<h5 class="head5">Generate Array From XML</h5>
<pre>
<code data-language="php">
/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/**
  * Read an xml file/xml and return content as array
  *
  * @param   string    $xml               	    xml as string or xml file name
  *
  * return   array                              return array
  * 
  */	
   
   $ACS->xmlToArray($xmlSource);
?&gt;    
</code>
</pre>
</div>