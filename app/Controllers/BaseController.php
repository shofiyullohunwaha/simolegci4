<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\I18n\Time;
use App\Models\Msistem;
use App\Models\Mlog;
use App\Models\Msi933;
use App\Models\Mme776;
use App\Models\Mle409;
use App\Models\Mfo110;
use App\Models\Mka556;
use App\Models\Mdr699;
use App\Models\Mak755;
use App\Models\Mpu002;
use App\Models\Mpv002;
use App\Models\Mkc002;
use App\Models\Mkb002;
use App\Models\Mds002;
use App\Models\Mpg003;
use App\Models\Mju002;
use App\Models\Mtr002;
use App\Models\Mut002;
use App\Models\Mva002;
use App\Models\Mra002;
use App\Models\Mpn002;
use App\Models\Mpk002;



/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ["custom_function","url","redirect"];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->encrypter = \Config\Services::encrypter();
        $this->session = \Config\Services::session();
        $this->msistem = new Msistem();
        $this->mlog = new Mlog();
        $this->msi933 = new Msi933();
        $this->mme776 = new Mme776();
        $this->mle409 = new Mle409();
        $this->mfo110 = new Mfo110();
        $this->mka556 = new Mka556();
        $this->mdr699 = new Mdr699();
        $this->mak755 = new Mak755();
        $this->mpu002 = new Mpu002();
        $this->mpv002 = new Mpv002();
        $this->mkc002 = new Mkc002();
        $this->mkb002 = new Mkb002();
        $this->mds002 = new Mds002();
        $this->mpg003 = new Mpg003();
        $this->mju002 = new Mju002();
        $this->mtr002 = new Mtr002();
        $this->mut002 = new Mut002();
        $this->mva002 = new Mva002();
        $this->mra002 = new Mra002();
        $this->mpn002 = new Mpn002();
        $this->mpk002 = new Mpk002();
        // $this->wilayah = new Wilayah();

        
    }

    public function CekLogin(){
        helper("custom_function");
        $this->mlog = new Mlog();
        //------------------------------------
        $dtl = IdLogin2();
        $status = false;
        if($dtl != ""){
            $dtlogin = $this->mlog->CekLogin($dtl[0], $dtl[1]);
            if(is_array($dtlogin)){
                if(count($dtlogin)>0){
                    $status = true;
                }
            }
        }
        return $status ? [$status, $dtlogin] : [$status];
    }

    public function CekLogin2($jenis, $idform){
        helper("custom_function");
        $this->mlog = new Mlog();
        //------------------------------------
        $dtl = IdLogin2();
        $status = false;
        if($dtl != ""){
            $dtlogin = $this->mlog->CekLogin($dtl[0], $dtl[1]);
            if(is_array($dtlogin)){
                if(count($dtlogin)>0){
                    if($jenis == "dashboard"){$idsistem_sistem = $idform;}
                    else{
                        $dataform = $this->mlog->CekSistem($idform);
                        if(is_array($dataform)){
                            if(count($dataform)>0){
                                foreach($dataform as $cx){
                                    $idsistem_sistem = $cx->id_sistem;
                                }
                            }
                        }
                    }
                    $idsistem_user = [];
                    foreach($dtlogin as $dl){
                        $idlevel = $dl->id_level;
                        array_push($idsistem_user, $dl->id_sistem);
                    }
                    if(array_search($idsistem_sistem, $idsistem_user) !== false){
                        $status = true;
                        $dtmenu = $this->mlog->CekMenu($idsistem_sistem, $idlevel);
                        $dtform = $this->mlog->CekForm($idsistem_sistem, $idlevel);
                        $idform_user = [];
                        $akses_user = [];
                        if(is_array($dtform)){
                            if(count($dtform)>0){
                                foreach($dtform as $dx){
                                    array_push($idform_user, $dx->id_form);
                                    if($dx->id_form == $idform){
                                        array_push($akses_user, $dx->akses);
                                    }
                                }
                                $ids = $idsistem_sistem;
                                $idf = $idform;
                                $akses = "";
                                if($jenis == "dashboard"){$hal = $idsistem_sistem;}
                                else{
                                    $akses = $akses_user[0];
                                    if(array_search($idform, $idform_user) !== false){
                                        $hal = $idform;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $status ? [$status, $dtlogin, $akses, $dtmenu, $dtform, $ids, $idf, $hal] : [$status, "", ""];
    }
}