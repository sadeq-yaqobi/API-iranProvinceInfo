<?php
namespace App\Services;
class ProvinceService{
    public function getProvinces($data){
        $result=getProvinces($data);
        return $result;
    }
    public function createProvince($data){
        $result = addProvince($data);
        return $result;
    }
    public function updateProvinceName($id, $name){
        $result = changeProvinceName($id, $name);
        return $result;
    }
    public function deleteProvince($id){
        $result =  deleteProvince($id);
        return $result;
    }
}
