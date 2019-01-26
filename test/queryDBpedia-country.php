<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
        header('X-XSS-Protection:0');  // to prevent X-XSS-Protection
        // define variables and set to empty values
        
        $querystring = "";


        if (!empty($_POST["q"]))
            $querystring = $_POST['q'];


        //echo $querystring;	
// Include all RAP classes 
        define("RDFAPI_INCLUDE_DIR", "C:/wamp64/www/rdfapi-php/api/");
        include(RDFAPI_INCLUDE_DIR . "RdfAPI.php");
        include (RDFAPI_INCLUDE_DIR . "sparql/SparqlEngine.php");
// Create a SPARQL client  
        $client = ModelFactory::getSparqlClient("https://dbpedia.org/sparql");
        $query = new ClientQuery();
        $querystring = '
		
            PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>
            PREFIX owl: <http://www.w3.org/2002/07/owl#>

            SELECT ?country  
            WHERE { 
              ?country rdf:type dbpedia-owl:Country .FILTER (regex(str(?country), "Aruba","i")).
            }
		';
        $query = new ClientQuery();
        $query->query($querystring);
        $result = $client->query($query);
//        foreach ($result as $n => $var) { //n=0..n
//              foreach ($var as $varName => $value) { 
//                echo $value->getLabel();
//            }
//        }
        echo $result[0]['?country']->getLabel();

//        SPARQLEngine::writeQueryResultAsHtmlTable($result);
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