<?php

namespace Cresta\AulasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CrestaAulasBundle:Default:index.html.twig', array());
    }
    
    public function acercadeAction()
    {
        return $this->render('CrestaAulasBundle:Default:acercade.html.twig', array());
    }

    public function ayudaAction()
    {
        return $this->render('CrestaAulasBundle:Default:ayuda.html.twig', array());

    }

    //funcion agregada para dump de bbdd
    public function dumpAction()
    {
        //$dbhost = 'localhost';
        //$dbname = 'symfony';
        //$dbuser = 'root';
        //$dbpass = 'root';
        $dbhost=$this->container->getParameter('database_host');
        $dbname=$this->container->getParameter('database_name');
        $dbuser=$this->container->getParameter('database_user');
        $dbpass=$this->container->getParameter('database_password');
        $fecha=new \DateTime('now');
        $fecha->format('c');
        $fechaString=string($fecha);

        $pathActual = getcwd() . '/'; //trae el path actual 
         
        $backup_file = $pathActual . 'Gestion-Aulas -' . $fecha . '.sql';
        $NombreBackup =  'Gestion-Aulas -' . $fecha . '.sql';

        //Comando a ejecutar
        $command = "mysqldump --user=$dbuser --password=$dbpass $dbname > $backup_file";

        //system($command,$sarasa);
        system($command,$output);

        if (($output =='0')){  //Si se creó con exito el BackUp
            //return $this->render('CrestaAulasBundle:Default:exitodump.html.twig', array());            
                echo "<script type='text/javascript'>
                  alert('El resguardo de la base de datos se realizo correctamente! El backup se encuentra en la carpeta Web de symfony');
                </script>";            
            return $this->render('CrestaAulasBundle:Default:acercade.html.twig', array());
            //return $this->render('CrestaAulasBundle:Reserva:index.html.twig', array());
            }                         
        else { //Si no se creó el BackUp
            //return $this->render('CrestaAulasBundle:Default:errordump.html.twig', array());
              echo "<script type='text/javascript'>
                  alert('El resguardo de la base de datos NO se realizo correctamente!');
                </script>";
            
            return $this->render('CrestaAulasBundle:Default:acercade.html.twig', array());
            //return $this->render('CrestaAulasBundle:Reserva:index.html.twig', array());
            }                         
    }
}
?>
