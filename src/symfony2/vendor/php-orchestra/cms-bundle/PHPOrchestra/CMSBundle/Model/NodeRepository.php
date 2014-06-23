<?php

namespace PHPOrchestra\CMSBundle\Model;

use PHPOrchestra\CMSBundle\Helper\NodesHelper;

/**
 * Model\PHPOrchestraCMSBundle\Node bundle document repository.
 */
class NodeRepository extends \Model\PHPOrchestraCMSBundle\Base\NodeRepository
{

    /**
     * create a node tree for Menu
     * 
     * @return node tree
     */
    public function getMenuTree()
    {
        $filter = array(
            'status' => 'published',
            'deleted' => false,
            'inMenu' => true,
        );
        
        $tree = $this->getTree($filter);
        return $tree;
    }


    /**
     * create a node tree for Footer
     * 
     * @return node tree
     */
    public function getFooterTree()
    {
        $filter = array(
            'status' => 'published',
            'deleted' => false,
            'inFooter' => true,
        );
        
        $tree = $this->getTree($filter);
        
        return $tree;
    }


    /**
     * Create query to get nodes and create tree
     * 
     * @param array $filter array of criteria
     */
    public function getTree($filter)
    {
        $query = $this->getMandango()->getRepository('Model\PHPOrchestraCMSBundle\Node')->createQuery();
        $query->criteria($filter);
        $nodes = $query->all();

        return $this->nodeListAsTree($nodes);
    }


    /**
     * Transform a list of node in tree
     * 
     * @param unknown $nodes list of nodes
     * 
     * @return node's tree
     */
    public function nodeListAsTree($nodes)
    {
        $superroot = '-';
        $links = array();
        foreach ($nodes as $node) {
            $nodeId   = $node->getNodeId();
            $parentId = $node->getParentId();
            $name     = $node->getName();
            $links[$nodeId][] = array('id' => $nodeId, 'text' => $name);
        }
        
        $links2 = array($superroot => array());

        foreach ($nodes as $node) {
            $nodeId   = $node->getNodeId();
            $parentId = $node->getParentId();
            $name     = $node->getName();
            if (isset($links[$parentId])) {
                $links2[$parentId][] = array('id' => $nodeId, 'text' => $name);
            } else {
                $links2[$superroot][] = array('id' => $nodeId, 'text' => $name);
            }
        }
        return NodesHelper::createRecTree($links2, $links2[$superroot]);
    }


    /**
     * Get all nodes in mongodb
     * 
     * @return list of nodes
     */
    public function getAllNodes()
    {
        $query = $this->getMandango()->getRepository('Model\PHPOrchestraCMSBundle\Node')->createQuery();
        $nodes = $query->all();
        
        return $nodes;
    }
}
