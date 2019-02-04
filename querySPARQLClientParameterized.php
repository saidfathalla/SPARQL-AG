<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>SPARQL-AG</title>
        <style>
            .error {color: #FF0000;}
            .style2 {  font-style: italic; }
        </style>
    </head>


    <body>
        <h2>SPARQL-AG service</h2>
        Your query has been executed by EVENTSKG public SPARQL endpoint and below are the results. 

        <h3>Results:</h3>
        <p> <button onclick="goBack()">Back </button></p>


        <?php
        header('X-XSS-Protection:0');  // to prevent X-XSS-Protection
        // define variables and set to empty values
       
        $querystring = "";
 
 	   if(isset($_POST['submit31'])){ // for query 3.1

            $querystring = ' PREFIX seo: <http://purl.org/seo/> 
                    PREFIX conference-ontology: <https://w3id.org/scholarlydata/ontology/conference-ontology.owl#>
                    SELECT DISTINCT  *
                    WHERE {
                    ?event rdf:type ?type. FILTER( ?type = conference-ontology:Conference || ?type = conference-ontology:Workshop || ?type = seo:Symposium) .
                    ?event seo:heldInCountry  ?country FILTER(?country= <'.$_POST['country31'] .'>) .
                    ?event seo:field  ?field FILTER (?field='.$_POST['ParaField31'] .')
                    ?event conference-ontology:startDate  ?SD. FILTER (?SD> xsd:dateTime("'.$_POST['SDVal311'] .'") &&  ?SD< xsd:dateTime("'.$_POST['SDVal312'] .'") ) .
                    ?event seo:eventWebsite  ?website. 
                    }' ;
           }  
           else if(isset($_POST['submit32'])){ // for query 3.1

            $querystring = ' PREFIX seo: <http://purl.org/seo/> 
                    PREFIX conference-ontology: <https://w3id.org/scholarlydata/ontology/conference-ontology.owl#>
                    SELECT DISTINCT  *
                    WHERE {
                    ?event rdf:type ?type. FILTER( ?type = conference-ontology:Conference || ?type = conference-ontology:Workshop || ?type = seo:Symposium) .
                    ?event seo:field  ?field FILTER (?field='.$_POST['field32'] .').
                    ?event seo:acceptanceRate   ?acc. FILTER(?acc '.$_POST["op32"] . $_POST["accVal32"] . ')
                    }' ;
           }  
           else if(isset($_POST['submit33'])){ // for query 3.1

            $querystring = ' PREFIX seo: <http://purl.org/seo/> 
                    PREFIX conference-ontology: <https://w3id.org/scholarlydata/ontology/conference-ontology.owl#>
                    SELECT DISTINCT  *
                    WHERE {
                    ?event rdf:type ?type. FILTER( ?type = conference-ontology:Conference || ?type = conference-ontology:Workshop || ?type = seo:Symposium) .
                    ?event seo:belongsToSeries    ?series. FILTER( ?series= <http://purl.org/events_ds#'.$_POST['seriesList33'] .'>).
                    ?event conference-ontology:startDate  ?SD. FILTER (?SD> xsd:dateTime("'.$_POST['SDVal33'] .'")) '
                    . '  }' ;
           }
           else if(isset($_POST['submit34'])){ // for query 3.1

            $querystring = ' PREFIX seo: <http://purl.org/seo/> 
                    PREFIX conference-ontology: <https://w3id.org/scholarlydata/ontology/conference-ontology.owl#>
                    SELECT ?country COUNT( ?type) AS ?type_COUNT
                    WHERE {
                    ?event rdf:type ?type .
                    ?event seo:heldInCountry  ?country .
                    }
                    GROUP BY ?country
                    ORDER BY DESC(?type_COUNT)
                    LIMIT  '.$_POST['limit34']  ;
           
           }
           else if(isset($_POST['submit35'])){ // for query 3.1

            $querystring = ' PREFIX seo: <http://purl.org/seo/> 
                    PREFIX conference-ontology: <https://w3id.org/scholarlydata/ontology/conference-ontology.owl#>
                    SELECT ?field COUNT( ?type) AS ?num_event
                    WHERE {
                    ?event rdf:type ?type .
                    ?event seo:field ?field.
                    ?event seo:heldInCountry  ?country FILTER(?country= <'.$_POST['country35'] .'>) .
                    ?event conference-ontology:startDate  ?SD. FILTER (?SD> xsd:dateTime("'.$_POST['SDVal35'] .'") ) .    
                    }
                    GROUP BY ?field
                    ORDER BY DESC(?num_event)
                    '  ;
           
           }
           
//        echo $querystring."\n";	
// Include all RAP classes 
      if ($_SERVER['DOCUMENT_ROOT']=='C:/wamp64/www')
	define("RDFAPI_INCLUDE_DIR", $_SERVER['DOCUMENT_ROOT']."/SPARQL-AG/api/");
      else
	define("RDFAPI_INCLUDE_DIR", $_SERVER['DOCUMENT_ROOT']."SPARQL-AG/api/");
		
	//	echo " </br>" .RDFAPI_INCLUDE_DIR . "sparql/SparqlEngine.php  ";
	//	echo " </br>" .RDFAPI_INCLUDE_DIR . "RdfAPI.php  " ;
        include(RDFAPI_INCLUDE_DIR . "RdfAPI.php");
        include (RDFAPI_INCLUDE_DIR . "sparql/SparqlEngine.php");
		
		
		 
// Create a SPARQL client  
        $client = ModelFactory::getSparqlClient("http://kddste.sda.tech/sparql");
        $query = new ClientQuery();
        // $querystring = '
//		PREFIX seo: <http://purl.org/seo/>
// 		SELECT * 
//		 WHERE { ?e seo:heldInCountry   ?country.  FILTER(regex(str(?country), "Germany", "i" )) .
// 		}
//
//		';
        $query = new ClientQuery();
        $query->query($querystring);
        $result = $client->query($query);
        
        
	
        SPARQLEngine::writeQueryResultAsHtmlTable($result);
 
		
//foreach($result as $line){
//  $value = $line['?events'];
//    if($value != "")
//      echo $value->toString()."<br>";
//    else
//      echo "undbound<br>";
//}
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

    </body>
</html>
