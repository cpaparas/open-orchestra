<?php
/**
 * This file is part of the PHPOrchestra\CMSBundle.
 *
 * @author Noël Gilain <noel.gilain@businessdecision.com>
 */

namespace PHPOrchestra\CMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use PHPOrchestra\CMSBundle\Form\DataTransformer\jsonToBlocksTransformer;
use Mandango;

class BlocksType extends AbstractType
{
    /**
     * Mandango service
     * @var Mandango\Mandango
     */
    var $mandango = null;

    
    /**
     * Constructor, require mandango service
     * 
     * @param Mandango\Mandango $mandango
     */
    public function __construct(Mandango\Mandango $mandango = null)
    {
        $this->mandango = $mandango;
    }
    
    
    /**
     * Form builder
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new jsonToBlocksTransformer($this->mandango);
    	$builder->addModelTransformer($transformer);
    }
	
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'showDialog' => false
        ));
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
    	if($options['showDialog']){
	        $view->vars['dialog'] = '
		    <div class="dialog-blocks" style="display:none;" title="Block">
		        <label for="component">Component : </label><input type="text" name="component" id="component" value=""><br />
		        <label for="customAttribute">Custom Attributes : </label><input type="text" name="customAttributes" id="customAttributes" value=""><br />
		    </div>
	        ';
    	}
    }
    
    
    /**
     * Extends textarea type
     */
    public function getParent()
    {
        return 'hidden';
    }

    /**
     * getName
     */
    public function getName()
    {
        return 'orchestra_blocks';
    }

}