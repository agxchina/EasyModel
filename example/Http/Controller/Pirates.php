<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App;
use App\Repositories\PiratesRepository;
use Agxmaster\EasyModel\EasyModel;


class Pirates extends Controller {
	
	private $pirates = null;
	
	private $easy = null;
	public function __construct(PiratesRepository $pirates){
		$this -> pirates = $pirates;
		parent::__construct();
	}
	
	public function anyTest(){
		$this->pirates->test();
	}

}