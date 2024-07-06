<?php
require_once '../app/models/MiMascota.php';
require_once '../app/helpers/functions.php';

class MiMascotaController
{
    public function index()
    {   if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = $_GET['id'];
            $decrypted_id = decrypt($id, KEY, IV);

            $miMascotas = MiMascota::getMascotas($decrypted_id);

        }
        require_once '../app/views/mimascota/index.php';
    }
}
