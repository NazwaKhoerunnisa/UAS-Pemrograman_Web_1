<?php
/**
 * Simple PDF Generator using native PHP
 * Ini adalah solusi sederhana tanpa library eksternal
 */

class SimplePDF {
    private $html;
    private $filename;
    
    public function __construct($html, $filename = 'document.pdf') {
        $this->html = $html;
        $this->filename = $filename;
    }
    
    /**
     * Convert HTML ke PDF menggunakan browser print-to-PDF
     * Browser akan handle konversi HTML ke PDF
     */
    public function output() {
        header('Content-Type: text/html; charset=UTF-8');
        
        // Tambahkan JavaScript untuk auto-print
        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>';
        
        echo $this->html;
        
        echo '<script>
        window.onload = function() {
            window.print();
        }
        </script>
</body>
</html>';
    }
    
    /**
     * Fallback: Buat file PDF sederhana jika wkhtmltopdf tersedia
     */
    public function downloadWithWkhtmltopdf() {
        $temp_html = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pdf_' . time() . '.html';
        $temp_pdf = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pdf_' . time() . '.pdf';
        
        // Simpan HTML
        file_put_contents($temp_html, $this->getFullHtml());
        
        // Path wkhtmltopdf
        $wkhtmltopdf_paths = array(
            'C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            'C:\\Program Files (x86)\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            '/usr/bin/wkhtmltopdf',
            '/usr/local/bin/wkhtmltopdf'
        );
        
        foreach ($wkhtmltopdf_paths as $path) {
            if (file_exists($path)) {
                $cmd = '"' . $path . '" "' . $temp_html . '" "' . $temp_pdf . '" 2>&1';
                exec($cmd, $output, $return);
                
                if ($return === 0 && file_exists($temp_pdf)) {
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="' . $this->filename . '"');
                    header('Content-Length: ' . filesize($temp_pdf));
                    readfile($temp_pdf);
                    
                    // Cleanup
                    @unlink($temp_html);
                    @unlink($temp_pdf);
                    return true;
                }
            }
        }
        
        // Cleanup if failed
        @unlink($temp_html);
        @unlink($temp_pdf);
        return false;
    }
    
    private function getFullHtml() {
        return '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
        }
        .page-break { page-break-after: always; }
        @page { margin: 1cm; }
    </style>
</head>
<body>
' . $this->html . '
</body>
</html>';
    }
}
?>
