<?php

require_once "../config.php";
require_once "helper.php";
require_once "../functions.php";

$request_method = $_SERVER['REQUEST_METHOD'];

switch($request_method)
{
    case "GET":
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $get_id = $_GET['id'];

        $members = edit_member($db);

        if($members == NULL){
            $respon = array(
                'status' => false,
                'message' => "Data tidak ditemukan",
                'data' => array()
            );
            echo response($respon, 404);
            die;
        }else{  
            $respon = array(
                'status' => true,
                'message'=> "Sukses",
                'data' => $members
            );
            
        }
        
    }
    else
    {
         $members =  getAllMembers($db);
         $respon = array(
             'status' => true,
             'message' => "sukses",
             'data' => $members
         );
         echo response($respon, 200);

    }
        break;
        case 'POST':
            if (!empty($_POST['nama'])) {
                $nama = $_POST['nama'];
                if (addMember($db, $nama)) 
                {

                    $respon = array(
                        'status' => true, 
                        'message' => 'Anggota berhasil ditambah',
                        'data' => $nama
                );
                echo response($respon, 200);
                } else {
                     $respon = array(
                        'status' => false, 
                        'message' => 'Gagal menambah anggota',
                        'data' => array()
                    );
                echo response($respon, 404);
                }
            } else {
                 $respon = array(
                    'status' => false, 
                    'message' => 'Nama diperlukan',
                    'data' => array()
                );
                echo response($respon, 404);
                    
            }
            break;
    default:
        
    $respon = array(
        'status' => false,
        'message' => 'Not Found',
        'data' => array()
    );
    
    echo response($respon, 404);

    break;
}