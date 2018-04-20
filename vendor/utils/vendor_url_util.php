<?php

class vendor_url_util {
  public function makeURL($options = null) {
    global $app;
    $controller = $app['controller'];
    $action = '';
    $rootRel = RootREL == '/' ? '' : RootREL;

    if ($options == '/') { return 'index.php'; }
    if (isset($options['controller'])) { $controller = $options['controller']; }
    if(isset($options['action'])) { $action = '/' . $options['action']; }

    return $rootRel . '/?route=' .$controller . $action;
  }
}