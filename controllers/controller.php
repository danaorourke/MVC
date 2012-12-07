<?php
class Controller {
    protected $name = 'Controller';
    protected $view;
    public $url = array();
    public $route_map = array();
    
    # renders the directed view
    public function render_view($content='') {
        $this->view = new View();
        $this->view->render($content);
    }
    # get url as an array
    public function get_url() {
        # pass the array to the url.
       $u = $_SERVER["REQUEST_URI"];
       $this->url = explode('/', $u);
    }
    # open routing file, set to var
    # this needs error checking - empty file? malformed route?
    protected function read_router() {
        $xml = simplexml_load_file( FILE_ROOT . '/config/router.xml');
        # set routes to array
        foreach ($xml->route as $r) {
            $this->route_map["$r->name"] = array('route' => $r->url, 'name' => $r->name);
        }
        unset($r);
    }
    # find_route compares the first part of the url to the routing data
    protected function find_route() {
        if (array_key_exists($this->url[1], $this->route_map)) {
            $k = $this->url[1];
            $c = FILE_ROOT . '/controllers/' . $this->route_map["$k"]['name'] . '.php';
            require_once($c); unset($c);
        } else { # include the default controller
            $c = FILE_ROOT . '/controllers/' . $this->route_map['default']['name'] . '.php';
            require_once($c); unset($c);
            # update: check for no match - return 404
        }
    }
    # all the peices at once, now
    protected function route_me() {
        $this->get_url();
        $this->read_router();
        $this->find_route();
    }
    
    # constructor - calls router
    public function __construct($c='') {
        $this->route_me();
        ($c != '') ? $this->render_view($c) : '' ;
    }
}
?>