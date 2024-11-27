<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bongo | Hadithi</title>
    <style>
        .heading{
            background-color: #aaa;
            height: 20vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;      
        }
        .story-img{
            width: 200px;
            height: 200px;
        }
        .story-body{
            margin: 0 auto;
            text-align: center;
            background-color: #000;
            color:#aaa;
            padding: 2rem;
        }
        .story-body .maudhui{
            text-align: justify;
        }
    </style>
</head>
<body>
    <div>
    <?php
// API ya burudani
$api_url = "https://bongoclass.com/api/sk/3";
// initiate curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$api_url);
curl_setopt($ch, CURLOPT_HTTPHEADER,['content-type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
// execute the curl
$response = curl_exec($ch);
//check if there is any errors
if(curl_errno($ch)){
    echo "cURL Error: " . curl_error($ch);
}else{
    // decode the responses into json array 
    $story = json_decode($response, true);
    if(isset($story['posts']) && !empty($story['posts']))
    {
        $outputs = $story['posts'];
        echo "<div class='heading'>";
            echo "<h2>" . "Hadithi za kusisimua" . "</h2>";
        echo "</div>";
        foreach($outputs as $output)
        {
            echo "<div class='story-body'>";

            echo "<p>" . "Title: " . "<br>" . "<span>" . 
            htmlspecialchars(strip_tags($output['jina'])) . "</span>" . 
            "</p>";

            echo "<p>" . "Utangulizi: " . "<br>" . "<span>" . 
            htmlspecialchars(strip_tags($output['utangulizi'])) . "</span>" . 
            "</p>";

            echo "<img class='story-img' src='" . $output['picha'] ."' alt='picha'>";

            //story
            echo "<p class='maudhui'>" . htmlspecialchars(strip_tags($output['maudhui'])) . "</p>";
            echo "</div>";

            
        }
    }
}
?>
    </div>
</body>
</html>