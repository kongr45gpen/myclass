<?php

namespace AppBundle\Block;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BlockServiceInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

class TeacherScheduleBlock extends BaseBlockService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'url'      => false,
            'title'    => 'Edit Schedule',
            'template' => 'AppBundle:Admin:teacher_list.html.twig',
        ));
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormMapper $formMapper
     * @param BlockInterface $block
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                ['url', 'url',['required' => false]],
                ['title', 'text', ['required' => false]],
            )
        ));
    }

    /**
     * @param ErrorElement $errorElement
     * @param BBlockInterface $block
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
            ->end();
    }

    /**
     * Render the block
     *
     * @param BlockContextInterface $blockContext
     * @param Response $response
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
        $settings = $blockContext->getSettings();

        $teachers = $this->entityManager
            ->getRepository('AppBundle:Teacher')
            ->findAll();

         return $this->renderResponse($blockContext->getTemplate(), array(
             'teachers'  => $teachers,
             'block'     => $blockContext->getBlock(),
             'settings'  => $settings
         ), $response);
    }
}
