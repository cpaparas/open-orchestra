<?php
/**
 * This file is part of the PHPOrchestra\CMSBundle.
 *
 * @author Nicolas ANNE <nicolas.anne@businessdecision.com>
 */

namespace PHPOrchestra\CMSBundle\Helper;

use Model\PHPOrchestraCMSBundle\Template;
use PHPOrchestra\CMSBundle\Form\DataTransformer\JsonToAreasTransformer;
use PHPOrchestra\CMSBundle\Form\DataTransformer\JsonToBlocksTransformer;

class TemplateHelper
{
    public static function formatTemplate(Template $template, $documentManager)
    {
        $areaTransformer = new JsonToAreasTransformer();
        $blockTransformer = new JsonToBlocksTransformer($documentManager);
        
        return array(
            'areas' => $areaTransformer->transform($template->getAreas()),
            'blocks' => $blockTransformer->transform($template->getBlocks())
        );
    }
}
