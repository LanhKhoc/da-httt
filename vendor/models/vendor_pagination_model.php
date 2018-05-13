<?php

class vendor_pagination_model extends vendor_model {
  protected $config = [
    'page' => 1,
    'limit' => 5,
    'range' => 6
  ];

  public function getCountRecords($options = null) {
    $conditions = (isset($options['conditions'])) ? ' WHERE ' . $options['conditions'] : "";
    $sql = "SELECT count(id_{$this->table}) as total FROM {$this->table} " . $conditions;

    $result = $this->conn->query($sql);
    return $result->fetch_assoc()['total'];
  }

  public function getAllRecordsLimit($fields = '*', $options = null) {
    $conditions = (isset($options['conditions'])) ? ' where ' . $options['conditions'] : "";
    if(isset($options['pagination'])) {
      if(isset($options['pagination']['page'])) $this->config['page'] = $options['pagination']['page'];
      if(isset($options['pagination']['limit'])) $this->config['limit'] = $options['pagination']['limit'];
      $this->config['start'] = ($this->config['page'] - 1) * $this->config['limit'];
    }
    $limit = " LIMIT " . $this->config['limit'] . " OFFSET " . $this->config['start'];

    $sql = "SELECT " . $fields . " FROM " . $this->table . $conditions . $limit;
    return $this->conn->query($sql);
  }


  public function pagination($page = 1) {
    $this->config['total_record'] = $this->getCountRecords();
    $this->config['total_page'] = ceil($this->config['total_record'] / $this->config['limit']);
    $this->config['page'] = $page;
    $this->config['start'] = ($page - 1) * $this->config['limit'];
    $this->config['min'] = $page - ceil($this->config['range'] / 2);
    $this->config['max'] = $page + ceil($this->config['range'] / 2);

    if ($this->config['min'] < 1) $this->config['min'] = 1;
    if ($this->config['max'] > $this->config['total_page']) $this->config['max'] = $this->config['total_page'];

    $result = $this->getAllRecordsLimit();
    while ($row = $result->fetch_assoc()) {
      $this->config['data'][] = $row;
    }

    return $this->config;
  }
}