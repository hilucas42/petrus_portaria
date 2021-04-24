<?php
namespace model;

use Exception;

class Picture {
    /**
     * Verifies if the pic exists on temp or persistent, otherwise throws an exception
     * @param picname the name of the picture requested
     * @return filepath the relative path to the picture
     * @throws err_file_not_found when the pic is not found 
     */
    public static function retrieve($picname) {
        $picsdir = 'data/pictures/';
        $tmpdir = 'data/temp/';

        if (file_exists($picsdir . $picname) && is_file($picsdir . $picname)) {
            return $picsdir . $picname;
        } elseif (file_exists($tmpdir . $picname) && is_file($tmpdir . $picname)) {
            return $tmpdir . $picname;
        } else {
            throw new Exception("err_file_not_found: Picture \"" . $picname . "\" could not be found", 1);
        }
    }

    /**
     * Create a filename for the pic, store it as a temp file and stores the
     * name on the user session for later work (change name and persist)
     * @return tmpname the temporary pic name
     * @throws err_no_file when no file was received
     * @throws err_wrong_format when the received file is not a picture
     */
    public static function store() {
        if (empty($_FILES) || $_FILES['file']['error'] !== 0) {
            throw new Exception("err_no_file: File not received", 1);
        }
        if (!getimagesize($_FILES['file']['tmp_name'])) {
            throw new Exception("err_wrong_format: File type not recognized", 1);
        }
        try {
            $tmpdir = 'data/temp/';
            $tmpname = uniqid();
            move_uploaded_file($_FILES['file']['tmp_name'], $tmpdir . $tmpname);
            $_SESSION['tmppic'] = $tmpname;
            return $tmpname;
        } catch(Exception $e) {
            error_log('Picture: ' . $e->getMessage());
            throw new Exception("err_save_file: File couldn't be saved", 1);
        }
    }

    /**
     * Persists a picture to the pictures dir, with a given name
     * @param tmppic the temp picture to be persisted
     * @param as the picture name after persisted
     * @throws err_save_file when something goes wrong on persisting the picture
     */
    public static function persist($tmppic, $as) {
        try {
            $picsdir = 'data/pictures/';
            $tmpdir = 'data/temp/';
            rename($tmpdir . $tmppic, $picsdir . $as);
        } catch(Exception $e) {
            error_log('Picture: ' . $e->getMessage());
            throw new Exception("err_save_file: File couldn't be moved", 1);
        }
    }

    /**
     * Flushes the session's temporary picture if it wasn't saved
     */
    public static function flush() {
        $tmpdir = 'data/temp/';
        unlink($tmpdir . $_SESSION['tmppic']);
        unset($_SESSION['tmppic']);
    }

    /**
     * Get the temporary stored picture if exists
     * @return tmppicname the name of the temporary picture stored or false
     */
    public static function gettemp() {
        return isset($_SESSION['tmppic']) ? $_SESSION['tmppic'] : false;
    }
}
