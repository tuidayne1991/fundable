<?
class Util{
   public function SendMail()
    {   
        $message            = new YiiMailMessage;
           //this points to the file test.php inside the view path
        $message->view = "test";
        $sid                 = 1;
        $criteria            = new CDbCriteria();
        $criteria->condition = "studentID=".$sid."";            
        $studModel1          = Student::model()->findByPk($sid);        
        $params              = array('myMail'=>1);
        $message->subject    = 'My TestSubject';
        $message->setBody($params, 'text/html');                
        $message->addTo('ctt.bk.hcmut2009@gmail.com');
        $message->from = 'tonycaovn@gmail.com';   
        Yii::app()->mail->send($message);       
    }
}
?>