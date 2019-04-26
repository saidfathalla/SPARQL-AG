# SPARQL-AG (SPARQL Query Generation Frontend)

SPARQL-AG, a front-end that automatically generates and executes SPARQL queries for querying EVENTSKG.
SPARQL-AG helps potential semantic data consumers, including non-experts and experts, by generating SPARQL queries, ranging from simple to complex ones, using an interactive web interface.  
The eminent feature of SPARQL-AG is that users neither need to know the schema of the knowledge graph being queried nor to learn the SPARQL syntax, as SPARQL-AG offers them a familiar and intuitive interface for query generation and execution.
% Most SPARQL features are covered, such as optional, filters, aggregations, restricting aggregations, ordering, and limiting the number of results.
It maintains separate clients to query three public SPARQL endpoints when asking for particular entities.

SPARQL-AG maintains three SPARQL clients to query three public SPARQL endpoints: [DBpedia SPARQL](https://dbpedia.org/sparql), the Scientific Events Ontology [SPARQL endpoint](http://kddste.sda.tech/SEOontology/sparql), and the EVENTSKG [SPARQL endpoint](http://kddste.sda.tech/sparql), asking for particular entities.

## How to use

SPARQL-AG has been available online [here](http://kddste.sda.tech/SER-Service/SPARQL-AG/test/SPARQL-AG.php) since December 2018. 
No special configuration is needed.

## Implementation

We have implemented all functions described in \autoref{sec:archi} using PHP 7.2.10 and
the [RAP](http://wifo5-03.informatik.uni-mannheim.de/bizer/rdfapi/index.html) (RDF API for PHP) toolkit, thanks to the toolkit developers. 
