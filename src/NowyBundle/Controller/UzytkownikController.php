<?php

namespace NowyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NowyBundle\Entity\Uzytkownik;
use NowyBundle\Form\UzytkownikType;

/**
 * Uzytkownik controller.
 *
 * @Route("/uzytkownik")
 */
class UzytkownikController extends Controller
{

    /**
     * Lists all Uzytkownik entities.
     *
     * @Route("/", name="uzytkownik")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NowyBundle:Uzytkownik')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Uzytkownik entity.
     *
     * @Route("/", name="uzytkownik_create")
     * @Method("POST")
     * @Template("NowyBundle:Uzytkownik:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Uzytkownik();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('uzytkownik_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Uzytkownik entity.
     *
     * @param Uzytkownik $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Uzytkownik $entity)
    {
        $form = $this->createForm(new UzytkownikType(), $entity, array(
            'action' => $this->generateUrl('uzytkownik_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Uzytkownik entity.
     *
     * @Route("/new", name="uzytkownik_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Uzytkownik();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Uzytkownik entity.
     *
     * @Route("/{id}", name="uzytkownik_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Uzytkownik')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Uzytkownik entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Uzytkownik entity.
     *
     * @Route("/{id}/edit", name="uzytkownik_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Uzytkownik')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Uzytkownik entity.');
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
    * Creates a form to edit a Uzytkownik entity.
    *
    * @param Uzytkownik $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Uzytkownik $entity)
    {
        $form = $this->createForm(new UzytkownikType(), $entity, array(
            'action' => $this->generateUrl('uzytkownik_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Uzytkownik entity.
     *
     * @Route("/{id}", name="uzytkownik_update")
     * @Method("PUT")
     * @Template("NowyBundle:Uzytkownik:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Uzytkownik')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Uzytkownik entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('uzytkownik_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Uzytkownik entity.
     *
     * @Route("/{id}", name="uzytkownik_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NowyBundle:Uzytkownik')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Uzytkownik entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('uzytkownik'));
    }

    /**
     * Creates a form to delete a Uzytkownik entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('uzytkownik_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
