<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Bilangan Desimal dan Biner</title>
    <a href="kalkulator.php">Kalkulator</a>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="converter">
        <h2>Desimal ke Biner</h2>
        <form method="post" action="">
            <input type="text" name="decimal" placeholder="Masukkan bilangan desimal" required>
            <input type="submit" name="convert_to_binary" value="Konversi ke Biner">
        </form>
    </div>

    <div class="converter">
        <h2>Biner ke Desimal</h2>
        <form method="post" action="">
            <input type="text" name="binary" placeholder="Masukkan bilangan biner" required>
            <input type="submit" name="convert_to_decimal" value="Konversi ke Desimal">
        </form>
    </div>

    <div class="result">
        <?php
        class bilangan {
            public function decimalToBinary($decimal) {
                return decbin($decimal);
            }

            public function binaryToDecimal($binary) {
                if (!preg_match('/^[01]+$/', $binary)) {
                    throw new Exception("Masukan hanya 0 dan 1.");
                }
                return bindec($binary);
            }
        }

        $converter = new bilangan();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (isset($_POST['convert_to_binary'])) {
                    $decimal = intval($_POST['decimal']);
                    $binary = $converter->decimalToBinary($decimal);
                    echo "Bilangan desimal $decimal dalam biner adalah $binary";
                }

                if (isset($_POST['convert_to_decimal'])) {
                    $binary = $_POST['binary'];
                    $decimal = $converter->binaryToDecimal($binary);
                    echo "Bilangan biner $binary dalam desimal adalah $decimal";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>
    </div>
</body>
</html>
