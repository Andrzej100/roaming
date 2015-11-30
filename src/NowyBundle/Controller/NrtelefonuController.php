<?php

namespace NowyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NowyBundle\Entity\Nrtelefonu;
use NowyBundle\Form\NrtelefonuType;

/**
 * Nrtelefonu controller.
 *
 * @Route("/nrtelefonu")
 */
class NrtelefonuController extends Controller
{

    /**
     * Lists all Nrtelefonu entities.
     *
     * @Route("/", name="nrtelefonu")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NowyBundle:Nrtelefonu')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Nrtelefonu entity.
     *
     * @Route("/", name="nrtelefonu_create")
     * @Method("POST")
     * @Template("NowyBundle:Nrtelefonu:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Nrtelefonu();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nrtelefonu_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Nrtelefonu entity.
     *
     * @param Nrtelefonu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Nrtelefonu $entity)
    {
        $form = $this->createForm(new NrtelefonuType(), $entity, array(
            'action' => $this->generateUrl('nrtelefonu_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Nrtelefonu entity.
     *
     * @Route("/new", name="nrtelefonu_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Nrtelefonu();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Nrtelefonu entity.
     *
     * @Route("/{id}", name="nrtelefonu_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Nrtelefonu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nrtelefonu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Nrtelefonu entity.
     *
     * @Route("/{id}/edit", name="nrtelefonu_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Nrtelefonu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nrtelefonu entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Nrtelefonu entity.
    *
    * @param Nrtelefonu $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Nrtelefonu $entity)
    {
        $form = $this->createForm(new NrtelefonuType(), $entity, array(
            'action' => $this->generateUrl('nrtelefonu_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Nrtelefonu entity.
     *
     * @Route("/{id}", name="nrtelefonu_update")
     * @Method("PUT")
     * @Template("NowyBundle:Nrtelefonu:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Nrtelefonu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nrtelefonu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nrtelefonu_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Nrtelefonu entity.
     *
     * @Route("/{id}", name="nrtelefonu_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NowyBundle:Nrtelefonu')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nrtelefonu entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nrtelefonu'));
    }

    /**
     * Creates a form to delete a Nrtelefonu entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nrtelefonu_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
