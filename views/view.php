<?php
/* view gatekeeper */ if (!defined('ISINDEX')) { die('You should not be here.');}
class View {
    protected $title;
    protected $page;
    protected $bodyid;
    protected $pagestyle;
    protected $content;
    
    /* tag_wrap wraps given string in given tag
     * takes tag and string
     */
    public function tag_wrap($tag,$str) {
        if ( ( !empty($tag) && !empty($str) ) && ( is_string($tag) && (is_string($str) || is_numeric($str) ) ) ) {
            $p = '<' . $tag . '>' . $str . '</' . $tag . '>';
            return $p; unset($p);
        } 
    } # end tag_wrap()
    
    /*  table_wrap takes associated vars and wraps them in appropriate table
     *  requires thead, tfoot, headers, th, td, id, caption
     */
    public function table_wrap($d,$h='') {
        $v  = '<table>';
        # check for headers
        if (!empty($h)) {
            $v .= '<thead><tr>';
            
            $v .= '</tr></thead>';
            unset($i);
        }
        
        # build body
        $v .= '<tbody>';
        foreach($d as $i) {
            $v .= '<tr>';

            
            $v .= '</tr>';
        }
        $v .= '</tbody>';
        $v .= '</table>';
        return $v;
    }
        
    /* return_string delivers the contents of an array as a string.
     *
     */
     public function return_string($array) {
         $c = count($array);
         for($i=0;$i<$c;$i++) {
             ($i == $c) ? $s .= "$i" : $s .= "$i, ";
         }
         return $s;
     }
     
     /* open_template()
      *
      */
      protected function open_template($template_name) {
          $f_name = FILE_ROOT . '/views/' . $template_name . '.php';
          $template = file_get_contents($f_name);
          unset($f_name);
          return $template;
      }

    /*  get_header parses together the header data.
     *  will call in required header
     */
    protected function get_header() {
        $this->page .= $this->open_template('header');
    } #end get_header()
    
    /*  get_footer parses together the footer data.
     *  will call in required footer
     */
    protected function get_footer() {
        $this->page .= $this->open_template('footer');
    } #end get_footer()

    /*  get_view() renders the requested object view
     *  include error checking?
     */
    
    /*  get_content pulls content and gives it to page.
     *  
     */
    public function get_content($content) {
        $this->page .= $content;
    } #end get_p_content
    
    /*  content sets value of string to page content.
     *  how does this string get error checked?
     */
    public function content($str) {
        if (is_string($str)) {
            $this->content = $str;
        }
    } #end content
    
    /* bangs together the view */
    public function render($content='') {
        $this->get_header();
        
        ($content != '') ? $this->content($content) : $this->content('No content given.');
        
        $this->get_content($this->content);
        $this->get_footer();
        print $this->page;
    } #end render()
}
