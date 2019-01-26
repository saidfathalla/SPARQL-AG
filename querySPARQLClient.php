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


        <?php
        header('X-XSS-Protection:0');  // to prevent X-XSS-Protection
        // define variables and set to empty values
       
        $querystring = "";
 
        if (!empty($_POST["q"]))
            $querystring = $_POST['q'];

         
   //     echo $querystring."\n";	
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
