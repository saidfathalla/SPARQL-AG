<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style type="text/css">
<!--
.style5 {color: #CC0000}
-->
</style>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>SPRQL-AG </title>
        <style>
		/* syle the page*/
		* {
  box-sizing: border-box;
}


/* Style the header */
.header {
  background-color: #f1f1f1;
  background-image: url("https://codyburleson.com/wp-content/uploads/2018/07/sparql-sql-for-sem-web-0.png");
   background-repeat: no-repeat;
    background-size: 120px 120px;
  padding: 20px;
  text-align: center;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
}

/* Left and right column */
.column.side {
  width: 10%;
}

/* Middle column */
.column.middle {
  width: 78%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }
}
		
		
		
            .error {color: #FF0000;}
            .style2 {  font-style: italic; }
			
/*			input[type=text], input[type=date], select {
  background-color: #3CBC8D;
  color: white;
   width: 10%;
}*/
 

textarea:focus {
  width: 95%;
}			
textarea{
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
			input[type=submit], button {
  width: 10%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover, button:hover {
  background-color: #45a049;
  font-weight:bold
}
        .style3 {
	font-size: large;
	font-weight: bold;
}
        .style4 {font-size: large}
        </style>

 
</head>


    <body>
	<div class="header">
	  <h1>SPARQL-AG service</h1>
      <p>A SPARQL auto-generation service for  EVENTSKG SPARQL endpoint </p>
  </div>

    <div class="topnav">
  <a href="http://kddste.sda.tech/EVENTSKG-Dataset/EVENTSKG_R2.html">EVENTSKG Homepage </a>
  <a href="#">Issue Tracker</a>
  <a href="#">SPARQL endpoint</a></div>
<div class="row">
  <div class="column side">
    <h2>&nbsp;</h2>
    <p>&nbsp;</p>
  </div>


        <?php
// define variables and set to empty values
        header('X-XSS-Protection:0');
		  include( "queryDBpediaClient.php");
        $nameErr = "";
        $generatedQuery="";
        $generatedQuery2="";
        $prefix="PREFIX seo: &lt;http://purl.org/seo/&gt; \n PREFIX conference-ontology: &lt;https://w3id.org/scholarlydata/ontology/conference-ontology.owl#&gt;";
	//define("RDFAPI_INCLUDE_DIR", $_SERVER['DOCUMENT_ROOT']."SPARQL-AG/api/");
//		echo RDFAPI_INCLUDE_DIR;
        if (empty($_POST["prefix"])) {
            $prefix .= "";
        } else {
            $prefix = test_input($_POST["prefix"]);
        }
         
        
        $gq =  " ".$prefix . "\n SELECT";

        ////// select cols
        if (!empty($_POST['selDISTINCT']))
            $gq =  " ".$prefix . "\n SELECT DISTINCT ";
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['submit'])) {
            
//            } else 
            if (!empty($_POST["selAll"]) and $_POST["selAll"] == TRUE) {
                $gq .=" * ";
            } else 
            {
//                $gq .="  ";
               if (!empty($_POST["selURI"]))   $gq .=" ?e";
                if (!empty($_POST["selType"]))   $gq .=" ?type";
              if (!empty($_POST["selSeries"]))   $gq .=" ?series";
             if (!empty($_POSTooo["selCountry"]))   $gq .=" ?country";
             if (!empty($_POST["selacc"]))    $gq .=" ?acc";
             if (!empty($_POST["selAP"]))    $gq .=" ?AP";
             if (!empty($_POST["selSP"]))    $gq .=" ?SP";
             if (!empty($_POST["selCity"]))    $gq .=" ?city";
             if (!empty($_POST["selWebsite"]))    $gq .=" ?website";
             if (!empty($_POST["selField"]))    $gq .=" ?field";
             if (!empty($_POST["selPublisher"]))    $gq .=" ?publisher";
             if (!empty($_POST["selStartDate"]))    $gq .=" ?SD";
             if (!empty($_POST["selEndDate"]))    $gq .=" ?ED";
            }
     
            /// add selected columns in WHERE to appear in coulmns 
            $gq .="\n WHERE {";
            
          
                
          if ((!empty($_POST["selType"]) or !empty($_POST["selURI"])) and empty($_POST["filType"]))  $gq .="\n ?e rdf:type ?type. FILTER( ?type = conference-ontology:Conference || ?type = conference-ontology:Workshop || ?type = seo:Symposium) .";
             elseif (!empty($_POST["typeVal"])and !empty($_POST["filType"])) $gq .="\n ?e rdf:type    <" . $_POST["typeVal"] . ">  .";
           
          if (!empty($_POST["selSeries"])  and empty($_POST["filSeries"]))  $gq .="\n ?e seo:belongsToSeries ?series. ";
             elseif (!empty($_POST["seriesVal"])and !empty($_POST["filSeries"])) $gq .="\n ?e seo:belongsToSeries    ?series. FILTER( ?series= <http://purl.org/events_ds#" . $_POST["seriesVal"] . ">) .";
             
           if ((!empty($_POST["selCountry"]) ) and empty($_POST["filCountry"]))   $gq .="\n ?e seo:heldInCountry   ?country .";
             else if (!empty($_POST["countryVal"]) and !empty($_POST["filCountry"])) $gq .="\n ?e seo:heldInCountry  ?country FILTER(?country= <" . ($_POST["countryVal"]) . ">) ."; //askDBpediaCountry($_POST["countryVal"])
             
           if ((!empty($_POST["selField"]) ) and empty($_POST["filField"]))   $gq .="\n ?e seo:field   ?field .";
             else if (!empty($_POST["fieldVal"]) and !empty($_POST["filField"])) $gq .="\n ?e seo:field  ?field FILTER (?field=" . $_POST["fieldVal"] . ") .";
                          
           if (!empty($_POST["selacc"]) and empty($_POST["filacc"]))   $gq .="\n ?e seo:acceptanceRate    ?acc .";
             else if (!empty($_POST["accVal"]) and !empty($_POST["filacc"])) $gq .="\n ?e seo:acceptanceRate   ?acc. FILTER (?acc ".$_POST["op"] . $_POST["accVal"] . ") .";
           
            if ((!empty($_POST["selCity"]) ) and empty($_POST["filCity"]))   $gq .="\n ?e seo:city    ?city .";
             else if ( !empty($_POST["cityVal"]) and !empty($_POST["filCity"])) $gq .="\n ?e seo:city   ?city. FILTER(regex(str(?city), '". str_replace(' ', '_',$_POST["cityVal"]) . "', 'i' )) .";
    
             // 1ST cond. -> to add col to where when * is selected
             // 2nd cond. -> when OPTIONAL not selected
             // 3rd cond. -> when OPTIONAL selected
           if ((!empty($_POST["selAP"]) ) and empty($_POST["filAP"]))   $gq .="\n ?e seo:acceptedPapers  ?AP .";
             else if ( !empty($_POST["APVal"]) and empty($_POST["OptionalAP"]) and !empty($_POST["filAP"])) $gq .="\n ?e seo:acceptedPapers  ?AP. FILTER (?AP ".$_POST["opAP"] . $_POST["APVal"] . ") .";
             else if ( !empty($_POST["APVal"]) and !empty($_POST["filAP"]) and !empty($_POST["OptionalAP"])) $gq .="\n OPTIONAL {?e seo:acceptedPapers  ?AP. FILTER (?AP ".$_POST["opAP"] . $_POST["APVal"] . ") } .";
         
          if ((!empty($_POST["selSP"]) ) and empty($_POST["filSP"]))   $gq .="\n ?e seo:submittedPapers  ?SP .";
             else if ( !empty($_POST["SPVal"]) and !empty($_POST["selSP"])and empty($_POST["OptionalSP"])) $gq .="\n ?e seo:submittedPapers  ?SP. FILTER (?SP ".$_POST["opSP"] . $_POST["SPVal"] . ") .";
             else if ( !empty($_POST["SPVal"]) and !empty($_POST["selSP"]) and !empty($_POST["OptionalSP"])) $gq .="\n OPTIONAL {?e seo:submittedPapers  ?SP. FILTER (?SP ".$_POST["opSP"] . $_POST["SPVal"] . ") } .";

          if ((!empty($_POST["selSP"]) ) and empty($_POST["filSP"]))   $gq .="\n ?e seo:submittedPapers  ?SP .";
             else if ( !empty($_POST["SPVal"]) and !empty($_POST["filSP"])and empty($_POST["OptionalSP"])) $gq .="\n ?e seo:submittedPapers  ?SP. FILTER (?SP ".$_POST["opSP"] . $_POST["SPVal"] . ") .";
             else if ( !empty($_POST["SPVal"]) and !empty($_POST["filSP"]) and !empty($_POST["OptionalSP"])) $gq .="\n OPTIONAL {?e seo:submittedPapers  ?SP. FILTER (?SP ".$_POST["opSP"] . $_POST["SPVal"] . ") } .";

          if ((!empty($_POST["selStartDate"]) ) and empty($_POST["filSD"]))   $gq .="\n ?e conference-ontology:startDate  ?SD .";
             else if ( !empty($_POST["SDVal"]) and !empty($_POST["filSD"])and empty($_POST["OptionalSD"])) $gq .="\n ?e conference-ontology:startDate  ?SD. FILTER (?SD".$_POST["opSD"] . "xsd:dateTime('".$_POST["SDVal"]."T00:00:00.0000000+00:00')) .";
             else if ( !empty($_POST["SDVal"]) and !empty($_POST["filSD"]) and !empty($_POST["OptionalSD"])) $gq .="\n OPTIONAL {?e conference-ontology:startDate   ?SD. FILTER (?SD".$_POST["opSD"] . "xsd:dateTime('".$_POST["SDVal"] . "T00:00:00.0000000+00:00')) } .";
     
          if ((!empty($_POST["selEndDate"]) ) and empty($_POST["filED"]))   $gq .="\n ?e conference-ontology:endDate  ?ED .";
             else if ( !empty($_POST["EDVal"]) and !empty($_POST["filED"])and empty($_POST["OptionalED"])) $gq .="\n ?e conference-ontology:endDate  ?ED. FILTER (?ED".$_POST["opED"] . "xsd:dateTime('".$_POST["EDVal"] . "T00:00:00.0000000+00:00')) .";
             else if ( !empty($_POST["EDVal"]) and !empty($_POST["filED"]) and !empty($_POST["OptionalED"])) $gq .="\n OPTIONAL {?e conference-ontology:endDate ?ED. FILTER (?ED".$_POST["opED"] . "xsd:dateTime('".$_POST["EDVal"] . "T00:00:00.0000000+00:00')) } .";

        if ((!empty($_POST["selPublisher"])) and empty($_POST["filPublisher"]))   $gq .="\n ?e seo:hasPublisher  ?publisher .";
             else if ( !empty($_POST["PublisherVal"]) and !empty($_POST["filPublisher"])and empty($_POST["OptionalPublisher"])) $gq .="\n ?e seo:hasPublisher  ?publisher. FILTER(regex(str(?publisher), '" .$_POST["PublisherVal"] . "', 'i' )) .";
             else if ( !empty($_POST["PublisherVal"]) and !empty($_POST["filPublisher"]) and !empty($_POST["OptionalPublisher"])) $gq .="\n OPTIONAL {?e seo:hasPublisher  ?publisher. FILTER(regex(str(?publisher), '" .$_POST["PublisherVal"] . "', 'i' )) }.";
             
      
            $gq .="\n }";
              // query modifiers ORDER  BY and LIMIT
              if (!empty($_POST["selOrderBy1"])) {
        if (empty($_POST["selOrderByDESC1_1"]))
            $gq .="\n ORDER BY " . $_POST["orderbyVal1"];
        else {
            $gq .="\n ORDER BY DESC(" . $_POST["orderbyVal1"] . ")";
        }
    }
    if (!empty($_POST["selOrderBy2"])) {
        if (!empty($_POST["selOrderBy1"])) {
            if (empty($_POST["selOrderByDEC1_2"]))
                $gq .="  " . $_POST["orderbyVal2"];
            else
                $gq .=" DESC(" . $_POST["orderbyVal2"] . ")";
        }
        else {
            if (empty($_POST["selOrderByDEC1_2"]))
                $gq .="\n ORDER BY  " . $_POST["orderbyVal2"];
            else
                $gq .="\n ORDER BY DESC(" . $_POST["orderbyVal2"] . ")";
        }
    }


////if (!empty($_POST["selOrderBy1"])and !empty($_POST["orderbyVal1"])and empty($_POST["selOrderByDESC1_1"]))    $gq .="\n ORDER BY ".$_POST["orderbyVal1"];
//if (!empty($_POST["selOrderBy1"])and !empty($_POST["orderbyVal1"]) and !empty($_POST["selOrderByDESC1_1"]))    $gq .="\n ORDER BY DESC(".$_POST["orderbyVal1"].")";
//
//if (!empty($_POST["selOrderBy2"])and !empty($_POST["selOrderBy1"]) and !empty($_POST["orderbyVal2"])and empty($_POST["selOrderByDESC1_1"])and empty($_POST["selOrderByDESC1_2"]))    $gq .="  ".$_POST["orderbyVal2"];
//if (!empty($_POST["selOrderBy2"])and !empty($_POST["selOrderBy1"]) and !empty($_POST["orderbyVal2"])and !empty($_POST["selOrderByDESC1_2"]))    $gq .="  DESC(".$_POST["orderbyVal2"].")";
//if (!empty($_POST["selOrderBy1"])and !empty($_POST["orderbyVal1"]) and !empty($_POST["selOrderByDESC1_2"]))    $gq .="\n ORDER BY DESC(".$_POST["orderbyVal2"].")";
//
//
//if (!empty($_POST["selOrderBy2"])and empty($_POST["selOrderBy1"]) and !empty($_POST["orderbyVal2"])and empty($_POST["selOrderByDESC1_2"]))    $gq .="\n ORDER BY  ".$_POST["orderbyVal2"];
//if (!empty($_POST["selOrderBy2"])and empty($_POST["selOrderBy1"]) and !empty($_POST["orderbyVal2"])and !empty($_POST["selOrderByDESC1_2"]))    $gq .="\n ORDER BY DESC(".$_POST["orderbyVal2"].")";

            if (!empty($_POST["selLimit"]))  $gq .="\n LIMIT  ".$_POST["LimitVal"];

            $generatedQuery = $gq;
 
            
        }
        // aggregation part starts here
   if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submitAgg']))
    {
        $prefix2="PREFIX seo: &lt;http://purl.org/seo/&gt; \n PREFIX conference-ontology: &lt;https://w3id.org/scholarlydata/ontology/conference-ontology.owl#&gt;";

       if (!empty($_POST["prefix2"]))    $prefix2 = test_input($_POST["prefix2"]);
       
       $gq2 =  " ".$prefix2 . "\n SELECT";
       if (!empty($_POST["selAggCol"]))    $gq2 .=  " ".$_POST["aggColVal"];
       if (!empty($_POST["selFn"]))    $gq2 .=  " ".$_POST["selFn"]."( ". $_POST["selFnCol"].") AS ".$_POST["asVal"];
        
       $gq2.="\n WHERE {\n  ?e ". getPropertyName($_POST["selFnCol"])." ".$_POST["selFnCol"]." .";    
       if (!empty($_POST["selGroupBy1"])) $gq2 .=  "\n ?e ". getPropertyName($_POST["groupbyVal1"])." ".$_POST["groupbyVal1"];
         $gq2.="\n }";    
       
        if (!empty($_POST["selGroupBy1"])) $gq2 .=  "\n GROUP BY ".$_POST["groupbyVal1"];
        
         // query modifiers ORDER  BY and LIMIT
           
        if (!empty($_POST["selHaving"])and !empty($_POST["HavingColVal"]) and !empty($_POST["havingVal"]))    $gq2 .="\n HAVING  (".$_POST["HavingColVal"]. $_POST["havingOP"].$_POST["havingVal"].")";

          // query modifiers ORDER  BY and LIMIT
              if (!empty($_POST["selOrderBy2_1"])) {
        if (empty($_POST["selOrderByDESC2_1"]))
            $gq2 .="\n ORDER BY " . $_POST["orderbyVal2_1"];
        else {
            $gq2 .="\n ORDER BY DESC(" . $_POST["orderbyVal2_1"] . ")";
        }
    }
    if (!empty($_POST["selOrderBy2_2"])) {
        if (!empty($_POST["selOrderBy2_1"])) {
            if (empty($_POST["selOrderByDESC2_2"]))
                $gq2 .="  " . $_POST["orderbyVal2_2"];
            else
                $gq2 .=" DESC(" . $_POST["orderbyVal2_2"] . ")";
        }
        else {
            if (empty($_POST["selOrderByDESC2_2"]))
                $gq2 .="\n ORDER BY  " . $_POST["orderbyVal2_2"];
            else
                $gq2 .="\n ORDER BY DESC(" . $_POST["orderbyVal2_2"] . ")";
        }
    }

        
        
            if (!empty($_POST["selLimit_2"]))  $gq2 .="\n LIMIT  ".$_POST["LimitVal_2"];
        
       $generatedQuery2 = $gq2;
    }
    
    ///////////////// functions //////////////////////////////
    function getPropertyName($param) {
        if($param== '?type') return 'rdf:type';
        if($param== '?series') return 'seo:belongsToSeries';
        if($param== '?country') return 'seo:heldInCountry';
        if($param== '?city') return 'seo:city';
        if($param== '?field') return 'seo:field';
        if($param== '?acc') return 'seo:acceptanceRate';
        if($param== '?AP') return 'seo:acceptedPapers';
        if($param== '?SP') return 'seo:submittedPapers';
        if($param== '?SD') return 'conference-ontology:startDate';
        if($param== '?ED') return 'conference-ontology:endDate';
        if($param== '?website') return 'seo:hasPublisher';
        if($param== '?publisher') return 'seo:hasPublisher';
            
    
}
  
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
         
        ?> 
		
<div class="column middle">
        <h4>&nbsp;</h4>
        The goal of developing SPARQL-AG service is to support users who are not familiar, and expert users, in generating SPARQL queries for querying EVENTSKG dataset without going into details how this SPARQL query is written. 
        A prominent feature of SPARQL-AG is the ability to execute the generated query using the SPARQL endpoint of EVENTSKG and display the returned results, which could be used for further processing, e.g., Data visualization.

        <h3>1. Simple SPARQL query generation</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <strong>1.1 Prefix declaration:</strong> each Name space SHOULD be in a new line and SHOULD be like: <span class="style2">vcard: &lt;http://www.w3.org/2001/vcard-rdf/3.0#&gt;</span>  

            <p> <textarea name="prefix" id="prefix" rows="5" cols="120" onkeypress="KeyPress(event)"  > <?php echo $prefix; ?></textarea> 
            </p>

            <p  ><strong> 1.2 Result clause: </strong>
            <p><span class="style3">
            <input name="selDISTINCT" type="checkbox" id="selDISTINCT" checked="checked" />
            </span><span class="style4">DISTINCT</span>
            -
            <input name="selURI" type="checkbox" checked="checked"> 
          URI, <input type="checkbox" name="selType" > 
          event type, 
            <input type="checkbox" name="selSeries" > 
          series,
			<input type="checkbox" name="selCountry" > 
			country,   
			<input type="checkbox" name="selCity" >
			city, 
			<input type="checkbox" name="selField" > 
			field, 
			<input type="checkbox" name="selacc" >
			acceptance rate,
                <input type="checkbox" name="selAP">
                accepted papers,
                <input name="selSP" type="checkbox" >
                submitted papers,               </p>
          <p>
              <input name="selStartDate" type="checkbox">
              start date,
              <input name="selEndDate" type="checkbox"">
              end date,
              <input type="checkbox" name="selWebsite" >
              website,
              <input name="selPublisher" type="checkbox" >
          publisher.&nbsp;</p>
            <p><strong>1.3 Query pattern: </strong></p>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input label="event type" type="checkbox" name="filType" /> 
        <!--checked="checked"-->
      event type </td>
    <td>&nbsp;</td>
    <td><select name="typeVal" class="form-control"  >
            <!--selected="selected"-->
        <option value="https://w3id.org/scholarlydata/ontology/conference-ontology.owl#Conference" >Conference</option>
        <option value="https://w3id.org/scholarlydata/ontology/conference-ontology.owl#Workshop">Workshop</option>
        <option value="http://purl.org/seo/Symposium">Symposium</option>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="filSeries" type="checkbox" id="filSeries" />      
      series</td>
    <td>&nbsp;</td>
    <td><input name="seriesVal" type="text" class="form-control" value="ISWC"    size="33"  placeholder= "ISWC"/></td>
    <td>&nbsp;</td>
  </tr> 
   
   <tr>
    <td width="18%"><input name="filCountry" type="checkbox"  />
country </td>
    <td width="6%">&nbsp;</td>
    <td width="38%"><select name="countryVal" class="form-control">
                                                                          <option value="http://dbpedia.org/resource/Afganistan">Afghanistan</option>
                                                                          <option value="http://dbpedia.org/resource/Albania">Albania</option>
                                                                          <option value="http://dbpedia.org/resource/Algeria">Algeria</option>
                                                                          <option value="http://dbpedia.org/resource/American_Samoa">American Samoa</option>
                                                                          <option value="http://dbpedia.org/resource/Andorra">Andorra</option>
                                                                          <option value="http://dbpedia.org/resource/Angola">Angola</option>
                                                                          <option value="http://dbpedia.org/resource/Anguilla">Anguilla</option>
                                                                          <option value="http://dbpedia.org/resource/Antigua_and_Barbuda">Antigua &amp; Barbuda</option>
                                                                          <option value="http://dbpedia.org/resource/Argentina">Argentina</option>
                                                                          <option value="http://dbpedia.org/resource/Armenia">Armenia</option>
                                                                          <option value="http://dbpedia.org/resource/Aruba">Aruba</option>
                                                                          <option value="http://dbpedia.org/resource/Australia">Australia</option>
                                                                          <option value="http://dbpedia.org/resource/Austria">Austria</option>
                                                                          <option value="http://dbpedia.org/resource/Azerbaijan">Azerbaijan</option>
                                                                          <option value="http://dbpedia.org/resource/Bahamas">Bahamas</option>
                                                                          <option value="http://dbpedia.org/resource/Bahrain">Bahrain</option>
                                                                          <option value="http://dbpedia.org/resource/Bangladesh">Bangladesh</option>
                                                                          <option value="http://dbpedia.org/resource/Barbados">Barbados</option>
                                                                          <option value="http://dbpedia.org/resource/Belarus">Belarus</option>
                                                                          <option value="http://dbpedia.org/resource/Belgium">Belgium</option>
                                                                          <option value="http://dbpedia.org/resource/Belize">Belize</option>
                                                                          <option value="http://dbpedia.org/resource/Benin">Benin</option>
                                                                          <option value="http://dbpedia.org/resource/Bermuda">Bermuda</option>
                                                                          <option value="http://dbpedia.org/resource/Bhutan">Bhutan</option>
                                                                          <option value="http://dbpedia.org/resource/Bolivia">Bolivia</option>
                                                                          <option value="http://dbpedia.org/resource/Bonaire">Bonaire</option>
                                                                          <option value="http://dbpedia.org/resource/Bosnia_and_Herzegovina">Bosnia &amp; Herzegovina</option>
                                                                          <option value="http://dbpedia.org/resource/Botswana">Botswana</option>
                                                                          <option value="http://dbpedia.org/resource/Brazil">Brazil</option>
                                                                          <option value="http://dbpedia.org/resource/Brunei">Brunei</option>
                                                                          <option value="http://dbpedia.org/resource/Bulgaria">Bulgaria</option>
                                                                          <option value="http://dbpedia.org/resource/Burkina_Faso">Burkina Faso</option>
                                                                          <option value="http://dbpedia.org/resource/Burundi">Burundi</option>
                                                                          <option value="http://dbpedia.org/resource/Cambodia">Cambodia</option>
                                                                          <option value="http://dbpedia.org/resource/Cameroon">Cameroon</option>
                                                                          <option value="http://dbpedia.org/resource/Canada">Canada</option>
                                                                          <option value="http://dbpedia.org/resource/Canary_Islands">Canary Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Cape_Verde">Cape Verde</option>
                                                                          <option value="http://dbpedia.org/resource/Cayman_Islands">Cayman Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Central_African_Republic">Central African Republic</option>
                                                                          <option value="http://dbpedia.org/resource/Chad">Chad</option>
                                                                          <option value="http://dbpedia.org/resource/Channel_Islands_Beach,_California">Channel Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Chile">Chile</option>
                                                                          <option value="http://dbpedia.org/resource/China">China</option>
                                                                          <option value="http://dbpedia.org/resource/Christmas_Island">Christmas Island</option>
                                                                          <option value="http://dbpedia.org/resource/Colombia">Colombia</option>
                                                                          <option value="http://dbpedia.org/resource/Comoros">Comoros</option>
                                                                          <option value="http://dbpedia.org/resource/Congo">Congo</option>
                                                                          <option value="http://dbpedia.org/resource/Cook_Islands">Cook Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Costa_Rica">Costa Rica</option>
                                                                          <option value="http://dbpedia.org/resource/Ivory_Coast">Cote D'Ivoire</option>
                                                                          <option value="http://dbpedia.org/resource/Croatia">Croatia</option>
                                                                          <option value="http://dbpedia.org/resource/Cuba">Cuba</option>
                                                                          <option value="http://dbpedia.org/resource/Curaco">Curacao</option>
                                                                          <option value="http://dbpedia.org/resource/Cyprus">Cyprus</option>
                                                                          <option value="http://dbpedia.org/resource/Czech_Republic">Czech Republic</option>
                                                                          <option value="http://dbpedia.org/resource/Denmark">Denmark</option>
                                                                          <option value="http://dbpedia.org/resource/Djibouti">Djibouti</option>
                                                                          <option value="http://dbpedia.org/resource/Dominica">Dominica</option>
                                                                          <option value="http://dbpedia.org/resource/Dominican_Republic">Dominican Republic</option>
                                                                          <option value="http://dbpedia.org/resource/East_Timor">East Timor</option>
                                                                          <option value="http://dbpedia.org/resource/Ecuador">Ecuador</option>
                                                                          <option value="http://dbpedia.org/resource/Egypt">Egypt</option>
                                                                          <option value="http://dbpedia.org/resource/El_Salvador">El_Salvador</option>
                                                                          <option value="http://dbpedia.org/resource/Equatorial_Guinea">Equatorial Guinea</option>
                                                                          <option value="http://dbpedia.org/resource/Eritrea">Eritrea</option>
                                                                          <option value="http://dbpedia.org/resource/Estonia">Estonia</option>
                                                                          <option value="http://dbpedia.org/resource/Ethiopia">Ethiopia</option>
                                                                          <option value="http://dbpedia.org/resource/Falkland_Islands">Falkland Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Faroe_Islands">Faroe Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Fiji">Fiji</option>
                                                                          <option value="http://dbpedia.org/resource/Finland">Finland</option>
                                                                          <option value="http://dbpedia.org/resource/France">France</option>
                                                                          <option value="http://dbpedia.org/resource/French_Guiana">French Guiana</option>
                                                                          <option value="http://dbpedia.org/resource/French_Polynesia">French Polynesia</option>
                                                                          <option value="http://dbpedia.org/resource/Gabon">Gabon</option>
                                                                          <option value="http://dbpedia.org/resource/Gambia">Gambia</option>
                                                                          <option value="http://dbpedia.org/resource/Georgia">Georgia</option>
                                                                          <option value="http://dbpedia.org/resource/Germany" selected="selected">Germany</option>
                                                                          <option value="http://dbpedia.org/resource/Ghana">Ghana</option>
                                                                          <option value="http://dbpedia.org/resource/Gibraltar">Gibraltar</option>
                                                                          <option value="http://dbpedia.org/resource/Great_Britain">United Kingdom</option>
                                                                          <option value="http://dbpedia.org/resource/Greece">Greece</option>
                                                                          <option value="http://dbpedia.org/resource/Greenland">Greenland</option>
                                                                          <option value="http://dbpedia.org/resource/Grenada">Grenada</option>
                                                                          <option value="http://dbpedia.org/resource/Guadeloupe">Guadeloupe</option>
                                                                          <option value="http://dbpedia.org/resource/Guam">Guam</option>
                                                                          <option value="http://dbpedia.org/resource/Guatemala">Guatemala</option>
                                                                          <option value="http://dbpedia.org/resource/Guinea">Guinea</option>
                                                                          <option value="http://dbpedia.org/resource/Guyana">Guyana</option>
                                                                          <option value="http://dbpedia.org/resource/Haiti">Haiti</option>
                                                                          <option value="http://dbpedia.org/resource/Hawaii">Hawaii</option>
                                                                          <option value="http://dbpedia.org/resource/Honduras">Honduras</option>
                                                                          <option value="http://dbpedia.org/resource/Hong_Kong">Hong Kong</option>
                                                                          <option value="http://dbpedia.org/resource/Hungary">Hungary</option>
                                                                          <option value="http://dbpedia.org/resource/Iceland">Iceland</option>
                                                                          <option value="http://dbpedia.org/resource/India">India</option>
                                                                          <option value="http://dbpedia.org/resource/Indonesia">Indonesia</option>
                                                                          <option value="http://dbpedia.org/resource/Iran">Iran</option>
                                                                          <option value="http://dbpedia.org/resource/Iraq">Iraq</option>
                                                                          <option value="http://dbpedia.org/resource/Ireland">Ireland</option>
                                                                          <option value="http://dbpedia.org/resource/Isle_of_Man">Isle of Man</option>
                                                                          <option value="http://dbpedia.org/resource/Israel">Israel</option>
                                                                          <option value="http://dbpedia.org/resource/Italy">Italy</option>
                                                                          <option value="http://dbpedia.org/resource/Jamaica">Jamaica</option>
                                                                          <option value="http://dbpedia.org/resource/Japan">Japan</option>
                                                                          <option value="http://dbpedia.org/resource/Jordan">Jordan</option>
                                                                          <option value="http://dbpedia.org/resource/Kazakhstan">Kazakhstan</option>
                                                                          <option value="http://dbpedia.org/resource/Kenya">Kenya</option>
                                                                          <option value="http://dbpedia.org/resource/Kiribati">Kiribati</option>
                                                                          <option value="Korea North">Korea North</option>
                                                                          <option value="Korea South">Korea South</option>
                                                                          <option value="http://dbpedia.org/resource/Kuwait">Kuwait</option>
                                                                          <option value="http://dbpedia.org/resource/Kyrgyzstan">Kyrgyzstan</option>
                                                                          <option value="http://dbpedia.org/resource/Laos">Laos</option>
                                                                          <option value="http://dbpedia.org/resource/Latvia">Latvia</option>
                                                                          <option value="http://dbpedia.org/resource/Lebanon">Lebanon</option>
                                                                          <option value="http://dbpedia.org/resource/Lesotho">Lesotho</option>
                                                                          <option value="http://dbpedia.org/resource/Liberia">Liberia</option>
                                                                          <option value="http://dbpedia.org/resource/Libya">Libya</option>
                                                                          <option value="http://dbpedia.org/resource/Liechtenstein">Liechtenstein</option>
                                                                          <option value="http://dbpedia.org/resource/Lithuania">Lithuania</option>
                                                                          <option value="http://dbpedia.org/resource/Luxembourg">Luxembourg</option>
                                                                          <option value="http://dbpedia.org/resource/Macau">Macau</option>
                                                                          <option value="http://dbpedia.org/resource/Macedonia">Macedonia</option>
                                                                          <option value="http://dbpedia.org/resource/Madagascar">Madagascar</option>
                                                                          <option value="http://dbpedia.org/resource/Malaysia">Malaysia</option>
                                                                          <option value="http://dbpedia.org/resource/Malawi">Malawi</option>
                                                                          <option value="http://dbpedia.org/resource/Maldives">Maldives</option>
                                                                          <option value="http://dbpedia.org/resource/Mali">Mali</option>
                                                                          <option value="http://dbpedia.org/resource/Malta">Malta</option>
                                                                          <option value="http://dbpedia.org/resource/Marshall Islands">Marshall Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Martinique">Martinique</option>
                                                                          <option value="http://dbpedia.org/resource/Mauritania">Mauritania</option>
                                                                          <option value="http://dbpedia.org/resource/Mauritius">Mauritius</option>
                                                                          <option value="http://dbpedia.org/resource/Mayotte">Mayotte</option>
                                                                          <option value="http://dbpedia.org/resource/Mexico">Mexico</option>
                                                                          <option value="http://dbpedia.org/resource/Midway Islands">Midway Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Moldova">Moldova</option>
                                                                          <option value="http://dbpedia.org/resource/Monaco">Monaco</option>
                                                                          <option value="http://dbpedia.org/resource/Mongolia">Mongolia</option>
                                                                          <option value="http://dbpedia.org/resource/Montserrat">Montserrat</option>
                                                                          <option value="http://dbpedia.org/resource/Morocco">Morocco</option>
                                                                          <option value="http://dbpedia.org/resource/Mozambique">Mozambique</option>
                                                                          <option value="http://dbpedia.org/resource/Myanmar">Myanmar</option>
                                                                          <option value="http://dbpedia.org/resource/Nambia">Nambia</option>
                                                                          <option value="http://dbpedia.org/resource/Nauru">Nauru</option>
                                                                          <option value="http://dbpedia.org/resource/Nepal">Nepal</option>
                                                                          <option value="http://dbpedia.org/resource/Netherland_Antilles">Netherland Antilles</option>
                                                                          <option value="http://dbpedia.org/resource/Netherlands">Netherlands (Holland, Europe)</option>
                                                                          <option value="http://dbpedia.org/resource/Nevis">Nevis</option>
                                                                          <option value="http://dbpedia.org/resource/New_Caledonia">New Caledonia</option>
                                                                          <option value="http://dbpedia.org/resource/New_Zealand">New Zealand</option>
                                                                          <option value="http://dbpedia.org/resource/Nicaragua">Nicaragua</option>
                                                                          <option value="http://dbpedia.org/resource/Niger">Niger</option>
                                                                          <option value="http://dbpedia.org/resource/Nigeria">Nigeria</option>
                                                                          <option value="http://dbpedia.org/resource/Niue">Niue</option>
                                                                          <option value="http://dbpedia.org/resource/Norway">Norway</option>
                                                                          <option value="http://dbpedia.org/resource/Oman">Oman</option>
                                                                          <option value="http://dbpedia.org/resource/Pakistan">Pakistan</option>
                                                                          <option value="http://dbpedia.org/resource/Palau_Island">Palau Island</option>
                                                                          <option value="http://dbpedia.org/resource/Palestine">Palestine</option>
                                                                          <option value="http://dbpedia.org/resource/Panama">Panama</option>
                                                                          <option value="Papua New Guinea">Papua New Guinea</option>
                                                                          <option value="http://dbpedia.org/resource/Paraguay">Paraguay</option>
                                                                          <option value="http://dbpedia.org/resource/Peru">Peru</option>
                                                                          <option value="http://dbpedia.org/resource/Phillipines">Philippines</option>
                                                                          <option value="http://dbpedia.org/resource/Pitcairn Island">Pitcairn Island</option>
                                                                          <option value="http://dbpedia.org/resource/Poland">Poland</option>
                                                                          <option value="http://dbpedia.org/resource/Portugal">Portugal</option>
                                                                          <option value="http://dbpedia.org/resource/Puerto_Rico">Puerto Rico</option>
                                                                          <option value="http://dbpedia.org/resource/Qatar">Qatar</option>
                                                                          <option value="Republic of Montenegro">Republic of Montenegro</option>
                                                                          <option value="Republic of Serbia">Republic of Serbia</option>
                                                                          <option value="http://dbpedia.org/resource/Reunion">Reunion</option>
                                                                          <option value="http://dbpedia.org/resource/Romania">Romania</option>
                                                                          <option value="http://dbpedia.org/resource/Russia">Russia</option>
                                                                          <option value="http://dbpedia.org/resource/Rwanda">Rwanda</option>
                                                                          <option value="http://dbpedia.org/resource/Saipan">Saipan</option>
                                                                          <option value="http://dbpedia.org/resource/Samoa">Samoa</option>
                                                                          <option value="Samoa American">Samoa American</option>
                                                                          <option value="San Marino">San Marino</option>
                                                                          <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                                                                          <option value="http://dbpedia.org/resource/Saudi_Arabia">Saudi Arabia</option>
                                                                          <option value="http://dbpedia.org/resource/Senegal">Senegal</option>
                                                                          <option value="http://dbpedia.org/resource/Serbia">Serbia</option>
                                                                          <option value="http://dbpedia.org/resource/Seychelles">Seychelles</option>
                                                                          <option value="Sierra Leone">Sierra Leone</option>
                                                                          <option value="http://dbpedia.org/resource/Singapore">Singapore</option>
                                                                          <option value="http://dbpedia.org/resource/Slovakia">Slovakia</option>
                                                                          <option value="http://dbpedia.org/resource/Slovenia">Slovenia</option>
                                                                          <option value="Solomon Islands">Solomon Islands</option>
                                                                          <option value="http://dbpedia.org/resource/Somalia">Somalia</option>
                                                                          <option value="South Africa">South Africa</option>
                                                                          <option value="http://dbpedia.org/resource/Spain">Spain</option>
                                                                          <option value="http://dbpedia.org/resource/Sudan">Sudan</option>
                                                                          <option value="http://dbpedia.org/resource/Suriname">Suriname</option>
                                                                          <option value="http://dbpedia.org/resource/Swaziland">Swaziland</option>
                                                                          <option value="http://dbpedia.org/resource/Sweden">Sweden</option>
                                                                          <option value="http://dbpedia.org/resource/Switzerland">Switzerland</option>
                                                                          <option value="http://dbpedia.org/resource/Syria">Syria</option>
                                                                          <option value="http://dbpedia.org/resource/Tahiti">Tahiti</option>
                                                                          <option value="http://dbpedia.org/resource/Taiwan">Taiwan</option>
                                                                          <option value="http://dbpedia.org/resource/Tajikistan">Tajikistan</option>
                                                                          <option value="http://dbpedia.org/resource/Tanzania">Tanzania</option>
                                                                          <option value="http://dbpedia.org/resource/Thailand">Thailand</option>
                                                                          <option value="http://dbpedia.org/resource/Togo">Togo</option>
                                                                          <option value="http://dbpedia.org/resource/Tokelau">Tokelau</option>
                                                                          <option value="http://dbpedia.org/resource/Tonga">Tonga</option>
                                                                          <option value="http://dbpedia.org/resource/Tunisia">Tunisia</option>
                                                                          <option value="http://dbpedia.org/resource/Turkey">Turkey</option>
                                                                          <option value="http://dbpedia.org/resource/Turkmenistan">Turkmenistan</option>
                                                                          <option value="http://dbpedia.org/resource/Tuvalu">Tuvalu</option>
                                                                          <option value="http://dbpedia.org/resource/Uganda">Uganda</option>
                                                                          <option value="http://dbpedia.org/resource/Ukraine">Ukraine</option>
                                                                          <option value="United Arab Erimates">United Arab Emirates</option>
                                                                          <option value="http://dbpedia.org/resource/England">England</option>
                                                                          <option value="http://dbpedia.org/resource/United_States">United States</option>
                                                                          <option value="http://dbpedia.org/resource/Uraguay">Uruguay</option>
                                                                          <option value="http://dbpedia.org/resource/Uzbekistan">Uzbekistan</option>
                                                                          <option value="http://dbpedia.org/resource/Vanuatu">Vanuatu</option>
                                                                          <option value="http://dbpedia.org/resource/Vatican_City">Vatican City State</option>
                                                                          <option value="http://dbpedia.org/resource/Venezuela">Venezuela</option>
                                                                          <option value="http://dbpedia.org/resource/Vietnam">Vietnam</option>
                                                                          <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                                          <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                                          <option value="Wake Island">Wake Island</option>
                                                                          <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                                                                          <option value="http://dbpedia.org/resource/Yemen">Yemen</option>
                                                                          <option value="http://dbpedia.org/resource/Zaire">Zaire</option>
                                                                          <option value="http://dbpedia.org/resource/Zambia">Zambia</option>
                                                                          <option value="http://dbpedia.org/resource/Zimbabwe">Zimbabwe</option>
      </select></td>
    <td width="38%">&nbsp;</td>
   </tr>
   <tr>
     <td><input type="checkbox" name="filCity"  >
       city </td>
     <td>&nbsp;</td>
     <td><input name="cityVal" type="text" value="Berlin" size="36" class="form-control" /></td>
     <td>&nbsp;</td>
   </tr>
    
    <tr>
        <td><input name="filField" type="checkbox"  > 
        field</td>
        <td>&nbsp;</td>
        <!--checked="checked"-->
                                                                        <td><select name="fieldVal" class="form-control">
                                                                          <option value="<http://purl.org/seo#ArtificialIntelligence>">Artificial Intelligence</option>
                                                                          <option value="<http://purl.org/seo#SoftwareEngineering>">Software Engineering </option>
                                                                          <option value="<http://purl.org/seo#WorldWideWeb>">Web Technologies</option>
                                                                          <option value="<http://purl.org/seo#SecurityAndPrivacy>">Computer Security</option>
                                                                          <option value="<http://purl.org/seo#InformationSystems>">Information systems</option>
                                                                          <option value="<http://purl.org/seo#ComputerSystemsOrganization>">Computer systems organization</option>
                                                                          <option value="<http://purl.org/seo#HumanCenteredComputing>">Human Centered Computing</option>
                                                                          <option value="<http://purl.org/seo#TheoryOfComputations>">Theory of Computation</option>
                                                                        </select></td>
                                                                        <td>&nbsp;</td>
    </tr>
                                                                      <tr>
                                                                          <td><input name="filacc" type="checkbox" checked="checked"  />  
                                                                          acceptance rate </td>
                                                                          <td><select name="op">
                                                                            <option value=">"> &gt;</option>
                                                                            <option value=">="> &ge;</option>
                                                                            <option value="<"> &lt;</option>
                                                                            <option value=">="> &le;</option>
                                                                            <option value="="> =</option>
                                                                            <option value="!="> &ne;</option>
                                                                          </select></td>
                                                                          <td><input name="accVal" type="text" value="0.20" size="27"class="form-control"/></td>
                                                                          <td>&nbsp;</td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td><input name="filAP" type="checkbox" checked="checked" />
                                                                          accepted papers </td>
                                                                        <td><select name="opAP">
                                                                          <option value="&gt;"> &gt;</option>
                                                                          <option value="&gt;="> &ge;</option>
                                                                          <option value="&lt;"> &lt;</option>
                                                                          <option value="&gt;="> &le;</option>
                                                                          <option value="="> =</option>
                                                                          <option value="!="> &ne;</option>
                                                                        </select></td>
                                                                        <td><input name="APVal" type="text" value="50" size="27"class="form-control"/></td>
                                                                        <td>   &nbsp;
                                                                          <input name="OptionalAP" type="checkbox" id="OptionalAP"/>
OPTIONAL</td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td><input name="filSP" type="checkbox" checked="checked" />
                                                                        submitted papers </td>
                                                                        <td><select name="opSP">
                                                                          <option value="&gt;"> &gt;</option>
                                                                          <option value="&gt;="> &ge;</option>
                                                                          <option value="&lt;"> &lt;</option>
                                                                          <option value="&gt;="> &le;</option>
                                                                          <option value="="> =</option>
                                                                          <option value="!="> &ne;</option>
                                                                        </select></td>
                                                                        <td><input name="SPVal" type="text" value="100" size="27"class="form-control"/></td>
                                                                        <td> &nbsp;
                                                                          <input name="OptionalSP" type="checkbox" id="OptionalSP"/>
OPTIONAL</td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td><input name="filSD" type="checkbox" id="filSD" checked="checked"  />
                                                                          start date </td>
                                                                        <td><select name="opSD" id="opSD">
                                                                          <option value="&gt;"> &gt;</option>
                                                                          <option value="&gt;="> &ge;</option>
                                                                          <option value="&lt;"> &lt;</option>
                                                                          <option value="&gt;="> &le;</option>
                                                                          <option value="="> =</option>
                                                                          <option value="!="> &ne;</option>
                                                                        </select></td>
                                                                        <td><input name="SDVal" type="date" id="SDVal" value="2013-01-08" class="form-control"/></td>
                                                                        <td>  &nbsp;
                                                                          <input name="OptionalSD" type="checkbox" id="OptionalSD"/>
OPTIONAL&nbsp;-- &nbsp;format&nbsp;<em>YYYY-MM-DD</em> </td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td><input name="filED" type="checkbox" id="filED" checked="checked"  />
                                                                          end date </td>
                                                                        <td><select name="opED" id="opED">
                                                                          <option value="&gt;"> &gt;</option>
                                                                          <option value="&gt;="> &ge;</option>
                                                                          <option value="&lt;"> &lt;</option>
                                                                          <option value="&gt;="> &le;</option>
                                                                          <option value="="> =</option>
                                                                          <option value="!="> &ne;</option>
                                                                        </select></td>
                                                                        <td><input name="EDVal" type="date" id="EDVal" value="2013-01-08"class="form-control"/></td>
                                                                        <td>  &nbsp;
                                                                           <input name="OptionalED" type="checkbox" id="OptionalED"/>
OPTIONAL&nbsp;-- &nbsp;format&nbsp;<em>YYYY-MM-DD</em></td>
                                                                      </tr>
                                                                      <tr>
                                                                        <td><input name="filPublisher" type="checkbox" id="filPublisher" checked="checked" />
                                                                          publisher</td>
                                                                        <td>&nbsp;</td>
                                                                        <td><input name="PublisherVal" type="text" id="PublisherVal" value="Springer" size="36" class="form-control"/></td>
                                                                        <td> &nbsp;
                                                                           <input name="OptionalPublisher" type="checkbox" id="OptionalPublisher"/>
OPTIONAL</td>
                                                                      </tr>
          </table>
 
   <p><strong>1.4 Query modifiers</strong></p>
   <table width="80%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="10%" >Order by:&nbsp;</td>
       <td width="5%" ><input name="selOrderBy1" type="checkbox" id="selOrderBy1" checked="checked" /></td>
       <td width="18%" ><select name="orderbyVal1" class="form-control" id="orderbyVal1"  >
           <option value="?type" selected="selected">type</option>
           <option value="?series">series</option>
           <option value="?country">country</option>
           <option value="?city">city</option>
           <option value="?field">field</option>
           <option value="?acc">acceptance rate</option>
           <option value="?AP">accepted papers</option>
           <option value="?SP">submitted papers</option>
           <option value="?SD">start date</option>
           <option value="?ED">end date</option>
           <option value="?website">website</option>
           <option value="?publisher">publisher</option>
           <!--selected="selected"-->
         </select></td>
       <td width="12%" > &nbsp;
         <input name="selOrderByDESC1_1" type="checkbox" id="selOrderByDESC1_1" />
DESC</td>
       <td width="6%" >,
         &nbsp;
         <input name="selOrderBy2" type="checkbox" id="selOrderBy2" /></td>
       <td width="22%" ><select name="orderbyVal2" class="form-control" id="orderbyVal2"  >
           <option value="?type">type</option>
           <option value="?series"selected="selected">series</option>
           <option value="?country">country</option>
           <option value="?city">city</option>
           <option value="?field">field</option>
           <option value="?acc">acceptance rate</option>
           <option value="?AP">accepted papers</option>
           <option value="?SP">submitted papers</option>
           <option value="?SD">start date</option>
           <option value="?ED">end date</option>
           <option value="?website">website</option>
           <option value="?publisher">publisher</option>
           <!--selected="selected"-->
         </select></td>
       <td width="5%" > &nbsp;
          <input name="selOrderByDEC1_2" type="checkbox" id="selOrderByDEC1_2" /></td>
       <td width="22%" > DESC</td>
     </tr>
     <tr>
       <td>Limit:</td>
       <td><input name="selLimit" type="checkbox" id="selLimit" checked="checked" /></td>
       <td><input name="LimitVal" type="text" id="LimitVal" value="10" size="20" class="form-control"/></td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
   </table>
   <p>
     <input type="submit" name="submit" value="Generate"> 
   
   <button type="button" onclick="copy('generatedQuery')">Copy</button></p>
  
 <div align="center"></div>
     <p>    Generated query:  </p>
     <p><textarea id="generatedQuery" name="generatedQuery" rows="10" cols="120"><?php echo $generatedQuery; ?></textarea> </p>
 </form>
<form method="post" action="querySPARQLClient.php"><!-- /SER-Service/SPARQL-AG/-->
  <p><strong>1.5 query execution: </strong>you can edit the generated query before press the Execute button (<em>modify-before-execution</em> is enabled). </p>
  <p>
    	&nbsp;
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
    	<input type="submit" name="submit2" value="Execute" onclick="getVal('hiddenField1','generatedQuery')" />
    	<input type="hidden" id='hiddenField1'  name="q" value="<?php echo $generatedQuery; ?>" />
    	<!--            getVal()to get the updated query from textarea-->
    </p>
</form>
<hr />
<h4>2. SPARQL query generation with aggregation  </h4>
<strong>2.1 Prefix declaration:</strong>  each namespace SHOULD be in a new line and SHOULD be like: <span class="style2">vcard: &lt;http://www.w3.org/2001/vcard-rdf/3.0#&gt;</span>  
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  

            <p> <textarea name="prefix2" id="prefix2" rows="5" cols="120" onkeypress="KeyPress(event)"  > <?php echo $prefix; ?></textarea> 
            </p>

            <p  ><strong> 2.2 Select aggregation function: </strong>
           &nbsp;            
            <table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9%" >function:&nbsp;&nbsp;&nbsp; </td>
                <td width="18%" >
				
		<select name="selFn" class="form-control" id="selFn"  onchange="generateAlias()">
                  <option value="COUNT">COUNT</option>
                  <option value="SUM">SUM</option>
                  <option value="AVG" selected="selected">AVG</option>
                  <option value="MIN">MIN</option>
                  <option value="MAX">MAX</option>
                  <option value="SAMPLE">SAMPLE</option>
                  <option value="GROUP_CONCAT">GROUP_CONCAT</option>
                  <!--selected="selected"-->
                </select>                </td>
				<td width="18%">&nbsp; column:</td>
                <td width="25%"><select name="selFnCol" class="form-control" id="selFnCol"  onchange="generateAlias()">
                  <option value="?type">type</option>
                  <option value="?series">series</option>
                  <option value="?country">country</option>
                  <option value="?city">city</option>
                  <option value="?field">field</option>
                  <option value="?acc" selected="selected">acceptance rate</option>
                  <option value="?AP">accepted papers</option>
                  <option value="?SP">submitted papers</option>
                  <option value="?SD">start date</option>
                  <option value="?ED">end date</option>
                  <option value="?website">website</option>
                  <option value="?publisher">publisher</option>
                  <!--selected="selected"-->
                </select></td>
                <td width="5%">&nbsp;&nbsp; AS</td>
                <td width="25%"><input name="asVal" type="text" class="form-control" id="asVal" value="?type_COUNT" size="20"/></td>
              </tr>
              <tr>
                <td ><div align="right">
                  <input name="selAggCol" type="checkbox" id="selAggCol"  onclick="addAggregationColToGroupBy()"/>
                  &nbsp;&nbsp; 
                </div></td>
                <td >add column:</td>
                <td><select name="aggColVal" class="form-control" id="aggColVal"  onchange="addAggregationColToGroupBy()">
                  <option value="?e">event URI</option>
                  <option value="?type">type</option>
                  <option value="?series" selected="selected">series</option>
                  <option value="?country">country</option>
                  <option value="?city">city</option>
                  <option value="?field">field</option>
                  <option value="?acc">acceptance rate</option>
                  <option value="?AP">accepted papers</option>
                  <option value="?SP">submitted papers</option>
                  <option value="?SD">start date</option>
                  <option value="?ED">end date</option>
                  <option value="?website">website</option>
                  <option value="?publisher">publisher</option>
                  <!--selected="selected"-->
                </select></td>
                <td colspan="3"><span class="style5">&nbsp;*  selected column must added to group by clause; we do it for you. </span></td>
              </tr>
          </table>
            <p  >
          
            <table width="50%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="16%" >Group by:&nbsp;</td>
               <td width="5%" ><input name="selGroupBy1" type="checkbox" id="selGroupBy1" /></td>
               <td width="27%" ><select name="groupbyVal1" class="form-control" id="groupbyVal1"  >
                   <option value="?type">type</option>
                   <option value="?series" selected="selected">series</option>
                   <option value="?country">country</option>
                   <option value="?city">city</option>
                   <option value="?field">field</option>
                   <option value="?acc">acceptance rate</option>
                   <option value="?AP">accepted papers</option>
                   <option value="?SP">submitted papers</option>
                   <option value="?SD">start date</option>
                   <option value="?ED">end date</option>
                   <option value="?website">website</option>
                   <option value="?publisher">publisher</option>
                   <!--selected="selected"-->
               </select></td>
               <td width="11%" >&nbsp;
                 &nbsp;
             <input name="selGroupBy2" type="checkbox" id="selGroupBy2" /></td>
               <td width="41%" ><select name="groupbyVal2" class="form-control" id="groupbyVal2"  >
                   <option value="?type">type</option>
                   <option value="?series"selected="selected">series</option>
                   <option value="?country">country</option>
                   <option value="?city">city</option>
                   <option value="?field">field</option>
                   <option value="?acc">acceptance rate</option>
                   <option value="?AP">accepted papers</option>
                   <option value="?SP">submitted papers</option>
                   <option value="?SD">start date</option>
                   <option value="?ED">end date</option>
                   <option value="?website">website</option>
                   <option value="?publisher">publisher</option>
                   <!--selected="selected"-->
               </select></td>
             </tr>
             <tr>
               <td>Having:</td>
               <td><input name="selHaving" type="checkbox" id="selHaving" onclick="addAggregationFnToHaving()"/></td>
               <td><input name="HavingColVal" type="text" id="HavingColVal" size="20" class="form-control"/></td>
               <td> &nbsp;
                 <select name="havingOP" id="havingOP">
                 <option value="&gt;"> &gt;</option>
                 <option value="&gt;="> &ge;</option>
                 <option value="&lt;"> &lt;</option>
                 <option value="&gt;="> &le;</option>
                 <option value="="> =</option>
                 <option value="!="> &ne;</option>
               </select></td>
               <td><input name="havingVal" type="text" id="havingVal" value="0" size="20" class="form-control"/></td>
             </tr>
          </table>
    <p><strong>2.4 Query modifiers</strong></p>
    <table width="70%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="13%" >Order by:&nbsp;</td>
        <td width="4%" ><input name="selOrderBy2_1" type="checkbox" id="selOrderBy2_1" /></td>
        <td width="29%" ><select name="orderbyVal2_1" class="form-control" id="orderbyVal2_1"  >
            <option value="?type" selected="selected">type</option>
            <option value="?series">series</option>
            <option value="?country">country</option>
            <option value="?city">city</option>
            <option value="?field">field</option>
            <option value="?acc">acceptance rate</option>
            <option value="?AP">accepted papers</option>
            <option value="?SP">submitted papers</option>
            <option value="?SD">start date</option>
            <option value="?ED">end date</option>
            <option value="?website">website</option>
            <option value="?publisher">publisher</option>
            <!--selected="selected"-->
        </select></td>
        <td width="12%" > &nbsp;
          <input name="selOrderByDESC2_1" type="checkbox" id="selOrderByDESC2_1" />
DESC</td>
        <td width="5%" >, 
          <input name="selOrderBy2_2" type="checkbox" id="selOrderBy2_2" /></td>
        <td width="19%" ><select name="orderbyVal2_2" class="form-control" id="select2"  >
          <option value="?type">type</option>
          <option value="?series"selected="selected">series</option>
          <option value="?country">country</option>
          <option value="?city">city</option>
          <option value="?field">field</option>
          <option value="?acc">acceptance rate</option>
          <option value="?AP">accepted papers</option>
          <option value="?SP">submitted papers</option>
          <option value="?SD">start date</option>
          <option value="?ED">end date</option>
          <option value="?website">website</option>
          <option value="?publisher">publisher</option>
          <!--selected="selected"-->
        </select></td>
        <td width="18%" > &nbsp;
          <input name="selOrderByDESC2_2" type="checkbox" id="selOrderByDESC2_2" />
DESC</td>
      </tr>
      <tr>
        <td>Limit:</td>
        <td><input name="selLimit_2" type="checkbox" id="selLimit_2" /></td>
        <td><input name="LimitVal_2" type="text" id="LimitVal_2" value="10" size="20" class="form-control"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    
    <p>
      <input type="submit" name="submitAgg" value="Generate" />
      <button type="button" onclick="copy('generatedQuery2')">Copy</button>
    </p>
    <p>Generated query: </p>
    <p>   <textarea id="generatedQuery2" name="textarea2" rows="10" cols="120"><?php echo $generatedQuery2; ?></textarea>   </p>
			
		
	</form>
            <form method="post" action="/SER-Service/SPARQL-AG/querySPARQLClient.php">
  <p><strong>2.5 query execution: </strong>you can edit the generated query before press the Execute button.</p>
  <p>
    	&nbsp;
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="submit" name="submit22" value="Execute" onclick="getVal('hiddenField2','generatedQuery2')" />
    	<input type="hidden" id='hiddenField2'  name="q" value="<?php echo $generatedQuery2; ?>">
    <!--            getVal()to get the updated query from textarea-->
    </p>
</form>
            <hr />
            <h4>3. Parametarized predefined SPARQL query</h4>
            <ol>
              <li>give me all events in the field&nbsp;
                <select name="ParaField" class="form-control" id="ParaField">
                  <option value="&lt;http://purl.org/seo#ArtificialIntelligence&gt;">Artificial Intelligence</option>
                  <option value="&lt;http://purl.org/seo#SoftwareEngineering&gt;">Software Engineering </option>
                  <option value="&lt;http://purl.org/seo#WorldWideWeb&gt;">Web Technologies</option>
                  <option value="&lt;http://purl.org/seo#SecurityAndPrivacy&gt;">Computer Security</option>
                  <option value="&lt;http://purl.org/seo#InformationSystems&gt;">Information systems</option>
                  <option value="&lt;http://purl.org/seo#ComputerSystemsOrganization&gt;">Computer systems organization</option>
                  <option value="&lt;http://purl.org/seo#HumanCenteredComputing&gt;">Human Centered Computing</option>
                  <option value="&lt;http://purl.org/seo#TheoryOfComputations&gt;">Theory of Computation</option>
                </select> 
              that took place between&nbsp;&nbsp;
              <input name="SDVal2" type="date" id="SDVal2" value="2013-01-08" class="form-control"/>  
              and 
              <input name="SDVal3" type="date" id="SDVal3" value="2013-01-08" class="form-control"/>
             &nbsp; in 
             <select name="select3" class="form-control">
               <option value="Afganistan">Afghanistan</option>
               <option value="Albania">Albania</option>
               <option value="Algeria">Algeria</option>
               <option value="American_Samoa">American Samoa</option>
               <option value="Andorra">Andorra</option>
               <option value="Angola">Angola</option>
               <option value="Anguilla">Anguilla</option>
               <option value="Antigua_and_Barbuda">Antigua &amp; Barbuda</option>
               <option value="Argentina">Argentina</option>
               <option value="Armenia">Armenia</option>
               <option value="Aruba">Aruba</option>
               <option value="Australia">Australia</option>
               <option value="Austria">Austria</option>
               <option value="Azerbaijan">Azerbaijan</option>
               <option value="Bahamas">Bahamas</option>
               <option value="Bahrain">Bahrain</option>
               <option value="Bangladesh">Bangladesh</option>
               <option value="Barbados">Barbados</option>
               <option value="Belarus">Belarus</option>
               <option value="Belgium">Belgium</option>
               <option value="Belize">Belize</option>
               <option value="Benin">Benin</option>
               <option value="Bermuda">Bermuda</option>
               <option value="Bhutan">Bhutan</option>
               <option value="Bolivia">Bolivia</option>
               <option value="Bonaire">Bonaire</option>
               <option value="Bosnia_and_Herzegovina">Bosnia &amp; Herzegovina</option>
               <option value="Botswana">Botswana</option>
               <option value="Brazil">Brazil</option>
               <option value="Brunei">Brunei</option>
               <option value="Bulgaria">Bulgaria</option>
               <option value="Burkina_Faso">Burkina Faso</option>
               <option value="Burundi">Burundi</option>
               <option value="Cambodia">Cambodia</option>
               <option value="Cameroon">Cameroon</option>
               <option value="Canada">Canada</option>
               <option value="Canary_Islands">Canary Islands</option>
               <option value="Cape_Verde">Cape Verde</option>
               <option value="Cayman_Islands">Cayman Islands</option>
               <option value="Central_African_Republic">Central African Republic</option>
               <option value="Chad">Chad</option>
               <option value="Channel_Islands_Beach,_California">Channel Islands</option>
               <option value="Chile">Chile</option>
               <option value="China">China</option>
               <option value="Christmas_Island">Christmas Island</option>
               <option value="Colombia">Colombia</option>
               <option value="Comoros">Comoros</option>
               <option value="Congo">Congo</option>
               <option value="Cook_Islands">Cook Islands</option>
               <option value="Costa_Rica">Costa Rica</option>
               <option value="Ivory_Coast">Cote D'Ivoire</option>
               <option value="Croatia">Croatia</option>
               <option value="Cuba">Cuba</option>
               <option value="Curaco">Curacao</option>
               <option value="Cyprus">Cyprus</option>
               <option value="Czech_Republic">Czech Republic</option>
               <option value="Denmark">Denmark</option>
               <option value="Djibouti">Djibouti</option>
               <option value="Dominica">Dominica</option>
               <option value="Dominican_Republic">Dominican Republic</option>
               <option value="East_Timor">East Timor</option>
               <option value="Ecuador">Ecuador</option>
               <option value="Egypt">Egypt</option>
               <option value="El Salvador">El_Salvador</option>
               <option value="Equatorial_Guinea">Equatorial Guinea</option>
               <option value="Eritrea">Eritrea</option>
               <option value="Estonia">Estonia</option>
               <option value="Ethiopia">Ethiopia</option>
               <option value="Falkland_Islands">Falkland Islands</option>
               <option value="Faroe_Islands">Faroe Islands</option>
               <option value="Fiji">Fiji</option>
               <option value="Finland">Finland</option>
               <option value="France">France</option>
               <option value="French_Guiana">French Guiana</option>
               <option value="French_Polynesia">French Polynesia</option>
               <option value="Gabon">Gabon</option>
               <option value="Gambia">Gambia</option>
               <option value="Georgia">Georgia</option>
               <option value="Germany" selected="selected">Germany</option>
               <option value="Ghana">Ghana</option>
               <option value="Gibraltar">Gibraltar</option>
               <option value="Great Britain">United Kingdom</option>
               <option value="Greece">Greece</option>
               <option value="Greenland">Greenland</option>
               <option value="Grenada">Grenada</option>
               <option value="Guadeloupe">Guadeloupe</option>
               <option value="Guam">Guam</option>
               <option value="Guatemala">Guatemala</option>
               <option value="Guinea">Guinea</option>
               <option value="Guyana">Guyana</option>
               <option value="Haiti">Haiti</option>
               <option value="Hawaii">Hawaii</option>
               <option value="Honduras">Honduras</option>
               <option value="Hong Kong">Hong Kong</option>
               <option value="Hungary">Hungary</option>
               <option value="Iceland">Iceland</option>
               <option value="India">India</option>
               <option value="Indonesia">Indonesia</option>
               <option value="Iran">Iran</option>
               <option value="Iraq">Iraq</option>
               <option value="Ireland">Ireland</option>
               <option value="Isle of Man">Isle of Man</option>
               <option value="Israel">Israel</option>
               <option value="Italy">Italy</option>
               <option value="Jamaica">Jamaica</option>
               <option value="Japan">Japan</option>
               <option value="Jordan">Jordan</option>
               <option value="Kazakhstan">Kazakhstan</option>
               <option value="Kenya">Kenya</option>
               <option value="Kiribati">Kiribati</option>
               <option value="Korea North">Korea North</option>
               <option value="Korea Sout">Korea South</option>
               <option value="Kuwait">Kuwait</option>
               <option value="Kyrgyzstan">Kyrgyzstan</option>
               <option value="Laos">Laos</option>
               <option value="Latvia">Latvia</option>
               <option value="Lebanon">Lebanon</option>
               <option value="Lesotho">Lesotho</option>
               <option value="Liberia">Liberia</option>
               <option value="Libya">Libya</option>
               <option value="Liechtenstein">Liechtenstein</option>
               <option value="Lithuania">Lithuania</option>
               <option value="Luxembourg">Luxembourg</option>
               <option value="Macau">Macau</option>
               <option value="Macedonia">Macedonia</option>
               <option value="Madagascar">Madagascar</option>
               <option value="Malaysia">Malaysia</option>
               <option value="Malawi">Malawi</option>
               <option value="Maldives">Maldives</option>
               <option value="Mali">Mali</option>
               <option value="Malta">Malta</option>
               <option value="Marshall Islands">Marshall Islands</option>
               <option value="Martinique">Martinique</option>
               <option value="Mauritania">Mauritania</option>
               <option value="Mauritius">Mauritius</option>
               <option value="Mayotte">Mayotte</option>
               <option value="Mexico">Mexico</option>
               <option value="Midway Islands">Midway Islands</option>
               <option value="Moldova">Moldova</option>
               <option value="Monaco">Monaco</option>
               <option value="Mongolia">Mongolia</option>
               <option value="Montserrat">Montserrat</option>
               <option value="Morocco">Morocco</option>
               <option value="Mozambique">Mozambique</option>
               <option value="Myanmar">Myanmar</option>
               <option value="Nambia">Nambia</option>
               <option value="Nauru">Nauru</option>
               <option value="Nepal">Nepal</option>
               <option value="Netherland Antilles">Netherland Antilles</option>
               <option value="Netherlands">Netherlands (Holland, Europe)</option>
               <option value="Nevis">Nevis</option>
               <option value="New Caledonia">New Caledonia</option>
               <option value="New Zealand">New Zealand</option>
               <option value="Nicaragua">Nicaragua</option>
               <option value="Niger">Niger</option>
               <option value="Nigeria">Nigeria</option>
               <option value="Niue">Niue</option>
               <option value="Norfolk Island">Norfolk Island</option>
               <option value="Norway">Norway</option>
               <option value="Oman">Oman</option>
               <option value="Pakistan">Pakistan</option>
               <option value="Palau Island">Palau Island</option>
               <option value="Palestine">Palestine</option>
               <option value="Panama">Panama</option>
               <option value="Papua New Guinea">Papua New Guinea</option>
               <option value="Paraguay">Paraguay</option>
               <option value="Peru">Peru</option>
               <option value="Phillipines">Philippines</option>
               <option value="Pitcairn Island">Pitcairn Island</option>
               <option value="Poland">Poland</option>
               <option value="Portugal">Portugal</option>
               <option value="Puerto Rico">Puerto Rico</option>
               <option value="Qatar">Qatar</option>
               <option value="Republic of Montenegro">Republic of Montenegro</option>
               <option value="Republic of Serbia">Republic of Serbia</option>
               <option value="Reunion">Reunion</option>
               <option value="Romania">Romania</option>
               <option value="Russia">Russia</option>
               <option value="Rwanda">Rwanda</option>
               <option value="St Barthelemy">St Barthelemy</option>
               <option value="St Eustatius">St Eustatius</option>
               <option value="St Helena">St Helena</option>
               <option value="St Kitts-Nevis">St Kitts-Nevis</option>
               <option value="St Lucia">St Lucia</option>
               <option value="St Maarten">St Maarten</option>
               <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
               <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
               <option value="Saipan">Saipan</option>
               <option value="Samoa">Samoa</option>
               <option value="Samoa American">Samoa American</option>
               <option value="San Marino">San Marino</option>
               <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
               <option value="Saudi Arabia">Saudi Arabia</option>
               <option value="Senegal">Senegal</option>
               <option value="Serbia">Serbia</option>
               <option value="Seychelles">Seychelles</option>
               <option value="Sierra Leone">Sierra Leone</option>
               <option value="Singapore">Singapore</option>
               <option value="Slovakia">Slovakia</option>
               <option value="Slovenia">Slovenia</option>
               <option value="Solomon Islands">Solomon Islands</option>
               <option value="Somalia">Somalia</option>
               <option value="South Africa">South Africa</option>
               <option value="Spain">Spain</option>
               <option value="Sri Lanka">Sri Lanka</option>
               <option value="Sudan">Sudan</option>
               <option value="Suriname">Suriname</option>
               <option value="Swaziland">Swaziland</option>
               <option value="Sweden">Sweden</option>
               <option value="Switzerland">Switzerland</option>
               <option value="Syria">Syria</option>
               <option value="Tahiti">Tahiti</option>
               <option value="Taiwan">Taiwan</option>
               <option value="Tajikistan">Tajikistan</option>
               <option value="Tanzania">Tanzania</option>
               <option value="Thailand">Thailand</option>
               <option value="Togo">Togo</option>
               <option value="Tokelau">Tokelau</option>
               <option value="Tonga">Tonga</option>
               <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
               <option value="Tunisia">Tunisia</option>
               <option value="Turkey">Turkey</option>
               <option value="Turkmenistan">Turkmenistan</option>
               <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
               <option value="Tuvalu">Tuvalu</option>
               <option value="Uganda">Uganda</option>
               <option value="Ukraine">Ukraine</option>
               <option value="United Arab Erimates">United Arab Emirates</option>
               <option value="England">England</option>
               <option value="United States">United States</option>
               <option value="Uraguay">Uruguay</option>
               <option value="Uzbekistan">Uzbekistan</option>
               <option value="Vanuatu">Vanuatu</option>
               <option value="Vatican City State">Vatican City State</option>
               <option value="Venezuela">Venezuela</option>
               <option value="Vietnam">Vietnam</option>
               <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
               <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
               <option value="Wake Island">Wake Island</option>
               <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
               <option value="Yemen">Yemen</option>
               <option value="Zaire">Zaire</option>
               <option value="Zambia">Zambia</option>
               <option value="Zimbabwe">Zimbabwe</option>
             </select>
             &nbsp; 
              <input type="submit" name="submit222" value="Execute" onclick="getVal('hiddenField2','generatedQuery2')" />
              </li>
              <li>give me all events in the field&nbsp;
                <select name="select" class="form-control" id="select">
                  <option value="&lt;http://purl.org/seo#ArtificialIntelligence&gt;">Artificial Intelligence</option>
                  <option value="&lt;http://purl.org/seo#SoftwareEngineering&gt;">Software Engineering </option>
                  <option value="&lt;http://purl.org/seo#WorldWideWeb&gt;">Web Technologies</option>
                  <option value="&lt;http://purl.org/seo#SecurityAndPrivacy&gt;">Computer Security</option>
                  <option value="&lt;http://purl.org/seo#InformationSystems&gt;">Information systems</option>
                  <option value="&lt;http://purl.org/seo#ComputerSystemsOrganization&gt;">Computer systems organization</option>
                  <option value="&lt;http://purl.org/seo#HumanCenteredComputing&gt;">Human Centered Computing</option>
                  <option value="&lt;http://purl.org/seo#TheoryOfComputations&gt;">Theory of Computation</option>
                </select>
that took place in&nbsp; 
<select name="select2" class="form-control">
  <option value="Afganistan">Afghanistan</option>
  <option value="Albania">Albania</option>
  <option value="Algeria">Algeria</option>
  <option value="American_Samoa">American Samoa</option>
  <option value="Andorra">Andorra</option>
  <option value="Angola">Angola</option>
  <option value="Anguilla">Anguilla</option>
  <option value="Antigua_and_Barbuda">Antigua &amp; Barbuda</option>
  <option value="Argentina">Argentina</option>
  <option value="Armenia">Armenia</option>
  <option value="Aruba">Aruba</option>
  <option value="Australia">Australia</option>
  <option value="Austria">Austria</option>
  <option value="Azerbaijan">Azerbaijan</option>
  <option value="Bahamas">Bahamas</option>
  <option value="Bahrain">Bahrain</option>
  <option value="Bangladesh">Bangladesh</option>
  <option value="Barbados">Barbados</option>
  <option value="Belarus">Belarus</option>
  <option value="Belgium">Belgium</option>
  <option value="Belize">Belize</option>
  <option value="Benin">Benin</option>
  <option value="Bermuda">Bermuda</option>
  <option value="Bhutan">Bhutan</option>
  <option value="Bolivia">Bolivia</option>
  <option value="Bonaire">Bonaire</option>
  <option value="Bosnia_and_Herzegovina">Bosnia &amp; Herzegovina</option>
  <option value="Botswana">Botswana</option>
  <option value="Brazil">Brazil</option>
  <option value="Brunei">Brunei</option>
  <option value="Bulgaria">Bulgaria</option>
  <option value="Burkina_Faso">Burkina Faso</option>
  <option value="Burundi">Burundi</option>
  <option value="Cambodia">Cambodia</option>
  <option value="Cameroon">Cameroon</option>
  <option value="Canada">Canada</option>
  <option value="Canary_Islands">Canary Islands</option>
  <option value="Cape_Verde">Cape Verde</option>
  <option value="Cayman_Islands">Cayman Islands</option>
  <option value="Central_African_Republic">Central African Republic</option>
  <option value="Chad">Chad</option>
  <option value="Channel_Islands_Beach,_California">Channel Islands</option>
  <option value="Chile">Chile</option>
  <option value="China">China</option>
  <option value="Christmas_Island">Christmas Island</option>
  <option value="Colombia">Colombia</option>
  <option value="Comoros">Comoros</option>
  <option value="Congo">Congo</option>
  <option value="Cook_Islands">Cook Islands</option>
  <option value="Costa_Rica">Costa Rica</option>
  <option value="Ivory_Coast">Cote D'Ivoire</option>
  <option value="Croatia">Croatia</option>
  <option value="Cuba">Cuba</option>
  <option value="Curaco">Curacao</option>
  <option value="Cyprus">Cyprus</option>
  <option value="Czech_Republic">Czech Republic</option>
  <option value="Denmark">Denmark</option>
  <option value="Djibouti">Djibouti</option>
  <option value="Dominica">Dominica</option>
  <option value="Dominican_Republic">Dominican Republic</option>
  <option value="East_Timor">East Timor</option>
  <option value="Ecuador">Ecuador</option>
  <option value="Egypt">Egypt</option>
  <option value="El Salvador">El_Salvador</option>
  <option value="Equatorial_Guinea">Equatorial Guinea</option>
  <option value="Eritrea">Eritrea</option>
  <option value="Estonia">Estonia</option>
  <option value="Ethiopia">Ethiopia</option>
  <option value="Falkland_Islands">Falkland Islands</option>
  <option value="Faroe_Islands">Faroe Islands</option>
  <option value="Fiji">Fiji</option>
  <option value="Finland">Finland</option>
  <option value="France">France</option>
  <option value="French_Guiana">French Guiana</option>
  <option value="French_Polynesia">French Polynesia</option>
  <option value="Gabon">Gabon</option>
  <option value="Gambia">Gambia</option>
  <option value="Georgia">Georgia</option>
  <option value="Germany" selected="selected">Germany</option>
  <option value="Ghana">Ghana</option>
  <option value="Gibraltar">Gibraltar</option>
  <option value="Great Britain">United Kingdom</option>
  <option value="Greece">Greece</option>
  <option value="Greenland">Greenland</option>
  <option value="Grenada">Grenada</option>
  <option value="Guadeloupe">Guadeloupe</option>
  <option value="Guam">Guam</option>
  <option value="Guatemala">Guatemala</option>
  <option value="Guinea">Guinea</option>
  <option value="Guyana">Guyana</option>
  <option value="Haiti">Haiti</option>
  <option value="Hawaii">Hawaii</option>
  <option value="Honduras">Honduras</option>
  <option value="Hong Kong">Hong Kong</option>
  <option value="Hungary">Hungary</option>
  <option value="Iceland">Iceland</option>
  <option value="India">India</option>
  <option value="Indonesia">Indonesia</option>
  <option value="Iran">Iran</option>
  <option value="Iraq">Iraq</option>
  <option value="Ireland">Ireland</option>
  <option value="Isle of Man">Isle of Man</option>
  <option value="Israel">Israel</option>
  <option value="Italy">Italy</option>
  <option value="Jamaica">Jamaica</option>
  <option value="Japan">Japan</option>
  <option value="Jordan">Jordan</option>
  <option value="Kazakhstan">Kazakhstan</option>
  <option value="Kenya">Kenya</option>
  <option value="Kiribati">Kiribati</option>
  <option value="Korea North">Korea North</option>
  <option value="Korea Sout">Korea South</option>
  <option value="Kuwait">Kuwait</option>
  <option value="Kyrgyzstan">Kyrgyzstan</option>
  <option value="Laos">Laos</option>
  <option value="Latvia">Latvia</option>
  <option value="Lebanon">Lebanon</option>
  <option value="Lesotho">Lesotho</option>
  <option value="Liberia">Liberia</option>
  <option value="Libya">Libya</option>
  <option value="Liechtenstein">Liechtenstein</option>
  <option value="Lithuania">Lithuania</option>
  <option value="Luxembourg">Luxembourg</option>
  <option value="Macau">Macau</option>
  <option value="Macedonia">Macedonia</option>
  <option value="Madagascar">Madagascar</option>
  <option value="Malaysia">Malaysia</option>
  <option value="Malawi">Malawi</option>
  <option value="Maldives">Maldives</option>
  <option value="Mali">Mali</option>
  <option value="Malta">Malta</option>
  <option value="Marshall Islands">Marshall Islands</option>
  <option value="Martinique">Martinique</option>
  <option value="Mauritania">Mauritania</option>
  <option value="Mauritius">Mauritius</option>
  <option value="Mayotte">Mayotte</option>
  <option value="Mexico">Mexico</option>
  <option value="Midway Islands">Midway Islands</option>
  <option value="Moldova">Moldova</option>
  <option value="Monaco">Monaco</option>
  <option value="Mongolia">Mongolia</option>
  <option value="Montserrat">Montserrat</option>
  <option value="Morocco">Morocco</option>
  <option value="Mozambique">Mozambique</option>
  <option value="Myanmar">Myanmar</option>
  <option value="Nambia">Nambia</option>
  <option value="Nauru">Nauru</option>
  <option value="Nepal">Nepal</option>
  <option value="Netherland Antilles">Netherland Antilles</option>
  <option value="Netherlands">Netherlands (Holland, Europe)</option>
  <option value="Nevis">Nevis</option>
  <option value="New Caledonia">New Caledonia</option>
  <option value="New Zealand">New Zealand</option>
  <option value="Nicaragua">Nicaragua</option>
  <option value="Niger">Niger</option>
  <option value="Nigeria">Nigeria</option>
  <option value="Niue">Niue</option>
  <option value="Norfolk Island">Norfolk Island</option>
  <option value="Norway">Norway</option>
  <option value="Oman">Oman</option>
  <option value="Pakistan">Pakistan</option>
  <option value="Palau Island">Palau Island</option>
  <option value="Palestine">Palestine</option>
  <option value="Panama">Panama</option>
  <option value="Papua New Guinea">Papua New Guinea</option>
  <option value="Paraguay">Paraguay</option>
  <option value="Peru">Peru</option>
  <option value="Phillipines">Philippines</option>
  <option value="Pitcairn Island">Pitcairn Island</option>
  <option value="Poland">Poland</option>
  <option value="Portugal">Portugal</option>
  <option value="Puerto Rico">Puerto Rico</option>
  <option value="Qatar">Qatar</option>
  <option value="Republic of Montenegro">Republic of Montenegro</option>
  <option value="Republic of Serbia">Republic of Serbia</option>
  <option value="Reunion">Reunion</option>
  <option value="Romania">Romania</option>
  <option value="Russia">Russia</option>
  <option value="Rwanda">Rwanda</option>
  <option value="St Barthelemy">St Barthelemy</option>
  <option value="St Eustatius">St Eustatius</option>
  <option value="St Helena">St Helena</option>
  <option value="St Kitts-Nevis">St Kitts-Nevis</option>
  <option value="St Lucia">St Lucia</option>
  <option value="St Maarten">St Maarten</option>
  <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
  <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
  <option value="Saipan">Saipan</option>
  <option value="Samoa">Samoa</option>
  <option value="Samoa American">Samoa American</option>
  <option value="San Marino">San Marino</option>
  <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
  <option value="Saudi Arabia">Saudi Arabia</option>
  <option value="Senegal">Senegal</option>
  <option value="Serbia">Serbia</option>
  <option value="Seychelles">Seychelles</option>
  <option value="Sierra Leone">Sierra Leone</option>
  <option value="Singapore">Singapore</option>
  <option value="Slovakia">Slovakia</option>
  <option value="Slovenia">Slovenia</option>
  <option value="Solomon Islands">Solomon Islands</option>
  <option value="Somalia">Somalia</option>
  <option value="South Africa">South Africa</option>
  <option value="Spain">Spain</option>
  <option value="Sri Lanka">Sri Lanka</option>
  <option value="Sudan">Sudan</option>
  <option value="Suriname">Suriname</option>
  <option value="Swaziland">Swaziland</option>
  <option value="Sweden">Sweden</option>
  <option value="Switzerland">Switzerland</option>
  <option value="Syria">Syria</option>
  <option value="Tahiti">Tahiti</option>
  <option value="Taiwan">Taiwan</option>
  <option value="Tajikistan">Tajikistan</option>
  <option value="Tanzania">Tanzania</option>
  <option value="Thailand">Thailand</option>
  <option value="Togo">Togo</option>
  <option value="Tokelau">Tokelau</option>
  <option value="Tonga">Tonga</option>
  <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
  <option value="Tunisia">Tunisia</option>
  <option value="Turkey">Turkey</option>
  <option value="Turkmenistan">Turkmenistan</option>
  <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
  <option value="Tuvalu">Tuvalu</option>
  <option value="Uganda">Uganda</option>
  <option value="Ukraine">Ukraine</option>
  <option value="United Arab Erimates">United Arab Emirates</option>
  <option value="England">England</option>
  <option value="United States">United States</option>
  <option value="Uraguay">Uruguay</option>
  <option value="Uzbekistan">Uzbekistan</option>
  <option value="Vanuatu">Vanuatu</option>
  <option value="Vatican City State">Vatican City State</option>
  <option value="Venezuela">Venezuela</option>
  <option value="Vietnam">Vietnam</option>
  <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
  <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
  <option value="Wake Island">Wake Island</option>
  <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
  <option value="Yemen">Yemen</option>
  <option value="Zaire">Zaire</option>
  <option value="Zambia">Zambia</option>
  <option value="Zimbabwe">Zimbabwe</option>
</select>
.&nbsp;
<input type="submit" name="submit2222" value="Execute" onclick="getVal('hiddenField2','generatedQuery2')" />
</li>
            </ol>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>Combining SPARQL Graph Patterns : { A } UNION { B } &nbsp;&nbsp; A MINUS { B }</p>
            <p>SPARQL Subqueries</p>
</div>
  <div class="column side">
    <h2>&nbsp;</h2>
  </div>
	</div>
        <script>
           
   function generateAlias(){
         document.getElementById('asVal').value = document.getElementById('selFnCol').value+  "_"+ document.getElementById('selFn').value  ;
    }
    function getVal(hiddenId,textareaID)
    {
        document.getElementById(hiddenId).value = document.getElementById(textareaID).value ;
    }
function KeyPress(e) { 
e = e || window.event;
var key = e.keyCode ? e.keyCode : e.which;
if (key == 13) {
e.preventDefault();
 document.getElementById("prefix").value += "\n PREFIX ";
}
}
function copy(id) {
let textarea = document.getElementById(id);
textarea.select();
document.execCommand("copy");
}
function addAggregationFnToHaving() { // automaticll add Agg fun to having
// Get the checkbox
var checkBox = document.getElementById("selHaving");
// Get the output text
var text = document.getElementById("HavingColVal");

// If the checkbox is checked, display the output text
if (checkBox.checked == true){
text.value = document.getElementById("selFn").value+"("+document.getElementById("selFnCol").value+")";
} else {
text.value = "";
}
}
function addAggregationColToGroupBy() { // automaticll add Agg fun to having
// Get the checkbox
var checkBox = document.getElementById("selAggCol");
// Get the output text
var text = document.getElementById("groupbyVal1");

// If the checkbox is checked, display the output text
if (checkBox.checked == true){
text.value = document.getElementById("aggColVal").value;
document.getElementById("selGroupBy1").checked=true;

} else {
text.value = "";
document.getElementById("selGroupBy1").checked=false;

}
}

        </script>
</body>
                                                                                        </html>
