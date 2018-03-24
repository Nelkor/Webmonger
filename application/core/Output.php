<?php

class Output
{
    public static function html(string $file_name, array $args = [])
    {
        ob_start();

        extract($args);

        include "application/views/$file_name.php";

        return ob_get_clean();
    }

    public static function error(string $code)
    {
        switch ($code) {
            case '404':
                header('HTTP/1.0 404 Not Found');
                header('Status: 404 Not Found');
                break;
            case '403':
                header('HTTP/1.0 403 Forbidden');
                header('Status: 403 Forbidden');
                break;
        }

        include "application/views/errors/$code.html";
        exit;
    }

    public static function json(string $status, array $content = [])
    {
        echo json_encode([
            'response' => $status,
            'content' => $content
        ]);

        exit;
    }

    public static function file(string $file_name, string $type)
    {
        header("Content-Type: $type");
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        readfile($file_name);
    }
}
