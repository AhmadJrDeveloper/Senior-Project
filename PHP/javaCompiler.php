<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../" href="../pictures/pc.webp" />

    <title>Java Compiler</title>
    <link rel="stylesheet" href="../css/manage.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h3><span>Java Compiler</span></h3>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $code = $_POST["code"];
                $file = "../php/compile.java";
                file_put_contents($file, $code);
                $output = shell_exec("javac $file 2>&1 && java Main 2>&1");
                echo "<form method=\"post\" class=\"form-container\">";
                echo "<h3>Enter your Java code:</h3>";
                echo "<label for=\"code\">Code:</label>";
                echo "<br>";
                echo "<textarea id=\"code\" spellcheck=\"false\" name=\"code\" rows=\"10\" cols=\"50\">$code</textarea>";
                echo "<br><br>";
                echo "<input type=\"submit\" value=\"Compile and Run\" class=\"form-btn\">";
                echo "</form>";
                
                echo "<label for=\"output\">Output:</label>";
                echo "<br>";
                echo "<textarea id=\"output\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea>";
            } else {
                $code = "class Main{\n" .
                        "    public static void main(String[] args){\n" .
                        "        System.out.println(\"Hello World\");\n" .
                        "    }\n" .
                        "}";
                echo "<form method=\"post\" class=\"form-container\">";
                echo "<h3>Enter your Java code:</h3>";
                echo "<label for=\"code\">Code:</label>";
                echo "<br>";
                echo "<textarea id=\"code\" spellcheck=\"false\" name=\"code\" rows=\"10\" cols=\"50\">$code</textarea>";
                echo "<br><br>";
                echo "<input type=\"submit\" value=\"Compile and Run\" class=\"form-btn\">";
                echo "</form>";
            }   
            ?>
        </div>
    </div>
</body>
</html>
