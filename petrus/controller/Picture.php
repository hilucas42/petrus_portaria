<?php
namespace controller;

use Exception;

class Picture {

    private static $missing_picture = 'public/img/no_profile.png';

    /**
     * GET handler for the Picture interface. Returns the picture requested or
     * a MISSING_PICTURE fallback picture, as well as 404, if not found
     */
    public static function get($picname) {
        try {
            $file = \model\Picture::retrieve($picname);
            header('Cache-control: private');
            header('Content-Type: image/jpg');
            header('Content-Length: '.filesize($file));
            header('Content-Disposition: filename='.$picname);

            readfile($file);
        } catch (Exception $e) {
            error_log($e->getMessage());
            http_response_code(404);
            header('Content-Type: image/jpg');
            header('Content-Length: '.filesize(Picture::$missing_picture));
            header('Content-Disposition: filename=no_image.jpg');
            readfile(Picture::$missing_picture);
            die();
        }
    }

    /**
     * POST handler for the Picture interface. Sends the URL to the POSTed picture
     */
    public static function post() {
        try {
            error_log('PictureCTL: entrando');
            $filename = \model\Picture::store();
            print(json_encode([
                'url' => '/picture/' . $filename
            ]));
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * [TODO] POST handler for the Picture interface. Future implementation
     */
    public static function delete($id) {
        http_response_code(501);
    }
}
