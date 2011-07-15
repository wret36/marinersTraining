<?php
if (!class_exists('SpreadsheetReader'))
    require_once dirname(__FILE__) . '/../SpreadsheetReader.php';
class SpreadsheetReader_CSV extends SpreadsheetReader {
    /**
     * Constructor
     *
     * @access public
     */
    public function __construct() {
    }
    
    /**
     * $sheets = read('~/example.csv');
     * $sheet = 0;
     * $row = 0;
     * $column = 0;
     * echo $sheets[$sheet][$row][$column];
     *
     * @todo    return results as XML String.
     *          how to detect char encoding, or to convert to utf-8?
     *
     * @param $csvFilePath  File path of Open Document Sheet file.
     * @param $returnType   Type of return value.
     *                      'array':  Array. This is default.
     *                      'string': XML string.
     * @return FALSE or an array contains sheets.
     */
    public function &read($csvFilePath, $returnType = 'array') {
        $ReturnFalse = FALSE;

        //strcmp(pathinfo($csvFilePath, PATHINFO_EXTENSION), 'csv')
        if (!is_readable($csvFilePath)) {
            return $ReturnFalse;
        }
        $fp = fopen($csvFilePath, 'r');

        $sheets[0] = array();  //there is only one sheet in csv.
        while ($row = fgetcsv($fp, 16384)) {
            $sheets[0][] = $row;
        }
        fclose($fp);

        if ($returnType == 'string') {
            throw new Exception('not implemented!');
            return $xmlString;
        }
        return $sheets;
    }
}
?>
