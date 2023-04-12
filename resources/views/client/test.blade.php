<?php
# scraping books to scrape: https://books.toscrape.com/
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://zingnews.vn/xay-dung-van-hoa-liem-chinh-post1399000.html');
$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);
dump($xpath->evaluate('//h1[@class="the-article-title"]'));
$titles = $xpath->evaluate('//h1[@class="the-article-title"]');
$extractedTitles = [];
foreach ($titles as $title) {
    $extractedTitles[] = $title->textContent.PHP_EOL;
    echo $title->textContent.PHP_EOL;
}

