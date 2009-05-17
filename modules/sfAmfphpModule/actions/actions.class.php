<?php

/**
 * sfAmfphpModule actions.
 *
 * @package    sf10
 * @subpackage sfAmfphpModule
 * @author     Your name here
 * @version    SVN: $Id$
 */
class sfAmfphpModuleActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('sfAmfphpModule', 'gateway');
  }
  
  /**
  * el gateway de coneccion con el servicio remoto
  */
  public function executeGateway()
  {
    sfConfig::set('sf_web_debug', false);
    
    $gateway = new sfAmfphpGateway();
    
    //For a full and real interaction with symfony (headers for authenticated users)
    $response = sfContext::GetInstance()->getResponse();
    
    ob_start();
      //Serve the AMF Request
      $gateway->service();
      $response->setContent(ob_get_contents());
    //Don't use ob_end_clean() not ob_get_clean() since this will kill symfony own headers
    ob_clean();
    
    //The response content is automatically sent by symfony, so no need for a $response->sendContent();
    $this->setLayout(false);
    return sfView::NONE;
  }
  
  /**
  * el brownser de amf, solo disponibel desde el entorno de desarrollo
  * en el entornoce produccion debe de dar un 404
  */
  public function executeBrowser()
  {
    if (sfConfig::get('sf_environment') == 'dev')
    {
      return sfView::SUCCESS;
    }
    else
    {
      $this->forward404();
    }
  }
}
