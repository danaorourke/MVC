<?php
class DefaultController extends Controller {
    protected $name = 'Default';
    
    public function info_dump() {
	    $this->route_me();
    	$test .= 'Url: ';
        # check for array, pass results
        if (is_array($this->url)) {
            $test .= 'array: ' . implode('/',$this->url);
        } else { $test .=  'string: ' . $this->url; }
        $test .= '<br><br>Route map: ';
        if (is_array($this->route_map)) {
            $test .= 'array: ';
            foreach($this->route_map as $r) {
                $test .= '<br>record: ' . implode(', ', $r);
            }
            unset($r);
        } else {
            $test .= 'string: ' . $this->route_map;
        }
        return($test); unset($test);
    }

    public function __construct($c='') {
    	$c .= $this->info_dump();
	    $this->render_view($c);
	}
	
	
	
}

# logic
$hello  = '<p>You have reached the default controller.</p>';
$hello .= '<p>This loads whenever the index page loads, because that\'s what it is being told to do in the router file. Make sure your routers are appropriately formed if you\'re seeing this unexpectedly.</p>';

$world = new DefaultController($hello);
?>