<?php

//recursive fonksıyon alt cocuklarını gezmek için,kategori eklerken kullanıyoruz
function getChildren($category, &$html, $level=1){

    foreach($category->children as $child){

        $html .="<option value=" . $child->id . ">".str_repeat( "&nbsp;", $level*4) . $child->kategori_ad . "</option>";
        $level++;
        getChildren($child, $html, $level);
        $level--;
    }
}

//kategorileri yazdırmak için,kategori eklerken kullanıyoruz
function kategori(){

$html="<option value='0'>Ust Kategori</option>";


$kategoriler=\App\Kategoriler::where('kategori_ust',0)->where('aktif',1)->get();

    foreach($kategoriler as $kategori) {

        $html .= "<option value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option>";

        getChildren($kategori,$html);

    }


       return $html;



}










//kategorileri güncellerken alt kategorilerini gezmek için,kategori güncellerken kullanıyoruz

function getChildrenguncelle($id,$category, &$html, $level=1){

    foreach($category->children as $child){

        if($child->id==$id){
            $html .="<option selected value=" . $child->id . ">".str_repeat( "&nbsp;", $level*4) . $child->kategori_ad . "</option>";

        }else{
            $html .="<option value=" . $child->id . ">".str_repeat( "&nbsp;", $level*4) . $child->kategori_ad . "</option>";

        }
        $level++;
        getChildrenguncelle($id,$child, $html, $level);
        $level--;
    }
}

//kategorileri yazdırmak için
/**
 * @param $id
 * @return string
 */


//kategorileri güncellerken  kategorilerini gezmek için,kategori güncellerken kullanıyoruz

function kategoriguncelle($id){

    $html="<option value='0' >Üst Kategori</option>";


    $kategoriler=\App\Kategoriler::where('kategori_ust',0)->where('aktif',1)->get();

    foreach($kategoriler as $kategori) {

        if($kategori->id==$id){
            $html .="<option selected value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option>";

        }else{
            $html .= "<option value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option>";

        }

        getChildrenguncelle($id,$kategori,$html);

    }

    return $html;


}


function egzersizkategoriguncelle($id){

    $html="<option value='0' >Üst Kategori</option>";


    $kategoriler=\App\Egzersizkategori::where('kategori_ust',0)->where('aktif',1)->get();

    foreach($kategoriler as $kategori) {

        if($kategori->id==$id){
            $html .="<option selected value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option>";

        }else{
            $html .= "<option value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option>";

        }

        getChildrenguncelle($id,$kategori,$html);

    }

    return $html;


}




function hastalik_kategori(){

    $html="<option value='0'>Kategori Seçiniz</option>";


    $kategoriler=\App\Kategoriler::where('kategori_ust',0)->where('aktif',1)->get();

    foreach($kategoriler as $kategori) {

        $html .= "<option value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option>";

        getChildren($kategori,$html);

    }


    return $html;



}




function egzersiz_kategori(){

    $html="<option value='0'>Kategori Seçiniz</option>";


    $kategoriler=\App\Egzersizkategori::where('kategori_ust',0)->where('aktif',1)->get();

    foreach($kategoriler as $kategori) {

        $html .= "<option value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option>";

        getChildren($kategori,$html);

    }


    return $html;



}














function getChildrenoynat($category, &$html, $level=1){

    foreach($category->children as $child){

        $html .="<li><option value=" . $child->id . ">".str_repeat( "&nbsp;", $level*4) . $child->kategori_ad . "</option></li>";
        $level++;
        getChildren($child, $html, $level);
        $level--;
    }
}

function kategorioynat(){

    $html="<li><option value='0' >Kategori Seçiniz</option></li>";


    $kategoriler=\App\Kategoriler::where('kategori_ust',0)->where('aktif',1)->get();

    foreach($kategoriler as $kategori) {

        $html .= "<li><option value=" . $kategori->id . ">" . $kategori->kategori_ad . "</option></li>";

        getChildrenoynat($kategori,$html);

    }


    return $html;



}








//egzersiz kategorılerinde bır kategorının alt kategori id lerini bulma

function egzersizkategori_id($id){

    $idler=[];
    array_push($idler,$id);

    $kategoriler=\App\Egzersizkategori::find($id);


        getChildre_kategori_id($kategoriler,$idler);


    return $idler;


}

function getChildre_kategori_id($id, &$idler){

    foreach($id->children as $child){

        array_push($idler,$child->id);

        getChildre_kategori_id($child, $idler);

    }
}




?>



