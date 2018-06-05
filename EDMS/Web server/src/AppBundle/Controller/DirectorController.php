<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AcademicYear;
use AppBundle\Entity\Dormapplication;
use AppBundle\Entity\EventParticipants;
use AppBundle\Entity\Events;
use AppBundle\Entity\Files;
use AppBundle\Entity\Person;
use AppBundle\Form\academic_year_form;
use AppBundle\Form\add_assistant_form;
use AppBundle\Form\edit_profile_form;
use AppBundle\Utils\ConvertApplicationIntoStudent;
use AppBundle\Utils\SocketManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class DirectorController extends Controller
{


    private $host;
    private $port;

    /**
     * @Route("/director",name="director")
     */
    public function homepageAction(){

        /** @var Person $user */
        $user = $this->getUser();


        $em = $this->getDoctrine()->getManager();

        $leftSDB = $this->getLeftSideMenu($em);

        // show the homepage of the director

        return $this->render('@App/director_pages/index.html.twig',array(

            'title'=>"EDMS Director Roles",
            'user'=>$user,
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events']

        ));

    }


    /**
     * @Route("/director/manage/assistants", name="manage_assistants")
     * @return Response
     */
    public function showAssistantsAction(){

        $this->setPathUrl('/director/manage/assistants');


        //get the list of the assistants registered in the dormitory

        $em = $this->getDoctrine()->getManager();


        $leftSDB = $this->getLeftSideMenu($em);

        $assistants = $em->getRepository('AppBundle:Person')->getAllAssistantsList();


        return $this->render("@App/director_pages/assistant_manage.html.twig",array(
            'title'=>"Manage Assistants",
            'assistants'=>$assistants,
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events']

        ));


    }



    /**
     * @Route("/director/delete/assistant/{user_id}", name="delete_assistants")
     */
    public function deleteAssistantAction(Person $user_id){

        // open a modal to warn you if you want to delete it

        // delete an assistant

        if($user_id->getType() != 'assistant'){
            $this->addFlash('failure','An error occured while deleting the assistant');
            return $this->redirectToRoute('manage_assistants');
        }



        if($user_id->getExistOnServer()) {
            $this->addFlash('failure', 'The Student was not removed due to server connection problem. Make sure that you remove student from the server !');
            return $this->redirectToRoute('dormitory_members');
        }

        $em = $this->getDoctrine()->getManager();

        if($user_id->getRoles()[0]!="ROLE_ASSIST")
        {
            $this->addFlash('failure','There was an error while deleting the Assistant!!');
            return $this->redirectToRoute('manage_assistants');
        }


        $em->remove($user_id);
//      $em->remove($user_id->getStudentMappedEvents());

        // delete everything which the assistant is related to
        foreach ($user_id->getAssistantaddedPerformances() as $pf)
            $em->remove($pf);

        $em->flush();
        $this->addFlash('success','The assistant was deleted successfully');

        return $this->redirectToRoute('manage_assistants');

    }


    /**
     * @Route("/director/add/assistant", name="add_assistants")
     */
    public function addAssistantsAction(Request $request){

        $assistant = new Person();

        // assign to an academic semester

        $form = $this->createForm(add_assistant_form::class,$assistant);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $academic_semester = $em->getRepository('AppBundle:AcademicYear')->getNowAyear();

        if(!$academic_semester){
            $this->addFlash('failure','There is no opened academic semester !!');
            return $this->redirectToRoute('academic_year');
        }

        if($form->isSubmitted() && $form->isValid()) {


            $username = strtolower(substr($assistant->getName(), 0, 1)) . $assistant->getSurname();
            $password = "2546" . rand(5, 100) . $assistant->getName();


            $assistant->setBirthday(date('Y-m-d',$assistant->getBirthday()->getTimestamp()));

            $assistant->setRoles(['ROLE_ASSIST']);
            $assistant->setUsername($username);
            $assistant->setPassword($password);
            $assistant->setIsaccepted(true);
            $assistant->setType('assistant');
            $assistant->setExistOnServer(false);
            $assistant->setAcademicYear($academic_semester);



            if ($em->contains($assistant)) {

                $username = strtolower(substr($assistant->getName(), 0, 2)) .$assistant->getSurname();
                $assistant->setUsername($username);

                $this->addFlash("failure","The Students actually exists!!");

                return $this->redirectToRoute('manage_assistants');

            }

            try {
                $em->persist($assistant);
                $em->flush();

                $this->addFlash('success','The Assistant was added successfully');

            }catch(\Exception $e){
                $this->addFlash("failure","There was a problem in adding an assistant!");
            }


            return $this->redirectToRoute('manage_assistants');

        }


        $leftSDB = $this->getLeftSideMenu($em);


        return $this->render('@App/director_pages/assistant_add_page.html.twig',array(
            'title'=>"Add Assistants",
            'form'=>$form->createView(),
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events']

        ));

    }



    // --------------------------------------------------

    /**
     * @Route("/director/show/applications",name="applicants_show")
     */
    public function showApplicantsAction(){

        $this->setPathUrl('/director/show/applications');

        // show into the template if they were accepted or not

        $em = $this->getDoctrine()->getManager();

        $acpt_list = $em->getRepository('AppBundle:Dormapplication')
            ->getacceptedApplicants();

        $rejct_list = $em->getRepository('AppBundle:Dormapplication')
            ->getrejetedApplicants();

        $appr = $em->getRepository('AppBundle:Person')->getacceptedStudents();

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/applications_show.html.twig',array(
            'title'=>'Student Applications',
            'accepted_list'=>$acpt_list,
            'rejected_list'=>$rejct_list,
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'approved_list'=>$appr
        ));

    }

    /**
     *@Route("/director/show/info/{person}", name="show_information")
     */
    public function showDetailsAction(Person $person){

        $session  = new Session();
        $path = $session->get('prv_route');

        // return all the information related to the person

        $em = $this->getDoctrine()->getManager();
        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/info_show.html.twig',array(
            'title'=>'More Details',
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'person'=>$person,
            'back'=>$path
        ));

    }


    /**
     * @Route("/director/show/applied/info/{person}", name="show_applicants_info")
     */
    public function showApplicantsDetailsAction(Dormapplication $person){

        $session  = new Session();
        $path = $session->get('prv_route');

        // return all the information related to the person

        $em = $this->getDoctrine()->getManager();

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/info_show.html.twig',array(

            'title'=>'More Details',
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'person'=>$person,
            'back'=>$path
        ));

    }





    /**
     * @Route("/director/students/performances", name="student_performances")
     */
    public function showStudentPreformancesAction(){

        $this->setPathUrl('/director/students/performances');


        $em = $this->getDoctrine()->getManager();

        $lst = $em -> getRepository('AppBundle:Performances')->getAllStudentPerformances();


        // TODO  -> group the performances according to the student id


        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/student_performances.html.twig',array(
           'title'=> "Student",
            'performances'=>$lst,
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events']

        ));

    }


    /**
     * @Route("/director/register/member/{mem_id}",name="send_images_to_server")
     */
    public function sendImagesToEntranceSecurityAction(Person $mem_id){

//          send the image and the student name to the python server


//        accept student applications

        $this->init_connection();
        $cn = new SocketManager($this->getParameter('person_images'),$this->host,$this->port);

        if(!$cn->checkConnection()) {
            $this->addFlash('failure', 'The serve is not available! Make sure it is on !!!');
            return $this->redirectToRoute('dormitory_members');
        }



        $res  = $cn->manageStudentsToCameraServer('save',$mem_id->getName(),$mem_id->getSurname(),$mem_id->getImage());


        if($res) {
            $this->addFlash('success', 'The Student was accepted');
        }

        else{
            $this->addFlash('failure','The server could not be opened. Please check the server!!');
        }
        return $this->redirectToRoute('dormitory_members');
    }


    /**
     * @Route("/director/delete/member/{mem_id}",name="delete_images_from_server")
     */
    public function removeImagesToEntranceSecurityAction(Person $mem_id){

        //  remove student applications

        $this->init_connection();

        $cn = new SocketManager($this->getParameter('person_images'),$this->host,$this->port);

        if(!$cn->checkConnection()) {
            $this->addFlash('failure', 'The serve is not available! Make sure it is on !!!');
            return $this->redirectToRoute('applicants_show');
        }


        $res  = $cn->manageStudentsToCameraServer('remove',$mem_id->getName(),$mem_id->getSurname(),$mem_id->getImage());

        if($res) {
            $this->addFlash('success', 'The Student was accepted');
        }

        else{
            $this->addFlash('failure','The server could not be opened. Please check the server!!');
        }

        return $this->redirectToRoute('dormitory_members');

    }


    /**
     * @Route("/director/manage/applicant/{dormapplication}", name="accept_reject_applicants")
     * @return Response
     */
    public function Accept_RejectApplicantsAction(Dormapplication $dormapplication){


        $em = $this->getDoctrine()->getManager();




        if($dormapplication->isIsaccepted()){

            $dormapplication->setIsaccepted(false);

            /** @var Person $person */
            $person = $em->getRepository('AppBundle:Person')->getPerson($dormapplication->getEmail(),$dormapplication->getCardId());



            try {

                $em->remove($person);
                $em->persist($dormapplication);
                $em->flush();

                $this->addFlash('success', 'The Student was removed successfully !');

            }catch (\Exception $e) {

                $this->addFlash('failure', 'An Error occured while deleting the student !');
                return $this->redirectToRoute('applicants_show');

            }

        }
        else{

            $dormapplication->setIsaccepted(true);

            $cnv = new ConvertApplicationIntoStudent($dormapplication);

            /** @var Person $student */
            $student = $cnv->convert();

            $academic_semester = $em->getRepository('AppBundle:AcademicYear')->getNowAyear();

            if(!$academic_semester){
                $this->addFlash('failure','There is no opened academic semester !!');
                return $this->redirectToRoute('academic_year');
            }

            $student->setAcademicYear($academic_semester);
            $em->persist($student);


            try {
                $em->persist($dormapplication);
                $em->persist($student);
                $em->flush();
                $this->addFlash('success', 'The Student was accepted successfully!');

            }catch (\Exception $e){
                $this->addFlash('failure',"An Error occured!");
            }
        }



        return $this->redirectToRoute('applicants_show');

    }


    // ------------------------------------------------


    /**
     * @Route("/director/dormitory/members", name="dormitory_members")
     * @return Response
     */
    public function showAllMembers(){

        // TODO show all the lists of the dormitory members

        $this->setPathUrl('/director/dormitory/members');

        $em = $this->getDoctrine()->getManager();

        $student_list = $em->getRepository('AppBundle:Person')->getAllTheStudentMembersOFDorm();
        $staff_list = $em->getRepository('AppBundle:Person')->getAllTheStaffMembersOfDorm();
        $applicants = $em->getRepository('AppBundle:Dormapplication')->gettheNumberOFApplciants();
        $events = $em->getRepository('AppBundle:Events')->countUnoccuredEvents();

        $this->init_connection();

        $cn = new SocketManager($this->getParameter('person_images'),$this->host,$this->port);

        $server_mg = true;

        if(!$cn->checkConnection()) {
//            $this->addFlash('failure', 'The serve is not available! Make sure it is on !!!');
            $server_mg= false;
        }


        $counter = count($student_list)+count($staff_list);

        return $this->render('@App/director_pages/members_show.html.twig',array(

            'title'=>"Dormitory Members",
            'students_list'=>$student_list,
            'staff_list'=>$staff_list,
            'members'=>$counter,
            'applicants'=>$applicants,
            'events'=>$events,
            'server_ava'=>$server_mg

        ));

    }



    // ----------------------------------------------

    /**
     * @Route("/director/technical/problems", name="technical_problems")
     * @return Response
     */
    public function showTechnicalProblemsAction(){

        // TODO show all problems

        $em = $this->getDoctrine()->getManager();



        $fixed_problems = $em->getRepository('AppBundle:TechProblems')->get_fixed_DormProblems();
        $pending_problems = $em->getRepository('AppBundle:TechProblems')->get_pending_DormProblems();



        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/technical_information.html.twig',array(

            'title'=>"Technical Problems",
            'fixed_problems'=>$fixed_problems,
            "pending_problems"=>$pending_problems,
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events']

        ));

    }

    

    public function getLeftSideMenu(EntityManager $em){

        $cnt_members = $em->getRepository('AppBundle:Person')->countNrOfMembers();
        $cnt_applicants = $em->getRepository('AppBundle:Dormapplication')->gettheNumberOFApplciants();

        $events = $em->getRepository('AppBundle:Events')->countUnoccuredEvents();

        return array("applicants"=>$cnt_applicants,"members"=>$cnt_members,'events'=>$events);

    }


    /**
     * @Route("/director/events/show", name="events_show")
     */
    public function showEvents(){


        /** @var Person $user */
        $user = $this->getUser();
//        $your_events = $user->getStudentMappedEvents();

        $em = $this->getDoctrine()->getManager();

        $other_events = $em->getRepository('AppBundle:Events')->getAllNewEvents();
        $your_events = $em->getRepository('AppBundle:EventParticipants')->getEventsOfTheUserId($user->getId());

        $old_events = $em -> getRepository("AppBundle:Events")
            ->getAllOldEvents();

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/events_show_page.html.twig',array(
            'title'=>"Dormitory Events",
            'acc_events'=>$other_events,
            "your_events"=>$your_events,
            'old_events'=>$old_events,
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events']
        ));


    }



    /**
     * @Route("/director/event/participating/{ventParticiating}", name="invited_events")
     */

    public function acceptInvitation(EventParticipants $eventParticiating){

        if($eventParticiating->getisParticipating()){
            $eventParticiating->setIsParticipating(false);
        }else{
            $eventParticiating->setIsParticipating(true);
        }

        $em =  $this->getDoctrine()->getManager();
        $em->persist($eventParticiating);
        $em->flush();

        return $this->redirectToRoute('events_show');

    }


    /**
     * @Route("/director/event/{event}", name="acc_reje_events")
     */
    public function acceptEvents(Events $event){

        if($event->getisConfirmed()){
            $event->setIsConfirmed(false);
        }else{
            $event->setIsConfirmed(true);
        }

        $em =  $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();

        return $this->redirectToRoute('events_show');

    }


    /**
     * @Route("/director/print/contracts/{student_id}", name="print_contracts")
     */
    public function printContracts(Person $student_id){

        if($student_id->getType()!='student')
            return new Response("");

        $html = $this->renderView('@App/director_pages/contract.html.twig', array(
            'student'=>$student_id
        ));

//        return $this->render('@App/director_pages/contract.html.twig', array(
//            'student'=>$student_id
//        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            $student_id->getName().'.pdf'
        );

    }


    /**
     * @Route("/director/academic/year", name="academic_year")
     */
    public function showAcademicYearAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $active = $em->getRepository('AppBundle:AcademicYear')->getActiveAcademicYears();
        $inactive = $em->getRepository('AppBundle:AcademicYear')->getInactiveAcademicYears();

        // get academic years saved

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/manageAcademicYears.html.twig',array(
            'title'=>"Camera Details",
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'academic_active'=>$active,
            'academic_inactive'=>$inactive
        ));


    }

    /**
     * @Route("/director/academic/year/info/{aca}", name="academic_year_info")
     */
    public function show_info_ofAcademicYearAction(AcademicYear $aca){


        $this->setPathUrl('/director/academic/year/info/'.$aca->getId());


        $em = $this->getDoctrine()->getManager();

        $persons_lists = $aca->getMemberId();

        $staff = array();
        $students = array();


        /** @var Person $person */
        foreach ($persons_lists as $person){

            if($person->getType() === 'student')
                $students[] = $person;
            else $staff[] = $person;

        }


        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/academicYearDetailedInformation.html.twig',array(
            'title'=>"Camera Details",
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'ac'=>$aca,
            'staff'=>$staff,
            'student'=>$students
        ));

    }


    /**
     * @Route("/director/academic/year/new", name="new_academic_year")
     */
    public function add_academicYearAction(Request $request){

        $ac = new AcademicYear();
        
        $form = $this->createForm(academic_year_form::class,$ac);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $availibility = $em->getRepository('AppBundle:AcademicYear')->checkIfItisAvailable();

        if($availibility){
            $this->addFlash('failure','The Academic year '.$ac->getYear().' for '.$ac->getSemester().' actually exists for that period. !!');
            return $this->redirectToRoute('academic_year');
        }


        if($form->isSubmitted() && $form->isValid()){

            /** @var \DateTime $sdtime */
            $sdtime = $ac->getStartDate();

            /** @var \DateTime $edtime */
            $edtime = $ac->getEndDate();

            $ac->setYear(date('Y',$sdtime->getTimestamp()).'-'.date('Y',$edtime->getTimestamp()));

            $em->persist($ac);

            try {

                $em->flush();
                $this->addFlash('success','The Academic year '.$ac->getYear().' for '.$ac->getSemester().'is added. !!');

            }catch (\Exception $e){
                $this->addFlash('failure','The Academic year '.$ac->getYear().' for '.$ac->getSemester().' is not added. !!');
            }

            return $this->redirectToRoute('academic_year');

        }


        $leftSDB = $this->getLeftSideMenu($em);


        return $this->render('@App/director_pages/addAcademicYears.html.twig',array(
            'title'=>"Add Academic year",
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'form'=>$form->createView(),
        ));
    }


    /**
     * @Route("/director/academic/year/edit/{ac}", name="edit_academic_year")
     */
    public function edit_academicYearAction(AcademicYear $ac,Request $request){

        $this->setPathUrl('/director/academic/year/edit/'.$ac->getId());

        $form = $this->createForm(academic_year_form::class,$ac);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();


//        $availibility = $em->getRepository('AppBundle:AcademicYear')->checkIfItisAvailable();
        /** @var AcademicYear $availibility */
        $availibility = $em->getRepository('AppBundle:AcademicYear')->getNowAyear();

        if(!$availibility){
            $this->addFlash('failure','The Academic year '.$ac->getYear().' for '.$ac->getSemester().' actually exists for that period. !!');
            return $this->redirectToRoute('academic_year');
        }

        if( $ac->getId() != $availibility->getId()){
            $this->addFlash('failure','The Academic year '.$ac->getYear().' for '.$ac->getSemester().' actually exists for that period. !!');
            return $this->redirectToRoute('academic_year');
        }


        if($form->isSubmitted() && $form->isValid()){

            /** @var \DateTime $sdtime */
            $sdtime = $ac->getStartDate();

            /** @var \DateTime $edtime */
            $edtime = $ac->getEndDate();

            $ac->setYear(date('Y',$sdtime->getTimestamp()).'-'.date('Y',$edtime->getTimestamp()));

            $em->persist($ac);

            try {
                $em->flush();
                $this->addFlash('success','The Academic year '.$ac->getYear().' for '.$ac->getSemester().'is saved. !!');
            }catch (\Exception $e){
                $this->addFlash('failure','The Academic year '.$ac->getYear().' for '.$ac->getSemester().'is not saved. !!');
            }
            return $this->redirectToRoute('academic_year');
        }

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/addAcademicYears.html.twig',array(
            'title'=>"Edit Academic year",
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'form'=>$form->createView()
        ));

    }


    /**
     * @Route("/director/profile.html.twig/show", name="director_show_profile")
     */
    public function showProfileAction(){

        /** @var Person $user */
        $user =  $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/profile_show.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
        ));

    }


    /**
     * @Route("/director/profile.html.twig/edit", name="director_edit_profile")
     */
    public function editProfileAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        /** @var Person $user */
        $user =  $this->getUser();

        $user =  $em->getRepository('AppBundle:Person')->getPerson($user->getEmail(),$user->getCardId());

        $form = $this->createForm(edit_profile_form::class,$user,array(
            'image_path'=>$this->getParameter('person_images')
        ));



        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            try {


                $file = $form['image']->getData();

                if ($file) {

                    if (file_exists($this->getParameter('person_images') . '/' . $user->getImage()))
                        unlink($this->getParameter('person_images') . '/' . $user->getImage());

                    $file_name = $this->generateUniqueFileName() . "." . $file->guessExtension();
                    $file->move($this->getParameter('person_images'), $file_name);

                    $user->setImage($file_name);

                }
            }catch (\Exception $e){}

            try {
                $em->persist($user);
                $em->flush();

                $this->addFlash('success','The profile.html.twig updated successfully!!');
            }catch (\Exception $e){
                $this->addFlash('failure','The profile.html.twig was not updated!!');
            }


            return $this->redirectToRoute('director_show_profile');

        }



        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/profile_edit.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'form'=>$form->createView(),
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
        ));

    }



    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }



    private function setPathUrl($url){
        $session  = new Session();
        $session->set('prv_route','/web/app.php'.$url);
    }


    private function init_connection()
    {
        $this->host = $this->getParameter('socket_host');
        $this->port = $this->getParameter('socket_port');
    }



}
