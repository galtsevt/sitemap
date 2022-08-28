<?php
// example page
use Sitemap\Sitemap;

require __DIR__ . '/scr/Sitemap.php';

$array = [
    [
        'link' => 'https://example/blog/1',
        'date' => '2018-06-04'
    ],
    [
        'link' => 'https://example/blog/2',
        'date' => '2018-06-04'
    ],
    [
        'link' => 'https://example/blog/3',
        'date' => '2018-06-04'
    ],
];

$sitemap = new Sitemap();
foreach ($array as $blog) {
    $sitemap->add($blog['link'], $blog['date'], 1);
}
echo $sitemap->getBrowser();

