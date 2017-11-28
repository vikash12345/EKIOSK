<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
for($page = 11412; $page <248998; $page++)
{
  echo "$page\n";
  $LINK               =     'http://202.61.43.37:8082/ekioskv2/(S(kq4pwh3tumdqjfrn2fckn3ch))/CaseProfile.aspx?1='.$page;
  $html               =     file_get_html($LINK);
  if($html){
  $caseno             =     $html->find("//*[@id='lbl_caseno']",0)->plaintext;
  $parties            =     $html->find("//*[@id='lbl_parties']",0)->plaintext;
  $advocate           =     $html->find("//*[@id='lbl_advo_p1']",0)->plaintext;
  $caseinst           =     $html->find("//*[@id='lbl_case_institution_date']",0)->plaintext;
  $html_encoded 			= html_entity_decode($html);
  
  if($caseno  != "")
  {
  $record = array( 'link' =>$LINK, 'caseno' => $caseno ,'parties' => $parties ,'advocate' => $advocate,'caseinst' => $caseinst , 'html_encoded' => $html_encoded);
  
 scraperwiki::save(array('link','caseno','parties','advocate','caseinst','html_encoded'), $record);
  
  }
    else{
       $record = array( 'link' =>$LINK, 'caseno' => "N/A" ,'parties' => "N/A" ,'advocate' => "N/A",'caseinst' => "N/A" , 'html_encoded' => "N/A");
  
 scraperwiki::save(array('link','caseno','parties','advocate','caseinst','html_encoded'), $record);
    }
  }
  
}

//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
