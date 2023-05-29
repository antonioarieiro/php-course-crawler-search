<?php

require 'vendor/autoload.php';
require 'src/SearchCourse.php';
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Search\CourseSearch\Search;
$client = new Client([
    'verify' => false,
    'base_uri' => 'https://www.alura.com.br'
]);
$crawler = new Crawler();
$search = new Search($client, $crawler);
$tag = '';

if (isset($_POST['tag']) ) {
    $tag = $_POST['tag'];
    if(strlen($tag) > 0) {

        $courses = $search->searchCourseFromUrl('/cursos-online-programacao/'.$tag);
    }

}
?>
<!DOCTYPE html>
<html>
    <style>
        form {
            margin-bottom: 20px;
        }
        .input-text {
            border: solid 1px;
            padding: 8px;
            border-radius: 4px;
        }
        .btn-search {
            border: none;
            padding: 8px;
            background: #a76161;
            color: white;
        }
    </style>
    <body>
        <p class="message">Search course in alura from tag!</p>
        <form method="post">
            <input class="input-text" name="tag" type="text" placeholder="insert tag name exp: php">
            <button class="btn-search">Search</button>
        </form>
        <?php
            if(strlen($tag) > 1) {
                foreach ($courses as $course) {
                    $courseText = $course->textContent;
                    $courseLink = 'https://www.alura.com.br/cursos-online-programacao/' . urlencode($courseText);
                    echo '<a href="' . $courseLink . '">' . $courseText . '</a><br/>';
                }
            }
        ?>
    </body>
</html>
