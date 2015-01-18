<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 1/17/15
 * Time: 11:55 PM
 */

//list all the files from our scratch folder
$files = scandir('./scratch');
//get rid of . and .. in array list
array_shift($files);
array_shift($files);

function is_public_key ($filePath){
    if(openssl_pkey_get_public('file://' . $filePath)){
        print_r('++++++++++');
        return true;
    } else {
        return false;
    }
}

function is_private_key ($filePath){
    if(openssl_pkey_get_private('file://' . $filePath)){
        return true;
    } else {
        return false;
    }
}

function is_certificate ($filePath){
    if(is_array(openssl_x509_parse('file://' . $filePath)['subject'])){
        return true;
    } else {
        return false;
    }
}

function is_csr ($filePath){
    if(openssl_csr_get_subject('file://' . $filePath)){
        return true;
    } else {
        return false;
    }
}


foreach($files AS $file){

    if(is_csr('./scratch/'.$file)) {

        echo $file . ":\t\tcsr\n";

    } else if(is_private_key('./scratch/'.$file)) {

        echo $file . ":\t\tprivate key\n";

    } else if(is_certificate('./scratch/'.$file)){

        echo $file . ":\t\tcertificate\n";

    } else if(is_public_key('./scratch/'.$file)){

        echo $file . ":\t\tpublic key\n";

    } else {

        echo $file . ":\t\tunknown\n";

    }

}

