<?php 
$domain = rex_request('domain', 'string', "");

if($domain) {
  
  $query = 'SELECT * FROM `rex_project_manager_domain_hosting` AS H
              INNER JOIN `rex_project_manager_domain` as D
              ON D.domain = H.domain
              WHERE H.domain = ? 
              LIMIT 1';
  
  $item = rex_sql::factory()->setDebug(0)->getArray($query, [$domain])[0];
  $raw = json_decode($item['raw'], true);

  if(is_array($raw)) {
         
    $output = '';    
    $output = '<table class="table table-striped"><thead><tr><th>'.$this->i18n('organisation').'</th><th>'.$this->i18n('isp').'</th><th>'. $this->i18n('project_manager_hosting_ip').'</th></tr></thead><tbody>';
    $output .= '<tr><td>'.$raw['org'].'</td><td>'.$raw['isp'].'<br />'.$raw['zip'].' '.$raw['city'].'<br />'.$raw['country'].'</td><td>'.$item['ip'].'</td></tr>';
    $output .= '</tbody></table>';

    return $output;
    
  }
}


