<?php
if (!class_exists('SpreadsheetReader'))
    require_once dirname(__FILE__) . '/../SpreadsheetReader.php';
class SpreadsheetReader_Excel extends SpreadsheetReader {
    private static $jxlCommand = FALSE;

    /**
     * Constructor
     *
     * @param $path     $path['java'] - Path of java
     *                  $path['jxl'] - Path of jxl.jar
     *
     * @access public
     */
    public function __construct($path = FALSE) {
        if ( !self::$jxlCommand ) {
            $javaPath = (isset($path['java'])
                ? $path['java']
                : 'java'
            );
            $jxlPath = (isset($path['jxl'])
                ? $path['jxl']
                : dirname(__FILE__) . '/jxl.jar'
            );
            self::$jxlCommand = $javaPath . ' -jar "' . $jxlPath . '" -xml';
        }

        if (!self::$ignoreChar) {
            self::$ignoreChar = array();
            for ($i = 1; $i < 32; ++$i) {
                if ($i == 10 or $i == 13)
                    continue; //skip LF and CR
                self::$ignoreChar[] = chr($i);
            }
        }
    }
    
    /**
     * Sometimes, data will contain non-readable chars.
     * XML parser will occur a parse error.
     * So we need to strip those non-readable chars.
     */
    private static $ignoreChar = false;

    /**
     * $sheets = read('~/example.xls');
     * $sheet = 0;
     * $row = 0;
     * $column = 0;
     * echo $sheets[$sheet][$row][$column];
     *
     * @param $xlsFilePath  File path of Excel sheet file.
     * @param $returnType   Type of return value.
     *                      'array':  Array. This is default.
     *                      'string': XML string.
     * @return FALSE or an array contains sheets.
     */
    public function &read($xlsFilePath, $returnType = 'array') {
        $ReturnFalse = FALSE;

        if ( !is_readable($xlsFilePath) ) {
            return $ReturnFalse;
        }

        @exec(self::$jxlCommand . ' "' . $xlsFilePath . '"', $output);
        if ($output[0] != '<?xml version="1.0" ?>') {
            return $ReturnFalse;
        }

        //Strip those non-readable chars
        $xmlString = str_replace(self::$ignoreChar,
            '',
            implode('', $output)
        );
        if ($returnType == 'string') {
            return $xmlString;
        }
        return $this->_toArray($xmlString);
    }
}
?>
