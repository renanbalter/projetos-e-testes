<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="calculadora">
    <input id="calc"type="text" placeholder="0">

    <div class="row">

        <button onclick="calc('action', 'c')" class="zerocalcbtn">C</button>
        <button onclick="calc('action', '/')" class="calcbtn">/</button>
        <button onclick="calc('action', '*')" class="calcbtn">x</button>
    </div>
    <div class="row">

        <button onclick="calc('value', 9)" class="calcbtn">9</button>
        <button onclick="calc('value', 8)" class="calcbtn">8</button>
        <button onclick="calc('value', 7)" class="calcbtn">7</button>
        <button onclick="calc('action', '-')" class="calcbtn">-</button>

    </div>
    <div class="row">

        <button onclick="calc('value', 6)" class="calcbtn">6</button>
        <button onclick="calc('value', 5)" class="calcbtn">5</button>
        <button onclick="calc('value', 4)" class="calcbtn">4</button>
        <button onclick="calc('action', '+')" class="calcbtn">+</button>

    </div>

    <div class="row">

        <button onclick="calc('value', 3)" class="calcbtn">3</button>
        <button onclick="calc('value', 2)" class="calcbtn">2</button>
        <button onclick="calc('value', 1)" class="calcbtn">1</button>
        <button onclick="calc('action', '=')" class="equalcalcbtn">=</button>
        

    </div>

    <div class="row">
        <button onclick="calc('value', 0)" class="zerocalcbtn">0</button>
        <button onclick="calc('action', '.')" class="calcbtn">.</button>
    </div>

</div>

<script>
    function calc(type, value) {
        console.log(type, value);

        if (type == 'action') {
            if(value == '.' || value == '+' || value == '-' || value == '*' || value == '/' ) {
                document.getElementById("calc").value += value;
            }
            if(value == '=') {
                try {
                document.getElementById("calc").value = eval(document.getElementById("calc").value);
                } catch(error) {
                    alert("Erro");
                    document.getElementById("calc").value = "";

                }
            }
            if(value == 'c') {
                document.getElementById("calc").value = "";
            }

        }
        else if(type == 'value'){

            document.getElementById("calc").value += value;
        }

    }
</script>





    
</body>
</html>