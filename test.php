<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>SPRQL-AG </title>
        <style>
            .error {color: #FF0000;}
            .style2 {  font-style: italic; }
        </style>
    </head>


    <body>
        <h2>SPRQL-AG service</h2>
        Your query has been executed by EVENTSKG public SPARQL endpoint and below are the results. 

        <h3>Results:</h3>
        <p> <button onclick="goBack()">Back </button></p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
<input type="submit" name="submit" value="Execute"  />

</form>
       <div> <?php
	   if(isset($_POST['submit'])){ 
         //code to be executed
        header('X-XSS-Protection:0');  // to prevent X-XSS-Protection
        // define variables and set to empty values
		    define("RDFAPI_INCLUDE_DIR", $_SERVER['DOCUMENT_ROOT']."/SPARQL-AG/api/");
        include(RDFAPI_INCLUDE_DIR . "RdfAPI.php");
        include (RDFAPI_INCLUDE_DIR . "sparql/SparqlEngine.php");
		include (RDFAPI_INCLUDE_DIR . "sparql/SparqlParser.php");
        $querystring = '
		PREFIX seo: <http://purl.org/seo/> 
 		PREFIX conference-ontology: <https://w3id.org/scholarlydata/ontology/conference-ontology.owl#>
	 SELECT DISTINCT  ?e
 WHERE {
 ?e rdf:type ?type. FILTER( ?type = conference-ontology:Conference || ?type = conference-ontology:Workshop || ?type = seo:Symposium) .
 ?e seo:heldInCountry  ?country FILTER(?country= <http://dbpedia.org/resource/Germany>
 }
 ';
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
 
         echo "<div id='ValidateDIV'>"; 
	 
		 $result = $client->query($query);
		 if (isset($result[0]))
		 echo "No errors.";
		 echo "</div>";
 }					
        ?>
</div>
    </body>
</html>
