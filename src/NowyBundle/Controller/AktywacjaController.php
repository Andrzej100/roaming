<?php

namespace NowyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use NowyBundle\Entity\Aktywacja;
use NowyBundle\Form\AktywacjaType;

/**
 * Aktywacja controller.
 *
 * @Route("/aktywacja")
 */
class AktywacjaController extends Controller
{

    /**
     * Lists all Aktywacja entities.
     *
     * @Route("/", name="aktywacja")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NowyBundle:Aktywacja')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Aktywacja entity.
     *
     * @Route("/", name="aktywacja_create")
     * @Method("POST")
     * @Template("NowyBundle:Aktywacja:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Aktywacja();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aktywacja_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Aktywacja entity.
     *
     * @param Aktywacja $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Aktywacja $entity)
    {
        $form = $this->createForm(new AktywacjaType(), $entity, array(
            'action' => $this->generateUrl('aktywacja_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Aktywacja entity.
     *
     * @Route("/new", name="aktywacja_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Aktywacja();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Aktywacja entity.
     *
     * @Route("/{id}/{mod}", defaults={"mod"=0} , name="aktywacja_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id,$mod = 0)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Aktywacja')->find($id);
        $komunikat=' ';
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aktywacja entity.');
        }
        elseif($mod=='2'){
            $entity->setAktywacja(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $komunikat="Dezaktywowano pakiet";
        }
        elseif($mod=='1'){
                $date=$entity->getDo();
                $aktywacja=$entity->getAktywacja();
                if($aktywacja==null){
                    $aktywacja=$entity->setAktywacja(new \DateTime());
                }else{
                $date->modify('+28 day');
                $entity->setDo(new \DateTime($date->format("Y/m/d H:i:s")));}
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $komunikat="Aktywowano";
            }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'message'=>$komunikat,
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Aktywacja entity.
     *
     * @Route("/{id}/edit", name="aktywacja_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Aktywacja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aktywacja entity.');
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
    * Creates a form to edit a Aktywacja entity.
    *
    * @param Aktywacja $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Aktywacja $entity)
    {
        $form = $this->createForm(new AktywacjaType(), $entity, array(
            'action' => $this->generateUrl('aktywacja_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Aktywacja entity.
     *
     * @Route("/{id}", name="aktywacja_update")
     * @Method("PUT")
     * @Template("NowyBundle:Aktywacja:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NowyBundle:Aktywacja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aktywacja entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('aktywacja_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Aktywacja entity.
     *
     * @Route("/{id}", name="aktywacja_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NowyBundle:Aktywacja')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aktywacja entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aktywacja'));
    }

    /**
     * Creates a form to delete a Aktywacja entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aktywacja_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
