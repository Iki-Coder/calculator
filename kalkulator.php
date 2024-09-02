<?php
class Kalkulator {
    private $c;

    public function __construct($c) {
        $this->c = preg_replace('/(\d)(\()/','${1}*${2}', $c);
        $this->c = str_replace('x', '*', $this->c);
    }

    public function hitung() {
        try {
            eval('$result = ' . $this->c . ';');
            return $result;
        } catch (ParseError $e) {
            return 'kaga bisa';
        }
    }
}

$result = '';
$c = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['c'])) {
    $c = $_POST['c'];
    $kalkulator = new Kalkulator($c);
    $result = $kalkulator->hitung();
}
?>

<form method="post">
    <input type="text" name="c" size="20" readonly value="<?php echo($c); ?>"> &nbsp;
    
    <span style="color: black;"><?php echo $error; ?></span><br>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '0';">0</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '1';">1</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '2';">2</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '3';">3</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '4';">4</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '5';">5</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '6';">6</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '7';">7</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '8';">8</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value += '9';">9</button><br>
    <button type="button" class="btn btn-secondary" onclick="if (document.forms[0].c.value === '' || document.forms[0].c.value.slice(-1)!== '(') document.forms[0].c.value += '(';">(</button>
    <button type="button" class="btn btn-secondary" onclick="if (document.forms[0].c.value === '' || document.forms[0].c.value.slice(-1)!== ')') document.forms[0].c.value += ')';">)</button>
    <button type="button" class="btn btn-secondary" onclick="if (document.forms[0].c.value === '' || document.forms[0].c.value.slice(-1)!== '+') document.forms[0].c.value += '+';">+</button>
    <button type="button" class="btn btn-secondary" onclick="if (document.forms[0].c.value === '' || document.forms[0].c.value.slice(-1)!== '-') document.forms[0].c.value += '-';">-</button>
    <button type="button" class="btn btn-secondary" onclick="if (document.forms[0].c.value === '' || document.forms[0].c.value.slice(-1)!== '*') document.forms[0].c.value += '*';">*</button>
    <button type="button" class="btn btn-secondary" onclick="if (document.forms[0].c.value === '' || document.forms[0].c.value.slice(-1)!== '/') document.forms[0].c.value += '/';">/</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value = '';">AC</button>
    <button type="button" class="btn btn-secondary" onclick="document.forms[0].c.value = document.forms[0].c.value.slice(0, -1);">DEL</button>
    <input type="submit" value="hitung">

</form>

<?php if ($result !== ''): ?>
    <div class="result">
        Hasil= <?php echo $result; ?>
    </div>
<?php endif; ?>
