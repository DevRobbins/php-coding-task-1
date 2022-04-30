<!-- 
1. Assume you have arrays where each array holds client information that follows this format:
[‘first’ => ‘’, ‘last’ => ‘’, ‘email’ => ‘’]
Write a function that does a loose comparison, returning true if any 2 of the 3 keys have the same value. For
example, you might have the following arrays to compare in pairs:
$employee1 = [‘first’ => ‘bob’, ‘last’ => ‘smith’, ‘email’ => ‘bob@example.com];
$employee2 = [‘first’ => ‘sue’, ‘last’ => ‘smith’, ‘email’ => ‘smith@example.com’];
$employee3 = [‘first’ => ‘sue’, ‘last’ => ‘storm’, ‘email’ => ‘smith@example.com’];
-->

<div style="margin-bottom: 20px;">
<?php 
    $employee1 = ['first' => 'bob', 'last' => 'smith', 'email' => 'bob@example.com'];
    $employee2 = ['first' => 'sue', 'last' => 'smith', 'email' => 'smith@example.com'];
    $employee3 = ['first' => 'sue', 'last' => 'storm', 'email' => 'smith@example.com'];
    $employee4 = ['first' => 'lorem', 'last' => 'ipsum', 'email' => 'smith@example.com'];
    $employee5 = ['first' => 'lorem', 'last' => 'ipsum', 'email' => 'smith@example.com'];

    compareAssArr($employee1, $employee2); // Expected output - false
    compareAssArr($employee2, $employee3); // Expected output - true
    compareAssArr($employee3, $employee4); // Expected output - false
    compareAssArr($employee4, $employee5); // Expected output - Duplicate Associative Arrays


    // Input two associative arrays of same length with same keys
    function compareAssArr($assArr1, $assArr2) {
        $boolLog = 0; 
        
        foreach($assArr1 as $key => $value) {
            $assArr1[$key] == $assArr2[$key] ? $boolLog++ : '';
        }

        switch ($boolLog) {
            case 2;
                echo "true <br />"; break;
            case 3;
                echo "Duplicate Associative Arrays <br />"; break;
            default; 
                echo "false <br />"; break;  
        }
    }
?>
</div>


<!-- 
2a. Write a function that will be passed two strings of random length. Have your function return a string with
all characters that appear in both strings. 

TR assumption: duplicate characters not desired. 
-->

<div style="margin-bottom: 20px;">
    <?php 
        $string1 = 'aabcd !!/.,<> 123';
        $string2 = 'd c B aaaa !!/.,<> 123';
        $string3 = 'Afghijklmnopqrstuvw x y z';
        $string4 = 'a yz ps cb';

        stringCharacterCompDupesOut($string1, $string2); // Expected output - abcd
        stringCharacterCompDupesOut($string2, $string3); // Expected output - a
        stringCharacterCompDupesOut($string3, $string4); // Expected output - apsyz

        function stringCharacterCompDupesOut($randString1, $randString2) {
            // modify input so no spaces, capital letters, and convert to array for easy comparison

            // This version removes numbers and special characters
            $randString1 = array_unique(str_split(str_replace(' ', '', preg_replace('/[^a-zA-Z_ -]/s',' ', strtolower($randString1))), $length = 1));
            $randString2 = array_unique(str_split(str_replace(' ', '', preg_replace('/[^a-zA-Z_ -]/s',' ', strtolower($randString2))), $length = 1));

            // This version keeps in numbers and special characters
            // $randString1 = array_unique(str_split(str_replace(' ', '', strtolower($randString1)), $length = 1));
            // $randString2 = array_unique(str_split(str_replace(' ', '', strtolower($randString2)), $length = 1));
            
            sort($randString1); sort($randString2);

            $outputString = '';

            foreach($randString1 as $firstStringArray) {
                foreach($randString2 as $secondStringArray) {
                    if($firstStringArray == $secondStringArray) {
                        $outputString .= $firstStringArray; 
                        break; 
                    }
                }
            }
            
            echo $outputString . '<br />';         
        }
    ?>
</div>

<!-- 
2b. Write a function that will be passed two strings of random length. Have your function return a string with
all characters that appear in both strings. 

TR assumption: duplicate characters ARE desired 
so if string1 has 2x 'a' and string2 has 3x 'a', output should have 5x 'a'. 
-->
<div style="margin-bottom: 20px;">
    <?php 
        stringCharacterCompDupesIn($string1, $string2); // Expected output - aaaaaabbccdd
        stringCharacterCompDupesIn($string2, $string3); // Expected output - aaaaa
        stringCharacterCompDupesIn($string3, $string4); // Expected output - aappssyyzz

        function stringCharacterCompDupesIn($randString1, $randString2) {
            // This version removes numbers and special characters
            $randString1 = str_split(str_replace(' ', '', preg_replace('/[^a-zA-Z_ -]/s',' ', strtolower($randString1))), $length = 1);
            $randString2 = str_split(str_replace(' ', '', preg_replace('/[^a-zA-Z_ -]/s',' ', strtolower($randString2))), $length = 1);

            // This version keeps in numbers and special characters
            // $randString1 = str_split(str_replace(' ', '', strtolower($randString1)), $length = 1);
            // $randString2 = str_split(str_replace(' ', '', strtolower($randString2)), $length = 1);
            
            sort($randString1); sort($randString2);

            $outputArr = [];
            $outputString = '';

            // Merge the string arrays together using a key structure like:
            // [a] => ['first' => 2], ['second' => 4]
            // For each of the characters so we can keep track of how
            // many times they occur in each string

            foreach($randString1 as $firstStringArray) {
                if(array_key_exists($firstStringArray, $outputArr)) {
                    $outputArr[$firstStringArray]['first']++;
                }else {
                    $outputArr[$firstStringArray]['first'] = 1;
                } 
            }

            foreach($randString2 as $secondStringArray) {
                if(array_key_exists($secondStringArray, $outputArr)) {
                    if(array_key_exists('second', $outputArr[$secondStringArray])) {
                        $outputArr[$secondStringArray]['second']++;                    
                    } else {
                        $outputArr[$secondStringArray]['second'] = 1;
                    }
                }
            }

            // Construct output string
            foreach($outputArr as $key => $value) {
                if(count($outputArr[$key]) == 2) {
                    for($i = 0; $i < $outputArr[$key]['first']; $i++) {
                        $outputString .= $key;
                    }
                    for($i = 0; $i < $outputArr[$key]['second']; $i++) {
                        $outputString .= $key;
                    }
                }
            }

            echo $outputString . '<br />';     
        }
    ?>
</div>