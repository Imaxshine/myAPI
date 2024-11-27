<?php
if(isset($_POST['submit'])){
    $searchData = $_POST['search'];
    
    $api_url = "https://bongoclass.com/api/sk3/";
    $full_url = $api_url . $searchData;
    //initiate curl
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$full_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,["content-type: application/json"]);
    $response = curl_exec($ch);
    if(curl_errno($ch)){
        $curlErrors = "cURL ERROR " . curl_error($ch);
    }else{
        // decode the response 
        $result = json_decode($response, true);
        // echo $full_url;
        if(isset($result["posts"])){
            $getData = $result["posts"];
        }else{
            $noData = $result["message"]; //"{$searchData} not found!";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bongo | api</title>
    <style>
        .result-body{
            margin-top: 10px;
            padding: 1px;
            background-color: #dda;
            width: fit-content;
            display: block;
        }
        .container{
            margin: 5px auto;
        }
        .post-item{
            background-color: white;
            padding: 3px;
            border-bottom: 2px solid #ddd;

        }
    </style>
</head>
<body>
    <div class="container">
        <form action="#" method="POST">
            <input type="search" placeholder="Tafuta hapa..." name="search" required>
            <button type="submit" name="submit">Tafuta</button>
        </form>
        <div class="result-body">
            <?php
                if(!empty($getData)){
                    echo "<h2 style='display: fixed;'>". "Taarifa za " . htmlspecialchars(strip_tags(strtolower($searchData))) . " zilizopatikana"."</h2>";
                    foreach ($getData as $post) {
                        echo "<div class='post-item'>";
                        echo "<p>" ."Kichwa cha habari: " . "<span>". htmlspecialchars($post['jina']) . "</span>" . "</p>";
                        echo "<p>"."Utangulizi: " . "<span>" . htmlspecialchars($post['utangulizi']) . "</span>" . "</p>";
                        echo "<a href='".htmlspecialchars($post['kiungo'])."' target='_blank'>" . "Soma zaidi" . "</a>";
                        echo "</div>";
                    }
                }
                if(!empty($noData)){
                    echo $noData;
                    exit;
                }
                // curl Errors
                if (!empty($curlErrors))
                {
                    echo $curlErrors;
                }
            ?>
        </div>
    </div>
</body>
</html>