<?php
if (isset($_FILES['xmlFile']) && isset($_FILES['xsdFile'])) {
    $xmlFile = $_FILES['xmlFile']['tmp_name'];
    $xsdFile = $_FILES['xsdFile']['tmp_name'];

    libxml_use_internal_errors(true);
    $xml = new DOMDocument();
    $xml->load($xmlFile);
    if ($xml->schemaValidate($xsdFile)) {
        echo "<div style='padding:20px'><h3 style='color:green;'>XML je valjan prema shemi.</h3></div>";
    } else {
        echo "<div style='padding:20px'><h3 style='color:red;'>XML NIJE valjan prema shemi.</h3>";
        foreach (libxml_get_errors() as $error) {
            echo "<p>{$error->message}</p>";
        }
        echo "</div>";
        libxml_clear_errors();
    }
} else {
    echo "Datoteke nisu ispravno poslane";
}
?>
