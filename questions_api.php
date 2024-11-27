<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions | API</title>
    <style>
        .main-questions h2{
            text-align: center;
            color: #aaa;
            text-decoration: underline;
            padding: 3px;
        }
        ol{
            list-style-type:lower-alpha;
        }
        .questions-body{
            height: 70vh;
            width: 400px;
            background-color: #ddd;
            padding: 20px;
            margin: 10px auto;
            overflow: scroll;
        }
        .main-questions{
            background: #fff;
            padding: 10px;
            border-bottom: 2px solid #aaddac;
            box-shadow: 7px 5px 8px 8px rgba(0,0,0,0.2);
        }
        .main-questions .answer-box{
            color: #562;
            float: right;
        }
    </style>
</head>
<body>
    <div>
    <?php
// Questions API
$api_url = "https://bongoclass.com/quiz/brain/jj.php";
// Initiate curl
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$api_url);
curl_setopt($ch, CURLOPT_HTTPHEADER,["content-type: application/json"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
// check for cURL errors
if(curl_errno($ch)){
    echo "cURL error. " . curl_error($ch);
}else{
    // execute the curl
    $feedback = curl_exec($ch);
    // decode the data from API into JSON and now take data as object 
    $response = json_decode($feedback);
    if(isset($response->questions)){
        $questions = $response->questions;
    }
}
?>

    <div class="questions-body">
        <div class="main-questions">
            <h2>Maswali na Majibu</h2>
            <?php
                if (!empty($questions)){
                    $no = 1;
                    foreach($questions as $question)
                    {?>
                        <!-- echo $output->text . "<br>"; -->
                        <p>
                            <?php
                                echo $no++ . ":\n" . $question->text . "<br>";
                            ?>
                        </p>
                    <?php
                    // Loop answers
                    $opt = $question->options;
                    echo "<ol>";
                    foreach($opt as $option){?>
                        <!-- echo $option->text . "<br>"; -->
                            <li><?php echo $option->text; ?></li>
                    <?php
                    }
                    echo "<span class='answer-box'>[  ]</span>";
                    echo "</ol>";
                    
                }
                }
            ?>
        </div>
    </div>

    </div>
</body>
</html>