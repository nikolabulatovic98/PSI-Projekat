<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */
use App\Models\VestModel;
use App\Models\AutorModel;
use CodeIgniter\Controller;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url'];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
            // Do Not Edit This Line
            parent::initController($request, $response, $logger);

            //--------------------------------------------------------------------
            // Preload any models, libraries, etc, here.
            //--------------------------------------------------------------------
            // E.g.:
        $this->session = session();
    }

    protected function prikaz($page, $data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    /*
    public function index(){
        $vestModel=new VestModel();
        $vesti=$vestModel->findAll();
        $this->prikaz('vesti', ['vesti'=>$vesti]);
    }*/

    public function vest($id){
        $vestModel=new VestModel();
        $vest=$vestModel->find($id);
        $this->prikaz('vest', ['vest'=>$vest]);
    }
    public function pretraga(){
        $vestModel=new VestModel();
        $vesti=$vestModel->pretraga($this->request->getVar('pretraga'));
        $this->prikaz('vesti',['vesti'=>$vesti, 
            'trazeno'=>$this->request->getVar('pretraga')]);
    }
     public function index(){
       // $vestModel=new VestModel();
       // $vesti=$vestModel->findAll();
        $this->prikaz('pocetna', []);
    }
}
