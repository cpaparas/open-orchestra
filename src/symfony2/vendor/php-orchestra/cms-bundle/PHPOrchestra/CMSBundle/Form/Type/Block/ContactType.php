<?php
namespace PHPOrchestra\CMSBundle\Form\Type\Block;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Model\PHPOrchestraCMSBundle\Content;

class ContactType extends AbstractType
{
	/**
	 * (non-PHPdoc)
	 * @see src/symfony2/vendor/symfony/symfony/src/Symfony/Component/Form/Symfony
	 * \Component\Form.AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('id', 'text')
		->add('class', 'text')
		->add('form', 'text');
	}

	/**
	 * (non-PHPdoc)
	 * @see src/symfony2/vendor/symfony/symfony/src/Symfony/Component/Form/Symfony
	 * \Component\Form.FormTypeInterface::getName()
	 */
	public function getName()
	{
		return 'contact';
	}
}